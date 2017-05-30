

                <div class="row">
                    
                    </div>
         
            <script>
function myFunction()
{
        var printButton = document.getElementById("printpagebutton");
        printButton.style.visibility = 'hidden';
        printButton.style.visibility = 'hidden';
        window.print()
}

</script>

<!-- sdas -->




<a href="forms.php" id="printpagebutton" onclick="myFunction()">Print</a>

                    <div align="center" style="margin-top:40px; height:130px;"><img src="img/intro.jpg" height="100%"><br />
 <B>--------------------------------------Users Records-------------------------------------------</B> </div>
 <br/>



 <br/> <br/>
<table border="1" align="center" cellpadding="0" cellspacing="0" style="width:100%">
          <thead>
            <tr bgcolor="#cccccc" style="margin-bottom:10px;">
           
                                        <th><div align="center">First Name</div></th>
                                        
                                        <th><div align="center">Last name</div></th>
                                        <th><div align="center">Email</div></th>
                                        <th><div align="center">phone number</div></th>
                                        </tr>

            </tr>
          </thead>
          <tbody>
      <?php
        require "dbconnect.php";
          $user_query1=mysql_query("select * from users")or die(mysql_error());
                  while($row=mysql_fetch_array($user_query1)){
                   ?>
                  
                                    <td ><?php echo $row['fname']; ?> </td>
                                    
                                     <td ><?php echo $row['sname']; ?> </td>
                                     <td ><?php echo $row['email']; ?> </td>
                                     <td ><?php echo $row['phonenumber']; ?> </td>


               </tr>
                  <?php  }  ?>
          </tbody>
              