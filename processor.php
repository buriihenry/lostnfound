<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Processor</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href=" " rel="stylesheet" type="text/css">
    <link href=" " rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand">Lost N Found</div>
    <div class="address-bar"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.php">Business Casual</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    if(isset($_SESSION['phonenumber'])){
                        ?>
                        <li>
                            <a href="account.php">Account</a>
                        </li>
                        <li>
                            <a href="founditems.php">All found Items</a>
                        </li>
                        <li>
                            <a href="mainpage.php">Post Items</a>
                        </li>
                        <li>
                            <a href="inbox.php">Messages<?php
                                include "dbconnect.php";
                                $count = 0;
                                $sql1 = "SELECT * FROM messages WHERE readstatus1 = 'unread'";
                                $result1 = mysql_query($sql1);
                                while($row1 = mysql_fetch_array($result1)){
                                    if($row1['recipient'] == $_SESSION['phonenumber']){
                                        $count++;
                                    }
                                }
                                if($count > 0){
                                    echo "(".$count.")";
                                }
                                ?></a>
                        </li>
                        <li>
                            <a href="contact.php">Contact</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout(<?php echo $_SESSION['username']; ?>)</a>
                        </li>
                        <?php
                    }else{
                        ?>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="about.php">About</a>
                        </li>
                        <li>
                            <a href="register.php">Register</a>
                        </li>
                        <li>
                            <a href="login.php">Login</a>
                        </li>
                        <li>
                            <a href="contact.php">Contact</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Processor
                        <strong>Lost N Found</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/slide-2.jpg" alt="">
                </div>
                <div class="col-md-4">
                    <?php
                    include "dbconnect.php";
                    if((isset($_POST['who'])) && ($_POST['who'] == "register")){
                        $fname = $_POST['fname'];
                        $sname = $_POST['sname'];
                        $phonenumber = $_POST['phonenumber'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $confirmpassword = $_POST['confirmpassword'];

                        $reason = "";
                        $dbwrite = "yes";

                        if($password == $confirmpassword){

                        }else{
                            $dbwrite = "no";
                            $reason = $reason."|Passwords do not match";
                        }

                        $sql1 = "SELECT * FROM users";
                        $result1 = mysql_query($sql1);
                        while($row1 = mysql_fetch_array($result1)){
                            if($row1['phonenumber'] == $phonenumber){
                                $dbwrite = "no";
                                $reason = $reason."|The Phone Number Already Exists";
                            }
                        }
                        if($dbwrite == "yes"){
                            $sql2 = "INSERT INTO users (fname, sname, phonenumber, email, password)
                                VALUE ('".$fname."', '".$sname."', '".$phonenumber."', '".$email."', '".$password."')";
                            if(mysql_query($sql2)){
                                $_SESSION['username'] = $fname." ".$sname;
                                $_SESSION['phonenumber'] = $phonenumber;
                                header("location: account.php");
                            }else{
                                echo "<h3>There was an error registering you</h3>";
                            }
                        }else{
                            echo $reason;
                        }
                    }elseif((isset($_POST['who'])) && ($_POST['who'] == "login")){
                        $phonenumber = $_POST['phonenumber'];
                        $password = $_POST['password'];

                        $reason = "";
                        $sql1 = "SELECT * FROM users";
                        $result1 = mysql_query($sql1);
                        while($row1 = mysql_fetch_array($result1)){
                            if($row1['phonenumber'] == $phonenumber){
                                if($password == $row1['password']){
                                    $_SESSION['username'] = $row1['fname']." ".$row1['sname'];
                                    $_SESSION['phonenumber'] = $phonenumber;
                                    header("location: account.php");
                                }else{
                                    $reason = "Wrong password";
                                }
                            }
                        }
                        if($reason != ""){
                            echo "<h3>".$reason."</h3>";
                        }else{
                            echo "<h3>The phone number does not exist</h3>";
                        }
                    }elseif((isset($_POST['who'])) && ($_POST['who'] == "lostanitem")){
                        $itemname = $_POST['itemname'];
                        $itemtype = $_POST['itemtype'];
                        if(isset($_POST['itemnumber'])){
                            $itemnumber = $_POST['itemnumber'];    
                        }else{
                            $itemnumber = 0;
                            $sql1 = "SELECT * FROM lostitems";
                            $result1 = mysql_query($sql1);
                            while($row1 = mysql_fetch_array($result1)){
                                $itemnumber++;
                            }
                        }
                        $reason = "";
                        $dbwrite = "yes";
                        $locationlost = $_POST['locationlost'];
                        $itemdescription = $_POST['itemdescription'];
                        if((trim($itemdescription)) == ""){
                            $dbwrite = "no";
                            $reason = $reason."|Item description is empty";
                        }
                        if((trim($itemname)) == ""){
                            $dbwrite = "no";
                            $reason = $reason."|Item name is empty";
                        }
                        if($dbwrite == "yes"){
                            $sql2 = "INSERT INTO lostitems (itemname, itemtype, itemnumber, locationlost, itemdescription, owner, found)
                                VALUE ('".$itemname."', '".$itemtype."', '".$itemnumber."', '".$locationlost."', '".$itemdescription."', '".$_SESSION['phonenumber']."', 'no')";
                            if(mysql_query($sql2)){
                                echo "<h3>Your Lost item has been successfully added. We will inform you when we find your lost item.</h3>
                                <a href='mainpage.php' class='btn btn-success'>Post items</a>";
                            }else{
                                echo "Error inserting your item to DB<br><a href='mainpage.php' class='btn btn-success'>Post items</a>";
                            }
                        }else{
                            echo "<h3>".$reason."</h3>";
                        }
                    }elseif((isset($_POST['who'])) && ($_POST['who'] == "foundanitem")){
                        $itemname = $_POST['itemname'];
                        $itemtype = $_POST['itemtype'];
                        if(isset($_POST['itemnumber'])){
                            $itemnumber = $_POST['itemnumber'];    
                        }else{
                            $itemnumber = 0;
                            $sql1 = "SELECT * FROM founditems";
                            $result1 = mysql_query($sql1);
                            while($row1 = mysql_fetch_array($result1)){
                                $itemnumber++;
                            }
                        }
                        $reason = "";
                        $dbwrite = "yes";
                        $locationfound = $_POST['locationfound'];
                        $itemdescription = $_POST['itemdescription'];
                        if((trim($itemdescription)) == ""){
                            $dbwrite = "no";
                            $reason = $reason."|Item description is empty";
                        }
                        if((trim($itemname)) == ""){
                            $dbwrite = "no";
                            $reason = $reason."|Item name is empty";
                        }
                        if($dbwrite == "yes"){
                            $sql2 = "INSERT INTO founditems (itemname, itemtype, itemnumber, locationfound, itemdescription, finder, claimed)
                                VALUE ('".$itemname."', '".$itemtype."', '".$itemnumber."', '".$locationfound."', '".$itemdescription."', '".$_SESSION['phonenumber']."', 'no')";
                            if(mysql_query($sql2)){
                                echo "<h3>The found item has been successfully added. The owner will contact you.</h3>
                                <a href='mainpage.php' class='btn btn-success'>Post items</a>";
                                $sql1 = "SELECT * FROM lostitems WHERE `found` = 'no'";
                                $result1 = mysql_query($sql1);
                                while($row1 = mysql_fetch_array($result1)){
                                    $itemstr = $row1['itemname']." ".$row1['itemtype']." ".$row1['locationlost']." ".$row1['itemdescription'];
                                    $itemstr = strtolower($itemstr);
                                    $itemname = strtolower($itemname);
                                    if((strchr($itemstr,substr($itemname,0,6)) != "") && ($row1['owner'] != $_SESSION['phonenumber'])){
                                        $date = date(" d/m/y");
                                        $time1 = date("h")+1;
                                        $time1 = $time1.date(":i:s A");
                                        $timesent = $time1.$date;
                                        include "smscode.php";
                                        $message = "Dear customer, we have found an item named <a href='closematch.php?itemname=".$row1['itemname']."&itemstr=".$itemstr."'>".$itemname."</a> that matches your lost item (".$row1['itemname']."). ";
                                        $sql3 = "INSERT INTO messages (message, sender, recipient, timesent, readstatus1)
                                            VALUE ('".mysql_real_escape_string($message)."', 'admin', '".$row1['owner']."', '".$timesent."', 'unread')";
                                        if(mysql_query($sql3)){

                                        }
                                    }
                                }
                            }else{
                                echo mysql_error()."<br>Error inserting your item to DB<br><a href='mainpage.php' class='btn btn-success'>Post items</a>";
                            }
                        }else{
                            echo "<h3>".$reason."</h3>";
                        }
                    }elseif((isset($_POST['who'])) && ($_POST['who'] == "payment")){
                        $phonenumber = $_POST['phonenumber'];
                        $itemindex = $_POST['itemindex'];

                        $reason = "";
                        $totalamount = 0;
                        $sql1 = "SELECT * FROM payment WHERE confirmed = 'no'";
                        $result1 = mysql_query($sql1);
                        while($row1 = mysql_fetch_array($result1)){
                            if($row1['phonenumber'] == $phonenumber){
                                $sql11 = "SELECT * FROM founditems WHERE `index` = '".$itemindex."'";
                                $result11 = mysql_query($sql11);
                                while($row11 = mysql_fetch_array($result11)){
                                    $sql3 = "UPDATE founditems SET mpesacode = '".$row1['mpesacode']."' WHERE `index` = '".$itemindex."'";
                                    $sql31 = "UPDATE payment SET confirmed = 'yes' WHERE `mpesacode` = '".$row1['mpesacode']."'";
                                    $totalamount = $totalamount + $row1['amountpaid'];
                                    if($totalamount >= 100){
                                        if((mysql_query($sql3)) && (mysql_query($sql31))){
                                            $date = date(" d/m/y");
                                            $time1 = date("h")+1;
                                            $time1 = $time1.date(":i:s A");
                                            $timesent = $time1.$date;
                                            $sql31 = "INSERT INTO messages (message, sender, recipient, timesent, readstatus1)
                                                VALUE ('An item you found, (".$row11['itemname']."), has been claimed by a client with the following contacts: ".$_SESSION['phonenumber'].". Please make sure that he or she confirms reciept of the item on his or her account, for you to recieve payment for your services.', 'Admin', '".$row11['finder']."', '".$timesent."', 'unread')" ;
                                            if(mysql_query($sql31)){
                                                $reason = "ok";
                                                echo "<h3>Transaction successfull</h3>
                                                    The number of the finder of your item is ";
                                                echo " ".$row11['finder'].". <br>Go to your account to confirm transactions.<br><a href='account.php' class='btn btn-success'>Account</a>";
                                            }else{
                                                echo  mysql_error()."There was an error in transactions";
                                            }

                                        }else{
                                            echo "Error processing your transaction";
                                        }
                                    }
                                }

                            }
                        }
                        if($reason != "ok"){
                            echo "<h3>Please wait while your transaction is being processed...</h3>";
                            ?>
                                <form action="processor.php" method="post">
                                <input type="hidden" name="who" value="payment">
                                <input type="hidden" name="itemindex" value=<?php echo "'".$itemindex."'"; ?>>
                                <input type="hidden" name="phonenumber" value=<?php echo "'".$phonenumber."'"; ?>>
                                <br>
                                <input type="submit" value="Try again" class="btn btn-success">
                                </form>
                            <?php
                        }
                    }elseif((isset($_POST['who'])) && ($_POST['who'] == "dummyphone")){
                        $mpesacode = $_POST['mpesacode'];
                        $phonenumber = $_POST['phonenumber'];
                        $amountpaid = $_POST['amountpaid'];

                        $sql2 = "INSERT INTO payment (mpesacode, confirmed, phonenumber, account, amountpaid)
                            VALUE ('".$mpesacode."', 'no', '".$phonenumber."', '".$_SESSION['phonenumber']."', '".$amountpaid."')";
                        if(mysql_query($sql2)){
                            echo "<h3>You successfully sent ".$amountpaid." to Lost N Found</h3>
                             <a href='dummyphone.php' class='btn btn-success'>Back to Dummy phone</a>";
                        }else{
                            echo "<h3>Failed</h3>
                             <a href='dummyphone.php' class='btn btn-success'>Back to Dummy phone</a>";
                        }
                    }elseif((isset($_POST['who'])) && ($_POST['who'] == "contact")){
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $phonenumber = $_POST['phonenumber'];
                        $message = $_POST['message'];
                        $date = date(" d/m/y");
                        $time1 = date("h")+1;
                        $time1 = $time1.date(":i:s A");
                        $timesent = $time1.$date;
                        $sql3 = "INSERT INTO messages (message, sender, recipient, timesent, readstatus1)
                            VALUE ('".$message."', '".$phonenumber."', 'admin', '".$timesent."', 'unread')";
                        if(mysql_query($sql3)){
                            echo "<h2>Message sent successfully, we will get back to you very soon.</h2>";
                        }else{
                            echo "<h2>Error sending the message</h2>";
                        }
                    }else{
                        header("location: index.php");
                    }
                    /*else if((isset($_POST['who']))&&($_POST['who'])){
                           
                            $sql3="SELECT * from admin";
                            $result3=mysql_query($sql3);
                            $isthere = "no";
                            while ($row3=mysql_fetch_array($result3)) {
                                if($_POST['username'] == $row3['username']){
                                    $isthere = "yes";
                                    if($_POST['password']==$row3['password']){
                                        //$_SESSION['phonenumber'] = $row3['username'];
                                        header("location:admin.php");
                                    }
                                }
                            }
                            if($isthere == "yes"){
                                echo "<h3>You entered the wrong password!</h3>";
                            }else{
                                echo "<h3>The username ".$_POST['username']." does not exist!</h3>";
                                <!-- end of the processor -->
                            }
                        }*/
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Lost N Found 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
