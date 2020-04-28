<?php

session_start();

$mysqli = new mysqli('localhost', 'felix', '123456', 'crud_firstlast') or die(mysqli_error($mysqli));

$id = 0;
$first_name = '';
$last_name = '';
$update = false;

function move_to(){
  header('Location: index.php');
}

#Check if button was clicked
if(isset($_POST['save'])){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  $mysqli->query("INSERT INTO data(first_name, last_name) VALUES('$first_name', '$last_name')") or die($mysqli->error);

  
  $_SESSION['message'] = "Record has been saved!";
  $_SESSION['msg_type'] = "success";

  move_to();

}

if (isset($_GET['delete'])){
  $id = $_GET['delete'];

  $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  move_to();

}

if (isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update = true;

  $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

  if($result->num_rows){
    $row = $result->fetch_array();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
  }
}

if (isset($_POST['update'])){
  $id = $_POST['id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  $mysqli->query("UPDATE data SET first_name='$first_name', last_name='$last_name' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been updated!";
  $_SESSION['msg_type'] = "warning";

  move_to();
}
?>
