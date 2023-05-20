<?php
session_start();

try {
  $db = new mysqli("mysql-cdc","root","pass","latihan");
} catch(Exception $e) {
  echo $e->getMessage();
  exit(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    if ($_POST['token'] != $_SESSION['edituser']) {
      header("Location: index.php?error=Invalid Token"); 
      unset($_SESSION["edituser"]);
      exit();
    } 

    $query = "UPDATE users SET name=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $_POST['name'], $_POST['id']);
    $stmt->execute();
    $stmt->close();
    $db -> close();
    header("Location: index.php?message=User berhasil diupdate");
    unset($_SESSION["edituser"]);
    exit();

  } catch(Exception $e) {
    header("Location: index.php?error=User gagal diupdate");
    unset($_SESSION["edituser"]);
    exit();
  }
} else {
  try {
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $_GET['id']);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $stmt->close();
    $data = $result -> fetch_assoc();
    if (!$data) {
      header("Location: index.php?error=Invalid ID User");
      unset($_SESSION["edituser"]);
      exit();
    }
    $result -> free_result();
    $db -> close();

  } catch(Exception $e) {
    header("Location: index.php?error=Invalid ID User"); 
    unset($_SESSION["edituser"]);
    exit();
  }
}

$datetime = new DateTime();
$_SESSION["edituser"] = $datetime->getTimestamp();

include("edit_view.php");