<?php
    $title = 'Home';
    include 'head.php';

?>

<body>
<?php
    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
    {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                    <h1 class="text-center login-title main-title">Member Area</h1>
                    <h1 class="text-center login-title">Thanks for logging in!</h1>
                    <div class="account-wall">
    <!--                <h1>Member Area</h1>
                    <p>Thanks for logging in! You are <code><?=$_SESSION['FullName']?></code>
                    and your email address is <code><?=$_SESSION['EmailAddress']?></code>.</p>
    -->
                    <?php
                        if($_SESSION['prev'] == "ADMIN"){
                        echo '<a href="viewproducts.php">
                                <button type="button" class="btn btn-lg btn-primary btn-cntr">View Products</button>
                            </a>';
                        }else{
                            echo '<a href="submitinventory.php">
                            <button type="button" class="btn btn-lg btn-primary btn-cntr">Submit Inventory</button>
                            </a>';
                            echo '<a href="submitorder.php">
                            <button type="button" class="btn btn-lg btn-primary btn-cntr">Submit Order</button>
                            </a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    elseif(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        //require_once('db.php');
        $sql = "SELECT * FROM user WHERE
        userid = '$username' AND password = '$password'";
        $result = @mysqli_query($dbc, $sql);
        if($result){
            $row = mysqli_fetch_array($result);
            if($row != 0){
                $email = $row['email'];
                $fullname = $row['fullname'];
                $idnum = $row['ID'];
                $prev = $row['previligs'];

                $_SESSION['Username'] = $username;
                $_SESSION['EmailAddress'] = $email;
                $_SESSION['FullName'] = $fullname;
                $_SESSION['LoggedIn'] = 1;
                $_SESSION['IDnum'] = $idnum;
                $_SESSION['prev'] = $prev;

                mysqli_close($dbc);

                echo '<div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                        <h1 class="text-center login-title main-title">Success</h1>
                        <h1 class="text-center login-title">We are now redirecting you to the member area.</h1>
                        <h1 class="text-center login-title">If you auto directing doesnt work please click
                        <a href="index.php">here</a></h1>
                </div></div></div>';

                //echo "<h1>Success</h1>";
            // echo "<p>We are now redirecting you to the member area.</p>";
                //echo <meta http-equiv="refresh" content="2;url=http://example.com/" />
                //echo "<meta http-equiv='refresh' content='=2;url=index.php' />";
            echo '<script language="javascript" type="text/javascript">
                location.href = "index.php";
                </script>
                ';
            }
            else
            {
                error("Sorry, the Username or Password is not correct");
            /* echo "<h1>Error</h1>";
                echo "<p>Sorry, your account could not be found. Please
                    <a href=\"index.php\">click here to try again</a>.</p>";*/
                mysqli_close($dbc);
            }

        }else {
        error('A database error occurred in processing your '.
        'submission.\\nIf this error persists, please '.
        'contact info@pharmacy.com.');
        }

    }
    else
    {
        ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <h1 class="text-center login-title main-title">Member Login</h1>
            <h1 class="text-center login-title">Thanks for visiting!</h1>
            <h1 class="text-center login-title">Please login to continue</h1>
                <div class="account-wall">
                    <form class="form-signin" method="post" action="index.php" name="loginform" id="loginform">
                        <fieldset>
                            <input class="form-control" placeholder="Uername" type="text" name="username" id="username" required autofocus/><br />
                            <input class="form-control" placeholder="Password" type="password" name="password" id="password" required/><br />
                            <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" id="login" value="Login" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    }

    ?>
</body>
</html>