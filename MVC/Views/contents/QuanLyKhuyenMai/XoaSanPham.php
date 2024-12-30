<?php
    $maSanPham = $_GET['idSanPham'];
    $con=mysqli_connect('localhost:3367','root','','Bai_Tap_Lon')
    or die('Lỗi kết nối');
    //Tạo và thực hiện xóa
    $sql = "DELETE FROM sanpham WHERE idSanPham = '$maSanPham'";
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
            echo "<script>window.location.href = 'DanhSachSanPham.php';</script>";
           // header("location: danhSachLoaiSach.php");
            //exit;
?>