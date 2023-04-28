import {useJsApiLoader, GoogleMap, MarkerF, DirectionsRenderer} from '@react-google-maps/api';
import { useEffect, useRef, useState } from 'react'

const center = { lat: 59.105890, lng: -102.005848}

const provinces = ["","Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador","Northwest Territories", "Nunavut","Ontario","Prince Edward Island", "Quebec", "Saskatchewan", "Yukon"]
const branch = ["", "Yorkdale", "Eatons", "Dufferin Mall"]

const libraries = ['places'];

const Google_Map = (props) => {

    const { isLoaded } = useJsApiLoader({
        googleMapsApiKey: process.env.REACT_APP_GOOGLE_MAPS_API_KEY,
        libraries,
    })

    const [map, setMap] = useState(/** @type google.maps.Map */ (null))
    const [directionsResponse, setDirectionsResponse] = useState(null)
    const isFirstRender = useRef(true)

    const [selectedProvince, setProvince] = useState(provinces[0])
    useEffect(() => {
        if (isFirstRender.current) {
            isFirstRender.current = false
            return;
        }
        panMapProvince(map)
    }, [selectedProvince])

    const [selectedCity, setCity] = useState(null)
    const [selectedAddress, setAddress] = useState(null)
    const [selectedBranch, setBranch] = useState(null)

    function changeProvince(province){
        setProvince(province.target.value)
        panMapProvince(map)
    }

    function changeCity(city){
        setCity(city.target.value)
        panMapCity(map)
    }

    function changeAddress(address){
        setAddress(address.target.value)
        panMapAddress(map)
    }

    function changeBranch(branch){
        setBranch(branch.target.value)
    }

    function updateMap(map){
        setDirectionsResponse(null)
        generatePath()
    }

    function returnGeolocation(){
        if(selectedBranch == "Yorkdale"){
            return "PGGX+54 Toronto, Ontario"
        }else if(selectedBranch == "Eatons"){
            return "MJ39+QP Toronto, Ontario"
        }else if(selectedBranch == "Dufferin Mall"){
            return "MH47+8P Toronto, Ontario"
        }
    }

    async function panMapProvince(map){
        const geocoder = new window.google.maps.Geocoder()
        geocoder.geocode({address: selectedProvince}).then((response) => {
            if(response.results[0]){
                var theJson = JSON.parse(JSON.stringify(response, null, 2));
                map.panTo({lat: theJson.results[0].geometry.location.lat, lng: theJson.results[0].geometry.location.lng });
                map.setZoom(5);
            }else{
                window.alert("No results found");
            }});
    }

    function panMapCity(map){
        var geocoder = new window.google.maps.Geocoder();
        geocoder.geocode({address: selectedCity}).then((response) => {
            if(response.results[0]){
                var theJson = JSON.parse(JSON.stringify(response, null, 2));
                map.panTo({lat: theJson.results[0].geometry.location.lat, lng: theJson.results[0].geometry.location.lng });
                map.setZoom(11);
            }else{
                window.alert("No results found");
            }
        });
        console.log(selectedCity)
    }

    function panMapAddress(map){
        const geocoder = new window.google.maps.Geocoder();  
        geocoder.geocode({address: `${selectedCity} ${selectedAddress}`}).then((response) => {
          if(response.results[0]){
            var theJson = JSON.parse(JSON.stringify(response, null, 2));
            map.panTo({lat: theJson.results[0].geometry.location.lat, lng: theJson.results[0].geometry.location.lng });
            map.setZoom(14);
          }else{
            window.alert("No results found");
          }
        });
    }

    async function generatePath(){
        const directionsService = new window.google.maps.DirectionsService()
        const results = await directionsService.route({
            origin: returnGeolocation(),
            destination: `${selectedCity} ${selectedAddress}`,
            travelMode: window.google.maps.TravelMode.DRIVING
        })
        setDirectionsResponse(results)
    }
    

    if(!isLoaded){
        return <div>hello world</div>
    }

    return(
        <div class="container">
        <div class="row mt-4" >
            <div class="col-md-4">
                <div class="row gx-0">
                    <div>First name:</div><input type="text" name="fname" /><br />
                    <div>Last name:</div><input type="text" name="lname" /><br />
                    <div>Phone number:</div><input type="text" name="phone-number" /><br />
                    <div>Provines & Territories:</div>
                    <select name="province" id="province" 
                        value={selectedProvince} 
                        onChange={changeProvince}
                    >
                        {provinces.map((value) => (
                            <option value={value} key={value}>
                                {value}
                            </option>
                        ))}
                    </select>
                    <div>City: </div><input type="text" name="city" id="city" value={selectedCity} placeholder="City" onChange={changeCity} /><br />
                    <div>Delivery Address:</div><input type="text" name="address" id="end" value={selectedAddress} placeholder="Address" onChange={changeAddress} /><br />
                </div>
                <div>Branch:</div>
                <select name="Branches" id="branch" 
                        value={selectedBranch} 
                        onChange={changeBranch}
                    >
                        {branch.map((value) => (
                            <option value={value} key={value}>
                                {value}
                            </option>
                        ))}
                    </select>
                <input type="submit" onClick={() => updateMap(map)}/>
            </div>
            <div class="col-md-8">
                <GoogleMap center={center} zoom={3} mapContainerStyle={{width:'100%', height:'100%'}} onLoad={map => setMap(map)}>
                    {directionsResponse && <DirectionsRenderer directions={directionsResponse}/>}
                </GoogleMap>
            </div>
        </div>
    </div>
    );
}

export default Google_Map;