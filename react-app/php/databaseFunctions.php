<?php
include_once "submitQuery.php";
include_once "Models.php";

/////////////////////////////////////////////// Sign In and Sign Up Functions ///////////////////////////////////////////////

function generateSalt() {
    $length = random_bytes('8');
    return bin2hex($length);
}

function hashPassword($password) {
    return md5($password);
}

function getUserSalt($login_id) {
    $sql = "SELECT userTable.salt FROM userTable WHERE login_id='$login_id'";
    $salt = submitSelectQuery($sql);
    if (count($salt) == 0) {
        return "";
    }
    else {
        return $salt[0]["salt"];
    }
}

function setUserPurchaseService($login_id, $hash) {
    $sql = "SELECT userTable.user_id FROM userTable WHERE login_id='$login_id' AND user_password='$hash'";
    $user_id = submitSelectQuery($sql)[0]["user_id"];
    $service = new PurchasedItem(1, $user_id);
    $service->insert();
}

/**
 * returns true (1) if user does not exists in database
 * returns false ("") if user exists in database
 * 
 * Use this when user sign_in
 */
function checkUserCredentials($login_id, $password)
{
    $userSalt = getUserSalt($login_id);
    $userHash = hashPassword($password.$userSalt);
    if ($userSalt != ""){
        $sql = "SELECT * FROM userTable WHERE login_id='$login_id' AND user_password='$userHash'";
        $array = submitSelectQuery($sql);
        if (empty($array) == "") {
            echo $array[0]['user_id'];
        } else {
            echo 'fail';
        }
    }
    else {
        echo 'fail';
    }
}

/**
 * Check if a user exists in database by checking login_id, $home_ad
 * 
 * returns true (1) if user does not exists in database
 * returns false ("") if user exists in database
 * 
 * Use this during user sign_up
 */
function checkExistingEmail($email)
{
    $sql = "SELECT * FROM userTable WHERE email='$email'";
    $array = submitSelectQuery($sql);
    return empty($array);
}
/**
 * returns true (1) if user does not exists in database
 * returns false ("") if user exists in database
 * 
 * Use this during user sign_up
 */
function checkExistingLoginId($login_id)
{
    $sql = "SELECT * FROM userTable WHERE login_id='$login_id'";
    $array = submitSelectQuery($sql);
    return empty($array);
}

/**
 * return an error string message if a email or login_id is used
 * else a new user record is inserted to the database
 * 
 * Use this during user sign_up
 */
function createNewUser($full_name, $telephone, $email, $home_address, $login_id, $user_password)
{
    if (checkExistingEmail($email) && checkExistingLoginId($login_id)) {
        $salt = generateSalt();
        $hash = hashPassword($user_password.$salt);
        $user = new User($full_name, $telephone, $email, $home_address, "", $login_id, $salt, $hash, 0);
        $user->insert();

        setUserPurchaseService($login_id, $hash);
        echo '<script type="text/javascript">window.location = "http://localhost:3000/registered"</script>';
    } else {
        echo '<script type="text/javascript">window.location = "http://localhost:3000/registered_fail"</script>';
    }
}

/////////////////////////////////////////////// Review and Edit Review Functions ///////////////////////////////////////////////

/**
 * Return an array of item_name of items with reviews
 * Used when viweing reviews
 */
function getItemReviewNames()
{
    $sql = "SELECT itemTable.item_name FROM reviewTable INNER JOIN itemTable ON reviewTable.item_id=itemTable.item_id WHERE itemTable.item_id <> 1 GROUP BY itemTable.item_name";
    $items = array();
    $record = submitSelectQuery($sql);
    foreach ($record as $row) {
        array_push($items, $row["item_name"]);
    }
    return $items;
}

/**
 * Return an associative array where:
 *    (1) key is item_name
 *    (2) value is array containing reviews of item only. Each review is an associative array where the keys are item_id, login_id, RN, review. 
 * 
 * Used when viewing item reviews
 */
function getItemReviews()
{
    $sql = "SELECT itemTable.item_name, userTable.login_id, reviewTable.RN, reviewTable.review FROM itemTable INNER JOIN reviewTable ON itemTable.item_id=reviewTable.item_id INNER JOIN userTable ON reviewTable.user_id=userTable.user_id WHERE itemTable.item_id <> 1 ORDER BY itemTable.item_name";
    $reviews = array();
    $items = getItemReviewNames();
    $record = submitSelectQuery($sql);
    foreach ($items as $item) {
        $itemReview = array();
        foreach ($record as $review) {
            if ($review["item_name"] == $item) {
                array_push($itemReview, array_slice($review, 1));
                //Add everything other than item_name column into itemReview

                $record = array_slice($record, 1);
                //Delete to skip iteration in the next item
            }
        }
        $reviews[$item] = $itemReview;
    }
    return $reviews;
}

/**
 * Return an associative array where:
 *    (1) key is Services
 *    (2) value: array containing reviews of service only. Each review is an associative array where the keys are login_id, RN, review. 
 * 
 * Used when viewing service reviews
 */
function getServiceReviews()
{
    $sql = "SELECT itemTable.item_name, userTable.login_id, reviewTable.RN, reviewTable.review FROM itemTable INNER JOIN reviewTable ON itemTable.item_id=reviewTable.item_id INNER JOIN userTable ON reviewTable.user_id=userTable.user_id WHERE itemTable.item_id = 1 ORDER BY itemTable.item_name";
    $reviews = array();
    $record = submitSelectQuery($sql);
    $serviceReview = array();
    foreach ($record as $review) {
        array_push($serviceReview, array_slice($review, 1));
        //Add everything other than item_name column into itemReview
    }
    $reviews["Service"] = $serviceReview;
    return $reviews;
}

/**
     * Return an associative array of items purchased by $user_id that is not yet reviewed. Key is item_id, and value is item_name
     * 
     * Used when creating reviews
     */
    function getRevewableItemByUser($user_id) {
        $sqlPurhased = "SELECT itemtable.item_id, itemtable.item_name FROM purchaseditemtable INNER JOIN itemtable ON purchaseditemtable.item_id = itemtable.item_id WHERE purchaseditemtable.user_id = $user_id";
        $sqlReviewed = "SELECT itemtable.item_id, itemtable.item_name FROM reviewtable INNER JOIN itemtable ON reviewtable.item_id = itemtable.item_id WHERE reviewtable.user_id = $user_id";
        $arr = submitSelectQuery($sqlPurhased);
        $purhasedItem = array();
        foreach($arr as $key=>$value) {
            $purhasedItem[$value['item_id']] = $value['item_name'];
        }
        $arr = submitSelectQuery($sqlReviewed);
        $reviewedItem = array();
        foreach($arr as $key=>$value) {
            $reviewedItem[$value['item_id']] = $value['item_name'];
        }
        $reviewableItem = array_diff($purhasedItem, $reviewedItem);
        return $reviewableItem;
    }

    /**
     * Return an array of reviews made by user (both service and item)
     */
    function getUserReview($user_id) {
        $sql = "SELECT itemTable.item_name, reviewTable.RN, reviewTable.review FROM itemTable INNER JOIN reviewTable ON itemTable.item_id=reviewTable.item_id INNER JOIN userTable ON reviewTable.user_id=userTable.user_id WHERE userTable.user_id = $user_id ORDER BY itemTable.item_name";
        $arr = submitSelectQuery($sql);
        return $arr;
    }

    /**
    * Return an array of item_name of all reviews
    */
    function getAllReviewNames()
    {
        $sql = "SELECT itemTable.item_name FROM reviewTable INNER JOIN itemTable ON reviewTable.item_id=itemTable.item_id GROUP BY itemTable.item_name";
        $reviewNames = array();
        $record = submitSelectQuery($sql);
        foreach ($record as $row) {
            array_push($reviewNames, $row["item_name"]);
        }
        return $reviewNames;
    }

    /**
    * Return an array of id's where the first index 0 is review_id and index 1 is item_id
    */
    function getReviewIdItemId($itemName, $user_id, $RN, $review) {
        $sql = "SELECT itemTable.item_id FROM itemTable WHERE itemTable.item_name = '$itemName'";
        $item_id = submitSelectQuery($sql)[0]["item_id"];
        $sql = "SELECT reviewTable.review_id FROM reviewTable WHERE reviewTable.item_id = $item_id AND reviewTable.user_id = $user_id AND reviewTable.RN = $RN AND reviewTable.review = '$review'";
        $review_id = submitSelectQuery($sql)[0]["review_id"];
        return array($review_id, $item_id);
    }

    function getRatingInfoByItemName($item_name) {
        $sql = "SELECT ROUND(AVG(RN), 1) as average, COUNT(RN) as votes FROM `reviewtable` WHERE item_id = (SELECT item_id FROM `itemtable` WHERE item_name='$item_name')";
        $ratingInfo = array();
        $record= submitSelectQuery($sql)[0];
        array_push($ratingInfo, $record["average"]);
        array_push($ratingInfo, $record["votes"]);
        return $ratingInfo;
    }

    /////////////////////////////////////////////// Search Order ///////////////////////////////////////////////

    /**
     * Return a list of order_ids made by $user_id
     */
    function getOrdersByUserId($user_id) {
        $sql = "SELECT orderTable.order_id FROM orderTable WHERE orderTable.user_id = $user_id";
        $records = submitSelectQuery($sql);
        $order_id = array();
        foreach($records as $record) {
            array_push($order_id, $record["order_id"]);
        }
        return $order_id;
    }

    /**
     * Return a list of Item objects made by $order_id
     */
    function getItemsByOrderId($order_id) {
        $sql = "SELECT purchasedItemTable.item_id FROM purchasedItemTable WHERE purchasedItemTable.order_id = $order_id";
        $records = submitSelectQuery($sql);
        $items = array();
        foreach($records as $record) {
            $item_id = $record["item_id"];

            $selectItem = "SELECT * FROM itemTable WHERE itemTable.item_id = $item_id";
            $row = submitSelectQuery($selectItem)[0];
            $item = new Item($row["item_id"], $row["item_name"], $row["item_price"], $row["made_in"], $row["department_code"], $row["image_name"]);
            array_push($items, $item);
        }
        return $items;
    }
?>
