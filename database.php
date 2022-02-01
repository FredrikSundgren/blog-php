<?php
function connectToDb()
{
  $server = "localhost";
  $user = "admin";
  $pass = "Johsamsebmat82!";
  $db = "blog";
  try {
    return new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    echo "Successfully connected to the database: " . $db;
  } catch (PDOException $e) {
    echo "Connection failed: ", $e->getMessage();
  }
}

function getArticle($article_id)
{
  $pdo = connectToDb();
  $query = $pdo->prepare("SELECT article.*, users.fname,users.lname FROM article INNER JOIN users ON article.user_id=users.id WHERE article.id=?");
  $query->execute([$article_id]);
  return $query->fetch();
}

function savePost($title,$content){
  $pdo = connectToDb();
  $query = $pdo->prepare("INSERT INTO article( user_id, title, content) VALUES(?,?,?)");
  $result = $query->execute([$_SESSION['user']['id'], $title, $content]);
  return $result;
}