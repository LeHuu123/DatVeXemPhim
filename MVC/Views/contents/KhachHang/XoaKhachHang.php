<?php
    $idKhachHang = $_GET['idKhachHang'];
    $con=mysqli_connect('localhost:3367','root','','bai_tap_lon')
    or die('Lỗi kết nối');
    //Tạo và thực hiện xóa
    $sql = "DELETE FROM khachhang WHERE idKhachHang = '$idKhachHang'";
    $kq = mysqli_query($con,$sql);
    if($kq)
            {
                echo" <script>
                alert('Xóa thành công!')
            </script>";
            }
            else
            {
                echo" <script>
                alert('Xóa thất bại!')
            </script>"; 
            } 
            echo "<script>
        window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachKhachHang'; 
        </script>";
           // header("location: danhSachLoaiSach.php");
            //exit;
?>
