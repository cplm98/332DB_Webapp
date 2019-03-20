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
  <link rel="stylesheet" type="text/css" href="..\static\home_style.css">
</head>

<body>


  <nav class="navbar navbar-expand-sm bg-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-dark" href=Home.php>Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href=Committees.php>Committees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="schedule.php">Schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="Sponsors.php">Sponsors</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="Jobs.php">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="Attendees.php">Attendees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="Finances.php">Finances</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="Edit.php">Edit</a>
      </li>
    </ul>
  </nav>
  <br>
  <?php
  $driver = "mysql";
  $host_name = 'localhost';
  $user_name = 'root';
  $password = '';
  $db_name = 'conferencev2';
  $dbh = new PDO("$driver:host=$host_name;dbname=$db_name", $user_name, $password);
  ?>
  <div class="intro_text">

    <div class="home_title">
      <h1>Schedule</h1>
      <h2>Day 1: Saturday</h2>
      <?php
      try {
          echo "<table class='table w-75 table-light table-bordered' border=1 align=left>", "<tr><th>", "Event Title", "</th><th>", "Start Time", "</th><th>", "End Time" ,"</th><th>", "Building" ,"</th><th>", "Room Number" ,"</th></tr>";
          $rows = $dbh->query("SELECT * From Sessions Where  Sessions.day_= 'Saturday'");
          while ($row = $rows->fetch()) {
            echo "<table", "<tr><td>" , $row['title'], "</td><td>", $row['start_time'] ,"</td><td>",$row['end_time'] ,"</td><td>",$row['building'] ,"</td><td>",$row['room_number'] ,"</td><tr>";
          }
      }
      catch(PDOException $e) {
          echo $e->getMessage();
      }
      ?>
    </div>
  </div>
  <div class="table2">
      <?php
      try {
          echo "<table class='table w-75 table-light table-bordered' border=1 align=left>", "<tr><th>", "Event Title", "</th><th>", "Start Time", "</th><th>", "End Time" ,"</th><th>", "Building" ,"</th><th>", "Room Number" ,"</th></tr>";
          $rows = $dbh->query("SELECT * From Sessions Where  Sessions.day_= 'Sunday'");
          while ($row = $rows->fetch()) {
            echo "<table", "<tr><td>" , $row['title'], "</td><td>", $row['start_time'] ,"</td><td>",$row['end_time'] ,"</td><td>",$row['building'] ,"</td><td>",$row['room_number'] ,"</td><tr>";
          }
      }
      catch(PDOException $e) {
          echo $e->getMessage();
      }
      ?>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <h2>Day 2: Sunday</h2>
  </div>
<?php
$dbh = null;
 ?>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>
