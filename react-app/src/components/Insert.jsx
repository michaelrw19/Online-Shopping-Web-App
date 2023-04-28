import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from "react-router-dom";
import { useCookies } from 'react-cookie';
import '../static/css/DBMaintain.css';

const Insert = () => {
    const navigate = useNavigate();
    const [data, setData] = useState("");
    const [cookies, setCookie] = useCookies(['user']);

    useEffect(() => {
        axios.get("http://localhost:8000/insertPage.php").then((response) => {
            setData(response.data);
            console.log(response.data);
        });
    }, []);

    if (cookies.user != 1) {
        navigate("/home");
    }

    return (
        <div class="container">
            <div class="row">
                <h3 class="mt-4 mb-4">Insert Table</h3>
            </div>
            <div
                dangerouslySetInnerHTML={{ __html: data }}
            />
        </div>
    );
}

export default Insert;