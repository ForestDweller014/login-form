<?php
$status = $_REQUEST['status'];
$numreq = $_REQUEST['numreq'];

if ($status == "reg") {
    $registeredUsername = $_REQUEST['registeredUsername'];
    $registeredPassword = $_REQUEST['registeredPassword'];
}

if ($status == "log") {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
}

$conn = mysqli_connect("localhost","postgres","joni","pr3");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$count = mysqli_query($conn, "SELECT COUNT(Usernames) FROM logininfo");
$count1 = mysqli_fetch_array($count);
$count1 = $count1['COUNT(Usernames)'];

if ($numreq != "nullifier") {
    echo $count1;
}

if ($status == "reg") {
    $query1 = mysqli_query($conn, "SELECT Passwords FROM logininfo WHERE Usernames = '$registeredUsername'");
	  $value1 = mysqli_fetch_array($query1);
	  $value1 = $value1['Passwords'];
  
	  if ($value1 == null) {
	      mysqli_query($conn, "INSERT INTO logininfo (Usernames, Passwords) VALUES ('$registeredUsername', '$registeredPassword')");
		    echo "You have been registered";
	  } else {
	      echo "Username already exists";
	  }
}

if ($status == "log") {
    $query2 = mysqli_query($conn, "SELECT Passwords FROM logininfo WHERE Usernames = '$username'");
	  $value2 = mysqli_fetch_array($query2);
	  $value2 = $value2['Passwords'];
  
	  if ($value2 == null) {
	      echo "Wrong username"; 
	  } else {
		    if ($password == $value2) {
			      echo "Login was successful"; 
		    } else {
			      echo "Wrong password"; 
		    }
	  }
}
mysqli_close($conn);
?>
