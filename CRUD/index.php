<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>CRUD in PHP</title>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel='stylesheet' type='text/css' href='css/style.php' />

  <?php include "header.php"; ?>
</head>
<body>
<?php require_once  'process.php'; ?> 

<?php if (isset($_SESSION['message'])): ?>
  <div class="container alert alert-<?=$_SESSION['msg_type']?>">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>

<div class="container mt-xl-5">
<div class="modal-body row">
  <!-- Start of left side -->
  <div class="scrollbar scrollbar-primary force-overflow col-md-6 row justify-content-center">
      <?php
        $mysqli = new mysqli('localhost', 'felix', '123456', 'crud_firstlast') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
      ?>
      <table class="table" dir="ltr"> <!-- bootstrap -->
        <thead>
           <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td> <?php echo $row['first_name']; ?> </td>
          <td> <?php echo $row['last_name']; ?> </td>
          <td>            
            <a href="index.php?edit=<?php echo $row['id'];?>"
              class="btn btn-info">Edit</a>
            <a href="process.php?delete=<?php echo $row['id']; ?>"
              class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </table> <!-- End of class="table -->
  </div> <!-- End of left side -->



  <!-- Start of right side -->
  <div class="col-md-4 row justify-content-center">
    <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>" placeholder="Enter your first name">
      </div>

      <div class="form-group" >
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" placeholder="Enter your last name">
      </div>

      <div class="form-group">
        <?php if ($update == true): ?>
          <button type="submit" class="btn btn-primary" name="update">Update</button>
        <?php endif; if ($update == false): ?>
          <button type="submit" class="btn btn-primary" name="save">Save</button>
        <?php endif; ?>
      </div>
    </form>
  </div> <!-- End of right side -->
</div> <!-- End of modal-body-row -->
</div> <!-- End of Container -->

</body>
</html>

<style>
  .scrollbar{
    direction: rtl;
    margin-left: 20px;
    float: left;
    height: 480px;
    overflow-y: scroll;
    margin-bottom: 25px;

    background: #fff;

  }
  
  .force-overflow {
    min-height: 450px;
  } 

  .scrollbar-primary::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5; }

</style>
