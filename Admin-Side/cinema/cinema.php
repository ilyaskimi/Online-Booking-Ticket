<?php
  include ('../../Config/db_config.php');

  $query = 'SELECT * FROM cinema ORDER BY cinema_id ASC';

  $res = mysqli_query($conn, $query);
  $cinemaList = mysqli_fetch_all($res, MYSQLI_ASSOC);
  $cinemaName = '';
    $cinemaLocation = '';
  $cinemaDesc = '';
  if (isset($_GET['delete'])) {
    $query = "DELETE FROM cinema WHERE cinema_id = {$_GET['delete']}";
    mysqli_query($conn,$query);
    header('Location: cinema.php');
  }

  if (isset($_GET['edit'])){
    $query = "SELECT * FROM cinema WHERE cinema_id = {$_GET['edit']}";
    $res = mysqli_query($conn, $query);
    $cinemaInst = mysqli_fetch_array($res);

    $cinemaName = $cinemaInst['cinema_name'];
    $cinemaLocation = $cinemaInst['cinema_location'];
    $cinemaDesc = $cinemaInst['cinema_description'];
  } 

  if (isset($_POST['editCinema'])){
    echo $_POST['cinemaName'];
    $cinemaName = $_POST['cinemaName'];
    $cinemaLocation = $_POST['cinemaLocation'];
    $cinemaDesc = $_POST['cinemaDesc'];

    //$query = "UPDATE cinema SET cinema_name = $cinemaName, cinema_location = $cinemaLocation, cinema_description = $cinemaDesc WHERE cinema_id = ";
  }
  // Free Result
  mysqli_free_result($res);

  // Close Connection
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Bootstrap CSS CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Asset/style.css" />
    <title>Manage Cinema</title>
    
      
  </head>
  <body>
    
    <div class="dashboardContainer">
      <?php include '../../Asset/sideNav.php'; ?>  
      
      <div id="main">
          <h2>Manage Cinema</h2>

          <form class="col-8" action="./addCinema.php" method="post" style="margin: 0px 20px;">
            <div class="form-group col-8">
              <label for="inputName">Name</label>
              <input type="text" class="form-control col-12" id="inputName" name="cinemaName" placeholder="Enter Name" value="<?php echo $cinemaName ?>" required>
            </div>
            <div class="form-group col-8">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control col-12" id="inputAddress" name="cinemaLocation" placeholder="Enter Adress" value="<?php echo $cinemaLocation ?>"required>
            </div>
            <div class="form-group col-8">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea class="form-control col-12" id="exampleFormControlTextarea1" name="cinemaDesc" rows="3" required> <?php echo $cinemaDesc ?> </textarea>
            </div>

            <?php if (isset($_GET['edit'])) {
              $id = $_GET['edit'];
        echo '<input  type="hidden" name="cinID" value="'.$id.'"></input>';
        echo '<button name="editCinema" type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Edit</button>';
        echo "<a href='./cinema.php' type='button' class='btn btn-outline-danger col-md-2 offset-md-5' >Cancel</a>";
      } else {
        echo '<button name="addCinema" type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Add New</button>';} ?>
          </form>

          <br>

          <table class="table w-75 p-3" style="margin: 0px 20px;">
            <thead>
              <tr>
                <th scope="col">Cinema ID</th>
                <th scope="col">Cinema</th>
                <th scope="col">Location</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($cinemaList as $cinemaRes) : ?>  
                <tr>
                  <?php $cinID = $cinemaRes['cinema_id']; ?>
                  <td><?php echo $cinemaRes['cinema_id']; ?></td>
                  <td><?php echo $cinemaRes['cinema_name']; ?></td>
                  <td><?php echo $cinemaRes['cinema_location']; ?></td>
                  <td><a type="button" href="./cinema.php?edit=<?php echo $cinID ?>"class="btn btn-outline-success col-md-5">Edit</a>
                  &nbsp;
                  <a type="button" href="./cinema.php?delete=<?php echo $cinID ?>" class="btn btn-outline-danger col-md-5">Delete</a>
                  </td>
                </tr>
            <?php endforeach; ?>  
            </tbody>
          </table>

      </div>

    </div>

  </body>
  
</html>