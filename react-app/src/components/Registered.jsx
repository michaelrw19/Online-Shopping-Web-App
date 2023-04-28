import React from 'react';
import { Link } from "react-router-dom";

const Registered = () => {
    return (
        <div class="container">
            <div class="row mt-4">
                <h3>Successfully Registered</h3>
                <Link to={'/'}><button>Please log in with your new credentials</button></Link>
                <br />
            </div>
        </div>
    )
}
export default Registered;