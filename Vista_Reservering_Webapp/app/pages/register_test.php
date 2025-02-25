<?php
    include '../functions/functions.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $register = new Register("formHandling", $_POST);
        echo "Registration process initiated.";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>

    <h1>Register</h1>

    <form method="post">
        <label for="user_name">Name:</label>
        <input type="text" name="user_name" id="user_name"> <br/>
        <label for="user_lname">Last Name:</label>
        <input type="text" name="user_lname" id="user_lname"> <br/>
        <label for="user_mail">Schoolmail:</label>
        <input type="text" name="user_mail" id="user_mail"> <br/>
        <label for="user_pw">Wachtwoord:</label>
        <input type="password" name="user_pw" id="user_pw"> <br/>
        <input type="hidden" name="user_role" id="user_role" value="1">

        <input type="submit" name="submit" id="submit" value="Submit!">
    </form>

    <?php 
    // Debugging: Check if form data is received
    var_dump($_POST); 

    // Sanitize input properly
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $cleaned_post = filter_input_array(INPUT_POST, [
            "user_name" => FILTER_SANITIZE_SPECIAL_CHARS,
            "user_lname" => FILTER_SANITIZE_SPECIAL_CHARS,
            "user_mail" => FILTER_SANITIZE_EMAIL,
            "user_pw" => FILTER_DEFAULT, // Passwords should not be altered
            "user_role" => FILTER_SANITIZE_NUMBER_INT,
            "submit" => FILTER_SANITIZE_SPECIAL_CHARS
        ]);

        // Remove the 'submit' key to avoid passing it into the Register class
        unset($cleaned_post["submit"]);

        // Ensure required fields are not empty
        if (!empty($cleaned_post["user_name"]) && 
            !empty($cleaned_post["user_lname"]) && 
            !empty($cleaned_post["user_mail"]) && 
            !empty($cleaned_post["user_pw"])) {
                
            // Create Register object
            $register = new Register("formHandling", $cleaned_post);
        } else {
            echo "Please fill in all required fields.";
        }

        // var_dump($cleaned_post);
    }
?>
    
</body>
</html>