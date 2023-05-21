<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("method is not allowed");
}

if (!isset($_POST['id']) || empty($_POST['id'])) {
  die("please suplly valid id");
}

if ($_POST['token'] != $_SESSION['deleteuser']) {
  unset($_SESSION["deleteuser"]);
  header("Location: index.php?error=Invalid Token"); 
  exit();
} 

try {
  $db = new mysqli("mysql-cdc","root","pass","latihan");
  
  $query = "DELETE FROM users WHERE id=?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("s", $_POST['id']);
  $stmt->execute();
  $stmt->close();
  $db -> close();
  header("Location: index.php?message=User berhasil dihapus");
  unset($_SESSION["deleteuser"]);
  exit();

} catch(Exception $e) {
  header("Location: index.php?error=User gagal dihapus");
  unset($_SESSION["deleteuser"]);
  exit();
}