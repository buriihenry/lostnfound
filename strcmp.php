<!DOCTYPE html>
<html>
<body>

<?php
echo strcmp("Hello world!","world! Hello")."<br>"; // the two strings are equal
echo strcmp("Hello world!","Hello")."<br>"; // string1 is greater than string2
echo strcmp("Hello world!","Hello world! Hello!")."<br>"; // string1 is less than string2
?>

</body>
</html>