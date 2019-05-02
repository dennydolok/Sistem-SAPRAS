<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="style.css">
<title>LAPORAN MASUK</title>
<?php include 'controller/controller.php';?>
</head>
<script></script>
<body onload="window.print()">
<br>
<br> 
<br>
<table border="1" class="table">
    <center>LAPORAN PASOK </center>
    <th>
        <td>ID Supply</td>
        <td>Jumlah</td>
        <td>Tanggal</td>
        <td>Nama</td>
    </th>
    <?php
            $sql = "SELECT * FROM masuk";
            $query =  mysqli_query($con,$sql);
            while ($data =  mysqli_fetch_array($query)){
        ?>
    <tr>
        <td></td>
        <td><?php echo $data['id_supply']?></td>
        <td><?php echo $data[1]?></td>
        <td><?php echo $data[2]?></td>
        <td><?php echo $data[3]?></td>
         <?php }?>
    </tr>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
<script>

</script>
</html>