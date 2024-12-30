<?php
    $idKhuyenMai = $_GET['idKhuyenMai'];
    echo "ádsaddsdsadasdsssssssssssssssssssssssssssss";
    $idChuongTrinhKhuyenMai = $_GET['idChuongTrinhKhuyenMai'];
    $con = mysqli_connect('localhost:3367', 'root', '', 'Bai_Tap_Lon') or die('Lỗi kết nối');

// Thực hiện truy vấn để lấy dữ liệu
$sql = "SELECT * FROM dongkhuyenmai WHERE idKhuyenMai = '$idKhuyenMai' AND idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
$result = mysqli_query($con, $sql);

// Kiểm tra số dòng kết quả trả về
if (mysqli_num_rows($result) > 0) {
    // Xóa các dòng liên kết trong bảng `dongkhuyenmai`
    $sqlDeleteDongKhuyenMai = "DELETE FROM dongkhuyenmai WHERE idKhuyenMai = '$idKhuyenMai' AND idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
    $resultDeleteDongKhuyenMai = mysqli_query($con, $sqlDeleteDongKhuyenMai);

    if ($resultDeleteDongKhuyenMai) {
        // Xóa thành công
        echo "<script>
        alert('Xóa thành công!');
        
       
        window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachDongKhuyenMai&idChuongTrinhKhuyenMai=$idChuongTrinhKhuyenMai'; 
    </script>";
exit;
    } else {
        // Xóa thất bại
        echo "<script>
            alert('Xóa  thành công!');
            window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachDongKhuyenMai&idChuongTrinhKhuyenMai=$idChuongTrinhKhuyenMai'; 
        </script>";
exit;
    }
}
    
?>