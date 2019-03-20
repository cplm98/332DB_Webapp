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
          <label for="room_num">Room Number</lable>
          <input class="form-control" id="room_num" name="room_num" placeholder="Room Number">
        </div>
        <input class="btn-light btn" type="submit" name="student_sub"/>
      </form>
      <!-- maybe you can't have php between those two php if tags -->
    <?php
    echo "down here";
    endif; ?>
    <?php
    if(isset($_POST['student_sub'])){
      echo "here";
      $dbh = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
      $sql = "INSERT INTO attendees (registration_num, fname, lname, email, rate) VALUES (?,?,?,?,?)";
      $stmt = $dbh->prepare($sql);
      $stmt->execute([$_POST['reg_num'], $_POST['fname'], $_POST['lname'], $_POST['email'], 50]);
      $dbh = null;
    }
    ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>
