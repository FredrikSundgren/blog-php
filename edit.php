<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
session_start();
require 'database.php';


if (isset($_GET['id'])) {
  $article = getArticle($_GET['id']);
}

if (isset($_POST['edit'])) {

  if(savePost($_POST['title'], $_POST['content'])){
    header('Location: index.php');
    $_SESSION['message'] = "Your article has been updated!";
  }

}
?>



<?php include("./includes/header.php") ?>


<div class="flex flex-col bg-red-100 w-full h-screen">

  <h4 class="">Articles:</h4>
  <!-- Postar bloggarna här--->

  <form action="" method="post">
    <input type="text" name="title" value="<?php echo $article['title']; ?>" />
    <textarea name="content" class="bg-black" cols="30" rows="30"><?php echo $article['content']; ?></textarea>
    <button class="bg-red-400 text-7xl font-semibold" type="submit" name="edit">Edit Post</button>
  </form>
  <?php include("./includes/footer.php") ?>