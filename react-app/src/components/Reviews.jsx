import React, { useEffect, useState } from 'react';
import {useCookies} from 'react-cookie';
import axios from 'axios';

const Reviews = () => {
    const [data, setData] = useState("");
    const [cookies, setCookie] = useCookies(['user']);

    useEffect(() => {
        axios.get("http://localhost:8000/reviews.php", {params: {user: JSON.stringify(cookies.user)}}).then((response) => {
            setData(response.data);
            console.log(response.data);
        });
    }, []);

    return (
        <div
            dangerouslySetInnerHTML={{ __html: data }}
        />
    );
}

export default Reviews;