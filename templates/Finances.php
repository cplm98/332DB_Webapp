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
      <h1>Finances</h1>
    </div>

  <!--show the total intake of the conference broken down by total registration amounts and total sponsorship amounts.-->
  <?php  //try to connect to database
  try{
  $pdo = new PDO('mysql:host=localhost;dbname=conferenceV2', "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {
    echo "Connection failed: " . $e->getMessage();
  }
  ?>

  <div class="registered_attendees">
    <h2>Registered Attendees</h2>
    <?php

    echo "<table class='table w-75 table-light table-bordered' border=1 align=left>", "<tr><th>", "","</th>","<th>", "Students","</th>","<th>","Professionals", "</th><th>", "Sponsors" ,"</th></tr>";
    echo "<tr><th>", "Cost ($)","</th>","<th>", "50","</th>","<th>","100", "</th><th>", "0" ,"</th></tr>";
    echo "<tr><th>", "Number Attending","</th>";

    $sqlStudents = "select count(registration_num) as numStudents from students";
    $sqlProfessionals ="select count(registration_num) as numProfessionals from professional";
    $sqlSponsors = "select count(registration_num) as numSponsors from sponsors";

    $studentStatement = $pdo->prepare($sqlStudents);
    $studentStatement->execute([$sqlStudents]);
    $studentStatement = $studentStatement->fetch()["numStudents"];
    echo "<th>".$studentStatement."</th>";

    $professionalsStatement = $pdo->prepare($sqlProfessionals);
    $professionalsStatement->execute([$sqlProfessionals]);
    $professionalsStatement=$professionalsStatement->fetch()["numProfessionals"];
    echo "<th>".$professionalsStatement."</th>";

    $sponsorsStatement = $pdo->prepare($sqlSponsors);
    $sponsorsStatement->execute([$sqlSponsors]);
    echo "<th>".$sponsorsStatement->fetch()["numSponsors"]."</th></tr>";

    echo "<tr><th>", "Net Gain ($)","</th>";
    $studentsEarned = $studentStatement * 50;
    echo "<th>",$studentsEarned,"</th>";
    $professionalsEarned = $professionalsStatement * 50;
    echo "<th>",$professionalsEarned,"</th>";
    echo "<th>","0","</th></tr>";

     ?>
    </div>



     <br>
     <div class="Sponsorships">
       <h2>Sponsorships</h2>

       <?php
       $totalSponsor = 0;
       $rows = $pdo->query("select comp_name, comp_level, spons_rate from company");
       echo "<table class='table w-75 table-light table-bordered' border=1 align=left>", "<tr><th>", "Company Name","</th>","<th>","Level", "</th><th>", "Sponsorship Rate" ,"</th></tr>";
       while ($row = $rows->fetch()) {
         echo "<table", "<tr><td>" , $row['comp_name'], "</td><td>", $row['comp_level'] ,"</td><td>",$row['spons_rate'] ,"</td></tr>";
         $totalSponsor = $row['spons_rate'] + $totalSponsor;
       }

       echo "<h3>Total earned through sponsorships: $ $totalSponsor</h3>";
       ?>

   </div>
  </div>
   <?php

   $pdo = null;
    ?>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
