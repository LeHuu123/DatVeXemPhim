
<?php
$idChuongTrinhKhuyenMai = $_GET['idChuongTrinhKhuyenMai'];
$con = mysqli_connect('localhost:3367', 'root', '', 'Bai_Tap_Lon') or die('Lỗi kết nối');

// Xóa các hàng liên quan trong bảng dongkhuyenmai trước
$sqlDeleteDongKhuyenMai = "DELETE FROM dongkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
$kqDeleteDongKhuyenMai = mysqli_query($con, $sqlDeleteDongKhuyenMai);

// Tiếp tục xóa hàng trong bảng chuongtrinhkhuyenmai
$sqlDeleteChuongTrinhKhuyenMai = "DELETE FROM chuongtrinhkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
$kqDeleteChuongTrinhKhuyenMai = mysqli_query($con, $sqlDeleteChuongTrinhKhuyenMai);

if ($kqDeleteChuongTrinhKhuyenMai) {
    echo "<script>alert('Xóa thành công!');</script>";
} else {
    echo "<script>alert('Xóa thất bại!');</script>";
}

echo "<script>window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLyKhuyenMai';</script>";

// $this->view("contents/QuanLyKhuyenMai/DanhSachChuongTrinhKhuyenMai");
?>