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
  <div class="intro_text">

    <div class="home_title">
      <h1>Edit</h1>
      <form method="post">
        <div class="form-group">
          <label for="sel1">Please select a type of attendee:</label>
          <select name ="edit_select" class="form-control w-75" id="sel1">
            <option>Add Student</option>
            <option>Add Sponsored Attendee</option>
            <option>Add Professional Attendee</option>
            <option value="add_Sp">Add Sponsoring Company</option>
            <option value="del_Sp">Delete Sponsoring Company</option>
            <option value="edit_ses">Edit Session</option>
          </select>
        </div>
        <input class="btn-light btn" type="submit" name ="send"/>
      </form>
    </div>
    <?php if (isset($_POST['send']) && $_POST['edit_select'] == "Add Student") : ?>
      <form method="post">
        <div class="form-group w-50">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
          <label for="fname">First Name</lable>
          <input class="form-control" id="fname" name="fname" placeholder="First Name">
          <label for="lname">Last Name</lable>
          <input class="form-control" id="lname" name="lname" placeholder="First Name">
          <!-- Might wanna generate this behind the scenes -->
          <label for="reg_num">Registration Number</lable>
          <input class="form-control" id="reg_num" name="reg_num" placeholder="Registration Number">
          <div class="form-group">
            <label for="sel1">Please Select a Room:</label>
              <select name ="room_num" class="form-control w-75" id="sel1">
          <?php
          $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
          $rows = $dbh->query("SELECT CASE WHEN number_of_beds > occupancy then room_num END as room_num FROM hotel_room");
          if (empty($rows)){
            echo "<option>No available rooms</option>";
          }
          else{
            while($row = $rows->fetch()){
              echo $row;
              if ($row['room_num'] != NULL){
                echo "<option>", $row['room_num'], "</option>";
              }
            }
          }
          ?>
            </select>
          </label>
        </div>
        </div>
        <input class="btn-light btn" type="submit" name="student_sub"/>
      </form>
    <!-- Do I have to update occupancy or should that be part of the database? -->
    <?php endif; ?>
    <?php
    if(isset($_POST['student_sub'])){
      $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
      $sql = "INSERT INTO attendees (registration_num, fname, lname, email, rate) VALUES (?,?,?,?,?)";
      $dbh->prepare($sql)->execute([$_POST['reg_num'], $_POST['fname'], $_POST['lname'], $_POST['email'], 50]);
      $sql = "INSERT INTO students (registration_num, room_number) VALUES (?,?)";
      $dbh->prepare($sql)->execute([$_POST['reg_num'], $_POST['room_num']]);
      $dbh = null;
    }
    ?>
    <?php if (isset($_POST['send']) && $_POST['edit_select'] == "Add Sponsored Attendee") : ?>
    <form method="post">
      <div class="form-group w-50">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        <label for="fname">First Name</lable>
        <input class="form-control" id="fname" name="fname" placeholder="First Name">
        <label for="lname">Last Name</lable>
        <input class="form-control" id="lname" name="lname" placeholder="First Name">
        <!-- Might wanna generate this behind the scenes -->
        <label for="reg_num">Registration Number</lable>
        <input class="form-control" id="reg_num" name="reg_num" placeholder="Registration Number">
        <div class="form-group">
          <label for="sel1">Please Select a Sponsoring Company:</label>
            <select name ="room_num" class="form-control w-75" id="sel1">
              <?php
              $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
              $rows = $dbh->query("SELECT comp_name FROM company");
              if (empty($rows)){
                echo "<option>No Sponsoring Companies</option>";
              }
              else{
                while($row = $rows->fetch()){
                  echo $row;
                  if ($row['comp_name'] != NULL){
                    echo "<option>", $row['comp_name'], "</option>";
                  }
                }
              }
              ?>
          </select>
        </label>
      </div>
      <input class="btn-light btn" type="submit" name="sponsor_sub"/>
    </form>
    <?php endif; ?>
    <?php
    if(isset($_POST['sponsor_sub'])){
      $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
      $sql = "INSERT INTO attendees (registration_num, fname, lname, email, rate) VALUES (?,?,?,?,?)";
      $dbh->prepare($sql)->execute([$_POST['reg_num'], $_POST['fname'], $_POST['lname'], $_POST['email'], 0]);
      $sql = "INSERT INTO sponsors (registration_num, comp_name) VALUES (?,?)";
      $dbh->prepare($sql)->execute([$_POST['reg_num'], $_POST['room_num']]);
      $dbh = null;
    }
    ?>
    <?php if (isset($_POST['send']) && $_POST['edit_select'] == "Add Professional Attendee") : ?>
      <form method="post">
        <div class="form-group w-50">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
          <label for="fname">First Name</lable>
          <input class="form-control" id="fname" name="fname" placeholder="First Name">
          <label for="lname">Last Name</lable>
          <input class="form-control" id="lname" name="lname" placeholder="First Name">
          <!-- Might wanna generate this behind the scenes -->
          <label for="reg_num">Registration Number</lable>
          <input class="form-control" id="reg_num" name="reg_num" placeholder="Registration Number">
          <label for="comp_name">Company Name</lable>
          <input class="form-control" id="comp_name" name="comp_name" placeholder="Company Name">
        </div>
        <input class="btn-light btn" type="submit" name="prof_sub"/>
      </form>
    <?php endif; ?>
    <?php
    if(isset($_POST['prof_sub'])){
      $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
      $sql = "INSERT INTO attendees (registration_num, fname, lname, email, rate) VALUES (?,?,?,?,?)";
      $dbh->prepare($sql)->execute([$_POST['reg_num'], $_POST['fname'], $_POST['lname'], $_POST['email'], 100]);
      $sql = "INSERT INTO professional (registration_num, comp_name) VALUES (?,?)";
      $dbh->prepare($sql)->execute([$_POST['reg_num'], $_POST['room_num']]);
      $dbh = null;
    }
    ?>
    <?php if (isset($_POST['send']) && $_POST['edit_select'] == "add_Sp") : ?>
      <form method="post">
        <div class="form-group w-50">
          <label for="comp_name">Company Name</label>
          <input class="form-control" id="comp_name" name="comp_name" placeholder="Company Name">
          <label for="sel1">Please select a Sponsorship Tier:</label>
          <select name ="tier" class="form-control w-75">
            <option>Platinum ($10000)</option>
            <option>Gold ($5000)</option>
            <option>Silver ($3000)</option>
            <option>Bronze ($1000)</option>
          </select>
        </div>
        <input class="btn-light btn" type="submit" name="comp_sub"/>
      </form>
    <?php endif; ?>
    <?php if(isset($_POST['comp_sub'])){
      if ($_POST['tier'] == 'Platinum ($10000)'){
        $val = 10000;
        $lvl = 'Platinum';
      }
      else if ($_POST['tier'] == 'Gold ($5000)'){
        $val = 5000;
        $lvl = 'Gold';
      }
      else if ($_POST['tier'] == 'Silver ($3000)'){
        $val = 3000;
        $lvl = 'Silver';
      }
      else if ($_POST['tier'] == 'Bronze ($1000)'){
        $val = 1000;
        $lvl = 'Bronze';
      }
      $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
      $sql = "INSERT INTO company (comp_name, comp_level, spons_rate, emails_sent, emails_remaining) VALUES (?,?,?,?,?)";
      $dbh->prepare($sql)->execute([$_POST['comp_name'], $lvl, $val, 0, 0]);
      $dbh = null;
    }
    ?>
    <?php
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>
