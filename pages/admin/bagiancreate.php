<?php include_once "partials/cssdatatables.php" ?>

<?php

$database = new Database();
$db = $database->getConnection();

if (isset($_POST['button_create'])) {

    $validateSQL = "SELECT * FROM bagian WHERE nama_bagian = ?";
    $stmt = $db->prepare($validateSQL);
    $stmt->bindParam(1, $_POST['nama_bagian']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
    ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h5><i class="icon fas fa-ban"></i> Gagal</h5>
            Nama bagian sama sudah ada
        </div>
    <?php    
    } else {    
        $insertSQL = "INSERT INTO bagian SET nama_bagian = ?, karyawan_id = ?, lokasi_id = ?";
        $stmt = $db->prepare($insertSQL);
        $stmt->bindParam(1, $_POST['nama_bagian']);
        $stmt->bindParam(2, $_POST['karyawan_id']);
        $stmt->bindParam(3, $_POST['lokasi_id']);
        if ($stmt->execute()) {
            $_SESSION['hasil'] = true;
            $_SESSION['pesan'] = "Berhasil simpan data";
        } else {
            $_SESSION['hasil'] = false;
            $_SESSION['pesan'] = "Gagal simpan data";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=bagianread'>";
    }
}
?>

<section class="content-header">
    <div class="container-fluid">
        <?php
        if (isset($_SESSION["hasil"])) {
            if ($_SESSION['hasil']) {
        ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                <?= $_SESSION["pesan"] ?>
            </div>
        <?php
            } else {
        ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                <?= $_SESSION["pesan"] ?>
            </div>
        <?php
            }
            unset($_SESSION["hasil"]);
            unset($_SESSION["pesan"]);
        }
        ?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Bagian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=bagianread">Bagian</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Bagian</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_bagian">Nama Bagian</label>
                    <input type="text" class="form-control" name="nama_bagian">
                </div>
                <div class="form-group">
                    <label for="karyawan_id">Kepala Bagian</label>
                    <select class="form-control" name="karyawan_id">
                        <option value="">-- Pilih Kepala Bagian --</option>
                        <?php
                            $selectSQL = "SELECT * FROM karyawan";
                            $stmt_karyawan = $db->prepare($selectSQL);
                            $stmt_karyawan->execute();
                            while ($row_karyawan = $stmt_karyawan->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"" . $row_karyawan["id"] . "\">" . $row_karyawan["nama_lengkap"] . "</option>";
                            }
                        ?>
                    </select>                    
                </div>
                <div class="form-group">
                    <label for="lokasi_id">Lokasi</label>
                    <select class="form-control" name="lokasi_id">
                        <option value="">-- Pilih Lokasi --</option>
                        <?php
                            $selectSQL = "SELECT * FROM lokasi";
                            $stmt_lokasi = $db->prepare($selectSQL);
                            $stmt_lokasi->execute();

                            while ($row_lokasi = $stmt_lokasi->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=\"".$row_lokasi["id"] . "\">". $row_lokasi["nama_lokasi"] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <a href="?page=bagianread" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times"></i> Batal
                </a>
                <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</section>

<?php include_once "partials/scripts.php" ?>