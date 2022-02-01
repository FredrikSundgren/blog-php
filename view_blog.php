<?php
session_start();ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require 'database.php';

if(isset($_GET['id'])){
$article=getArticle($_GET['id']);

}


?>

<?php include ("./includes/header.php") ?>

<div class="h-screen w-full bg-red-100 flex flex-row">
  <h1>Article:</h1>
  <p> <?php echo $article['title']?> <i> posted on <?php echo $article['date']; ?> </i></p>
  <span> <?php echo $article['content']; ?> </span>
  <div><?php echo $article['content']; ?></div>
  <button class=""> <a href="edit.php?id=<?php echo $article['id']; ?>">Edit</a> </button>

</div>


<?php include ("includes/footer.php") ?>