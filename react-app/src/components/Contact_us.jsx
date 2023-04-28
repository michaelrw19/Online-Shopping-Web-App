import React from 'react';
import avatar from '../static/img/profile_icon.png'

const Contact_us = () => {
    return (
        <div class="container">
            <div class="row mt-4">
                <h3>Team 37 - Contact us</h3>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col">
                    <div class="card">
                        <img src={avatar} alt="Avatar" />
                        <hr />
                        <div class="card_container">
                            <h4>Jenny Su</h4>
                            <p>j10su@torontomu.ca</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src={avatar} alt="Avatar" />
                        <hr />
                        <div class="card_container">
                            <h4>Tiffany Tran</h4>
                            <p>tiffany.tran@torontomu.ca</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col">
                    <div class="card">
                        <img src={avatar} alt="Avatar" />
                        <hr />
                        <div class="card_container">
                            <h4>Kevin Tran</h4>
                            <p>kevin.huy.tran@torontomu.ca</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src={avatar} alt="Avatar" />
                        <hr />
                        <div class="card_container">
                            <h4>Michael Widianto</h4>
                            <p>michael.r.widianto@torontomu.ca</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Contact_us;