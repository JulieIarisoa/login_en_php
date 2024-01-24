<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <!-- import the catalog style css -->
            <link rel="stylesheet" href="style1.css" media="screen" type="text/css" />
        </head>
        <body>

    
        <?php  
            session_start();
            //database connexion
            $db_username = 'root';
            $db_password = '';
            $db_name = 'login';
            $db_host = 'localhost';
            $db = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');

        //*****************Add**************************//
            // check if add button is very click
            if(isset($_POST['btn']))
            {
                //send information by post methode
                extract($_POST);
                
                // check that all field are totally complete
                if(isset($username) && isset($password))
                {

                    //condition if the field are not void
                    if($username !== "" && $password !== "")
                    {
                        //searched the values enter by user 
                        $requete = "SELECT count(*) FROM utilisateur where nom_utilisateur = '".$username."' or mot_de_passe = '".$password."' ";
                        $exec_requete = mysqli_query($db,$requete);
                        $reponse = mysqli_fetch_array($exec_requete);
                        $count = $reponse['count(*)'];

                        if($count!=0) //if one of the values enter by user exist return at login.php page and notify error
                        {
                            $_SESSION['username'] = $username;
                            header('Location: login.php?erreur=3');
                        }
                        else//if no one of the values exist, execute the request for new member 
                        {
                            $req = mysqli_query($db, "INSERT INTO utilisateur VALUES (Null, '$username', '$password')");
                            if($req)
                            {
                                //request successfull 
                                header("Location: principale.php");
                            }else
                            {
                                //request error
                                $message = "Erreur";
                            }
                        }
                    }

                }
            }

            //*****************Login**************************//
            // check if add button is very click
            if(isset($_POST['log'])){

                //send information by post methode
                extract($_POST);

                // check that all field are totally complete
                if(isset($_POST['username']) && isset($_POST['password']))
                {
                    //condition if the field are not void
                    if($username !== "" && $password !== "")
                    {
                        //searched the values enter by user 
                        $requete = "SELECT count(*) FROM utilisateur where nom_utilisateur = '".$username."' and mot_de_passe = '".$password."' ";
                        $exec_requete = mysqli_query($db,$requete);
                        $reponse = mysqli_fetch_array($exec_requete);
                        $count = $reponse['count(*)'];

                        if($count!=0) //if the values enter by user exist go at principale.php page
                        {
                            $_SESSION['username'] = $username;
                            header('Location: principale.php');
                        }
                        else
                        {
                            header('Location: login.php?erreur=1'); //if one of the values enter by user not exist return at login.php page and notify error
                        }
                    }
                    else
                    {
                    header('Location: login.php?erreur=2'); //if the values enter by user not exist return at login.php page and notify error
                    }
                }
                else
                {
                header('Location: login.php');
                }
                mysqli_close($db); // connexion close

            }
        ?>

            <div id="container">
                <!--connexion's form -->
                
                <form action=" " method="POST">
                    <h1>Connexion</h1>
                    <?php
                        if(isset($_GET['erreur'])){
                            $err = $_GET['erreur'];
                            if($err==1 || $err==2|| $err==3)
                                echo "<center><p style='color:red'>Invalid username or password</p></center>";
                        }
                    ?>
                    <label><b>Username</b></label>
                        <input type="text" placeholder="Username" name="username" required>

                    <label><b>Password</b></label>
                        <input type="password" placeholder="Password" name="password" required>

                    <input type="submit" id='submit' value='LOGIN' name = "log">
                    <input type="submit" id='submit' value='SIGN UP' name="btn">
                </form>
            </div>
        </body>
    </html>