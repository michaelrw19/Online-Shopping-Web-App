import React from 'react';
import shopping from '../static/img/shopping_icon.png'
import delivery from '../static/img/delivery_icon.png'
import firesale from '../static/img/firesale.png'

const Types_of_Services = () => {
    return (
        <div class="container">
            <div class="row mt-4" >
                <h5>The Smart Customer Services (SCS) offers the following services</h5>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-md-4">
                    <img src={shopping} alt="shopping_icon" id="shopping_icon" />
                    <div>
                        <h5 class="mt-5">Online shopping</h5>
                        <a href="/home" class="btn btn-success" role="button">To shopping</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src={delivery} alt="delivery_icon" id="delivery_icon" />
                    <div>
                        <h5 class="mt-5">Delivery</h5>
                        <a href="/map" class="btn btn-success" role="button">To delivery</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src={firesale} alt="delivery_icon" id="firesale_icon" />
                    <div>
                        <h5 class="mt-5" style={{paddingTop:'8px'}}>Fire sale shopping</h5>
                        <a href="/fire_sale" class="btn btn-success" role="button">To Fire sale</a>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Types_of_Services;