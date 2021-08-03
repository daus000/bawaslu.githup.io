<?php

include "koneksi.php";

header("Content-type: application/vnp-ms-excel");
header("Content-Disposition: attchment; Filename=Export data penggujung.xls");
header("Pragma: no-cache");
header("Expires:0");
?>
<table border="1">
    <thead>
        <tr>
            <th colspan="6"> Rekapitulasi Data Penggunjung </th>

            </th>
        </tr>
        <tr>
            <th>No. </th>
            <th>Tangal</th>
            <th>Nma pengujung</th>
            <th>Alamat</th>
            <th>Tujuan</th>
            <th>hp</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $tgl1 = $_POST['tanggala'];
        $tgl2 = $_POST['tanggalb'];
        $tampil = mysqli_query($koneksi, "SELECT * FROM tamu1 where  tanggal BETWEEN '$tgl1' and
                                '$tgl2' order by id asc");
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

            </tr>
        <?Php } ?>
    </tbody>
</table>