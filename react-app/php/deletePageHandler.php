<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "Models.php";
include_once "DBMaintainFunctions.php";

if(isset($_POST["identifier"])) {
    $identifier = $_POST["identifier"];
    $objectList = getObjectList($identifier);
    $id = $_POST[$identifier."_id"];
    $objectList[$id]->delete();

    //Works the same as above
    /*
    if($identifier == "shopping") {
        $shopping = getObjectList($identifier);
        $id = $_POST["shopping_id"];
        $shopping[$id]->delete();
    }
    else if($identifier == "truck") {
        $truck = getObjectList($identifier);
        $id = $_POST["truck_id"];
        $truck[$id]->delete();
    } 
    else if($identifier == "trip") {
        $trip = getObjectList($identifier);
        $id = $_POST["trip_id"];
        $trip[$id]->delete();
    } 
    else if($identifier == "user") {
        $user = getObjectList($identifier);
        $id = $_POST["user_id"];
        $user[$id]->delete();
    } 
    else if($identifier == "item") {
        $item = getObjectList($identifier);
        $id = $_POST["item_id"];
        $item[$id]->delete();
    } 
    else if($identifier == "order") {
        $order = getObjectList($identifier);
        $id = $_POST["order_id"];
        $order[$id]->delete();
    }
    */
}

print(" <form method='' action='http://localhost:3000/delete'>
            <button type='submit'/>Return to main page</button>
        </form>"
);

include_once "browserDetection.php";
?>