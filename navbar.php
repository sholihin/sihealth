<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">RSSB Client</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if($_SESSION['jabatan']=='admin') :?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Management <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="?m=obat">Produk</a></li>
                    <li><a href="?m=user">User</a></li>
                    <li><a href="?m=terapis">Terapis</a></li>
                    <!-- <li><a href="?m=ruangan">Ruangan</a></li> -->
                    <li><a href="?m=terapi">Terapi</a></li>
                  </ul>
                </li>
            <?php endif ?>
            <?php if($_SESSION['jabatan']=='operator' || $_SESSION['jabatan']=='admin') :?>
                <li><a href="?m=pasien">Data Pasien</a></li>   
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="?m=pasien_tambah">Pasien Baru</a></li>
                      <li><a href="?m=registrasi_tindakan">Pasien Lama</a></li>
                      <li><a href="?m=transaksi_belum_selesai">Belum Selesai</a></li>
                    </ul>
                  </li>
                </li>
            <?php endif ?>
            <?php if($_SESSION['jabatan']=='admin') : ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="?m=laporan_penjualan">Penjualan</a></li>
                    <li><a href="?m=laporan_terapi">Terapi</a></li>
                  </ul>
                </li>
                <li><a href="?m=ujroh">Ujroh Terapis</a></li>
            <?php endif ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">    
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Settings<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="?m=password">Change Password</a></li>
                  <li><a href="aksi.php?act=logout">Logout</a></li>
                </ul>
              </li>
          </ul>       
      </div>
  </div>
</nav>