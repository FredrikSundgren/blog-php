<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
session_start();



require ("database.php");
//fetch alla artiklar och användaren kopplad till article
$pdo = connectToDb();
$query = $pdo->prepare("SELECT article.*, users.fname,users.lname FROM article INNER JOIN users ON article.user_id=users.id ORDER by article.date DESC");
$query->execute();
$articles = $query->fetchAll();



?>
<?php include ("./includes/header.php") ?>

<?php if(!empty($_SESSION['message'])) : ?>
<div><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>
<div class="flex flex-col bg-red-100 w-full h-screen">
  <h2 class=""> Welcome: <?php echo $_SESSION['user']['fullname']; ?> </h2>
  <a href="add_blog.php" class="bg-blue-400 text-2xl">Add Blog</a>
  <h4 class="">Articles:</h4>
  <!-- Postar bloggarna här--->

  <?php foreach ($articles as $article) { ?>
  <ul>
    <li><a class="bg-amber-100" href="view_blog.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']?></a>
      <span class="bg-red-200">
        posted by
        <span class=" bg-blue-100"> <?php echo $article['fname'] .' '. $article['lname']?></span> on
        <?php echo $article['date']?> </span>

    </li>
  </ul>

  <?php } ?>

</div>


<?php include ("./includes/footer.php") ?>