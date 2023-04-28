import React, { useEffect, useState } from 'react';
import axios from 'axios';
import $ from 'jquery';
import { useNavigate } from "react-router-dom";
import { useCookies } from 'react-cookie';
import '../static/css/DBMaintain.css';

const Select = () => {
    const navigate = useNavigate();
    const [data, setData] = useState("");
    const [cookies, setCookie] = useCookies(['user']);

    useEffect(() => {
        axios.get("http://localhost:8000/selectPage.php").then((response) => {
            setData(response.data);
            console.log(response.data);
        });
    }, []);

    if (cookies.user != 1) {
        navigate("/home");
    }

    $("input#shopping").change(function () {
        if (this.checked) {
            $("div#shopping").css('display', 'block');
        } else {
            $("div#shopping").css('display', 'none');
        }
    })

    $("input#truck").change(function () {
        if (this.checked) {
            $("div#truck").css('display', 'block');
        } else {
            $("div#truck").css('display', 'none');
        }
    })

    $("input#trip").change(function () {
        if (this.checked) {
            $("div#trip").css('display', 'block');
        } else {
            $("div#trip").css('display', 'none');
        }
    })

    $("input#user").change(function () {
        if (this.checked) {
            $("div#user").css('display', 'block');
        } else {
            $("div#user").css('display', 'none');
        }
    })

    $("input#item").change(function () {
        if (this.checked) {
            $("div#item").css('display', 'block');
        } else {
            $("div#item").css('display', 'none');
        }
    })

    $("input#item_sale").change(function () {
        if (this.checked) {
            $("div#item_sale").css('display', 'block');
        } else {
            $("div#item_sale").css('display', 'none');
        }
    })

    $("input#review").change(function () {
        if (this.checked) {
            $("div#review").css('display', 'block');
        } else {
            $("div#review").css('display', 'none');
        }
    })

    $("input#payment").change(function () {
        if (this.checked) {
            $("div#payment").css('display', 'block');
        } else {
            $("div#payment").css('display', 'none');
        }
    })

    $("input#order").change(function () {
        if (this.checked) {
            $("div#order").css('display', 'block');
        } else {
            $("div#order").css('display', 'none');
        }
    })

    $("input#purchased_item").change(function () {
        if (this.checked) {
            $("div#purchased_item").css('display', 'block');
        } else {
            $("div#purchased_item").css('display', 'none');
        }
    })

    return (
        <div class="container">
            <div class="row">
                <h3 class="mt-4 mb-4">Select Table</h3>
            </div>
            <input type="checkbox" id="shopping" name="shopping" />
            <label for="shopping">&nbsp;Shopping Table</label>
            <input type="checkbox" id="truck" name="truck" />
            <label for="truck">&nbsp;Truck Table</label>
            <input type="checkbox" id="trip" name="trip" />
            <label for="trip">&nbsp;Trip Table</label>
            <input type="checkbox" id="user" name="user" />
            <label for="user">&nbsp;User Table</label>
            <input type="checkbox" id="item" name="item" />
            <label for="item">&nbsp;Item Table</label>
            <input type="checkbox" id="item_sale" name="item_sale" />
            <label for="item_sale">&nbsp;Item Sale Table</label>
            <input type="checkbox" id="review" name="review" />
            <label for="review">&nbsp;Review Table</label>
            <input type="checkbox" id="payment" name="payment" />
            <label for="payment">&nbsp;Payment Table</label>
            <input type="checkbox" id="order" name="order" />
            <label for="order">&nbsp;Order Table</label>
            <input type="checkbox" id="purchased_item" name="purchased_item" />
            <label for="purchased_item">&nbsp;Purchased Item Table</label>
            <div
                dangerouslySetInnerHTML={{ __html: data }}
            />
        </div>
    );
}

export default Select;