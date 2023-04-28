import React, { useEffect, useState } from 'react';
import axios from 'axios';
import {useCookies} from 'react-cookie';
import { param } from 'jquery';

const Fire_Sale = () => {

    const [items, setItems] = useState([]);
    const [cartItems, setCartItems] = useState([]);
    const [cartItems2, setCartItems2] = useState([]);
    const [cookies, setCookie] = useCookies(['fire_items']);

    function addItemsCookie(item_name) { 
        axios.get("http://localhost:8000/getItemID.php", {params: {name: item_name}}).then((response) => {
            let cart = [];
            if (cookies.fire_items && cookies.fire_items.length > 0) {
                cart = cookies.fire_items;
              }
            cart.push(response.data);
            setCookie("fire_items", cart, {path: '/'});
        });
    }

    useEffect(() => {
        axios.get("http://localhost:8000/getSaleItems.php").then((response) => {
            setItems(response.data);
        });
    }, []);
    
    useEffect(() => {
        setCartItems([]);
        if (cookies.fire_items && cookies.fire_items.length > 0) {
            axios.get("http://localhost:8000/getItemForCart.php", {params: {sale_item:JSON.stringify(cookies.fire_items)}}).then((response) => {
                setCartItems(response.data);
                // calculateTotal();
            });
        }
    }, []);

    useEffect(() => {
        axios.get("http://localhost:8000/calculateTotal.php", {params: {sale_item:JSON.stringify(cookies.fire_items), items:JSON.stringify(cookies.items)}}).then((response) => {
            console.log("x: ", response.data);
            let results = response.data;
            let price = results.reduce((total, currentItem) => total = total + Number(currentItem),0);
            var cart_total = document.getElementById("cart_total");
            cart_total.innerHTML = parseFloat(price).toFixed(2);
        });
    },[])

    // useEffect(() => {
    //     axios.get("http://localhost:8000/getItemForCart.php", {params: {sale_item:JSON.stringify(cookies.fire_items)}}).then((response) => {
    //         let results = response.data;
    //         console.log("SaleCart:", response.data);
    //         let price = results.reduce((total, currentItem) => total = total + Number(currentItem.sale_price), 0);
    //         var cart_total = document.getElementById("cart_total");
    //         cart_total.innerHTML = parseFloat(price).toFixed(2);
    //     });
    // },[])

    // Added from Index.js

    useEffect(() => {
        setCartItems([]);
        if (cookies.items && cookies.items.length > 0) {
            axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
                setCartItems2(response.data);
            });
        }
    }, []);

    // End of index.js add

    useEffect(() => {
        document.body.style.backgroundImage = 'linear-gradient(#b85653, #b09858)';
        document.body.style.backgroundAttachment = 'fixed';
    });

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        var linebreak = document.createElement("br");
        var data = ev.dataTransfer.getData("text");
        var item = document.getElementById("item_" + data);
        var item_price = document.getElementById("price_" + data);
        ev.preventDefault();
        ev.target.append(item.innerHTML + " - $" + item_price.innerHTML);
        ev.target.appendChild(linebreak);

        var cart_total = document.getElementById("cart_total");
        var price = Number(item_price.innerHTML);

        try {
            cart_total.innerHTML = Number(cart_total.innerHTML) + price;
        }
        catch {
            cart_total.innerHTML = price;
        }
        
        addItemsCookie(item.innerHTML);
    }

    return(
        <div className="container" >
            <div className="row">
                <h3 className="mt-4">Smart Customer Services</h3>
                <h6>Drag an item to add it to your shopping cart</h6>
            </div>
            <div className="row mt-4 mb-5">
                <div className="col-md-9">
                    {items.map((item, index) => (
                        <div className="card card_container mb-4">
                            <img id={index} src={require(`../static/img/${item.image_name}`)} draggable="true" onDragStart={event => drag(event)} />
                            <hr />
                            <h5 id={"item_" + index}>{item.item_name}</h5>
                            <p id={"price_" + index}>{item.sale_price}</p>
                        </div>
                    ))}
                </div>
                <div className="col-md-3">
                    <div id="shopping_cart" onDrop={event => drop(event)} onDragOver={event => allowDrop(event)}>
                        <h5 className="mt-3">Your Shopping Cart</h5>
                        <span>Current subtotal: $</span>
                        <span id="cart_total"></span>
                        <br />
                        <hr />
                        {cartItems2.map((item) => (
                            <p>{item["item_name"]} - ${item["item_price"]}</p>
                        ))}
                        {cartItems.map((item) => (
                            <p style={{color:"#45b322"}}>{item["item_name"]} - ${item["sale_price"]}</p>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Fire_Sale;