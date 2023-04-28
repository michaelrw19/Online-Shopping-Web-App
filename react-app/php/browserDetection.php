<!DOCTYPE html>

<head>
    <style>
        div#browserDetection p {
            margin: 0;
        }
        div#browserDetection {
            position: fixed;
            bottom: 0;
            left: 0;
            margin: 0;
            font-weight: bold;
            font-size: 11px;

            background-color: white;
            border: 1px solid black;
            padding: 5px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="jquery-3.6.1.min.js"></script>
    <script>
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
    </script>
</head>

<body>
    <div id="browserDetection">
        <p id="userAgent"></p>
        <p id="browser"></p> 
    </div>
</body>

</html>