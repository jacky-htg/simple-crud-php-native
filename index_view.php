<html>
  <head>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <header>
      <h1>Sistem Informasi Mahasiswa</h1>
    </header>
    <section>
      <?php if (isset($_GET['message']) || isset($_GET['error'])) : ?>
        <div id="alert" class="alert <?php echo isset($_GET['error']) ? 'alert-red' : 'alert-green';?>">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo isset($_GET['error']) ? $_GET['error'] : $_GET['message'];?>
        </div>
      <?php endif; ?>

      <h2>Users</h2>
      
      <div style="display:flex">
        <a href="add.php"><button>Tambah User Baru</button></a> &nbsp; &nbsp;
        <div class="search">
          <input type="text" id="search" placeholder="Search.." name="search" value="<?php echo isset($where['search']) ? $where['search']: '' ;?>">
          <button type="submit" onclick="window.location.href='index.php?search='+document.getElementById('search').value"><i class="fa fa-search"></i></button>
        </div>
      </div>
      <table>
        <tr>
          <th>
            <a class="header" href="index.php?sort_field=id&search=<?php echo isset($where['search'])?$where['search'] : '';?>&sort_order=<?php echo $sort['field'] == 'id' && $sort['order'] == 'asc' ? 'desc' : 'asc';?>">
              ID 	<?php echo $sort['field'] == 'id' ? ($sort['order'] == 'asc' ? '&uarr;': '&darr;') : '';?>
            </a>
          </th>
          <th>
            <a class="header" href="index.php?sort_field=name&search=<?php echo isset($where['search'])?$where['search'] : '';?>&sort_order=<?php echo $sort['field'] == 'name' && $sort['order'] == 'asc' ? 'desc' : 'asc';?>">
              NAME 	<?php echo $sort['field'] == 'name' ? ($sort['order'] == 'asc' ? '&uarr;': '&darr;') : '';?>
            </a>
          </th>
          <th>Action</th>
        </tr>
        <?php foreach($datas as $data) : ?>
          <tr>
            <td><?php echo $data['id'];?></td>
            <td><?php echo $data['name'];?></td>
            <td style="display:flex;">
              <a href="edit.php?id=<?php echo $data['id'];?>"><button>Update</button></a>
              &nbsp; &nbsp; 
              <form action="delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $data['id'];?>"/>
                <input type="hidden" name="token" value="<?php echo $_SESSION['deleteuser'];?>"/>
                <button type="button" onclick="if(confirm('Yakin ingin menghapus data <?php echo $data['id'];?>?')) this.parentElement.submit()">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <div class="pagination">
        <a href="<?php echo getLinkPagination(1, $sort, $where);?>">&laquo;</a>
        <?php if ($pagination['start']-10 > 1) : ?>
          <a href="<?php echo getLinkPagination($pagination['start']-10, $sort, $where);?>"><?php echo $pagination['start']-10;?></a>
          <div>...</div>
        <?php endif; ?>

        <?php for($i = $pagination['start']; $i <= $pagination['end']; $i++) : ?>
        <a href="<?php echo getLinkPagination($i, $sort, $where);?>" class="<?php echo $i == $page ? 'active':'';?>"><?php echo $i;?></a>
        <?php endfor; ?>

        <?php if ($pagination['end']+10 < $lastPage) : ?>
          <div>...</div>
          <a href="<?php echo getLinkPagination($pagination['end']+10, $sort, $where);?>"><?php echo $pagination['end']+10;?></a>
        <?php endif; ?>

        <a href="<?php echo getLinkPagination($lastPage, $sort, $where);?>">&raquo;</a>
      </div>
    </section>
    <footer>
      copyright &copy; 2023 - Rijal Asepnugroho
    </footer>
    <script>
      setTimeout(function(){ 
        document.getElementById("alert").style.display="none";
      }, 3000);
    </script>
  </body>
</html>