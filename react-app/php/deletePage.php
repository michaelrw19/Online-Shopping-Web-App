<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "DBMaintainFunctions.php";

print("<div class='mainContainer'>");
print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='shopping'>
                <label for='shopping_id'>receipt_id: </label>
                <input type='number' name='shopping_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("shopping");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='truck'>
                <label for='truck_id'>truck_id: </label>
                <input type='number' name='truck_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("truck");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='trip'>
                <label for='trip_id'>trip_id: </label>
                <input type='number' name='trip_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("trip");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='user'>
                <label for='user_id'>user_id: </label>
                <input type='number' name='user_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("user");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='item'>
                <label for='item_id'>item_id: </label>
                <input type='number' name='item_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("item");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
    <input hidden name='identifier' value='item_sale'>
    <label for='item_sale_id'>item_sale_id: </label>
    <input type='number' name='item_sale_id' min='0' max='99999' required>
    <input type='submit'>
</form>"
);
createHTMLTable("item_sale");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='review'>
                <label for='review_id'>review_id: </label>
                <input type='number' name='review_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("review");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='payment'>
                <label for='payment_id'>payment_id: </label>
                <input type='number' name='payment_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("payment");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
                <input hidden name='identifier' value='order'>
                <label for='order_id'>order_id: </label>
                <input type='number' name='order_id' min='0' max='99999' required>
                <input type='submit'>
            </form>"
);
createHTMLTable("order");

print("<form action='http://localhost:8000/deletePageHandler.php' method='POST'>
    <input hidden name='identifier' value='purchased_item'>
    <label for='purchased_item_id'>purchased_item_id: </label>
    <input type='number' name='purchased_item_id' min='0' max='99999' required>
    <input type='submit'>
</form>"
);
createHTMLTable("purchased_item");
print("</div>");

include_once "browserDetection.php";
?>