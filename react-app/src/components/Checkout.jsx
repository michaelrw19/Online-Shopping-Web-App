import React, { useEffect, useRef, useState } from 'react';
import {useCookies} from 'react-cookie';
import axios from 'axios';
import { Link } from "react-router-dom";

// ------------------------- Kevin import for map -------------------------

import {useJsApiLoader, GoogleMap, DirectionsRenderer} from '@react-google-maps/api';

// ------------------------- ------------------------- -------------------------

var data = [
    {
        payment: "new",
        card_num: "",
        card_name: "",
        card_expiry: "",
        cvv: "",

        address_1: "",
        address_2: "",
        city: "",
        region: "",
        country: "",
        postal_code: "",
        branch: ""
    }
]

// ------------------------- Kevin constants for map -------------------------

const center = { lat: 59.105890, lng: -102.005848}
const provinces = ["","Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador","Northwest Territories", "Nunavut","Ontario","Prince Edward Island", "Quebec", "Saskatchewan", "Yukon"]
const branch = ["", "Yorkdale", "Eatons", "Dufferin Mall"]
const libraries = ['places'];

// ------------------------- End -------------------------


const Checkout = () => {
    const handleChange = event => {
        data[0][event.target.name] = event.target.value;
        // console.log(data[0]);
    }

    const [cookies, setCookie] = useCookies();
    const [cartItems, setCartItems] = useState([]);
    const [cartSaleItems, setSaleItems] = useState([]);
    const [total, calculateTotal] = useState([]);
    const [cards, setExistingCards] = useState([]);
        
    const handleClick = event => {
        let enable = data[0]['address_1'].length > 0 && data[0]['city'].length > 0 && data[0]['region'].length > 0 && data[0]['country'].length > 0 && data[0]['postal_code'].length > 5;
        let payment_enable = true;
        if (data[0]['payment'] === "new"){
            payment_enable = data[0]['card_num'].length > 15 && data[0]['card_name'].length > 0 && data[0]['card_expiry'].length > 4 && data[0]['cvv'].length > 2;
        }
        // console.log(enable);
        // console.log(payment_enable);
        let fullEnable = enable && payment_enable;
        if(!fullEnable) {
            event.preventDefault();
        }
        else{

        }
    }
    
    // useEffect(() => {
    //     axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
    //         let results = response.data;
    //         console.log(results);
    //         let price = results.reduce((total, currentItem) => total = total + Number(currentItem.item_price), 0);
    //         var items = document.getElementById("items");
    //         items.innerHTML = results.length;
    //         var cart_total = document.getElementById("price");
    //         console.log(price)
    //         cart_total.innerHTML = parseFloat(price).toFixed(2);
    //     });
    // },[])

    useEffect(() => {
        setCartItems([]);
        if (cookies.items && cookies.items.length > 0) {
            // console.log(cookies.user);
            axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
                setCartItems(response.data);
                // console.log(JSON.stringify(cookies.items));
                // console.log(response.data);
            });
        }
    }, []);
    
    useEffect(() =>{
        axios.get("http://localhost:8000/getExistingCards.php", {params: {user_id: cookies.user}}).then((response) => {
            // console.log(response.data);
            if (response.data.length > 0){
                setExistingCards(response.data);
            }
            else{
                setExistingCards([]);
            }
        });
    }, []);

    // ------------------------- Kevin Cart effects -------------------------

	
    useEffect(() => {
        if (cookies.fire_items && cookies.fire_items.length > 0) {
            axios.get("http://localhost:8000/getItemForCart.php", {params: {sale_item:JSON.stringify(cookies.fire_items)}}).then((response) => {
                setSaleItems(response.data);
                // calculateTotal();
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

    // Kevin end

    // ------------------------- KEVIN MAP constants -------------------------

    const [map, setMap] = useState(/** @type google.maps.Map */ (null))
    const [directionsResponse, setDirectionsResponse] = useState(null)
    const isFirstRender = useRef(true)
    const firstRender = useRef(true)
    const [selectedCity, setCity] = useState(null)
    const [selectedAddress, setAddress] = useState(null)
    const [selectedBranch, setBranch] = useState(branch[0])
    const [selectedProvince, setProvince] = useState(provinces[0])

    const { isLoaded } = useJsApiLoader({
        googleMapsApiKey: process.env.REACT_APP_GOOGLE_MAPS_API_KEY,
        libraries,
    })

    // ------------------------- Rerender map on province or branch chagne -------------------------

    useEffect(() => {
        if (isFirstRender.current) {
            isFirstRender.current = false
            return;
        }
        panMapProvince(map)
    }, [selectedProvince]) // Every time province is changed, it rerenders the map

    useEffect(() => {
        if(firstRender.current){
            firstRender.current = false;
            return;
        }
        generatePath();
    }, [selectedBranch]) // Ideally anytime the branch is changed the route should be rerendered.

    // ------------------------- Functions called by input -------------------------

    const changeProvince = event => {
        data[0][event.target.name] = event.target.value;
        setProvince(event.target.value)
        panMapProvince(map)
    }

    const changeCity = event => {
        data[0][event.target.name] = event.target.value;
        setCity(event.target.value)
        panMapCity(map)
    }

    const changeAddress = event => {
        data[0][event.target.name] = event.target.value;
        setAddress(event.target.value)
        panMapAddress(map)
    }

    const changeBranch = event =>{
        data[0][event.target.name] = event.target.value;
        setBranch(event.target.value)
    }

    // ------------------------- Functions called by Functions -------------------------

    function returnGeolocation(){
        if(selectedBranch == "Yorkdale"){
            return "PGGX+54 Toronto, Ontario"
        }else if(selectedBranch == "Eatons"){
            return "MJ39+QP Toronto, Ontario"
        }else if(selectedBranch == "Dufferin Mall"){
            return "MH47+8P Toronto, Ontario"
        }
    }

    async function panMapProvince(map){
        const geocoder = new window.google.maps.Geocoder()
        geocoder.geocode({address: selectedProvince}).then((response) => {
            if(response.results[0]){
                var theJson = JSON.parse(JSON.stringify(response, null, 2));
                map.panTo({lat: theJson.results[0].geometry.location.lat, lng: theJson.results[0].geometry.location.lng });
                map.setZoom(5);
            }else{
                window.alert("No results found");
            }});
    }

    function panMapCity(map){
        var geocoder = new window.google.maps.Geocoder();
        geocoder.geocode({address: selectedCity}).then((response) => {
            if(response.results[0]){
                var theJson = JSON.parse(JSON.stringify(response, null, 2));
                map.panTo({lat: theJson.results[0].geometry.location.lat, lng: theJson.results[0].geometry.location.lng });
                map.setZoom(11);
            }else{
                window.alert("No results found");
            }
        });
    }

    function panMapAddress(map){
        const geocoder = new window.google.maps.Geocoder();  
        geocoder.geocode({address: `${selectedCity} ${selectedAddress}`}).then((response) => {
          if(response.results[0]){
            var theJson = JSON.parse(JSON.stringify(response, null, 2));
            map.panTo({lat: theJson.results[0].geometry.location.lat, lng: theJson.results[0].geometry.location.lng });
            map.setZoom(14);
          }else{
            window.alert("No results found");
          }
        });
    }

    async function generatePath(){
        const directionsService = new window.google.maps.DirectionsService()
        const results = await directionsService.route({
            origin: returnGeolocation(),
            destination: `${selectedCity} ${selectedAddress}`,
            travelMode: window.google.maps.TravelMode.DRIVING
        })
        setDirectionsResponse(results);
        console.log(map)
    }

    if(!isLoaded){
        return <div>Error Loading</div>
    }

    // ------------------------- ------------------------- ------------------------- ------------------------- -------------------------

    return (
        <div class="container">
            <div class="row mt-4">
                <h3>Checkout</h3>
                <h6>Final steps to complete your order</h6>
            </div>
            <hr></hr>
            <div class="row">
                <div class = "col-md-1">
                </div>
                <div class = "col-md-6 text-start">
                    <form >
                        {cards.map((card, index) => (
                            <div class="container">
                                <input type="radio" id={index} name="payment" value={card.payment_id} onChange={handleChange}/>
                                <label for={index}>
                                    <div class="card" style={{padding:"10px"}}> ************ {card.card_number.substring(12)}
                                    <br/> {card.cardholder_name} | {card.expiration_date.substring(5,7)}/{card.expiration_date.substring(2, 4)}
                                    </div>
                                </label>
                                <br/>
                            </div>
                        ))}
                        <input type="radio" id="new" name = "payment" value = "new" onChange={handleChange}/>
                        <label for="new">
                            <div class="card text-start" style={{padding:'10px'}}>
                            Card Number: * <input type="text" name="card_num" style={{width: "450px"}} onChange={handleChange} maxLength="16"></input>
                            Name: * <input type="text" name="card_name" style={{width:"150px"}} onChange={handleChange}></input>
                            Expiry Date: (MM/YY) * <input type="text" name="card_expiry" style={{width:"100px"}} onChange={handleChange} maxLength="5"></input>
                            CVV: * <input type="text" name="cvv" style={{width:"50px"}} onChange={handleChange} maxLength="3"></input>
                            </div>
                        </label>
                        <br/>* Required for new cards
                        <br/>
                        <hr/>
                        <p><b>Shipping Details</b></p>
                        {/* <div class="card" style={{padding:"10px"}}>
                            Address Line 1: * <input type="text" name="address_1" onChange={handleChange} required></input>
                            Address Line 2: <input type="text" name="address_2" onChange={handleChange}></input>
                            City: * <input type="text" name="city" style={{width:"150px"}} onChange={handleChange} required></input>
                            Province/State: * <input type="text" name="region" style={{width:"150px"}} onChange={handleChange} required></input>
                            Country: * <input type="text" name="country" style={{width:"150px"}} onChange={handleChange} required></input>
                            Postal Code (XXXXXX): * <input type="text" name="postal_code" style={{width:"150px"}} onChange={handleChange} maxLength="6" required></input>
                        </div> */}
                        <div class="card" style={{padding:"10px"}}>
                            Country: * <input type="text" name="country" style={{width:"150px"}} onChange={handleChange} required></input>
                            Province: * 
                            <select name="region" id="region" value={selectedProvince} onChange={changeProvince}>
                                {provinces.map((value) => (
                                    <option value={value} key={value}>
                                        {value}
                                    </option>
                                ))}
                            </select>
                            City: * <input type="text" name="city" style={{width:"150px"}} onChange={changeCity} required></input>
                            Address Line 1: * <input type="text" name="address_1" onChange={changeAddress} required></input>
                            Address Line 2: <input type="text" name="address_2" onChange={handleChange}></input>
                            Postal Code (XXXXXX): * <input type="text" name="postal_code" style={{width:"150px"}} onChange={handleChange} maxLength="6" required></input>
                            Branch:
                            <select name="branch" id="branch" value={selectedBranch} onChange={changeBranch}>
                                {branch.map((value) => (
                                    <option value={value} key={value}>
                                        {value}
                                    </option>
                                ))}
                            </select>
                        </div>
                        * required fields
                        <hr/><Link to='/review_order' state={{data:data}} style={{ color: '#000', textDecoration: 'none' }} onClick={handleClick}>
                            <button class="bg-light text-dark">Place Order</button>
                            </Link>
                    </form>
                    <hr/><br/>
                </div>
                <div class = "col-md-1">
                </div>
                <div class = "col">
                    <div class= "row">
                        <div id="total" class="col-sm-9 p-3 mb-2 mr-2 bg-dark text-light"><span id="items">0</span> Items <hr/> Total: $<span id="price">0</span><hr/>
                            {cartItems.map((item,index) => (
                                <div class="col-sm-12 p-3 mb-2 bg-light text-dark text-start">
                                <p><img id={index} src={require(`../static/img/${item.image_name}`)} height="50px" />    {item.item_name} - ${item.item_price}</p>
                                </div>
                            ))}
                            {cartSaleItems.map((item,index) => (
                                <div class="col-sm-12 p-3 mb-2 bg-light text-dark text-start">
                                    <p><img id={index} src={require(`../static/img/${item.image_name}`)} height="50px" />    {item.item_name} - ${item.sale_price}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
            <div style={{width:"100%" ,height:"500px"}}>
                <GoogleMap center={center} zoom={3} mapContainerStyle={{width:'100%', height:'100%'}} onLoad={map => setMap(map)}>
                    {directionsResponse && (<DirectionsRenderer directions={directionsResponse} />)}
                </GoogleMap> 
            </div><hr/><br/><br/>
        </div>
    );
}

export default Checkout;