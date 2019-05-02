<!doctype html>
<html class="no-js" lang="en">
<?php 
include 'library/oop.php';
include 'controller/controller.php';
$perintah = new oop();
date_default_timezone_set('Asia/Jakarta');
$int = random_int(10,999);
session_start();
@$nama = $_SESSION['nama_pegawai'];
@$id = $_SESSION['id_pegawai'];
// echo @$_SESSION['id_pegawai'];
@$table = "peminjaman";
@$tanggal_peminjaman = date('Y:m:d H:i:s');
@$tanggal_pengembalian = '';
@$status_peminjaman = "Blom";
@$id_pegawai = $_POST['id_pegawai'];
@$id_barang = $_POST['barang'];
@$jumlah = $_POST['jumlah'];
@$id_pinjam = $_POST['id_pinjam'];
@$isi = "id_peminjaman = '$int', tanggal_peminjaman = '$tanggal_peminjaman', tanggal_kembali='$tanggal_pengembalian', status_pengembalian='$status_peminjaman', id_pegawai='$id_pegawai'";
$form= "?form";
if(isset($_POST['simpan'])){
    // $data = mysqli_query($con,"SELECT MAX(id_peminjaman) as kode FROM peminjam");
    // echo $isi;
    $set = "id_detail_pinjam = '', id_inventaris = '$id_barang', jumlah ='$jumlah', id_peminjaman = '$int'";
    $perintah->detailPinjam($con,$set);
    // $kode = substr($data,1);
    // echo "INSERT INTO $table SET $isi";
    // $ambil = "SELECT * FROM 'inventaris' WHERE "
    $perintah->simpan($con,$table,$isi,$form); 
}
$cek = "SELECT * FROM pegawai WHERE status = '1'";
$mysql = mysqli_query($con,$cek);
$worker = mysqli_fetch_array($mysql);
if($worker > 0){

}else{
    echo "<script>alert('Harap Login');document.location.href='index.php'</script>";
}
if(isset($_POST['logout'])){
    $id = $staff[0];
    $where = "id_petugas = '$id'";
    $perintah->logout($con,$where);
}

// if($_SESSION['id_pegawai'] != "1" || $_SESSION['id_pegawai'] != "2"){
//     echo "<script>alert('This Page is For Admin and Operator Only!');document.location.href='index.php'</script>";
// }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO </title>
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
                                        class="ti-dashboard"></i><span></span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="?form">Peminjaman</a></li>
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
            <form action="" method="POST">
                <!-- header area start -->

                <!-- header area end -->
                <!-- page title area start -->
                <div class="page-title-area">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="breadcrumbs-area clearfix">
                                <h4 class="page-title pull-left">Peminjaman Pegawai </h4>
                            </div>
                        </div>
                        <div class="col-sm-6 clearfix">
                            <div class="user-profile pull-right">
                                <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                        echo $worker['nama_pegawai']
                                    ?>
                                    <i class="fa fa-angle-down"></i></h4>
                                <div class="dropdown-menu">
                                <input type="submit" name="logout" class="form-control" value="logout" onclick="return confirm('Logout?')">
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
                            Peminjaman
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo @$kode?></h5>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Barang</span>
                                                </div>
                                                <select class="form-control" name="barang" id="">
                                                    <option value="" selected>Pilih Barang</option>
                                                    <?php
                                                    $barang = $perintah->tampil($con,'inventaris');
                                                    $max = $barang['jumlah'];
                                                    foreach($barang as $item){
                                                    ?>
                                                    <option class="form-control"
                                                        value="<?php echo $item['id_inventaris']?>">
                                                        <?php echo $item['nama']?> || Jumlah :
                                                        <?php echo $item['jumlah']; $jumlahmax = $item['jumlah']?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Jumlah Barang</span>
                                                </div>
                                                <input class="form-control" type="number" max=""
                                                    placeholder="Jumlah barang" aria-label="Nama Jenis" value=""
                                                    name="jumlah" require>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">tanggal_pinjam</span>
                                                </div>
                                                <input class="form-control" type="datetime" placeholder="Nama Jenis"
                                                    aria-label="Nama Jenis" value="<?php echo $tanggal_peminjaman ?>"
                                                    name="nama_jenis" require>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">ID Pegawai</span>
                                                </div>
                                                <input class="form-control" type="text" placeholder="id_pegawai"
                                                    aria-label="id pegawai" readonly value="<?php echo @$worker['0'];?>" name="id_pegawai" require>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <?php 
                                                if(isset($_GET['edit'])){?>
                                            <input name="simpan" id="" class="form-control btn btn-sucess" type="submit"
                                                value="Update">
                                            <?php } else { ?>
                                            <input name="simpan" id="" class="form-control btn btn-sucess" type="submit"
                                                value="Save">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <br>
            </form>
        </div>
        <!-- main content area end -->

        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2019. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.
                </p>
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