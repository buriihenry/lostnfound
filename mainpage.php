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

    <title>Lost n Found - Home</title>

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
                        <a class="page-scroll" href="#lostanitem">Lost an item</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#foundanitem">Found an item</a>
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
                        <a href="admin/adminlogin.php">Admin</a>
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
                            <strong></strong>
                        </small>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row" id="lostanitem">
            <div class="box">
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/slide-2.jpg" alt="">
                </div>
                <div class="col-md-4">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Lost an item</strong>
                    </h2>
                    <hr>
                    <hr class="visible-xs">
                    <form action="processor.php" method="post">
                        Lost item type:
                        <select name = "itemtype" class="form-control">
                            <option value="Others">Others</option>
                            <option value="lostid">Lost ID</option>
                            <option value="lostcert">Lost certificate</option>
                            <option value="losttitledeed">Lost Title deed</option>
                            <option value="lostatmcard">Lost ATM Card</option>
                            <option value="losttranscript">Lost Transcript</option>
                        </select>
                        <p id="itemtype"></p>
                        Item name:
                        <input type = "text" class="form-control" name = "itemname" placeholder = "Item name" required>
                        Location lost:
                        <input type = "text" class="form-control" name = "locationlost" placeholder = "Location lost">
                        Item description:(E.g ID NO,Owner)
                        <textarea class="form-control" name="itemdescription" placeholder = "Item description" required></textarea>
                        <input type="hidden" name="who" value="lostanitem">
                        <br><input type="submit" value = "Submit" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>

        <div class="row" id="foundanitem">
            <div class="box">
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/slide-2.jpg" alt="">
                </div>
                <div class="col-md-4">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Found an item</strong>
                    </h2>
                    <hr>
                    <form action="processor.php" method="post">
                        Found item type:
                        <select name = "itemtype" class="form-control">
                            <option value="Others">Others</option>
                            <option value="foundid">Found ID</option>
                            <option value="foundcert">Found certificate</option>
                            <option value="losttitledeed">Lost Title deed</option>
                            <option value="lostatmcard">Lost ATM Card</option>
                            <option value="losttranscript">Lost Transcript</option>
                        </select>
                        <p id="itemtype"></p>
                        Item name:
                        <input type = "text" class="form-control" name = "itemname" placeholder = "Item name" required>
                        Location Found:
                        <input type = "text" class="form-control" name = "locationfound" placeholder = "Location found">
                        Item description:
                        <textarea class="form-control" name="itemdescription" placeholder = "Item description" required></textarea>
                        <input type="hidden" name="who" value="foundanitem">
                        <br><input type="submit" value = "Submit" class="btn btn-success">
                    </form>
                </div>
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
