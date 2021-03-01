<?php
include ("../inc/koneksi.php"); 
include ("../inc/fungsi_hdt");  
?>
<br>
<div class="row">
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?php
                        $result=mysql_query("SELECT count(*) as total from sopir");
                        $data=mysql_fetch_assoc($result);
                        echo $data['total'];
                    ?>
                </h3>
                <p>Sopir</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="?module=sopir" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    <?php
                        $result=mysql_query("SELECT count(*) as total from mobil");
                        $data=mysql_fetch_assoc($result);
                        echo $data['total'];
                    ?>
                </h3>
                <p>Mobil</p>
            </div>
            <div class="icon">
                <i class="fa fa-car"></i>
            </div>
            <a href="?module=mobil" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <?php
                        $month_now = date('m');
                        $result=mysql_query(
                            "SELECT sum(total) as total from transaksi WHERE MONTH(tanggal_sewa) = '$month_now'"
                        );
                        $data=mysql_fetch_assoc($result);
                        echo 'Rp. '.number_format($data['total'],2,',','.')
                    ?>
                </h3>
                <p>Pendapatan Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="?module=laporan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>