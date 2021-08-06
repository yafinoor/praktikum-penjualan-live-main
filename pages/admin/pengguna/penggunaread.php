<section class="content-header">
    <div class="container-fluid">
        <?php
        if (isset($_SESSION["hasil_create"])) {
            if ($_SESSION["hasil_create"]) {
        ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                    Tambah data Pengguna / User berhasil
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                    Tambah data Pengguna / User gagal
                </div>
            <?php
            }
            unset($_SESSION['hasil_create']);
        }

        if (isset($_SESSION["hasil_update"])) {
            if ($_SESSION["hasil_update"]) {
            ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                    Ubah data Pengguna / User berhasil
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                    Ubah data Pengguna / User gagal
                </div>
            <?php
            }
            unset($_SESSION['hasil_update']);
        }

        if (isset($_SESSION["hasil_delete"])) {
            if ($_SESSION["hasil_delete"]) {
            ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                    Hapus data Pengguna / User berhasil
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                    Hapus data Pengguna / User gagal
                </div>
        <?php
            }
            unset($_SESSION['hasil_delete']);
        }
        ?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengguna / User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Pengguna / User</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pengguna / User</h3>
            <a href="?page=penggunacreate" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i> Tambah Data</a>
        </div>
        <div class="card-body text-center">
            <table id="mytable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password Enkripsi</th>
                        <th>Nama Lengkap</th>
                        <th><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "database/database.php";
                    $database = new Database();
                    $db = $database->getConnection();

                    $selectSql = "SELECT * FROM pengguna";

                    $stmt = $db->prepare($selectSql);
                    $stmt->execute();

                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo md5($row['password']) ?></td>
                            <td><?php echo $row['namalengkap'] ?></td>
                            <td>
                                <form action method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <a href="?page=penggunaupdate&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i> Ubah</a>

                                    <a href="?page=penggunadelete&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fa fa-trash"></i> Hapus</a>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include_once "components/scripts.php" ?>