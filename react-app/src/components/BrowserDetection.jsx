import React from 'react';
import $ from 'jquery';

const BrowserDetection = () => {
    // const [data, setData] = useState("");
    const divStyleP = {
        margin: 0
    }
    const divStyle = {
        position: 'fixed',
        bottom: 0,
        left: 0,
        margin: 0,
        fontWeight: 'bold',
        fontSize: '11px',
        backgroundColor: 'white',
        border: '1px solid black',
        padding: '5px'
    }

    $(document).ready(function () {
        const userAgent = navigator.userAgent;
        /*
            Microsoft Edge: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.50
            Firefox: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/110.0
            Google Chrome: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36
        */
        var browser = "Browser: ";
        $("#userAgent").html(userAgent);

        if(userAgent.includes("Edg")) {
            browser += "Microsoft Edge";
        }
        else if(userAgent.includes("Firefox")){
            browser += "Firefox";
        }
        else if(userAgent.includes("Chrome")){
            browser += "Google Chrome";
        }
        else {
            browser += "Unknown";
        }

        $("#browser").html(browser);
    });

    // useEffect(() => {
    //     axios.get("http://localhost:8000/insertPage.php").then((response) => {
    //         setData(response.data);
    //         console.log(response.data);
    //     });
    // }, []);

    return (
        <div id="browserDetection" style={divStyle}>
            <p id="userAgent" style={divStyleP}></p>
            <p id="browser" style={divStyleP}></p>
        </div>
    );
}

export default BrowserDetection;