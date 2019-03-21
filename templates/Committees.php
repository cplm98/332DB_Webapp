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
  <link rel="stylesheet" type="text/css" href="..\static\Committees.css">
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
      <h1>Committees</h1>
    </div>

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

    <form method="post">
      <div class="form-group">
        <label for="sel1">Please select the sub-committee group:</label>
        <select name ="sub-committee" class="form-control w-75" id="sel1">
          <?php //fill the form with sub-committees
              $rows = $pdo->query("SELECT comm_name FROM sub_committees");
              if (empty($rows)){
                echo "<option>No sub-committees availiable.</option>";
              }
              else{
                while($row = $rows->fetch()){
                  echo $row;
                  if ($row['comm_name'] != NULL){
                    echo "<option>", $row['comm_name'], "</option>";
                  }
                }
              }
          ?>
        </select>
      </div>
      <input class="btn-light btn" type="submit" name ="send"/>
    </form>

    <?php //once submitted, list the first and last names from query
      if(isset($_POST['send'])){
        $selected_subcommittee = $_POST['sub-committee'];
        echo "<p>$selected_subcommittee members:</p>";

        $sql = "select fname, lname
        from Sub_committees, Member_of, Attendees
        where registration_num = member_id and comm_name = '$selected_subcommittee' and '$selected_subcommittee' = commitee_name";
        $statement = $pdo->prepare($sql);
        $statement->execute([$sql]);

        echo "<table class='table w-75 table-light table-bordered' border=1 align=left><tr><th>First Name</th><th>Last Name</th></tr>";
        while ($row = $statement->fetch()) {
        	echo "<tr><td>".$row["fname"]."</td><td>".$row["lname"]."</td></tr>";
        }
        $pdo = null;
      }
    ?>



  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>
