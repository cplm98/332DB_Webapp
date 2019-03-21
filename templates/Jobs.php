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
  <link rel="stylesheet" type="text/css" href="..\static\jobs.css">
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
      <h1>Jobs</h1>
      <h6>View all job postings or filter postings by company.</h6>
    </div>
    <?php
    $driver = "mysql";
    $host_name = 'localhost';
    $user_name = 'root';
    $password = '';
    $db_name = 'conferencev2';
    $dbh = new PDO("$driver:host=$host_name;dbname=$db_name", $user_name, $password);
    ?>
    <form method="post" name='send'>
      <div class="dropdown">
        <select name="company" class="dropbtn" id="company">
        <div class="dropdown-content">
          <option disbled selected>Filter..</option>
          <option> All Jobs</option>
          <?php
              $rows = $dbh->query("SELECT comp_name FROM jobs");
              if (empty($rows)){
                echo "<option>No Companies have jobs posted!</option>";
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
        </div>
      </select>
      <input class="refresh" type="submit" name ="send" value="Apply Filter"/>
      <br>
      <br>
      <?php
      if(isset($_POST['send'])){
        $comp=$_POST['company'];
          if ($comp=="All Jobs"){
            echo "Showing results for all job postings.";
            echo "<table class='table w-75 table-light table-bordered' border=1 align=left>", "<tr><th>", "Job ID", "</th><th>", "Job Title", "</th><th>", "City" ,"</th><th>", "State" ,"</th><th>","Salary" ,"</th><th>", "Company" ,"</th></tr>";
              $rows = $dbh->query("SELECT * From jobs");
              while ($row = $rows->fetch()) {
                echo "<table", "<tr><td>" , $row['Job_ID'], "</td><td>", $row['Title'] ,"</td><td>",$row['City'] ,"</td><td>",$row['Province'] ,"</td><td>",$row['Pay_rate'] ,"</td><td>",$row['comp_name'] ,"</td><tr>";
              }
          }
          else if ($comp=="Filter.."){
            echo "Choose a Company to view their jobs!";
          }
          else {
            echo "Showing results for $comp job postings. ";
            echo "<table class='table w-75 table-light table-bordered' border=1 align=left>", "<tr><th>", "Job ID", "</th><th>", "Job Title", "</th><th>", "City" ,"</th><th>", "State" ,"</th><th>","Salary" ,"</th></tr>";
              $rows = $dbh->query("SELECT * From jobs Where jobs.comp_name='$comp'");
              while ($row = $rows->fetch()) {
                echo "<table", "<tr><td>" , $row['Job_ID'], "</td><td>", $row['Title'] ,"</td><td>",$row['City'] ,"</td><td>",$row['Province'] ,"</td><td>",$row['Pay_rate'] ,"</td><tr>";
              }
            }
        }
      ?>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
