<?php
include('dbconnect.php');

$get_id=$_GET['id'];

$run=mysql_query("delete from payment where mpesacode='$get_id'")or die(mysql_error());

if($run){?>
<script type="text/javascript">
        alert("Deleted successfully");
          window.location= "pay.php";
</script>
<?php
}?>