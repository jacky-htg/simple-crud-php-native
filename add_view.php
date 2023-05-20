<html>
<head>
    <link rel="stylesheet" href="style.css"/>
  </head>
  
  <body>
    <header>
      <h1>Sistem Informasi Mahasiswa</h1>
    </header>
    
    <section>
      <h1>Tambah User Baru</h1>
      <form action="add.php" method="POST">
      <div>
        <label>Nama</label>
        <input name="name" required />
        <input type="hidden" name="token" value="<?php echo $_SESSION['adduser'];?>"/>
      </div>  
      <div><button type="submit">Submit</button></div>
      </form>
    </section>
    <footer>
      copyright &copy; 2023 - Rijal Asepnugroho
    </footer>
  </body>
</html>