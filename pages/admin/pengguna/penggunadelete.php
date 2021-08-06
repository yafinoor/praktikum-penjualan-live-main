<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include_once "database/database.php";
    $database = new Database();
    $db = $database->getConnection();

    $deleteSql = "DELETE FROM pengguna WHERE id = ?";
    $stmt = $db->prepare($deleteSql);
    $stmt->bindParam(1, $_GET['id']);
    if ($stmt->execute()) {
        $_SESSION['hasil_delete'] = true;
    } else {
        $_SESSION['hasil_delete'] = false;
    }
}
echo "<meta http-equiv='refresh' content='0;url=?page=penggunaread'>";
