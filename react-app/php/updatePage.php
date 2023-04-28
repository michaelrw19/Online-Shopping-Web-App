<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "DBMaintainFunctions.php";

print("<div class='mainContainer'>");
print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='shopping'>
                <label for='shopping_id'>receipt_id: </label>
                <input type='number' name='shopping_id' min='0' max='99999' required>
                <label for='store_code'>store_code: </label>
                <input type='number' name='store_code' min='0' max='99999' >
                <label for='total_price'>total_price: </label>
                <input type='number' name='total_price' min='0.01' max='9999.99' step='0.01' >
                <input type='submit'>
            </form>"
);
createHTMLTable("shopping");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='truck'>
                <label for='truck_id'>truck_id: </label>
                <input type='number' name='truck_id' min='0' max='99999' required>
                <label for='truck_code'>truck_code: </label>
                <input type='number' name='truck_code' min='0' max='99999' >
                <label for='availability_code'>availability_code: </label>
                <input type='number' name='availability_code' min='0' max='1' >
                <input type='submit'>
            </form>"
);
createHTMLTable("truck");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='trip'>
                <label for='trip_id'>trip_id: </label>
                <input type='number' name='trip_id' min='0' max='99999' required>
                <label for='source_code'>source_code: </label>
                <input type='text' name='source_code' minlength='6' maxlength='6' >
                <label for='destination_code'>destination_code: </label>
                <input type='text' name='destination_code' minlength='6' maxlength='6' >
                <label for='distance'>distance (km): </label>
                <input type='number' name='distance' min='0.01' max='999.99' step='0.01' >
                <label for='truck_id'>truck_id: </label>
                <input type='number' name='truck_id' min='1' max='999999' >
                <label for='price'>price: </label>
                <input type='number' name='price' min='0.01' max='9999.99' step='0.01' >
                <input type='submit'>
            </form>"
);
createHTMLTable("trip");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='user'>
                <label for='user_id'>user_id: </label>
                <input type='number' name='user_id' min='0' max='99999' required>
                <label for='full_name'>full_name: </label>
                <input type='text' name='full_name' minlength='1' maxlength='50' >
                <label for='telephone'>telephone: </label>
                <input type='text' name='telephone' minlength='10' maxlength='10' >
                <label for='email'>email: </label>
                <input type='text' name='email' minlength='1' maxlength='50' >
                <label for='home_address'>home_address: </label>
                <input type='text' name='home_address' minlength='1' maxlength='50' >
                <label for='city_code'>city_code: </label>
                <select name='city_code'>
                    <option value='416'>416</option>
                    <option value='647'>647</option>
                    <option value='437'>437</option>
                </select>
                <label for='login_id'>login_id: </label>
                <input type='text' name='login_id' minlength='1' maxlength='50' >
                <label for='salt'>salt (enter or generate): </label>
                <input type='text' name='salt' id='salt' minlength='1' maxlength='16'>
                <button type='button' id='salt'>Generate Salt</button>
                <label for='user_password'>user_password: </label>
                <input type='text' name='user_password' minlength='1' maxlength='16' >
                <label for='balance'>balance: </label>
                <input type='number' name='balance' min='0.01' max='999999999.99' step='0.01' >
                <input type='submit'>
            </form>"
);
createHTMLTable("user");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='item'>
                <label for='item_id'>item_id: </label>
                <input type='number' name='item_id' min='0' max='99999' required>
                <label for='item_name'>item_name: </label>
                <input type='text' name='item_name' minlength='1' maxlength='30' >
                <label for='item_price'>item_price: </label>
                <input type='number' name='item_price' min='0.01' max='9999.99' step='0.01' >
                <label for='made_in'>made_in: </label>
                <input type='text' name='made_in' minlength='1' maxlength='30' >
                <label for='department_code'>department_code: </label>
                <input type='text' name='department_code' minlength=1 maxlength='10' >
                <label for='image_name'>image_name: </label>
                <input type='text' name='image_name'>
                <input type='submit'>
            </form>"
);
createHTMLTable("item");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
    <input hidden name='identifier' value='item_sale'>
    <label for='item_sale_id'>item_sale_id: </label>
    <input type='number' name='item_sale_id' min='0' max='99999' required>
    <label for='item_id'>item_id: </label>
    <input type='number' name='item_id' min='0' max='99999'>
    <label for='sale_price'>sale_price: </label>
    <input type='number' name='sale_price' min='0.01' max='9999.99' step='0.01'>
    <label for='expiry_time'>expiry_time: </label>
    <input type='date' name='expiry_time'>
    <input type='submit'>
</form>"
);
createHTMLTable("item_sale");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='review'>
                <label for='review_id'>review_id: </label>
                <input type='number' name='review_id' min='0' max='99999' required>
                <label for='item_id'>item_id: </label>
                <input type='number' name='item_id' min='0' max='99999'>
                <label for='user_id'>user_id: </label>
                <input type='number' name='user_id' min='0' max='99999'>
                <label for='RN'>Rating: </label>
                <input type='number' name='RN' min='1' max='5'>
                <label for='review'>review: </label>
                <input type='text' name='review' minlength='0' maxlength='250' style='height: 50px; width: 300px;'>
                <input type='submit'>
            </form>"
);
createHTMLTable("review");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='payment'>
                <label for='payment_id'>payment_id: </label>
                <input type='number' name='payment_id' min='0' max='99999' required>
                <label for='user_id'>user_id: </label>
                <input type='number' name='user_id' min='0' max='99999'>
                <label for='cardholder_name'>cardholder_name: </label>
                <input type='text' name='cardholder_name' minlength='0' maxlength='50'>
                <label for='card_number'>card_number: </label>
                <input type='text' name='card_number' minlength='16' maxlength='16'>
                <label for='expiration_date'>expiration_date: </label>
                <input type='date' name='expiration_date' >
                <label for='cvv_code'>cvv_code: </label>
                <input type='text' name='cvv_code' minlength='3' maxlength='3'>
                <input type='submit'>
            </form>"
);
createHTMLTable("payment");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
                <input hidden name='identifier' value='order'>
                <label for='order_id'>order_id: </label>
                <input type='number' name='order_id' min='0' max='99999' required>
                <label for='date_issued'>date_issued: </label>
                <input type='date' name='date_issued' >
                <label for='date_received'>date_received: </label>
                <input type='date' name='date_received' >
                <label for='total_price'>total_price: </label>
                <input type='number' name='total_price' min='0.01' max='9999.99' step='0.01' 
                <label for='payment_id'>payment_id: </label>
                <input type='text' name='payment_id' minlength='1' maxlength='10' >
                <label for='user_id'>user_id: </label>
                <input type='number' name='user_id' min='1' max='999999' >
                <label for='trip_id'>trip_id: </label>
                <input type='number' name='trip_id' min='1' max='999999' >
                <label for='receipt_id'>receipt_id: </label>
                <input type='number' name='receipt_id' min='1' max='999999' >
                <input type='submit'>
            </form>"
);
createHTMLTable("order");

print("<form action='http://localhost:8000/updatePageHandler.php' method='POST'>
    <input hidden name='identifier' value='purchased_item'>
    <label for='purchased_item_id'>purchased_item_id: </label>
    <input type='number' name='purchased_item_id' min='0' max='99999' required>
    <label for='item_id'>item_id: </label>
    <input type='number' name='item_id' min='0' max='99999'>
    <label for='user_id'>user_id: </label>
    <input type='number' name='user_id' min='0' max='99999'>
    <label for='order_id'>order_id: </label>
    <input type='number' name='order_id' min='0' max='99999'>
    <input type='submit'>
</form>"
);
createHTMLTable("purchased_item");
print("</div>");
?>