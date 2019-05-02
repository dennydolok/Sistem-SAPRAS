<?php

    class oop{
        function simpan($con,$table,$isi,$form){
            $sql = "INSERT INTO $table SET $isi";
            $query = mysqli_query($con,$sql);
            if($query){
                echo "<script>alert('Success');document.location.href='$form'</script>";
            }else{
                echo "<script>alert('Failed');document.location.href='?failed'</script>";
            }
        }
        function tampil($con,$table){
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($con,$sql);
            // @$data;
            while ($data = mysqli_fetch_array($query)){
                $isi[] = $data;
            }
            return $isi;
        }
        function filterTampil($con,$table,$wheres){
            $sql = "SELECT * FROM $table WHERE $wheres";
            $query = mysqli_query($con,$sql);
            // @$data;
            while ($data = mysqli_fetch_array($query)){
                $isi[] = $data;
            }
            return $isi;
        }
        function edit($con,$table,$where){
            $sql = "SELECT * FROM $table WHERE $where";            
            $query = mysqli_query($con,$sql);
            $edit = mysqli_fetch_array($query);
            return $edit;
        }
        function update($con, $table, $isi, $where){
            $sql = "UPDATE $table SET $isi WHERE $where";
            $query = mysqli_query($con,$sql);
            if($query){
                echo "<script>alert('Success');document.location.href='?updated'</script>";
            }else{
                echo "<script>alert('failed');document.location.href='?failed'</script>";
            }
        }
        function loginAdmin($con,$table,$where,$form){
            $sql = "SELECT * FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            $cek = mysqli_fetch_array($query);
            if($cek > 1 ){
                
                $_SESSION['name'] = $cek['nama_petugas'];
                $_SESSION['id_petugas'] = $cek['id_petugas'];
                echo "<script>alert('Successfuly ');document.location.href='$form'</script>";
            }else{
                echo "<script>alert('Failed');document.location.href='?failed'</script>";
            }
        }
        function loginPetugas($con,$table,$where,$form){
            $sql = "SELECT * FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            $cek = mysqli_fetch_array($query);
            if($cek > 1 ){
                $update = mysqli_query($con,"UPDATE $table SET status = '1' WHERE id_petugas = '$cek[0]'");
                if($update){
                    echo "<script>alert('Successfuly Login');document.location.href='peminjaman.php'</script>";
                }
            }else{
                echo "<script>alert('Failed');document.location.href='?failed'</script>";
            }
        }
        function loginPegawai($con,$table,$where,$form){
            $sql = "SELECT * FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            $cek = mysqli_fetch_array($query);
            if($cek > 1){
                if($cek > 1 ){
                    $update = mysqli_query($con,"UPDATE $table SET status = '1' WHERE nip = '$cek[nip]'");
                    if($update){
                        echo "<script>alert('Successfuly Login');document.location.href='$form'</script>";
                }
                echo "<script>alert('Successfuly Login as Worker');document.location.href='$form'</script>";
            }else{
                echo "<script>alert('Failed');document.location.href='?failed'</script>";
            }
        }
    }
        function delete($con,$tables,$where){
            $sql = "DELETE FROM $tables WHERE $where";
            $query = mysqli_query($con,$sql);
            if($query){
                echo "<script>alert('success');document.location.href='?form'</script>";
            }else{
                echo "<script>alert('Failed');document.location.href='?failed'</script>";
            }
        }
        function detailPinjam($con,$set){
            $sql = "INSERT INTO detail_pinjam SET $set";
            $query = mysqli_query($con,$sql);
            if($query){
                echo "";
            }
        }
        function return($con,$table){
            $kode = $_GET['kode'];
            $sql = "SELECT * FROM $table WHERE id_peminjaman = '$kode'";
            $query = mysqli_query($con,$sql);
            $data = mysqli_fetch_array($query);
            if($sql){
                $barang = "SELECT * FROM 'inventaris' WHERE id_inventaris = '$data[id_inventaris]'";
                $test = mysqli_query($con,$barang);
                $tampung = mysqli_fetch_array($test);         
            }
            return $data;
            return $tampung;
        }
        function logout($con,$where){
            $sql = "UPDATE petugas SET status = '0' WHERE $where";
            $query = mysqli_query($con,$sql);
            if($query){
                echo "<script>alert('Done');document.location.href='index.php'</script>";
            }else{
                echo "<script>alert('Failed');document.location.href='?form'</script>";
            }
        }
    
    }
?>