<?php
require_once 'config.php';

//Proses Update Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    $sql = "UPDATE buku SET judul = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, stok = ? WHERE id_buku = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssii", $judul, $penulis, $penerbit, $tahun_terbit, $stok, $id_buku);
        if ($stmt->execute()) {
            header("location: buku.php");
            exit();
        } else {
            echo "Error: Gagal mengupdate data.";
        }
        $stmt->close();
    }
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_buku = $_GET['id'];

    $sql = "SELECT * FROM buku WHERE id_buku = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id_buku);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $buku = $result->fetch_assoc();
            } else {
                echo "Data tidak ditemukan."; exit();
            }
        } else {
            echo "Error."; exit();
        }
        $stmt->close();
    } else {
        header("location: buku.php");
    }
}


$mysqli->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4">
        <h2>Edit Buku</h2>
        <form action="edit_buku.php" method="post">
            <input type="hidden" name="id" value="<?php echo $buku['id_buku']; ?>" />
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input id="judul" type="text" class="form-control"  name="judul" value="<?php echo $buku['judul']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input id="penulis" type="text" class="form-control" name="penulis" placeholder="Nama penulis" value="<?php echo $buku['penulis']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input id="penerbit" type="text" class="form-control" name="penerbit" placeholder="Nama penerbit" value="<?php echo $buku['penerbit']; ?>" required>
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
                        <input id="tahun_terbit" type="number" class="form-control" name="tahun_terbit" value="<?php echo $buku['tahun_terbit']; ?>" required>
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input id="stok" type="number" class="form-control" name="stok" value="<?php echo $buku['stok']; ?>" required>
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