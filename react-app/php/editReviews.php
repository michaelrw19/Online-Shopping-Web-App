<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

include_once "databaseFunctions.php";

if(isset($_GET['user'])) {
    print(
        "<form action='http://localhost:3000/reviews' method=''>
            <input type='submit' value='Go Back To Reviews'>
        </form>"
    );

    $user_id = json_decode($_GET['user']);
    $reviews = getUserReview($user_id);

    foreach($reviews as $review) {
        $itemName = $review["item_name"];
        $rating = $review["RN"];
        $userReview = $review["review"];

        $IDs = getReviewIdItemId($itemName, $user_id, $rating, $userReview);
        $review_id = $IDs[0];
        $item_id = $IDs[1];

        print("<div class='row'><div class='col-md-6 offset-md-3'>
            <div class='card m-4' style='padding:15px'><h4 class='m-3'>$itemName</h4><hr>");
        print("
            <form action='http://localhost:8000/editReviewsPageHandler.php' method='POST'>
                <input hidden name='identifier' value='$itemName'>
                <input hidden name='review_id' value='$review_id'>
                <input hidden name='item_id' value='$item_id'>
                <input hidden name='user_id' value='$user_id'>
                <label for='RN'>Rating: </label>
                <input type='number' name='RN' min='1' max='5' value=$rating><br>
                <label for='review'>Review: </label>
                <input type='text' name='review' minlength='0' maxlength='250' value='$userReview' style='height: 50px; width: 300px;'><br>
                <input type='submit'>
            </form>    
            "
        );
        print("</div></div></div></div>");
    }
}


?>
