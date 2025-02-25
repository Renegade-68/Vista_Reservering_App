<?php include '../functions/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
        $components = new Components("head", "Home"); 
    ?>

</head>
<body>
    <?php $components = new Components("header") ?>
    <div class="container-fluid">

        <div class="row">

            <div class="col-12 d-flex justify-content-center align-items-center viewport-login ">

                <div class="login-container text">
                    <form action="login.php" method="POST">
                        <label for="username">School email:</label>
                        <input type="text" id="username" name="username" required>

                        <label for="password">Wachtwoord:</label>
                        <input type="password" id="password" name="password" required>

                        <button type="submit" class="btn2">Inloggen</button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</body>
</html>