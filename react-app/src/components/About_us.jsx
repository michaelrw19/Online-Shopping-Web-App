import React from 'react';
import avatar from '../static/img/profile_icon.png'

const About_us = () => {
    return (
        <div class="container">
            <div class="row">
                <h3 class="mt-4">Team 37 - About us</h3>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col">
                    <div class="card">
                        <img src={avatar} alt="Avatar" />
                        <hr />
                        <div class="card_container">
                            <h4>Jenny Su</h4>
                            <p>500962385</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src={avatar} alt="Avatar" />
                        <hr />
                        <div class="card_container">
                            <h4>Tiffany Tran</h4>
                            <p>500886609</p>
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
                            <p>500967982</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src={avatar} alt="Avatar" />
                        <hr />
                        <div class="card_container">
                            <h4>Michael Widianto</h4>
                            <p>501033366</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default About_us;