<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    if ($_POST['token'] != $_SESSION['adduser']) {
      header("Location: index.php?error=Invalid Token"); 
      unset($_SESSION["adduser"]);
      exit();
    } 
    $db = new mysqli("mysql-cdc","root","pass","latihan");

    $query = "INSERT INTO users (name) VALUES(?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $_POST['name']);
    $stmt->execute();
    $stmt->close();
    $db -> close();
    header("Location: index.php?message=User berhasil ditambahkan");
    unset($_SESSION["adduser"]);
    exit();

  } catch(Exception $e) {
    header("Location: index.php?error=User gagal ditambahkan"); 
    unset($_SESSION["adduser"]);
    exit();
  }
} 
  
$datetime = new DateTime();
$_SESSION["adduser"] = $datetime->getTimestamp();

include("add_view.php");