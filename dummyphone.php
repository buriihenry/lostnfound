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

    <title>Dummy phone</title>

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
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Dummy Phone</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/slide-2.jpg" alt="">
                </div>
                <div class="col-md-4">
                    <form action="processor.php" method="post">
                        Phone number:
                        <input type="text" name="phonenumber" value="0712345678" class="form-control" required>
                        Enter amount:
                        <input type="text" name="amountpaid" placeholder="Enter Amount" class="form-control" required>
                        <input type="hidden" name="who" value="dummyphone">
                        <input type="hidden" name="mpesacode" value=<?php echo "'".rand(1000, 9999).rand(1000, 9999)."'"; ?>><br>
                        <input type="submit" value="Send" class="btn btn-success">
                    </form>
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
