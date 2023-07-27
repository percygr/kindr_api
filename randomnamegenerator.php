<?php
$servername = "localhost";
$username = "root";
$password = "Casino.69";
$dbname = "names";

echo '
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$coinflip = rand(0,1);

if ($coinflip == 0) {
  $result = mysqli_query($conn, "SELECT * FROM boynames");
  $row_cnt = mysqli_num_rows($result);
  $randomnumber = rand(0, $row_cnt);


  $sql = "SELECT firstname FROM boynames";
  $result = $conn->query($sql);

  $rowcount = 0;
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $rowcount += 1;
      $chosenfirstname = $row["firstname"];
      if ($rowcount >= $randomnumber) break;

    }
  } else {
    echo "0 results";
  }

} else {
  $result = mysqli_query($conn, "SELECT * FROM girlnames");
  $row_cnt = mysqli_num_rows($result);
  $randomnumber = rand(0, $row_cnt);


  $sql = "SELECT firstname FROM girlnames";
  $result = $conn->query($sql);

  $rowcount = 0;
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $rowcount += 1;
      $chosenfirstname = $row["firstname"];
      if ($rowcount >= $randomnumber) break;

    }
  } else {
    echo "0 results";
  }

}
 

$result = mysqli_query($conn, "SELECT * FROM surnames");
$row_cnt = mysqli_num_rows($result);
$randomnumber = rand(0, $row_cnt);


$sql = "SELECT surname FROM surnames";
$result = $conn->query($sql);

$rowcount = 0;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    $rowcount += 1;
    $chosensurname = $row["surname"];
    if ($rowcount >= $randomnumber) break;

  }
} else {
  echo "0 results";
}

$conn->close();

echo "<br><br><br><table width=400 align=center><tr><td align=center>Your random ";

if ($coinflip ==0) {echo "male";} else {echo "female";}

echo " name is -<br><br></td></tr><tr><td align=center><h1>";

echo $chosenfirstname." ".$chosensurname;

echo "</h1></td></tr><tr><td align=center><br>Refresh for a new name</td></tr></table>"

?>