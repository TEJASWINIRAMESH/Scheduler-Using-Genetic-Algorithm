<?php

$username= $_POST['username'];
$password=$_POST['password'];

if (!empty($username) || !empty($password))
{
       $host = "localhost";
       $dbusername="root";
       $dbpassword="";
       $dbname="scheduler";

       $conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
       if (mysqli_connect_error()){
              die('Connect Error('.
              mysqli_connect_errno().')'
              .mysqli_connect_error());
       }
else{
       $SELECT= "SELECT username From 
       connect Where username =? Limit 1";
       $INSERT= "INSERT Into login(username,password)
       values(?,?,?,?)";
       $stmt = $conn->prepare($SELECT);
       $stmt->bind_param("s",$username);
       $stmt->execute();
       $stmt->bind_result($username);
       $stmt->store_result();
       $rnum=$stmt->num_rows;

       if ($rnum==0){
              $stmt->close();
              $stmt=$conn->prepare($INSERT);
              $stmt->bind_param("ss",$username,$password);
              $stmt->execute();
       }
       $stmt->close();
       $conn->close();
}
die();
}
       ?>