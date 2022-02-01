<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
session_start();
require 'database.php';
echo $_SESSION['user'];
if(isset($_POST['add_article'])){
//$title = $_POST['title'];
//$content = $_POST['content'];

if(savePost($_POST['title'], $_POST['content'])){
  header('Location: index.php');
  $_SESSION['message'] = "Your article has been added!";
}

}



?>
<?php include ("./includes/header.php")?>

<div class="container">
  <div class="blog">
    <h4>Add a Blog Article:</h4>
    <span class=""> <?php if(isset($msg)){echo $msg;} ?></span>
    <form action="add_blog.php" method="post">
      <input type="text" placeholder="Title..." class="" name="title">
      <textarea type="text" placeholder="Content..." class="" row="3" name="content"></textarea>
      <input class="" type="submit" value="Add Article" name="add_article">
    </form>
  </div>
</div>


<?php include ("./includes/footer.php")?>