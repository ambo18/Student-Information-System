<?php 

  session_start();

  require 'connect.php';
  require 'functions.php';

  if(isset($_POST['update'])) {

    $studentno = clean($_POST['studentno']);
    $fname = clean($_POST['firstname']);
    $lname = clean($_POST['lastname']);
    $course = clean($_POST['course']);
    $yrlevel = clean($_POST['yrlevel']);

    $query = "UPDATE students SET studentno = '$studentno', firstname = '$fname', lastname = '$lname', course = '$course', yrlevel = '$yrlevel'
    WHERE id='".$_SESSION['userid']."'";

    if($result = mysqli_query($con, $query)) {

      $_SESSION['prompt'] = "Profile Updated";
      header("location:profile.php");
      exit;

    } else {

      die("Error with the query");

    }

  }

  if(isset($_SESSION['username'], $_SESSION['password'])) {

    $qry = mysqli_query($con,"SELECT * FROM students where id = {$_SESSION['userid']} ");
    $data = mysqli_fetch_array($qry);
    extract($data);

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Edit Profile - Student Information System</title>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
    
</head>
<body>

  <?php include 'header.php'; ?>

  <section>
    
    <div class="container">
      <strong class="title">Edit Profile</strong>
    </div>
    

    <div class="box-left">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <div class="form-group">
          <label>Student No:</label>
          
          <input type="text" class="form-control" name="studentno" value="<?php echo $studentno ?>" placeholder="Student Number" required>

        </div>


        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" class="form-control" name="firstname" value="<?php echo $firstname ?>" placeholder="First Name" required>
        </div>


        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" class="form-control" name="lastname" value="<?php echo $lastname ?>" placeholder="Last Name" required>
        </div>


        <div class="form-group">
          <label for="course">Course</label>

          <select class="form-control" name="course">
              <option value="BSIT" <?php echo $course == 'BSIT' ? "selected": ""; ?>>BSIT</option>
              <option value="BSCS" <?php echo $course == 'BSCS' ? "selected": ""; ?>>BSCS</option>
              <option value="BEED" <?php echo $course == 'BEED' ? "selected": ""; ?>>BEED</option>
              <option value="BEng" <?php echo $course == 'BEng' ? "selected": ""; ?>>BEng</option>
              <option value="BBA" <?php echo $course == 'BBA' ? "selected": ""; ?>>BBA</option>
              <option value="BEd" <?php echo $course == 'BEd' ? "selected": ""; ?>>BEd</option>
            </select>

        </div>


        <div class="form-group">
          <label for="yrlevel">Year Level</label>

          <select class="form-control" name="yrlevel">
            <option <?php echo $yrlevel == '1st year' ? "selected": ""; ?>>1st year</option>
            <option <?php echo $yrlevel == '2nd year' ? "selected": ""; ?>>2nd year</option>
            <option <?php echo $yrlevel == '3rd year' ? "selected": ""; ?>>3rd year</option>
            <option <?php echo $yrlevel == '4th year' ? "selected": ""; ?>>4th year</option>
          </select>

        </div>
        
        <div class="form-footer">
          <a href="profile.php">Go back</a>
          <input class="btn btn-primary" type="submit" name="update" value="Update Profile">
        </div>    

      </form>
    </div>

  </section>

	<script src="assets/js/jquery-3.1.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>
</html>

<?php 

  } else {
    header("location:profile.php");
  }

  mysqli_close($con);

?>