<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "Models.php";
include_once "DBMaintainFunctions.php";
include_once "databaseFunctions.php";

if (isset($_POST["identifier"])) {
    $identifier = $_POST["identifier"];
    $objectList = getObjectList($identifier);
    $id = $_POST[$identifier . "_id"];
    if (array_key_exists($id, $objectList)) {
        $object = $objectList[$id];
        if ($identifier == "shopping") {
            if (!empty($_POST["store_code"])) {
                $object->setStore_code($_POST["store_code"]);
            }
            if (!empty($_POST["total_price"])) {
                $object->setTotal_price($_POST["total_price"]);
            }
            $object->update();
        } else if ($identifier == "truck") {
            if (!empty($_POST["truck_code"])) {
                $object->setTruck_code($_POST["truck_code"]);
            }
            if ($_POST["availability_code"] == "0" || $_POST["availability_code"] == "1") {
                $object->setAvailability_code($_POST["availability_code"]);
            }
            $object->update();
        } else if ($identifier == "trip") {
            if (!empty($_POST["source_code"])) {
                $object->setSource_code($_POST["source_code"]);
            }
            if (!empty($_POST["destination_code"])) {
                $object->setDestination_code($_POST["destination_code"]);
            }
            if (!empty($_POST["distance"])) {
                $object->setDistance($_POST["distance"]);
            }
            if (!empty($_POST["truck_id"])) {
                $object->setTruck_id($_POST["truck_id"]);
            }
            if (!empty($_POST["price"])) {
                $object->setPrice($_POST["price"]);
            }
            $object->update();
        } else if ($identifier == "user") {
            if (!empty($_POST["full_name"])) {
                $object->setFull_name($_POST["full_name"]);
            }
            if (!empty($_POST["telephone"])) {
                $object->setTelephone($_POST["telephone"]);
            }
            if (!empty($_POST["email"])) {
                $object->setEmail($_POST["email"]);
            }
            if (!empty($_POST["home_address"])) {
                $object->setHome_address($_POST["home_address"]);
            }
            if (!empty($_POST["city_code"])) {
                $object->setCity_code($_POST["city_code"]);
            }
            if (!empty($_POST["login_id"])) {
                $object->setLogin_id($_POST["login_id"]);
            }
            if (!empty($_POST["salt"])) {
                $object->setSalt($_POST["salt"]);
            }
            if (!empty($_POST["user_password"])) {
                $salt = $object->getSalt();
                $newPassword = $_POST["user_password"];
                $hashedPassword = hashPassword($newPassword.$salt);
                $object->setUser_password($hashedPassword);
            }
            if (!empty($_POST["balance"])) {
                $object->setBalance($_POST["balance"]);
            }
            $object->update();
        } else if ($identifier == "item") {
            if (!empty($_POST["item_name"])) {
                $object->setItem_name($_POST["item_name"]);
            }
            if (!empty($_POST["item_price"])) {
                $object->setItem_price($_POST["item_price"]);
            }
            if (!empty($_POST["made_in"])) {
                $object->setMade_in($_POST["made_in"]);
            }
            if (!empty($_POST["department_code"])) {
                $object->setDepartment_code($_POST["department_code"]);
            }
            if (!empty($_POST["image_name"])) {
                $object->setImage_name($_POST["image_name"]);
            }
            $object->update();
        } else if ($identifier == "item_sale") {
            if (!empty($_POST["item_id"])) {
                $object->setItem_id($_POST["item_id"]);
            }
            if (!empty($_POST["sale_price"])) {
                $object->setSale_price($_POST["sale_price"]);
            }
            if (!empty($_POST["expiry_time"])) {
                $object->setExpiry_time($_POST["expiry_time"]);
            }
            $object->update();
        } else if ($identifier == "review") {
            if (!empty($_POST["item_id"])) {
                $object->setItem_id($_POST["item_id"]);
            }
            if (!empty($_POST["user_id"])) {
                $object->setUser_id($_POST["user_id"]);
            }
            if (!empty($_POST["RN"])) {
                $object->setRN($_POST["RN"]);
            }
            if (!empty($_POST["review"])) {
                $object->setReview($_POST["review"]);
            }
            $object->update();
        } else if ($identifier == "payment") {
            if (!empty($_POST["user_id"])) {
                $object->setUser_id($_POST["user_id"]);
            }
            if (!empty($_POST["cardholder_name"])) {
                $object->setCardholder_name($_POST["cardholder_name"]);
            }
            if (!empty($_POST["card_number"])) {
                $object->setCard_number($_POST["card_number"]);
            }
            if (!empty($_POST["expiration_date"])) {
                $object->setExpiration_date($_POST["expiration_date"]);
            }
            if (!empty($_POST["cvv_code"])) {
                $object->setCvv_code($_POST["cvv_code"]);
            }
            $object->update();
        } else if ($identifier == "order") {
            if (!empty($_POST["date_issued"])) {
                $object->setDate_issued($_POST["date_issued"]);
            }
            if (!empty($_POST["date_received"])) {
                $object->setDate_received($_POST["date_received"]);
            }
            if (!empty($_POST["total_price"])) {
                $object->setTotal_price($_POST["total_price"]);
            }
            if (!empty($_POST["payment_id"])) {
                $object->setPayment_id($_POST["payment_id"]);
            }
            if (!empty($_POST["user_id"])) {
                $object->setUser_id($_POST["user_id"]);
            }
            if (!empty($_POST["trip_id"])) {
                $object->setTrip_id($_POST["trip_id"]);
            }
            if (!empty($_POST["receipt_id"])) {
                $object->setReceipt_id($_POST["receipt_id"]);
            }
            $object->update();
        } else if ($identifier == "purchased_item") {
            if (!empty($_POST["item_id"])) {
                $object->setItem_id($_POST["item_id"]);
            }
            if (!empty($_POST["user_id"])) {
                $object->setUser_id($_POST["user_id"]);
            }
            if (!empty($_POST["order_id"])) {
                $object->setOrder_id($_POST["order_id"]);
            }
            $object->update();
        }
    }
}

print(" <form method='' action='http://localhost:3000/update'>
            <button type='submit'/>Return to main page</button>
        </form>"
);

include_once "browserDetection.php";
?>