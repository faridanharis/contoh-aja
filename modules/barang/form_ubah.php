<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_barang"
  if (isset($_GET['id'])) {
    
    // ambil data GET dari tombol ubah
    $id_barang = $_GET['id'];

   // sql statement untuk menampilkan data dari tabel "tbl_barang", dan tabel "tbl_jenis" berdasarkan "stok"
   $query = mysqli_query($mysqli,"SELECT a.id_barang, a.nama_barang, a.jenis, a.stok_minimum, a.stok, a.jenis, b.nama_jenis
                                  FROM tbl_barang as a INNER JOIN tbl_jenis as b
                                  ON a.jenis=b.id_jenis
                                  WHERE a.stok<=a.stok_minimum ORDER BY a.id_barang ASC")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <!-- menampilkan pesan kesalahan unggah file -->
  <div id="pesan"></div>

  <div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-4">
      <div class="page-header text-white">
        <!-- judul halaman -->
        <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Ubah Barang</h4>
       
        </ul>
      </div>
    </div>
  </div>

  <div class="page-inner mt--5">
  <div class="card">
    <div class="card-header">
      <div class="card-title">Data Barang</div>
    </div>
    <form action="modules/barang/proses_entri.php" method="post" enctype="multipart/form-data">
      <div class="card-body">
        <div class="row">
          <div class="col-md-7">
            <div class="form-group">
              <?php
              // Logika untuk ID Barang
              $id_barang ; // Ganti dengan logika yang sesuai
              ?>
              <label>ID Barang <span class="text-danger">*</span></label>
              <input type="text" name="id_barang" class="form-control" value="<?php echo $id_barang; ?>" readonly>
            </div>

            <div class="form-group">
              <label>Nama Barang <span class="text-danger">*</span></label>
              <input type="text" name="nama_barang" class="form-control" value="<?php echo $id_barang; ?>" required>
              <div class="invalid-feedback">Nama Barang tidak boleh kosong</div>
            </div>

            <div class="form-group">
              <label>Jenis Barang<span class="text-danger">*</span></label>
              <input type="text" name="jenis" class="form-control" autocomplete="off" required>
              <div class="invalid-feedback">Jenis Barang tidak boleh kosong</div>
            </div>
            
            <div class="form-group">
              <label>Stok Minimum <span class="text-danger">*</span></label>
              <input type="text" name="stok_minimum" class="form-control" autocomplete="off" required>
              <div class="invalid-feedback">Stok Minimum tidak boleh kosong</div>
            </div>


            <div class="card-action">
        <input type="submit" name="simpan" value="Simpan" class="btn btn-secondary btn-round pl-4 pr-4 mr-2">
        <a href="?module=barang" class="btn btn-default btn-round pl-4 pr-4">Batal</a>
      </div>
    </form>
  </div>
</div>
</script>
<?php } ?>