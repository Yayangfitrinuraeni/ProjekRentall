<div class="box box-solid box-success">
    <div class="box-header">
        <h3 class="btn btn disabled box-title"><i class="fa fa-file"></i> Laporan Transaksi Rental</h3>
        <span class="pull-right">
            <a class="btn btn-default" target="blank" href="module/laporan/cetak_laporan.php">
            <i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;Cetak</a>
        </span>
    </div>		
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="text-blue">
                    <th width="20px">No</th>
                    <th>Kode Transaksi</th>
                    <th>Mobil</th>
                    <th>Tanggal Mulai Sewa</th>
                    <th>Tanggal Selesai Sewa</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $month_now = date('m');
                $sql = "SELECT a.id_transaksi, a.kode_transaksi, c.nama_merek, b.nama_mobil, b.plat_nomor, d.nama_sopir, 
                e.nama_pelanggan, f.kota_asal, f.kota_tujuan, a.tanggal_sewa, a.tanggal_selesai, a.status, a.total
                FROM transaksi a
                JOIN mobil b ON a.id_mobil = b.id_mobil
                JOIN merek c ON b.id_merek = c.id_merek
                LEFT JOIN sopir d ON a.id_sopir = d.id_sopir
                JOIN pelanggan e ON a.id_pelanggan = e.id_pelanggan
                LEFT JOIN rute f ON a.id_rute = f.id_rute
                WHERE MONTH(a.tanggal_sewa) = '$month_now'
                ORDER BY id_transaksi DESC";
                $tampil = mysql_query($sql);
                $no=1;
                while ($tampilkan = mysql_fetch_array($tampil)) { 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $tampilkan['kode_transaksi']; ?></td>
                    <td><?= $tampilkan['nama_merek'].' '.$tampilkan['nama_mobil'].' ('.$tampilkan['plat_nomor'].')'; ?></td>
                    <td><?= $tampilkan['tanggal_sewa']; ?></td>
                    <td><?= $tampilkan['tanggal_selesai']; ?></td>
                    <td><?= 'Rp. '.number_format($tampilkan['total'],2,',','.') ?></td>
                <?php
                    }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>