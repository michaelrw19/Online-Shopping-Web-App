<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "databaseFunctions.php";

if (isset($_GET['user'])) {
    $user_id = json_decode($_GET['user']);
    $reviewableItem = getRevewableItemByUser($user_id);
    print("<form action='http://localhost:3000/edit_reviews' method=''>
            <input type='submit' value='Edit Reviews'>
        </form>"
    );
    print("<form action='http://localhost:8000/reviewPageHandler.php' method='POST'>
            <label for='item_id'>Product / Service: </label>
            <select name='item_id' required>
        "
    );
    foreach ($reviewableItem as $item_id => $item_name) {
        print("<option value='$item_id'>$item_name</option>");
    }
    print("
            </select>
            <input hidden name='user_id' value='$user_id'>
            <label for='RN'>Rating: </label>
            <input type='number' name='RN' min='1' max='5' required>
            <label for='review'>Review: </label>
            <input type='text' name='review' minlength='0' maxlength='250' style='height: 50px; width: 300px;' required>
            <input type='submit'>
        </form>
    ");
}

$serviceReview = getServiceReviews();
print("<h3 class='mt-4'>Service Reviews</h3>");
foreach ($serviceReview as $key => $value) {
    $ratingInfo = getRatingInfoByItemName($key);
    $avgRating = $ratingInfo[0];
    $numVote = $ratingInfo[1];
    if ($numVote != 0) {
        $itemHeader = $key. " | " . $avgRating . " star (" . $numVote;
        if ($numVote > 1) {
            $itemHeader = $itemHeader . " votes)";
        } else {
            $itemHeader = $itemHeader . " vote)";
        }
        print("<div class='row'><div class='col-md-6 offset-md-3'>
            <div class='card m-4' style='padding:15px'><h4 class='m-3'>$itemHeader</h4><hr>");
    } else {
        print("<div class='row'><div class='col-md-6 offset-md-3'>
            <div class='card m-4' style='padding:15px'><h4 class='m-3'>$key</h4><hr>");
    }
    foreach ($value as $review) {
        $username = $review["login_id"];
        $rating = $review["RN"];
        $userReview = $review["review"];
        print("<p>Rating: $rating</p>
                <p>Reviewer: $username</p>
                <p>Review: $userReview</p><hr>"
        );
    }
    print("</div></div></div></div>");
}

$itemReview = getItemReviews();
print("<h3 class='mt-4'>Item Reviews</h3>");
foreach ($itemReview as $itemName => $item) {
    $ratingInfo = getRatingInfoByItemName($itemName);
    $avgRating = $ratingInfo[0];
    $numVote = $ratingInfo[1];

    if ($numVote != 0) {
        $itemHeader = $itemName . " | " . $avgRating . " star (" . $numVote;
        if ($numVote > 1) {
            $itemHeader = $itemHeader . " votes)";
        } else {
            $itemHeader = $itemHeader . " vote)";
        }
        print("<div class='row'><div class='col-md-6 offset-md-3'>
            <div class='card m-4' style='padding:15px'><h4 class='m-3'>$itemHeader</h4><hr>");
    } else {
        print("<div class='row'><div class='col-md-6 offset-md-3'>
            <div class='card m-4' style='padding:15px'><h4 class='m-3'>$itemName</h4><hr>");
    }
    foreach ($item as $review) {
        $username = $review["login_id"];
        $rating = $review["RN"];
        $userReview = $review["review"];
        print("<p>Rating: $rating</p>
                <p>Reviewer: $username</p>
                <p>Review: $userReview</p><hr>"
        );
    }
    print("</div></div></div></div>");
}
?>