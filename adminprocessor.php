<?php
session_start();
include "dbconnect.php";
if(mysql_select_db("lostnfound")){

}else{
    echo "error connecting to database";
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin Lost N found </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                      <li>
                        <a href="Print.php"><i class="fa fa-fw fa-edit"></i> Print</a>
                    </li>
                   
                    <li>
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                   
                 
                   
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
               
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">

                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong></strong><a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link"></a> for additional features!
                        </div>

                         <?php

                             include "dbconnect.php";
                             if((isset($_POST['who']))&&($_POST['who']=="adminlogin")){
                              $username = $_POST['username'];
                              $password = $_POST['password'];

                               $dbwrite = "yes";

                            }
                            else {
                                   // echo "No such thing";
                                }

                              
                              if((isset($_POST['who'])) && ($_POST['who'] == "lostanitem")){
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
                                    VALUE ('".$itemname."', '".$itemtype."', '".$itemnumber."', '".$locationlost."', '".$itemdescription."', '".@$_SESSION['phonenumber']."', 'no')";
                                if(mysql_query($sql2)){
                                    echo "<h3>Your Lost item has been successfully added. We will inform you when we find your lost item.</h3>
                                    <a href='admin.php' class='btn btn-success'>Post items</a>";
                                }else{
                                    echo "Error inserting your item to DB<br><a href='mainpage.php' class='btn btn-success'>Post items</a>";
                                }
                            }else{
                                echo "<h3>".$reason."</h3>";
                            }
                    } 
                     elseif((isset($_POST['who'])) && ($_POST['who'] == "foundanitem")){
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
                                VALUE ('".$itemname."', '".$itemtype."', '".$itemnumber."', '".$locationfound."', '".$itemdescription."', '".@$_SESSION['phonenumber']."', 'no')";
                            if(mysql_query($sql2)){
                                echo "<h3>The found item has been successfully added. The owner will contact you.</h3>
                                <a href='admin.php' class='btn btn-success'>Post items</a>";
                                $sql1 = "SELECT * FROM lostitems WHERE `found` = 'no'";
                                $result1 = mysql_query($sql1);
                                while($row1 = mysql_fetch_array($result1)){
                                    $itemstr = $row1['itemname']." ".$row1['itemtype']." ".$row1['locationlost']." ".$row1['itemdescription'];
                                    $itemstr = strtolower($itemstr);
                                    $itemname = strtolower($itemname);
                                    if((strchr($itemstr,substr($itemname,0,6)) != "") && ($row1['owner'] != @$_SESSION['phonenumber'])){
                                        $date = date(" d/m/y");
                                        $time1 = date("h")+1;
                                        $time1 = $time1.date(":i:s A");
                                        $timesent = $time1.$date;
                                        //include "smscode.php";
                                        $message = "Dear customer, we have found an item named <a href='closematch.php?itemname=".$row1['itemname']."&itemstr=".$itemstr."'>".$itemname."</a> that matches your lost item (".$row1['itemname']."). ";
                                        $sql3 = "INSERT INTO messages (message, sender, recipient, timesent, readstatus1)
                                            VALUE ('".mysql_real_escape_string($message)."', 'admin', '".$row1['owner']."', '".$timesent."', 'unread')";
                                        if(mysql_query($sql3)){

                                        }
                                    }
                                }
                            }else{
                                echo mysql_error()."<br>Error inserting your item to DB<br><a href='admin.php' class='btn btn-success'>Post items</a>";
                            }
                        }else{
                            echo "<h3>".$reason."</h3>";
                        }
                    }


                         ?>



                    </div>
                </div>
                <!-- /.row -->

               
                <!-- /.row -->

               
                   
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted"> Copyright &copy; Admin Lost N Found 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>