import React, {useRef, useEffect, useState } from 'react';
import shirt from '../static/img/shirt.jpg';
import {useCookies} from 'react-cookie';
import axios from 'axios';
import { useLocation } from 'react-router-dom'

// ------------------------- Kevin import for map -------------------------

import {useJsApiLoader, GoogleMap, DirectionsRenderer} from '@react-google-maps/api';

// ------------------------- Kevin constants for map -------------------------

const center = { lat: 59.105890, lng: -102.005848}
const provinces = ["","Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador","Northwest Territories", "Nunavut","Ontario","Prince Edward Island", "Quebec", "Saskatchewan", "Yukon"]
const branch = ["", "Yorkdale", "Eatons", "Dufferin Mall"]
const libraries = ['places'];

const Review_order = () => {
    const location = useLocation();
    const {data} = location.state;
    const info = data[0];

    const [cookies, setCookie] = useCookies();
    const [cartItems, setCartItems] = useState([]);
    const [total, calculateTotal] = useState([])
    const [payment, setPayment] = useState([]);
    const [order_id, setOrderId] = useState([]);
    const [cartSaleItems, setSaleItems] = useState([]);
    const dataFetchedRef = useRef(false);

    // useEffect(() => {
    //     axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
    //         let results = response.data;
    //         console.log(results);
    //         let price = results.reduce((total, currentItem) => total = total + Number(currentItem.item_price), 0);
    //         var items = document.getElementById("items");
    //         items.innerHTML = results.length;
    //         var cart_total = document.getElementById("price");
    //         console.log(price)
    //         calculateTotal(price);
    //         console.log(total);
    //         cart_total.innerHTML = parseFloat(price).toFixed(2);
    //     });
    // },[])

    useEffect(() => {
        axios.get("http://localhost:8000/addPayment.php", {params: {info: JSON.stringify(info), user: cookies.user}}).then((response) => {
            // console.log(JSON.stringify(info));
            // console.log(response.data);
            setPayment(response.data);
        });
    },[])

    useEffect(() => {
        if (dataFetchedRef.current) return;
        dataFetchedRef.current = true;
        axios.get("http://localhost:8000/getCartItems.php", {params: {sale_item:JSON.stringify(cookies.fire_items), items: JSON.stringify(cookies.items)}}).then((response) => {
            let results = response.data;
            let price = results.reduce((total, currentItem) => total = total + Number(currentItem.item_price), 0);
            // console.log(price);
            // console.log(info['payment']);
            // console.log(cookies.user);
            axios.get("http://localhost:8000/submitOrder.php", {params: {total: price, user: cookies.user, payment_id: info['payment'], payment: info['card_num'], postal: info['postal_code'], items: cookies.items, items_sale: cookies.fire_items}}).then((response) => {
                console.log(response.data);
                setOrderId(response.data);
            });
        });
    }, [])

    useEffect(() => {
        axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
            setCartItems(response.data);
            // console.log(JSON.stringify(cookies.items));
            // console.log(response.data);
            setCookie("items", [], {path: '/'});
        });
    }, []);

    // ------------------------- Kevin Cart effects -------------------------

	
    useEffect(() => {
        if (cookies.fire_items && cookies.fire_items.length > 0) {
            axios.get("http://localhost:8000/getItemForCart.php", {params: {sale_item:JSON.stringify(cookies.fire_items)}}).then((response) => {
                setSaleItems(response.data);
                // calculateTotal();
                setCookie("fire_items", [], {path: '/'});
            });
        }
    }, []);
    useEffect(() => {
        axios.get("http://localhost:8000/calculateTotal.php", {params: {sale_item:JSON.stringify(cookies.fire_items), items:JSON.stringify(cookies.items)}}).then((response) => {
            // console.log("x: ", response.data);
            let results = response.data;
            let price = results.reduce((total, currentItem) => total = total + Number(currentItem),0);
            var items = document.getElementById("items");
            items.innerHTML = results.length;
            var cart_total = document.getElementById("price");
            cart_total.innerHTML = parseFloat(price).toFixed(2);
        });
    },[])

    // Kevin Cart end

    // ------------------------- KEVIN MAP constants -------------------------

    const [map, setMap] = useState(/** @type google.maps.Map */ (null))
    const [directionsResponse, setDirectionsResponse] = useState(null)

    const { isLoaded } = useJsApiLoader({
        googleMapsApiKey: process.env.REACT_APP_GOOGLE_MAPS_API_KEY,
        libraries,
    })

    // ------------------------- Functions called by Functions -------------------------

    function returnGeolocation(branch){
        if(branch == "Yorkdale"){
            return "PGGX+54 Toronto, Ontario"
        }else if(branch == "Eatons"){
            return "MJ39+QP Toronto, Ontario"
        }else if(branch == "Dufferin Mall"){
            return "MH47+8P Toronto, Ontario"
        }
    }

    async function generatePath(){
        console.log("---------------------------")
        console.log(info['branch']);
        console.log(info['address_1']);
        console.log(info['ciy']);
        const directionsService = new window.google.maps.DirectionsService()
        const results = await directionsService.route({
            origin: returnGeolocation(info['branch']),
            destination: `${info['city']} ${info['address_1']}`,
            travelMode: window.google.maps.TravelMode.DRIVING
        })
        setDirectionsResponse(results);
        console.log(map)
    }

    if(!isLoaded){
        return <div>Error Loading</div>
    }

    return (
        <div class="container">
            <div class="row mt-4">
                <h3>Your order has been sent!</h3>
                <h6>Your order number is #{order_id}</h6>
            </div>
            <div class="row mt-4">
                <div class="col-1">
                </div>
                <hr/>
                <div class="col-12 text-start">
                    <b>Order Details:</b>
                    <hr/>
                    <div class="row p-3 mb-2 mr-2 bg-dark text-light">
                        Payment Method:
                        <br/>{payment}
                        <hr/>Shipping to: <br/>
                        <br/>{info['address_2']} {info['address_1']}
                        <br/>{info['city']}
                        <br/>{info['region']}
                        <br/>{info['country']}
                        <br/>{info['postal_code']}
                        <br/> <br/>Shipping From: <br/>
                        <br/>{info['branch']}
                    </div>
                    <div class="container">
                        <div class="row">
                            <div id="total" class="col-sm-12 p-3 mb-2 bg-dark text-light text-start"><span id="items">0</span> Items | Total: $<span id="price">0</span></div>
                        </div>
                        {cartItems.map((item,index) => (
                            <div class="col-sm-12 p-3 mb-2 bg-light text-dark text-start">
                                <p><img id={index} src={require(`../static/img/${item.image_name}`)} height="50px" />    {item.item_name} - ${item.item_price}</p>
                            </div>
                        ))}
                        {cartSaleItems.map((item,index) => (
                            <div class="col-sm-12 p-3 mb-2 bg-light text-dark text-start">
                                <p style={{color:"#45b322"}}><img id={index} src={require(`../static/img/${item.image_name}`)} height="50px" />    {item.item_name} - ${item.sale_price}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
            <div style={{width:"100%" ,height:"500px"}}>
                <GoogleMap center={center} zoom={3} mapContainerStyle={{width:'100%', height:'100%'}} onLoad={generatePath}>
                    {<DirectionsRenderer directions={directionsResponse} />}
                </GoogleMap> 
            </div><hr/><br/><br/>
        </div>
    );
}

export default Review_order;