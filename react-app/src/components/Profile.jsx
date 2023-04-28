import React, { useEffect, useState } from 'react';
import {useCookies} from 'react-cookie';
import axios from 'axios';
import { each } from 'jquery';

const Profile = () => {
    const [orders, setOrders] = useState([]);
    const [cookies, setCookie] = useCookies();
    const [items, setItems] = useState([]);

    useEffect(() => {
        axios.get("http://localhost:8000/getOrders.php", {params: {id: cookies.user, criteria: ""}}).then((response) => {
            if(response.data === ""){
                setOrders([]);
            }
            else {
                setOrders(response.data);
            }
        })
    },[]);

    useEffect(() => {
        axios.get("http://localhost:8000/getItemsForOrder.php", {params: {user: cookies.user}}).then((response) => {
            console.log(response.data)
            if(response.data === ""){
                setItems([]);
            }
            else {
                let item = {}
                for (let i = 0; i < response.data.length; i++){
                    if (item[response.data[i]['order_id']] == undefined){
                        item[response.data[i]['order_id']] = response.data[i]['num'] + "x " + response.data[i]['item_name'] + "\n"
                    }
                    else{
                        item[response.data[i]['order_id']] = item[response.data[i]['order_id']] + response.data[i]['num'] + "x " + response.data[i]['item_name'] + "\n"
                    }
                }
                setItems(item);
            }
        })
    },[]);

    const handleChange = event => {
        axios.get("http://localhost:8000/getOrders.php", {params: {id: cookies.user, criteria: event.target.value}}).then((response) => {
            console.log(response.data);
            if(response.data === ""){
                setOrders([]);
            }
            else {
                setOrders(response.data);
            }
        })
    }

    return (
        <div class="container">
            <div class="row mt-4">
                <h3>Your Orders</h3>
                <h6>View your order history</h6>
            </div>
            <hr/>
            <div class="row">
                Search By Order Number: <input type="text" onChange={handleChange}></input>
            </div>
            <hr/>
            <div class="row">
                <table style={{backgroundColor: 'white'}}>
                    <tr>
                        <th style={{width: "10%"}}>Order Number</th>
                        <th style={{width: "10%"}}>Order Date</th>
                        <th style={{width: "10%"}}>Destination Code</th>
                        <th style={{width: "10%"}}>Total Price</th>
                        <th style={{width: "10%"}}>Payment</th>
                        <th>Items Purchased</th>
                    </tr>
                    {orders.map((order,index) => (
                    <tr>
                        <td>{order.order_id}</td>
                        <td>{order.date_received}</td>
                        <td>{order.destination_code}</td>
                        <td>{order.total_price}</td>
                        <td style={{textAlign: "left"}}>************{order.card_number.substring(12)}</td>
                        <td>{items[order.order_id]}</td>
                    </tr>
                    ))}
                </table>
            </div>
        </div>
    )
}
export default Profile;