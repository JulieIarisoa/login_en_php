<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <!-- import the catalog style css -->
            <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
        </head>
        <body style='background:#fff;'>
            <div id="content">
                <!-- check if user is connected -->
                <?php
                session_start();
                if($_SESSION['username'] !== ""){
                $user = $_SESSION['username'];
                // notify one message
                echo "Welcome, you are connected";
                }
                ?>
            </div>
        </body>
    </html>