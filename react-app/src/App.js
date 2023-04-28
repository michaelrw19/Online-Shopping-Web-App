import './App.css';
import './static/css/style.css'
import { BrowserRouter, Routes, Route, withRouter } from "react-router-dom";
import WithNav from './withNav';
import WithoutNav from './withoutNav';
import Login_Register from './components/Login_Register';
import Registered from './components/Registered';
import Registered_Failed from './components/Registered_Failed';
import Index from './components/Index';
import About_us from './components/About_us';
import Contact_us from './components/Contact_us';
import Types_of_Services from './components/Types_of_Services';
import Reviews from './components/Reviews';
import EditReviews from './components/EditReviews';
import Shopping_Cart from './components/Shopping_Cart';
import Map from './components/Map';
import Fire_Sale from './components/Fire_sale';
import Select from './components/Select';
import Insert from './components/Insert';
import Update from './components/Update';
import Delete from './components/Delete';
import Checkout from './components/Checkout';
import Review_order from './components/Review_order';
import BrowserDetection from './components/BrowserDetection';
import Profile from "./components/Profile"

function App() {
  document.body.style = 'background: #b2edc2;';

  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route element={<WithNav />}>
            <Route path="/home" element={<Index />}></Route>
            <Route path="/about_us" element={<About_us />}></Route>
            <Route path="/contact_us" element={<Contact_us />}></Route>
            <Route path="/types_of_services" element={<Types_of_Services />}></Route>
            <Route path="/edit_reviews" element={<EditReviews />}></Route>
            <Route path="/reviews" element={<Reviews />}></Route>
            <Route path="/shopping_cart" element={<Shopping_Cart />}></Route>
            <Route path="/map" element={<Map />}></Route>
            <Route path="/fire_sale" element={<Fire_Sale />}></Route>
            <Route path="/select" element={<Select />}></Route>
            <Route path="/insert" element={<Insert />}></Route>
            <Route path="/update" element={<Update />}></Route>
            <Route path="/delete" element={<Delete />}></Route>
            <Route path="/checkout" element={<Checkout />}></Route>
            <Route path="/review_order" element={<Review_order />}></Route>
            <Route path="/profile" element={<Profile/>}></Route>
          </Route>
          <Route element={<WithoutNav />}>
            <Route path="/" element={<Login_Register />}></Route>
            <Route path="/registered" element={<Registered />}></Route>
            <Route path="/registered_fail" element={<Registered_Failed />}></Route>
          </Route>
        </Routes>
      </BrowserRouter>
      <BrowserDetection></BrowserDetection>
    </div>
  );
}

export default App;
