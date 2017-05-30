<?php
include('dbconnect.php');

$get_id=$_GET['id'];

$run=mysql_query("delete from users where fname='$get_id'")or die(mysql_error());

if($run){?>
<script type="text/javascript">
        alert("Deleted successfully");
          window.location= "forms.php";
</script>
<?php
}?>