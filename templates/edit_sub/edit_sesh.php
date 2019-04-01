<!DOCTYPE html>
<!-- saved from url=(0060)https://getbootstrap.com/docs/3.3/examples/starter-template/ -->
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Group 50 332 Final Project</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="..\..\static\home_style.css">
</head>

<body>


  <nav class="navbar navbar-expand-sm bg-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\Home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\Committees.php">Committees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\schedule.php">Schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\Sponsors.php">Sponsors</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\Jobs.php">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\Attendees.php">Attendees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\Finances.php">Finances</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="..\Edit.php">Edit</a>
      </li>
    </ul>
  </nav>
  <br>
  <div class="intro_text">

    <div class="home_title">
      <h1>Edit a Session</h1>

      <form method="post">
        <div class="form-group">
          <label for="sel1">Pick a session:</label>
            <select name ="sel_name" class="form-control w-75" id="sel1">
              <?php
              $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
              $rows = $dbh->query("SELECT title FROM sessions");
              if (empty($rows)){
                echo "<option>No Planned Sessions</option>";
              }
              else{
                while($row = $rows->fetch()){
                  echo $row;
                  if ($row['title'] != NULL){
                    echo "<option>", $row['title'], "</option>";
                  }
                }
              }
              $dbh = null;
              ?>
          </select>
        </label>
          <div class="form-group w-50">
            <label for="email">Start Time</label>
            <input class="form-control" id="email" name="s_time" placeholder="Enter New Start Time">
            <label for="fname">End Time</label>
            <input class="form-control" id="fname" name="e_time" placeholder="New End Time">
            <label for="sel1">Please Select a New Room:</label>
              <select name ="room_num" class="form-control" id="sel1">
            <?php
            $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
            $rows = $dbh->query("SELECT building, room_number From location");
            if (empty($rows)){
              echo "<option>No available rooms</option>";
            }
            else{
              while($row = $rows->fetch()){
                echo $row;
                if ($row['building'] != NULL){
                  echo "<option>", $row['building'], " Room ", $row['room_number'] ,"</option>";
                }
              }
            }
            ?>
              </select>
              <div class="form-group">
                <label for="sel1">Select Day:</label>
                <select name ="day" class="form-control w-75" id="sel1">
                  <option>Saturday</option>
                  <option>Sunday</option>
                </select>
              </div>
            </label>
          </div>
          </div>
          <input class="btn-light btn" type="submit" name="time_sub"/>
        </form>
      </div>
    <?php
    if(isset($_POST['time_sub'])){
      $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
      $str = explode(" Room ", $_POST['room_num']);
      echo $_POST['sel_name'];
      $sql = "UPDATE sessions SET day_ = ?, start_time = ?, end_time = ?, building = ?, room_number = ? WHERE title=?";
      $dbh->prepare($sql)->execute([$_POST['day'], $_POST['s_time'], $_POST['e_time'], $str[0], $str[1], $_POST['sel_name']]);
    }
    ?>
   </div>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>
