<?php


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
                <a class="navbar-brand" href="admin.php">Welcom Admin Lost N found </a>
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
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="print.php"><i class="fa fa-fw fa-edit"></i> Print</a>
                    </li>
                    <li>
                        <a href="forms.php"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                   <li>
                        <a href="pay.php"><i class="fa fa-fw fa-edit"></i> View Payment</a>
                    </li>
                    <li>
                        <a href="items.php"><i class="fa fa-fw fa-edit"></i> View Lost Items</a>
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
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    
                    </div>
                 
             <table cellpadding="1" cellspacing="1" border="1" class="table  table-bordered" id="example">
                             
                <p> <a style="margin-left: 500px;" href="#"><input type="button" class="btn btn-success" value="Back"></a>
                <a  href="add_users.php" class="btn btn-primary" style="color:white;"><i class="icon-plus"></i>&nbsp;Add User</a></p>
              
                                <thead  id="example">
                                    <tr>
                                        <th  id="example"><font color="purple">ID</font></th>
                                        <th  id="example"><font color="purple">First Name</font></th>
                                        <th  id="example"><font color="purple">Last Name</font></th>
                                        <th  id="example"><font color="purple">Email</font></th>
                                        <th  id="example"><font color="purple">phonenumber</font></th>
                                        <th  id="example"><font color="purple">Password</font></th>
                                        <th  id="example"><font color="purple">Actions</font></th> 
                                    </tr>
                                </thead>
                                <tbody>
                 <?php
                 require "dbconnect.php";
      $user_query=mysql_query("select * from users")or die(mysql_error());
                  while($row=mysql_fetch_array($user_query)){
                  
             ?>
   <tr >
   <td  id="example"><font color="black"><?php echo $row['index']; ?></font></td>
  <td  id="example"><font color="black"><?php echo $row['fname']; ?></font></td>                            
   <td  id="example"><font color="black"><?php echo $row['sname']; ?></font></td>
   <td  id="example"><font color="black"><?php echo $row['email']; ?></font> </td>
  <td  id="example"><font color="black"><?php echo $row['phonenumber']; ?></font> </td>
    <td  id="example"><font color="black"><?php echo $row['password']; ?></font> </td>  
<td  id="example"><a rel="tooltip"  title="Delete" id="<?php echo  $row['fname']; ?>" onClick="return confirm('Are you sure you want to delete?')" href="delete_user.php?id=<?php echo $row['fname'];?>" data-toggle="modal"    class="btn btn-danger"><i class="icon-trash  icon-large"></i></a>
<a  rel="tooltip"  title="Edit" id="<?php echo $row['fname']; ?>" href="update_users.php?id=<?php echo $row['fname'];?>" class="btn btn-info"><i class="icon-list icon-large"></i></a>
                                    </td>
                  
                                    </tr>
                  <?php  }  ?>
                           
                                </tbody>
                            </table>
                    <div class="col-lg-4 col-md-6">
                        
                </div>
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
                    <p class="copyright text-muted">Copyright &copy; Admin Lost N Found</p>
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