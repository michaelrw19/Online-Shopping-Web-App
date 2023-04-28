import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useNavigate } from "react-router-dom";
import { useCookies } from 'react-cookie';
import '../static/css/DBMaintain.css';

const Update = () => {
    const navigate = useNavigate();
    const [data, setData] = useState("");
    const [cookies, setCookie] = useCookies(['user']);

    useEffect(() => {
        axios.get("http://localhost:8000/updatePage.php").then((response) => {
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
                <h3 class="mt-4">Update Table</h3>
                <p class="mb-4">Select database to update by entering the id. Leave the input blank if you
                    don't want to update that column</p>
            </div>
            <div
                dangerouslySetInnerHTML={{ __html: data }}
            />
        </div>
    );
}

export default Update;