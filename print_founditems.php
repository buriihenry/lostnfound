

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
 <B>--------------------------------------Found Items-------------------------------------------</B> </div>
 <br/>



 <br/> <br/>
<table border="1" align="center" cellpadding="0" cellspacing="0" style="width:100%">
          <thead>
            <tr bgcolor="#cccccc" style="margin-bottom:10px;">
           
                                        <th><div align="center">Index</div></th>
                                        
                                        <th><div align="center">Item type</div></th>
                                        <th><div align="center">item name</div></th>
                                        <th><div align="center">item number</div></th>
                                        <th><div align="center">location lost</div></th>
                                        <th><div align="center">item Desc</div></th>
                                        <th><div align="center">Finder</div></th>
                                        <th><div align="center">Claimed</div></th>
                                        <th><div align="center">Mpesa Code</div></th>

                                        </tr>

            </tr>
          </thead>
          <tbody>
      <?php
        require "dbconnect.php";
          $user_query1=mysql_query("select * from founditems")or die(mysql_error());
                  while($row=mysql_fetch_array($user_query1)){
                   ?>
                  
                                    <td ><?php echo $row['index']; ?> </td>
                                    
                                     <td ><?php echo $row['itemtype']; ?> </td>
                                     <td ><?php echo $row['itemname']; ?> </td>
                                     <td ><?php echo $row['itemnumber']; ?> </td>
                                     <td ><?php echo $row['locationfound']; ?> </td>
                                     <td ><?php echo $row['itemdescription']; ?> </td>
                                     <td ><?php echo $row['finder']; ?> </td>
                                     <td ><?php echo $row['claimed']; ?> </td>
                                     <td ><?php echo $row['mpesacode']; ?> </td>



               </tr>
                  <?php  }  ?>
          </tbody>
              