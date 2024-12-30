<?php 
    $dx = $_GET['id'];
    $con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
    or die("Lỗi kết nối");

    $sql1="DELETE FROM phim WHERE id='$dx'";
    $data1=mysqli_query($con,$sql1);
    if(!$data1){
        echo  "<script> alert('Xóa mới thất bại!')
        </script>";
    }
    else{
        echo  "<script> alert('Xóa thành công !')</script>";
        $this->view("contents/QuanLyPhim/index");
    }
    mysqli_close($con);
?>