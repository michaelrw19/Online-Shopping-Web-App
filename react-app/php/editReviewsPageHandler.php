<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "Models.php";

$identifier = $_POST["identifier"];
$RNname = "RN" . $identifier;
$ReviewName = "review" . $identifier;

$review_id = $_POST["review_id"];
$item_id = $_POST["item_id"];
$user_id = $_POST["user_id"];
$RN = $_POST["RN"];
$review = $_POST["review"];

//echo $review_id . " " . $item_id . " " . $user_id . " " . $RN . " " . $review . " ";

$reviewObj = new Review($review_id, $item_id, $user_id, $RN, $review);
$reviewObj->update();

print("
    <h4>Review Updated</h4>
    <form method='' action='http://localhost:3000/edit_reviews'>
        <button type='submit'/>Return to review page</button>
    </form>"
);

?>
