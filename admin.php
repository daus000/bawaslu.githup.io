<?php include "header.php"; ?>

<?php
if (isset($_POST['bsimpan'])) {

    $tgl = date('Y-m-d');

    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);

    $simpan = mysqli_query($koneksi, "INSERT INTO tamu1 VALUES ('', '$tgl', '$nama', '$alamat','$tujuan', '$nope' )");

    if ($simpan) {
        echo "<script>alert('SimpaN Data Sukses Terimakasih...!!!!!'); 
        document.location='?'</script>";
    } else
        echo "<script>alert('SimpaN Data GAGAGAGL Terimakasih...!!!!!'); 
    document.location='?'</script>";
}
//Pengujian jika tombol Edit / Hapus di klik
if (isset($_GET['hal'])) {
    //Pengujian jika edit Data
    if ($_GET['hal'] == "edit") {
        //Tampilkan Data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tamu1 WHERE id = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            //Jika data ditemukan, maka data ditampung ke dalam variabel
            $vnama = $data['nama'];
            $valamat = $data['alamat'];
            $vtujuan = $data['tujuan'];
            $vnope = $data['nope'];
        }
    } else if ($_GET['hal'] == "hapus") {
        //Persiapan hapus data
        $hapus = mysqli_query($koneksi, "DELETE FROM tamu1 WHERE id = '$_GET[id]' ");
        if ($hapus) {
            echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='admin.php';
				</script>";
        }
    }
}


?>


<div class="head text-center mt-4">
    <img src="asset/img/logo1.png" width="250">
    <h2 class="text-white"> Sistem Informasi Buku Tamu <br> Bawslu Kediri </h2>
</div>

<div class="row mt-2">
    <div class="col-lg-7 mb-3">
        <div class="card shadow bg-gradient-light">
            <div class="card-body">

                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Identitas Tamu</h1>
                </div>
                <form class="user" method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control
                                    form-control-user" name="nama" placeholder="Nama Tamu" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control
                                    form-control-user" name="alamat" placeholder="Alamat Pngujung" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control
                                    form-control-user" name="tujuan" placeholder="Tujuan" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control
                                    form-control-user" name="nope" placeholder="hp" required>
                    </div>

                    <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block"> Simpan Data </button>


                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="#">By. Bawaslu Kabupaten Kedri | 2021 - <?=
                                                                                    date('Y') ?></a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-5 mb-3">
        <div class="card shadow">
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Statistik tamu</h1>
                </div>
                <?php

                $tgl_sekarang = date('Y-m-d');
                $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
                $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));
                $sekarang = date('Y-m-d h:i:s');

                //queryyy
                $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM tamu1 where tanggal like '%$tgl_sekarang%'"
                ));
                $kemarin = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM tamu1 where tanggal like '%$kemarin%'"
                ));
                $seminggu = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM tamu1 where tanggal BETWEEN '$seminggu' and
                    '$sekarang'"
                ));
                $bulan_ini = date('m');
                $sebulan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM tamu1 where month(tanggal) = '$bulan_ini'"
                ));
                $keseluruhan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM tamu1 "
                ));

                ?>
                <table class="table table-bordered">
                    <tr>
                        <td> Hari Ini </td>
                        <td> :<?= $tgl_sekarang[0] ?> </td>
                    </tr>
                    <tr>
                        <td> Kemarin </td>
                        <td> : <?= $kemarin[0] ?> </td>
                    </tr>
                    <tr>
                        <td> Minggu Ini </td>
                        <td> : <?= $kemarin[0] ?> </td>
                    </tr>
                    <tr>
                        <td> Bulan Ini </td>
                        <td> : <?= $sebulan[0] ?> </td>
                    </tr>
                    <tr>
                        <td> Keseluruhan </td>
                        <td> : <?= $keseluruhan[0] ?> </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dta penggujung hari ini [<?= date('d-m-Y') ?>]</h6>

    </div>
    <div class="card-body">
        <a href="rekap.php" class="btn btn-warning mb-3">
            <i class="fa fa-table"></i> Rekapitulasi Penggunjung
        </a>
        <a href="logot.php" class="btn btn-danger mb-3">
            <i class="fa fa-sign-in-alt"></i>
        </a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Tangal</th>
                        <th>Nma pengujung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>hp</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No. </th>
                        <th>Tangal</th>
                        <th>Nma pengujung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>hp</th>
                        <th>Aksi</th>

                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $tgl = date('Y-m-d');
                    $tampil = mysqli_query($koneksi, "SELECT * FROM tamu1 where  tanggal like '%$tgl%' order by id desc");
                    $no = 1;
                    while ($data = mysqli_fetch_array($tampil)) {

                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['tujuan'] ?></td>
                            <td><?= $data['nope'] ?></td>
                            <td>
                                <a href="admin.php?hal=edit&id=<?= $data['id'] ?>" class="btn btn-warning"> Edit </a>
                                <a href="admin.php?hal=hapus&id=<?= $data['id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
                            </td>

                        </tr>
                    <?Php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<?php include "footer.php"; ?>