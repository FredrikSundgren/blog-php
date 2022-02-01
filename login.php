<?php
session_start();
require "database.php";

if(isset($_POST['login'])){
$email = $_POST['email'];
$password = $_POST['password'];

//Hämta information från databasen
$pdo = connectToDb();
$query = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$query->execute([$email]);
$user = $query->fetch();


//Jämför användarens email och password med de vi hämtade från databasen
if(password_verify($password, $user['password'])){
//Lyckad inloggning
$_SESSION['user'] = [
  'id' => $user['id'],
  'fname' => $user['fname'],
  'lname' => $user['lname'],
  'fullname' => $user['fname'] .' ' .$user['lname'],
];

header('Location:index.php');
} else{
  $error = " <div class='flex justify-center'>Login failed! Please check your email and password again!</div>";
}
}
?>

<?php include ("../includes/head.php") ?>


<div class="h-screen w-full  pt-6">
  <h2 class="text-4xl text-center m-8"><span class="text-7xl">W</span>elcome <span class="text-7xl">T</span>o
    <span class="text-7xl"> T</span>he<span class="text-7xl"> B</span>log</span>
  </h2>
  <span class=""><?php if(isset($error)){echo $error;} ?></span>
  <?php if(isset($msg)){echo $msg;} ?>
  <div class="flex flex-row justify-center">
    <form class="flex flex-col  w-[500px] h-[500px] justify-center" action="login.php" method="POST">
      <div class="m-8 w-20 h-20 flex justify-center">
        <input class="w-10 h-10" type="text" placeholder="E-mail" name="email">
        <p></p>
      </div>
      <div class="m-8 w-20 h-20 flex justify-center">
        <input class=" w-10 h-10" type="password" placeholder="password" name="password">
        <p></p>
      </div>
      <div class="flex flex-col justify-center">
        <button class="bg-blue-500 text-white w-5 h-5 m-5" type="submit" value="Login" name="login">Login</button>
      </div>
      <div class=" w-[500px] h-[500px]">
        <h2 class="text-sm m-5 p-5">Don't have an Account? <a class="text-blue-100 text-sm" href="register.php">Create
            an
            Account
            here!!</a> </h2>
    </form>


  </div>

</div>
</div>

<?php include ("includes/footer.php") ?>