<section class="content-header">
    <div class="container-fluid">
        <?php
        include_once "database/database.php";
        include_once "database/fungsi_rupiah.php";
        $idpengguna = 1;
        $tanggal = Date('Ymd');

        if (isset($_POST["idpenjualan"])) {
            $idpenjualan = $_POST["idpenjualan"];
        } else {
            $database = new Database();
            $db = $database->getConnection();

            $insertSQL = "INSERT INTO penjualan SET tanggal = ?, idpengguna = ?, status = 'PENDING'";
            $stmt = $db->prepare($insertSQL);
            $stmt->bindParam(1, $tanggal);
            $stmt->bindParam(2, $idpengguna);
            if ($stmt->execute()) {
                $idpenjualan = $db->lastInsertId();
            }
        }

        if (isset($_POST['btnTambah'])) {
            $idpenjualan = $_POST['idpenjualan'];
            $idbarang = $_POST['idbarang'];
            $hargajual = $_POST['hargajual'];
            $jumlah = $_POST['jumlah'];

            $database = new Database();
            $db = $database->getConnection();

            $insertSQL = "INSERT INTO detailpenjualan SET idpenjualan = ?, idbarang = ?, hargajual = ?, jumlah = ?";
            $stmt = $db->prepare($insertSQL);
            $stmt->bindParam(1, $idpenjualan);
            $stmt->bindParam(2, $idbarang);
            $stmt->bindParam(3, $hargajual);
            $stmt->bindParam(4, $jumlah);
            if ($stmt->execute()) {
        ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                    Tambah data barang berhasil
                </div>
            <?php
            }
        }
        if (isset($_POST['btnHapus'])) {
            $idpenjualan = $_POST['idpenjualan'];
            $id = $_POST['id'];

            $database = new Database();
            $db = $database->getConnection();

            $deleteSQL = "DELETE FROM detailpenjualan WHERE id = ?";
            $stmt = $db->prepare($deleteSQL);
            $stmt->bindParam(1, $id);
            if ($stmt->execute()) {
            ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                    Hapus Berhasil
                </div>
            <?php
            }
        }

        if (isset($_POST['btnSelesai'])) {
            $idpenjualan = $_POST['idpenjualan'];

            $database = new Database();
            $db = $database->getConnection();

            $selesaiSQL = "UPDATE penjualan SET status = 'SELESAI' WHERE id = ?";
            $stmt = $db->prepare($selesaiSQL);
            $stmt->bindParam(1, $idpenjualan);
            if ($stmt->execute()) {
            ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                    Transaksi Selesai
                </div>
        <?php
            }
        }

        $database = new Database();
        $db = $database->getConnection();

        $insertSQL = "SELECT * FROM penjualan WHERE id = ?";
        $stmt = $db->prepare($insertSQL);
        $stmt->bindParam(1, $idpenjualan);
        $stmt->execute();
        $datapenjualan = $stmt->fetch();
        $statuspenjualan = $datapenjualan['status'];

        ?>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Penjualan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Penjualan</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <?php
    if ($statuspenjualan == "PENDING") {
    ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cari Barang</h3>
                <form method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" required>
                        <input type="hidden" class="form-control" name="idpenjualan" value="<?php echo $idpenjualan ?>">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat" name="btnCari"><i class="fa fa-search"></i> Cari</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <?php
                if (isset($_POST['keyword'])) {
                ?>
                    <table id="mytable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah Beli</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $database = new Database();
                            $db = $database->getConnection();

                            $selectSql = "SELECT B.*
                                    FROM barang B
                                    WHERE namabarang like ?";

                            $keyword =   "%" . $_POST['keyword'] . "%";
                            $stmt = $db->prepare($selectSql);
                            $stmt->bindParam(1, $keyword);
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                $no = 1;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['namabarang'] ?></td>
                                        <td style="text-align:right"><?php echo rupiah($row['harga']) ?></td>
                                        <td>
                                            <form action method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                <div class="input-group input-group-sm">
                                                    <input type="hidden" class="form-control" name="idbarang" value="<?php echo $row['id'] ?>">
                                                    <input type="hidden" class="form-control" name="idpenjualan" value="<?php echo $idpenjualan ?>">
                                                    <input type="number" class="form-control" name="jumlah" required>
                                                    <input type="hidden" name="hargajual" value="<?php echo $row['harga'] ?>">
                                                    <span class="input-group-append">
                                                        <button type="submit" class="btn btn-info btn-flat" name="btnTambah"><i class="fa fa-cart-plus"></i> </button>
                                                    </span>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<p>Data tidak ditemukan</p>';
                            }

                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>Cari dengan kata kunci</p>";
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-shopping-cart"></i> Keranjang Belanja</h3>
        </div>
        <div class="card-body">
            <table id="mytable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "database/database.php";
                    $database = new Database();
                    $db = $database->getConnection();

                    $selectSql = "SELECT D.*, B.namabarang
                                    FROM detailpenjualan D
                                    LEFT JOIN barang B ON B.id = D.idbarang
                                    WHERE idpenjualan = ?
                                    ";

                    $stmt = $db->prepare($selectSql);
                    $stmt->bindParam(1, $idpenjualan);
                    $stmt->execute();

                    $no = 1;
                    $grand_total = 0;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $grand_total += $row['jumlah'] * $row['hargajual'];
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['namabarang'] ?></td>
                            <td style="text-align:right"><?php echo rupiah($row['hargajual']) ?></td>
                            <td style="text-align:right"><?php echo $row['jumlah'] ?></td>
                            <td style="text-align:right"><?php echo rupiah($row['jumlah'] * $row['hargajual']) ?></td>
                            <td>
                                <?php
                                if ($statuspenjualan == "PENDING") {
                                ?>
                                    <form action method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <input type="hidden" name="idpenjualan" value="<?php echo $idpenjualan ?>">
                                        <button type="submit" name="btnHapus" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4">Grand Total</td>
                        <td style="text-align:right"><?php echo rupiah($grand_total) ?></td>
                        <td>
                            <?php
                            if ($statuspenjualan == "PENDING") {
                            ?>
                                <form method="POST">
                                    <input type="hidden" class="form-control" name="idpenjualan" value="<?php echo $idpenjualan ?>">
                                    <button type="submit" name="btnSelesai" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Selesai</button>
                                </form>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include_once "components/scripts.php" ?>