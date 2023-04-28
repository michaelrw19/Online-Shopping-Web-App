import React, { useEffect, useState } from 'react';
import {useCookies} from 'react-cookie';
import axios from 'axios';
import { useNavigate } from "react-router-dom";
import { Link } from "react-router-dom";

const Login_Register = () => {
    const [visible, setVisible ] = useState(false);
    const [cookie, setCookie] = useCookies();
    const navigate = useNavigate();

    const handleClick = async event => {
        event.preventDefault();
        let login = document.getElementById("loginID").value;
        let password = document.getElementById("loginPassword").value;
        let incorrect = true;
        let user_id = -1;
        await axios.get("http://localhost:8000/signIn.php", {params: {loginID: login, loginPassword: password}}).then((response) => {
            if (response.data !== "fail") {
                user_id = response.data;
                incorrect = false;
            }
        });
        if (incorrect){
            setVisible(true);
        }
        else{
            await setCookie("user", user_id, {path: '/'});
            navigate("/home");
        }
    }
    return (
        <div class="container">
            <div class="row m-5">
                <h3>Welcome to Smart Customer Services!</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col">
                            <div class="card">
                                <div class="row mt-3">
                                    <h4>Sign up</h4>
                                </div>
                                <div class="card-body registration">
                                    <form method="POST" action="http://localhost:8000/signUp.php">
                                        <div class="form-outline mt-4 mb-4">
                                            <label class="form-label" for="registerID">Login ID</label>
                                            <input type="text" name="registerID" id="registerID" maxlength="32" class="form-control"
                                                required />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="registerPassword">Password</label>
                                            <input type="password" name="registerPassword" id="registerPassword" minlength="8"
                                                maxlength="16" class="form-control" required />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="registerName">Name</label>
                                            <input type="text" name="registerName" id="registerName" class="form-control"
                                                maxlength="200" required />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="registerPhone">Phone number</label>
                                            <input type="tel" name="registerPhone" id="registerPhone" class="form-control" required />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="registerAddress">Home address</label>
                                            <input type="text" name="registerAddress" id="registerAddress" class="form-control"
                                                maxlength="200" required />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="registerEmail">Email address</label>
                                            <input type="email" name="registerEmail" id="registerEmail" class="form-control"
                                                maxlength="200" required />
                                        </div>
                                        <input class="btn btn-primary mt-3 mb-4" type="submit" name='register' value="Register" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col">
                            <div class="card">
                                <div class="row mt-3">
                                    <h4>Sign in</h4>
                                </div>
                                <div class="card-body registration">
                                    <form>
                                        <div class="form-outline mt-4 mb-4">
                                            <label class="form-label" for="loginID">Login ID</label>
                                            <input type="text" name="loginID" id="loginID" maxlength="32" class="form-control"
                                                required />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="loginPassword">Password</label>
                                            <input type="password" name="loginPassword" id="loginPassword" minlength="8" maxlength="16"
                                                class="form-control" required />
                                        </div>
                                        <Link to='/' onClick={handleClick}><input class="btn btn-primary mt-3 mb-4" name='sign_in' value="Sign in"/></Link>
                                    </form>
                                </div>
                                <p style={{visibility: !visible? "hidden" : "visible",color: "red"}}>Incorrect username and/or password</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login_Register;