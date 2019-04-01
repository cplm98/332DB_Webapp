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
  <link rel="stylesheet" type="text/css" href="..\static\Attendees.css">
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
  <div class="intro_text">

    <div class="home_title">
      <h1>Attendees</h1>
    </div>
    <form method="post">
      <div class="form-group">
        <label for="sel1">Please select a type of attendee:</label>
        <select name ="attendee" class="form-control w-75" id="sel1">
          <option>Students</option>
          <option>Professionals</option>
          <option>Sponsors</option>
        </select>
      </div>
      <input class="btn-light btn" type="submit" name ="send"/>
    </form>
    <?php
    if(isset($_POST['send'])){
      $val = $_POST['attendee'];  // Storing Selected Value In Variable
      //echo "<br>";
      //echo "<div id='Table1'>";
      //echo "<h3>$val:</h3>";
      echo "<table class='table w-75 table-light table-bordered' border=1 align=left>", "<tr><th>", "Registration Number", "</th><th>", "First Name", "</th><th>", "Last Name" ,"</th></tr>";
      $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
      if ($val == "Students"){
        $rows = $dbh->query("SELECT attendees.fname, attendees.lname, attendees.registration_num From attendees, students Where students.registration_num = attendees.registration_num");
        while ($row = $rows->fetch()) {
          echo "<table", "<tr><td>", $row['registration_num'], "</td><td>" , $row['fname'], "</td><td>", $row['lname'] ,"</td></tr>";
        }
      }
      if ($val == "Professionals"){
        $rows = $dbh->query("SELECT attendees.fname, attendees.lname, attendees.registration_num From attendees, professional Where professional.registration_num = attendees.registration_num");
        while ($row = $rows->fetch()) {
          echo "<table", "<tr><td>", $row['registration_num'], "</td><td>" , $row['fname'], "</td><td>", $row['lname'] ,"</td></tr>";
        }
      }
      if ($val == "Sponsors"){
        $rows = $dbh->query("SELECT attendees.fname, attendees.lname, attendees.registration_num From attendees, sponsors Where sponsors.registration_num = attendees.registration_num");
        while ($row = $rows->fetch()) {
          echo "<table", "<tr><td>", $row['registration_num'], "</td><td>" , $row['fname'], "</td><td>", $row['lname'] ,"</td></tr>";
        }
      }
      // SO THE FORM WORKS, NOW JUST HAVE TO DO THE QUERY
      // $dbh = new PDO('mysql:host=localhost;dbname=conference_test', "root", "");
      // $rows = $dbh->query("SELECT registration_num, fname FROM attendees");
      // echo "<table border=1 align=left>", "<tr><th>", "Registration Number", "</th><th>", "Name", "</th></tr>";

    }
    $dbh = null;
    ?>
    <!--pick a hotel room and list all the occupants -->
    <br>
    <br>
    <form method="post">
      <div class="form-group">
        <label for="sel1">To see the room arrangements and occupants, select a room number below:</label>
        <select name ="rooms" class="form-control w-75" id="sel1">
          <?php
          $pdo = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
          $rows = $pdo->query("SELECT hotel_room.room_num, students.registration_num
            FROM hotel_room, students
            WHERE hotel_room.room_num = students.room_number
            GROUP BY hotel_room.room_num");


            if (empty($rows)){
              echo "<option>No rooms are occupied.</option>";
            }
            else{
              while($row = $rows->fetch()){
                //echo $row;
                if ($row['room_num'] != NULL){
                  echo "<option>", $row['room_num'], "</option>";
                }
              }
            }

            ?>



          </select>
        </div>
        <input class="btn-light btn" type="submit" name ="sendRoom"/>
        <br>
        <br>
      </form>

      <?php //once submitted, list the first and last names from query
      if(isset($_POST['sendRoom'])){
        $selected_room = $_POST['rooms'];
        //echo "<br>";
        echo "<h3>Memebers of room $selected_room:</h3>";
        //$pdo = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
        $rows = $pdo->query("SELECT fname, lname
        from hotel_room, students, attendees
        where hotel_room.room_num = students.room_number
        and attendees.registration_num = students.registration_num
        and hotel_room.room_num = $selected_room
        ");

        echo "<table class='table w-75 table-light table-bordered' border=1 align=left><tr><th>First Name</th><th>Last Name</th></tr>";
        while ($row = $rows->fetch()) {
          echo "<tr><td>".$row["fname"]."</td><td>".$row["lname"]."</td></tr>";
        }
        $pdo = null;
      }
      if(isset($_POST['send'])){
        echo "<h3>$val:</h3>";
      }
      ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  </body>

  </html>
