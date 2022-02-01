<?php require ("database.php");
session_start();
//När en användare trycker på register så registreras en ny användare OM!!!! uppgifterna är korrekt ifyllda.
if(isset($_POST['register'])){

  //Validerar email på den nya användaren
  $email = $_POST['email'];
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $error = "Invalid email format";
}
$pdo = connectToDb();
//Kontrollerar om email redan är registrerad i databasen
$query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$query->execute([$email]);
$result = $query->rowCount();
if($result > 0){
  $error ="<span class='emailExist'>That email already exist! Please choose another one. </span>";
}

//Tar in variablerna som innehåller informationen om användaren
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //Krypterar password



if(empty($error)){
  $pdo = connectToDb();
  //Lägger till en ny användare i databasen med fname,lname,email och password. Om fälten är tomma kommer det ett fel meddelande. Om det är korrekt får du $msg ="Your account have been created";
  $query = $pdo->prepare("INSERT INTO users(fname,lname,email,password) VALUES(:fname,:lname,:email,:password)");
  $query->execute([
    'fname' => $fname,
    'lname' => $lname,
    'email' => $email,
    'password' => $password
  ]);
  $msg ="Your account has been created";
}
}
?>


<?php include ("includes/head.php") ?>

<div class="flex flex-col justify-center">
  <h2>Register</h2>
  <?php if(isset($error)){echo $error;}?>
  <!---Ger ett fel meddelande om du skriver fel format på email--->
  <?php if(isset($msg)){echo $msg;}?>
  <!---Ger ett meddelande om du lyckats skapa ett konto på databasen--->
  <form class="flexflex-col justify-center" action="register.php" method="post">
    <input class="border-sm border-2 border-solid border-black" type="text" placeholder="First name" name="fname">
    <input class="border-sm border-2 border-solid border-black" type="text" placeholder="Last name" name="lname">
    <input class="border-sm border-2 border-solid border-black" type="text" placeholder="Email" name="email">
    <input class="border-sm border-2 border-solid border-black" type="password" placeholder="Password" name="password">
    <!---Button---->
    <input class="border-sm border-2 border-solid border-black" type="submit" value="Register" placeholder="Register"
      name="register">
    <!-- [type="text"] i css på submit -->
  </form>
  <a href="login.php">Log in here!</a>
</div>

<?php include ("includes/footer.php") ?>