<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssi", $judul, $penulis, $penerbit, $tahun_terbit, $stok);
        if ($stmt->execute()) {
            header("location: buku.php");
            exit();
        } else {
            echo "Error: Gagal menyimpan data.";
        }
        $stmt->close();
    }
    $mysqli->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <h2>Tambah Buku Baru</h2>
        <form action="tambah_buku.php" method="post">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input id="judul" type="text" class="form-control"  name="judul" required>
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input id="penulis" type="text" class="form-control" name="penulis" placeholder="Nama penulis" required>
            </div>
            
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input id="penerbit" type="text" class="form-control" name="penerbit" placeholder="Nama penerbit" required>
            </div>

            <!-- <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input id="tahun_terbit" type="number" class="form-control" name="tahun_terbit" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input id="stok" type="number" class="form-control" name="stok" required>
            </div> -->

            <div class="row align-items-start">
                <div class="col">
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input id="tahun_terbit" type="number" class="form-control" name="tahun_terbit" required>
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input id="stok" type="number" class="form-control" name="stok" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="buku.php" class="btn btn-dark" >Batal</a>
            </div>

        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>