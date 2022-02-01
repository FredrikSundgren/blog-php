<?php
require ("database.php");



$name = $email = $comments = "";
if($_SERVER["REQUEST_METHOD"] == 'POST'){
  $pdo = connectToDb();
  $stmt = $pdo->prepare("INSERT INTO feedback (Name,Email,Comments) VALUES (:name, :email, :comments)");
  $stmt->bindparam(':name', $name);
  $stmt->bindparam(':email', $email);
  $stmt->bindparam(':comments', $comments);

  $name = clean($_POST["name"]);
  $email = clean($_POST["email"]);
  $comments = clean($_POST["comments"]);
  $stmt->execute();


}
function clean($userInput) {
  $userInput = trim($userInput);
  $userInput = stripslashes($userInput);
  $userInput = htmlspecialchars($userInput);
  return $userInput;
}
$conn = null;

?>


<?php include ("./includes/header.php") ?>
<h2>Please Fill Out The Form</h2>
<form class="flex justify-center flex-col w-64" method="post"
  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Full Name: <input class="border-sm border-2 border-solid border-black" type="text" name="name" required>
  <br><br>
  E-mail Address: <input class="border-sm border-2 border-solid border-black" type="text" name="email" required>
  <br><br>
  Comments/Feedback: <textarea class="border-sm border-2 border-solid border-black" name="comments" rows="5" cols="40"
    required></textarea>
  <br><br>
  <button class="border-sm border-2 border-solid border-black" type="submit" name="submit" value="Submit">Send</button>
</form>
<?php  echo "<div style='color:navy;'><h2>We Have Received Following Message From
    You:</h2>";
    echo "Your Name: ". $name;
    echo "<br>";
    echo "Your Email Address: " . $email;
    echo "<br>";
    echo "Your Company: ". $company;
    echo "<br>";
    echo "Your Comments: " . $comments;
    echo "<br>";
    echo "<h2>We will get back to you as soon as possible.</h2></div>";

 ?>
<?php include ("./includes/footer.php") ?>