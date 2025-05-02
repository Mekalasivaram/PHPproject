<?php
$username = "root";
$password = "";
$server = 'localhost';
$db = 'travelandtourism';

$con = mysqli_connect($server, $username, $password, $db);

if($con){
    // echo "connection successful";
    ?>
    <script>
        // alert("connection successfull!!!");
    </script>


    <?php
    
}else{
    die("no connection". mysqli_connect_error());
}

?>