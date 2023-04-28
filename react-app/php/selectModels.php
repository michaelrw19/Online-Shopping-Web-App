<?php
    include_once "dbConnection.php";
    include_once "submitQuery.php";
    /**
     * Return an associative array of Shopping objects where the key is the receipt_id (PRIMARY KEY) and the value is the Shopping object
     */
    function selectShopping () {
        $selectShopping="SELECT * FROM shoppingTable";
        $records = submitSelectQuery($selectShopping);
        
        $shoppingList = array();
        foreach($records as $row) {
            $shopping = new Shopping($row["receipt_id"], $row["store_code"], $row["total_price"]);
            $shoppingList[$row["receipt_id"]] = $shopping;
        }
        return $shoppingList;
    }
    
    /**
     * Return an associative array of Truck objects where the key is the truck_id (PRIMARY KEY) and the value is the Truck object
     */
    function selectTruck () {
        $selectTruck="SELECT * FROM truckTable";
        $records = submitSelectQuery($selectTruck);

        $truckList = array();
        foreach($records as $row) {
            $truck = new Truck($row["truck_id"], $row["truck_code"], $row["availability_code"]);
            $truckList[$row["truck_id"]] = $truck;
        }
        return $truckList;
    }

    /**
     * Return an associative array of Trip objects where the key is the trip_id (PRIMARY KEY) and the value is the Trip object
     */
    function selectTrip () {
        $selectTrip="SELECT * FROM tripTable";
        $records = submitSelectQuery($selectTrip);

        $tripList = array();
        foreach($records as $row) {
            $trip = new Trip($row["trip_id"], $row["source_code"], $row["destination_code"], $row["distance"], $row["truck_id"], $row["price"]);
            $tripList[$row["trip_id"]] = $trip;
        }
        return $tripList;
    }

    /**
     * Return an associative array of User objects where the key is the user_id (PRIMARY KEY) and the value is the User object
     */
    function selectUser () {
        $selectUser="SELECT * FROM userTable";
        $records = submitSelectQuery($selectUser);

        $userList = array();
        foreach($records as $row) {
            $user = new User($row["user_id"], $row["full_name"], $row["telephone"], $row["email"], $row["home_address"], $row["city_code"], $row["login_id"], $row["salt"], $row["user_password"], $row["balance"]);
            $userList[$row["user_id"]] = $user;
        }
        return $userList;
    }

    /**
     * Return an associative array of Item objects where the key is the item_id (PRIMARY KEY) and the value is the Item object
     */
    function selectItem () {
        $selectItem="SELECT * FROM itemTable";
        $records = submitSelectQuery ($selectItem);

        $itemList = array();
        foreach($records as $row) {
            $item = new Item($row["item_id"], $row["item_name"], $row["item_price"], $row["made_in"], $row["department_code"], $row["image_name"]);
            $itemList[$row["item_id"]] = $item;
        }
        return $itemList;
    }

    /**
     * Return an associative array of ItemSale objects where the key is the item_sale_id (PRIMARY KEY) and the value is the ItemSale object
     */
    function selectItemSale () {
        $selectItemSale="SELECT * FROM itemSaleTable";
        $records = submitSelectQuery ($selectItemSale);

        $itemSaleList = array();
        foreach($records as $row) {
            $itemSale = new ItemSale($row["item_sale_id"], $row["item_id"], $row["sale_price"], $row["expiry_time"]);
            $itemSaleList[$row["item_sale_id"]] = $itemSale;
        }
        return $itemSaleList;
    }
    
    /**
     * Return an associative array of Review objects where the key is the review_id (PRIMARY KEY) and the value is the Review object
     */
    function selectReview () {
        $selectReview="SELECT * FROM reviewTable";
        $records = submitSelectQuery($selectReview);

        $reviewList = array();
        foreach($records as $row) {
            $review = new Review($row["review_id"], $row["user_id"], $row["item_id"], $row["RN"], $row["review"]);
            $reviewList[$row["review_id"]] = $review;
        }
        return $reviewList;
    }

    /**
     * Return an associative array of Payment objects where the key is the payment_id (PRIMARY KEY) and the value is the Payment object
     */
    function selectPayment () {
        $selectPayment="SELECT * FROM paymentTable";
        $records = submitSelectQuery ($selectPayment);

        $paymentList = array();
        foreach($records as $row) {
            $payment = new Payment($row["payment_id"],  $row["user_id"], $row["cardholder_name"], $row["card_number"], $row["expiration_date"], $row["cvv_code"]);
            $paymentList[$row["payment_id"]] = $payment;
        }
        return $paymentList;
    }

    /**
     * Return an associative array of Order objects where the key is the order_id (PRIMARY KEY) and the value is the Order object
     */
    function selectOrder () {
        $selectOrder="SELECT * FROM orderTable";
        $records = submitSelectQuery($selectOrder);

        $orderList = array();
        foreach($records as $row) {
            $order = new Order($row["order_id"], $row["date_issued"], $row["date_received"], $row["total_price"], $row["payment_id"], $row["user_id"], $row["trip_id"], $row["receipt_id"]);
            $orderList[$row["order_id"]] = $order;
        }
        return $orderList;
    }

    /**
     * Return an associative array of purchasedItem_idobjects where the key is the purchasedItem_id (PRIMARY KEY) and the value is the PurchasedItem object
     */
    function selectPurchasedItem () {
        $selectPurchasedItem="SELECT * FROM purchasedItemTable";
        $records = submitSelectQuery ($selectPurchasedItem);

        $purchasedItemList = array();
        foreach($records as $row) {
            $purchasedItem = new PurchasedItem($row["purchased_item_id"], $row["item_id"], $row["user_id"], $row["order_id"]);
            $purchasedItemList[$row["purchased_item_id"]] = $purchasedItem;
        }
        return $purchasedItemList;
    }
?>