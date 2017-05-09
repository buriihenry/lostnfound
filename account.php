<?php
session_start();
if(isset($_SESSION['phonenumber'])){
    
}else{
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lost n Found - Account</title>

    <!-- Bootstrap Core CSS -->
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
                <a class="navbar-brand" href="index.php">Lost N Found</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
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
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <h2 class="brand-before">
                        <small>Welcome to</small>
                    </h2>
                    <h1 class="brand-name">Lost N Found</h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>
                            <strong>
                                <?php
                                $totalamount = 0;
                                $sql1 = "SELECT * FROM payment WHERE confirmed = 'no'";
                                $result1 = mysql_query($sql1);
                                while($row1 = mysql_fetch_array($result1)){
                                    if($row1['phonenumber'] == $_SESSION['phonenumber']){
                                        $totalamount = $totalamount + $row1['amountpaid'];
                                    }
                                }
                                echo "Your balance deposited by your phone is KSh. ".$totalamount." pending any transactions.";
                                ?>
                            </strong>
                        </small>
                    </h2>
                    <h3>
                    <?php
                    include "dbconnect.php";
                    if(isset($_GET['purpose'])){
                        $purpose = $_GET['purpose'];
                        $itemindex = $_GET['itemindex'];
                        if($purpose == "confirm"){
                            $mpesacode = $_GET['mpesacode'];
                            $sql3 = "UPDATE payment SET confirmed = 'yes' WHERE mpesacode = '".$mpesacode."'";
                            if(mysql_query($sql3)){
                                $sql3 = "UPDATE founditems SET claimed = 'yes' WHERE `index` = '".$itemindex."'";
                                if(mysql_query($sql3)){
                                    echo "Transaction confirmed successfully";
                                }else{
                                    echo "Error confirming transaction";    
                                }
                            }else{
                                echo "Error confirming transaction";
                            }
                        }elseif($purpose == "deletelost"){
                            $sql4 = "DELETE FROM lostitems WHERE `index` = '".$itemindex."'";
                            if(mysql_query($sql4)){
                                echo "Item deleted successfully";
                            }
                        }elseif($purpose == "wrongitem"){
                            $itemindex = $_GET['itemindex'];
                            $finder = $_GET['finder'];
                            $mpesacode = $_GET['mpesacode'];
                            $date = date(" d/m/y");
                            $time1 = date("h")+1;
                            $time1 = $time1.date(":i:s A");
                            $timesent = $time1.$date;
                            $sql2 = "INSERT INTO customercare (clientphone, purpose, details, dateadded, itemindex, mpesacode)
                                VALUE ('".$_SESSION['phonenumber']."', 'Wrong Item', 'Finder number: ".$finder."', '".$timesent."', '".$itemindex."', '".$mpesacode."')";
                            $dbwrite = "yes";
                            $sql1 = "SELECT * FROM customercare";
                            $result1 = mysql_query($sql1);
                            while($row1 = mysql_fetch_array($result1)){
                                if($row1['mpesacode'] == $mpesacode){
                                    $dbwrite = "no";
                                }
                            }
                            if($dbwrite == "yes"){
                                if(mysql_query($sql2)){
                                    echo "You have been successfully added to the customer care list, please wait for our call.";
                                }else{
                                    echo "Error processing your request";
                                }
                            }
                        }
                    }
                    ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class=" text-center">
                        <strong>Pending transactions</strong>
                    </h2>
                    <hr>
                    <hr class="visible-xs">
                    <center>
                    <?php
                    $isthere = "no";
                    echo "<h4>Confirm the following items</h4><hr></center>";
                    $sql11 = "SELECT * FROM payment WHERE `account` = '".$_SESSION['phonenumber']."'";
                    $result11 = mysql_query($sql11);
                    while($row11 = mysql_fetch_array($result11)){
                        $sql1 = "SELECT * FROM founditems WHERE `mpesacode` = '".$row11['mpesacode']."'";
                        $result1 = mysql_query($sql1);
                        while($row1 = mysql_fetch_array($result1)){
                            if($row1['claimed'] == 'no'){
                                $isthere = "yes";
                                ?>
                                <div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h4 class="pull-right">Type: <?php echo $row1['itemtype']; ?></h4>
                                            <h4><a href=""><?php echo $row1['itemname']; ?></a>
                                            </h4>
                                            <p><?php echo $row1['itemdescription']; ?></p>
                                            <p><a   href="">More Details</a>
                                                <br>
                                                <?php
                                                $onlist = "no";
                                                $sql12 = "SELECT * FROM customercare WHERE `itemindex` = '".$row1['index']."'";
                                                $result12 = mysql_query($sql12);
                                                while($row12 = mysql_fetch_array($result12)){
                                                    $onlist = "yes";
                                                }
                                                if($onlist == "no"){
                                                    ?>
                                                    <a href=<?php echo "'account.php?itemindex=".$row1['index']."&mpesacode=".$row11['mpesacode']."&finder=".$row1['finder']."&purpose=wrongitem'"; ?> class="btn btn-danger  pull-right">Not your item</a>
                                                    <a              href=<?php echo "'account.php?itemindex=".$row1['index']."&mpesacode=".$row11['mpesacode']."&purpose=confirm'"; ?> class="btn btn-success">Confirm receipt of item</a>
                                                    <?php
                                                }else{
                                                    echo "(Please wait for your call from customer care.)";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    if($isthere == "no"){
                        echo "<h5><center>You have no pending transactions!</center></h5>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                    <div class="thumbnail">
                        <div class="caption">
                            <p id="match"></p>
                        </div>
                    </div>
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Items you lost</strong>
                    </h2>
                    <hr>
                    <?php
                    $isthere = "no";
                    $sql1 = "SELECT * FROM lostitems WHERE `owner` = '".$_SESSION['phonenumber']."'";
                    $result1 = mysql_query($sql1);
                    while($row1 = mysql_fetch_array($result1)){
                        if($row1['found'] == "no"){
                            $isthere = "yes";
                            ?>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h4 class="pull-right">Type: <?php echo $row1['itemtype']; ?></h4>
                                        <h4><a href=""><?php echo $row1['itemname']; ?></a>
                                        </h4>
                                        <p><?php echo $row1['itemdescription']; ?></p>
                                        <p><a   href="">More Details</a>
                                            <a   href=<?php echo "'account.php?itemindex=".$row1['index']."&purpose=deletelost'"; ?> class="btn btn-danger  pull-right">Delete item</a>
                                        </p>
                                        <a href=<?php echo "'closematch.php?itemname=".$row1['itemname']."&itemstr=".$row1['itemname']." ".$row1['itemtype']." ".$row1['itemdescription']." "."'";?> class="btn btn-info">Close Match</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    if($isthere == "no"){
                        echo "<h3><center>You have no lost items!</center></h3>";
                    }
                    ?>
                </div>
                <a href="mainpage.php#lostanitem" class="btn btn-warning">Add</a>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Items you Found</strong>
                    </h2>
                    <hr>
                    <?php
                    $isthere = "no";
                    $sql1 = "SELECT * FROM founditems WHERE `finder` = '".$_SESSION['phonenumber']."'";
                    $result1 = mysql_query($sql1);
                    while($row1 = mysql_fetch_array($result1)){
                        if($row1['claimed'] == "no"){
                            $isthere = "yes";
                            ?>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="thumbnail">
                                    <div class="caption">
                                        <h4 class="pull-right">Type: <?php echo $row1['itemtype']; ?></h4>
                                        <h4><a href=""><?php echo $row1['itemname']; ?></a>
                                        </h4>
                                        <p><?php echo $row1['itemdescription']; ?></p>
                                        <p><a   href="">More Details</a>
                                            <?php
                                            if(($row1['mpesacode'] == "")){
                                                ?>
                                                <a   href=<?php echo "'account.php?itemindex=".$row1['index']."&purpose=delete'"; ?> class="btn btn-danger  pull-right">Delete item</a>
                                                <?php
                                            }else{
                                                echo "There is a transaction in progress...";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    if($isthere == "no"){
                        echo "<h3><center>You have not found any items!</center></h3>";
                    }
                    ?>
                </div>
                <a href="mainpage.php#foundanitem" class="btn btn-warning">Add</a>  
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

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
