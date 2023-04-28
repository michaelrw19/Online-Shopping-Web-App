import React from 'react';
import { Link } from "react-router-dom";

const Registered_Failed = () => {
    return (
        <div class="container">
            <div class="row mt-4">
                <h3>Registration failed - username or email already in use.</h3>
                <Link to={'/'}><button>Try again</button></Link>
                <br />
            </div>
        </div>
    )
}
export default Registered_Failed;