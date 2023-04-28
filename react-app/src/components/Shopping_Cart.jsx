import React, { useEffect, useState } from 'react';
import shirt from '../static/img/shirt.jpg';
import {useCookies} from 'react-cookie';
import axios from 'axios';
import { Link } from "react-router-dom";

const Shopping_Cart = () => {
    const [cookies, setCookie] = useCookies(['items']);
    const [cartItems, setCartItems] = useState([]);
    const [cartSaleItems, setSaleItems] = useState([]);
    const [total, calculateTotal] = useState([])

    const handleClick = event => {
        let enable = cookies.items.length > 0;
        if(!enable) {
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
        axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
            setCartItems(response.data);
            console.log(JSON.stringify(cookies.items));
            console.log(response.data);
        });
    }, []);

    // Kevin added

	
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
            console.log("x: ", response.data);
            let results = response.data;
            let price = results.reduce((total, currentItem) => total = total + Number(currentItem),0);
            var items = document.getElementById("items");
            items.innerHTML = results.length;
            var cart_total = document.getElementById("price");
            cart_total.innerHTML = parseFloat(price).toFixed(2);
        });
    },[])


    // Kevin end


    return (
        <div class="container">
            <div class="row mt-4">
                <h3>Shopping Cart</h3>
                <h6>View your current shopping cart</h6>
            </div>
            <div class="container">
                <div class="row">
                    <div id="total" class="col-sm-10 p-3 mb-2 bg-dark text-light text-start"><span id="items">0</span> Items | Total: $<span id="price">0</span></div>
                    <Link to={'/checkout'} style={{ color: '#FFF', textDecoration: 'none' }} class="col p-2"><button class="btn btn-secondary" onClick={handleClick}>Checkout</button></Link>
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
    );
}

export default Shopping_Cart;