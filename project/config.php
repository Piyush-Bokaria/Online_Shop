
<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'ecommerece');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM register WHERE Name='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Name'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO register (Name, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['Name'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM register WHERE email='$username'";
    $results = mysqli_query($db, $query);
    
    if ($results && mysqli_num_rows($results) == 1) {
      $user = mysqli_fetch_assoc($results);
      if (password_verify($password, $user['password'])) {
        $_SESSION['email'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
        exit();
      } else {
        array_push($errors, "Hello, Wrong username/password combination");
      }
    } else {
      array_push($errors, "Hello, Wrong username/password combination");
    }
  }
}

if(isset($_POST["email"]) && isset($_POST["password"])) {
  $email = mysqli_real_escape_string($con, $_POST["email"]);
  $password = $_POST["password"];

  $sql = "SELECT * FROM admin_info WHERE admin_email = '$email'";
  $run_query = mysqli_query($con, $sql);
  if ($run_query && mysqli_num_rows($run_query) == 1) {
    $admin = mysqli_fetch_assoc($run_query);
    if (password_verify($password, $admin['admin_password'])) {
      $_SESSION["uid"] = $admin["admin_id"];
      $_SESSION["name"] = $admin["admin_name"];
      echo "<script> location.href='admin/add_products.php'; </script>";
      exit();
    } else {
      echo "<span style='color:red;'>Wrong username/password combination</span>";
      exit();
    }
  } else {
    echo "<span style='color:red;'>Wrong username/password combination</span>";
    exit();
  }
}
