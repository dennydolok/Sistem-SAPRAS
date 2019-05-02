<!doctype html>
<html class="no-js" lang="en">
<?php 
include 'library/oop.php';
include 'controller/controller.php';
$perintah = new oop();
date_default_timezone_set('Asia/Jakarta');
$waktu = date('Y:m:d H:i:s');
session_start();
$table = "inventaris";
@$nama = $_POST['nama_barang'];
@$kondisi = "Baik";
@$keterangan = $_POST['keterangan'];
@$jumlah = $_POST['jumlah'];
@$jenis = $_POST['jenis'];
@$tanggal_register = $_POST['tanggal_register'];
@$id_ruang = $_POST['id_ruang'];
@$kode_inventaris = null;
@$kode_petugas = $_POST['id_petugas'];
@$isi = "id_inventaris='', nama='$nama',kondisi='$kondisi',keterangan = '$keterangan', jumlah='$jumlah',id_jenis='$jenis',tanggal_register='$tanggal_register',id_ruang='$id_ruang',kode_inventaris='$kode_inventaris',id_petugas='$kode_petugas'";
$form= "?form";
if(isset($_POST['simpan'])){
    // echo "INSERT INTO $table SET $isi";
    $perintah->simpan($con,$table,$isi,$form);
}
if(isset($_GET['edit'])){
    $id = $_GET['kode'];
    $where = "id_inventaris = $id";
    $edit = $perintah->edit($con,$table,$where);
}
if(isset($_POST['update'])){
    $id = $_GET['kode'];
    $where = "id_inventaris = $id";
    @$isi = "nama='$nama',kondisi='$kondisi',keterangan = '$keterangan', jumlah='$jumlah',id_jenis='$jenis',tanggal_register='$tanggal_register',id_ruang='$id_ruang',kode_inventaris='$kode_inventaris',id_petugas='$kode_petugas'";
    $perintah->update($con,$table,$isi,$where);
}
$cek = "SELECT * FROM petugas WHERE status = '1'";
$mysql = mysqli_query($con,$cek);
$staff = mysqli_fetch_array($mysql);
if($staff > 0){
    // $ceklevel = "SELECT * FROM petugas WHERE status = '1' AND level = '1'";
    // $jalan = mysqli_query($con,$ceklevel);
    // $state = mysqli_fetch_array($jalan);
    // if($state < 1){
    //     echo "<script>alert('Harap sebagai admin!');document.location.href='peminjaman.php'</script>";

    // }
}else{
    echo "<script>alert('Harap Login');document.location.href='index.php'</script>";
}
if(isset($_POST['logout'])){
    $id = $staff[0];
    $where = "id_petugas = '$id'";
    $perintah->logout($con,$where);
}
// if(($_SESSION['id_petugas'] == '1')){
//     echo "<script>alert('Welcome')</script>";
// }else{
//     echo "<script>alert('Silahkan Login Sebagai Admin');document.location.href='index.php'</script>";
//     session_destroy();
// }

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- amchart css -->
    <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i
                                        class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse">
                                <li class=""><a href="jenis.php">Jenis</a></li>
                                    <li><a href="ruang.php">Ruang</a></li>
                                    <li class="active"><a href="inventaris.php">Inventaris</a></li>
                                    <li class=""><a href="pasok.php">Supply</a></li>
                                    <li class=""><a href="pengembalian.php">pengembalian</a></li>
                                    <li class=""><a href="peminjaman.php">Peminjaman</a></li>
                                    <li class=""><a href="maintenance.php">Maintenance</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true">
                                    <i class="ti-paper"></i><span>Report</span>
                                </a>
                                <ul class="colapse">
                                    <li class=""><a href="masuk.php">Report Pinjam Barang</a></li>
                                    
                                    <li class=""><a href=" report_ruanganATK.php">Report Ruangan Dan Barang</a></li>
                                    <li class=""><a href=" report_ruanganELEK.php">Report Ruangan Dan Barang Elektronik</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <form action="" method="POST">
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-angle-down">
                                <?php echo $staff['nama_petugas']?>
                                </i></h4>
                            <div class="dropdown-menu">
                            <a href="index.php" onclick="return confirm('yakin ingin logout?') <?php session_destroy();?>">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                    <!-- Table Input-->
                    <br>
                    <div class="card">
                        <div class="card-header">
                            Input Barang
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Barang</h5>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Nama Barang</span>
                                                </div>
                                                <input class="form-control" type="text" placeholder="Nama Barang"
                                                    aria-label="Nama barang" value="<?php echo  @$edit['nama']?>"
                                                    name="nama_barang" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">kondisi</span>
                                                </div>
                                                <input class="form-control" type="text" placeholder="Kondisi"
                                                    aria-label="Kondisi" value="Baik" name="kondisi" readonly required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">keterangan</span>
                                                </div>
                                                <input class="form-control" type="text" placeholder="keterangan"
                                                    aria-label="keterangan" value="<?php echo  @$edit['keterangan']?>"
                                                    name="keterangan" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">jumlah</span>
                                                </div>
                                                <input class="form-control" type="number" placeholder="jumlah"
                                                    aria-label="jumlah" min="0" max="9999999999999"
                                                    value="<?php echo  @$edit['jumlah']?>" name="jumlah" required>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ID Jenis</span>
                                                </div>
                                                <select name="jenis" id="" class="form-control">
                                                <option value="<?php echo  @$edit['id_jenis']?>"><?php
                                                @$sqli = "SELECT * FROM jenis WHERE id_jenis = '$edit[id_jenis]'";
                                                @$quer = mysqli_query($con,$sqli);
                                                $tampils = mysqli_fetch_array($quer);
                                                echo @$tampils['nama_jenis'];
                                                ?></option>   
                                                <?php
                                                $tampil_jenis = $perintah->tampil($con,'jenis');
                                                foreach($tampil_jenis as $type){
                                                ?> 
                                                <option value="<?php echo $type[0]?>"><?php echo $type[1]?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Tanggal Register</span>
                                                </div>
                                                <input class="form-control" type="datetime"
                                                    placeholder="Tanggal Register" aria-label="Tanggal Register"
                                                    value="<?php echo $waktu?>"
                                                    name="tanggal_register" required>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">id_ruang</span>
                                                </div>
                                                <select name="id_ruang" id="" class="form-control">
                                                <option value="<?php echo @$edit['id_ruang']?>"><?php
                                                @$sqli = "SELECT * FROM ruang WHERE id_ruang = '$edit[id_ruang]'";
                                                @$quer = mysqli_query($con,$sqli);
                                                $tampils = mysqli_fetch_array($quer);
                                                echo @$tampils['nama_ruang'];
                                                ?></option>   
                                                <?php
                                                $tampil_jenis = $perintah->tampil($con,'ruang');
                                                foreach($tampil_jenis as $type){
                                                ?> 
                                                <option value="<?php echo $type[0]?>"><?php echo $type[1]?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">id_petugas</span>
                                                </div>
                                                <input class="form-control" readonly type="text" placeholder="id_petugas"
                                                    aria-label="id_petugas" value="<?php echo @$staff[0]?>"
                                                    name="id_petugas" required>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                        <?php if(@$_GET['kode']==""){?>
                                            <input name="simpan" id="" class="form-control btn btn-sucess" type="submit"
                                                value="Save">
                                            <?php } else { ?>
                                            <input name="update" id="" class="form-control btn btn-sucess" type="submit"
                                                value="Update">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <br>
                    <!-- data -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Jenis</h5>
                            <div class="data-tables datatable-primary">
                                <table class="table" id="dataTable">
                                    <th>
                                    <td>ID Jenis</td>
                                    <td>Nama Jenis</td>
                                    <td>Kode Jenis</td>
                                    <td>Keterangan</td>
                                    <td>ID Jenis</td>
                                    <td>Tanggal Register</td>
                                    <td>ID Ruang</td>
                                    <td>Action</td>
                                    </th>
                                    <tbody>
                                        <?php
                                    $field = $perintah->tampil($con,$table);
                                    foreach($field as $data){
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $data[0]?></td>
                                            <td><?php echo $data[1]?></td>
                                            <td><?php echo $data[2]?></td>
                                            <td><?php echo $data[3]?></td>
                                            <td><?php echo $data['id_jenis']?></td>
                                            <td><?php echo $data['tanggal_register']?></td>
                                            <td><?php echo $data['id_ruang']?></td>
                                            <td>
                                                <a href="?form&edit&kode='<?php echo $data[0]?>'">Update</a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- main content area end -->

            <!-- footer area start-->
            <footer>
                <div class="footer-area">
                    <p>© Copyright 2019. All right reserved. Template by <a
                            href="https://colorlib.com/wp/">Colorlib</a>.</p>
                </div>
            </footer>
            <!-- footer area end-->
        </div>
        <!-- page container area end -->
        <!-- offset area start -->

        <!-- offset area end -->
        <!-- jquery latest version -->
        <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
        <!-- bootstrap 4 js -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <script src="assets/js/jquery.slicknav.min.js"></script>

        <!-- all line chart activation -->
        <script src="assets/js/line-chart.js"></script>
        <!-- all pie chart -->
        <script src="assets/js/pie-chart.js"></script>
        <!-- others plugins -->
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/scripts.js"></script>

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
</body>

</html>