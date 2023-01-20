<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $database = new Database();
    $db = $database->getConnection();

    $deleteSql = "DELETE FROM karyawan WHERE id = ?";
    $stmt = $db->prepare($deleteSql);
    $stmt->bindParam(1, $id);

    if ($stmt->execute()) {



    $deletePengguna = "DELETE FROM pengguna WHERE id = ?";
    $stmtPengguna = $db->prepare($deletePengguna);
    $stmtPengguna->bindParam(1, $id);

    if ($stmtPengguna->execute()) {
        $_SESSION['hasil'] = true;
        $_SESSION['pesan'] = "Berhasil hapus data";
        
    } else {
        $_SESSION['hasil'] = false;
        $_SESSION['pesan'] = "Gagal hapus data";
      
        }
    }
    }

    echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";

?>