<?php
if (isset($_GET['id'])) {

    include_once "database/database.php";
    $database = new Database();
    $db = $database->getConnection();

    if (isset($_POST['btnSimpan'])) {

        $updateSql = "UPDATE pengguna SET username = ?, password = ?, namalengkap = ? WHERE id = ?";
        $stmt = $db->prepare($updateSql);
        $stmt->bindParam(1, $_POST['username']);
        $stmt->bindParam(2, $_POST['password']);
        $stmt->bindParam(3, $_POST['namalengkap']);
        $stmt->bindParam(4, $_POST['id']);
        if ($stmt->execute()) {
            $_SESSION['hasil_update'] = true;
        } else {
            $_SESSION['hasil_update'] = false;
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=penggunaread'>";
    }

    $id = $_GET['id'];
    $findSql = "SELECT * FROM pengguna WHERE id = ?";
    $stmt = $db->prepare($findSql);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();
    $row = $stmt->fetch();
    if (isset($row['id'])) {
?>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pengguna</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                            <li class="breadcrumb-item"><a href="?page=penggunaread">Pengguna</a></li>
                            <li class="breadcrumb-item active">Ubah Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ubah Pengguna</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                            <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>">

                            <label for="password">Password</label>
                            
                            <input type="text" class="form-control" name="password" value="<?php echo $row['password'] ?>">

                            <label for="namalengkap">Nama Pengguna</label>
                            
                            <input type="text" class="form-control" name="namalengkap" value="<?php echo $row['namalengkap'] ?>">
                        </div>
                        <a href="?page=penggunaread" class="btn btn-danger btn-sm float-right"><i class="fa fa-times"></i> Batal</a>
                        <button type="submit" name="btnSimpan" class="btn btn-success btn-sm float-right"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
    <?php
    } else {
        $_SESSION['hasil_update'] = false;
        echo "<meta http-equiv='refresh' content='0;url=?page=penggunaread'>";
    }
} else {
    $_SESSION['hasil_update'] = false;
    echo "<meta http-equiv='refresh' content='0;url=?page=penggunaread'>";
}
    ?>

    <?php include_once "components/scripts.php" ?>