<html>
  <head>
    <link rel="stylesheet" href="style.css"/>
  </head>
  <body>
  <header>
      <h1>Sistem Informasi Mahasiswa</h1>
    </header>
    <section>
      <h2>Edit User</h2>
      <form action="edit.php" method="POST">
      <div>
        <label>Nama</label>
        <input name="name" required value="<?php echo $data['name'];?>"/>
        <input name="id" type="hidden" value="<?php echo $data['id'];?>"/>
        <input type="hidden" name="token" value="<?php echo $_SESSION['edituser'];?>"/>
      </div>  
      <div><button type="submit">Submit</button></div>
      </form>
    </section>
    <footer>
      copyright &copy; 2023 - Rijal Asepnugroho
    </footer>
  </body>
</html>