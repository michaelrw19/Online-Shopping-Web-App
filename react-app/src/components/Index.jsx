import React, { useEffect, useState } from 'react';
import axios from 'axios';
import {useCookies} from 'react-cookie';

const Index = () => {
    const [items, setItems] = useState([]);
    const [cartItems, setCartItems] = useState([]);
    const [cartSaleItems, setCartSaleItems] = useState([]);
    const [total, calculateTotal] = useState([])
    const [cookies, setCookie] = useCookies(['items']);

    function addItemsCookie(item_name) { 
        axios.get("http://localhost:8000/getItemID.php", {params: {name: item_name}}).then((response) => {
            let cart = [];
            if (cookies.items && cookies.items.length > 0) {
                cart = cookies.items;
              }
            cart.push(response.data);
            setCookie("items", cart, {path: '/'});
        });
    }
    useEffect(() => {
        axios.get("http://localhost:8000/getItems.php").then((response) => {
            setItems(response.data);
        });
    }, []);
    
    // useEffect(() => {
    //     axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
    //         let results = response.data;
    //         console.log("Getting cart items array: ", results);
    //         let price = results.reduce((total, currentItem) => total = total + Number(currentItem.item_price), 0);
    //         var cart_total = document.getElementById("cart_total");
    //         console.log("Price total: ", price)
    //         cart_total.innerHTML = parseFloat(price).toFixed(2);
    //     });
    // },[])
    
    useEffect(() => {
        setCartItems([]);
        if (cookies.items && cookies.items.length > 0) {
            axios.get("http://localhost:8000/getCartItems.php", {params: {items: JSON.stringify(cookies.items)}}).then((response) => {
                setCartItems(response.data);
                calculateTotal();
            });
        }
    }, []);

    {/* Kevin added  */}

    useEffect(() => {
        setCartItems([]);
        if (cookies.fire_items && cookies.fire_items.length > 0) {
            axios.get("http://localhost:8000/getItemForCart.php", {params: {sale_item:JSON.stringify(cookies.fire_items)}}).then((response) => {
                setCartSaleItems(response.data);
                // calculateTotal();
            });
        }
    }, []);

    useEffect(() => {
        axios.get("http://localhost:8000/calculateTotal.php", {params: {sale_item:JSON.stringify(cookies.fire_items), items:JSON.stringify(cookies.items)}}).then((response) => {
            let results = response.data;
            let price = results.reduce((total, currentItem) => total = total + Number(currentItem),0);
            var cart_total = document.getElementById("cart_total");
            cart_total.innerHTML = parseFloat(price).toFixed(2);
        });
    },[])

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
        //cookie contains item_ids
        // $.ajax({
        //     url: 'setCookie.php',
        //     type: 'GET',
        //     data: { name: item.innerHTML }
        // });
    }
    
    return (
        <div class="container">
            <div class="row">
                <h3 class="mt-4">Smart Customer Services</h3>
                <h6>Drag an item to add it to your shopping cart</h6>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-md-9">
                    {items.map((item, index) => (
                        <div class="card card_container mb-4">
                            <img id={index} src={require(`../static/img/${item.image_name}`)} draggable="true" onDragStart={event => drag(event)} />
                            <hr />
                            <h5 id={"item_" + index}>{item.item_name}</h5>
                            <p id={"price_" + index}>{item.item_price}</p>
                        </div>
                    ))}
                </div>
                <div class="col-md-3">
                    <div id="shopping_cart" onDrop={event => drop(event)} onDragOver={event => allowDrop(event)}>
                        <h5 class="mt-3">Your Shopping Cart</h5>
                        <span>Current subtotal: $</span>
                        <span id="cart_total"></span>
                        <br />
                        <hr />
                        {cartItems.map((item,index) => (
                            <p>{item.item_name} - ${item.item_price}</p>
                        ))}
                        {cartSaleItems.map((item,index) => (
                            <p style={{color:"#45b322"}}>{item.item_name} - ${item.sale_price}</p>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Index;