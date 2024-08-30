
<?php
$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL);
mysqli_real_connect($conn, "fgatechnology.mysql.database.azure.com", "felipe", "!Barbisan2207!", "prj-rle", 3306, MYSQLI_CLIENT_SSL);
?>