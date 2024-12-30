<?php
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'Bai_Tap_Lon') or die('Lỗi kết nối');

// Tạo và thực hiện chèn dữ liệu vào bảng chuongtrinhkhuyenmai
$idChuongTrinhKhuyenMai = '';
$tenChuongTrinhKhuyenMai = '';
$ngayBatDau = '';
$ngayKetThuc = '';
$moTa = '';

if (isset($_POST['btnThem'])) {
   $idChuongTrinhKhuyenMai = $_POST['txtMa'];
   $tenChuongTrinhKhuyenMai = $_POST['txtTen'];
   $ngayBatDau = $_POST['ngayBatDau'];
   $ngayKetThuc = $_POST['ngayKetThuc'];
   $moTa = $_POST['txtMoTa'];


   if ($ngayBatDau > $ngayKetThuc) {
      echo "<script>alert('Nhập sai ngày!')</script>";
      include_once './ThemChuongTrinhKhuyenMai.php';
   } else {
      // Kiểm tra trùng mã
      $sql1 = "SELECT * FROM chuongtrinhkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
      $kq1 = mysqli_query($con, $sql1);

      if (mysqli_num_rows($kq1) <= 0) {
         $sql = "INSERT INTO chuongtrinhkhuyenmai (idChuongTrinhKhuyenMai, tenChuongTrinhKhuyenMai, ngayBatDau, ngayKetThuc, moTa) VALUES ('$idChuongTrinhKhuyenMai', '$tenChuongTrinhKhuyenMai', '$ngayBatDau', '$ngayKetThuc', '$moTa')";
         $kq = mysqli_query($con, $sql);

         if ($kq) {
            echo "<script>alert('Thêm thành công!')</script>";
         } else {
            echo "<script>alert('Thêm thất bại!')</script>";
         }
      } else {
         echo "<script>alert('Trùng mã chương trình khuyến mãi!')</script>";
      }
   }
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>Form Example</title>
   <style>
      .button-container {
         margin-top: 20px;
         display: flex;
         justify-content: center;
         align-items: center;
         margin-bottom: 30px;
         /* Thêm khoảng cách dưới container nếu cần */
      }

      .button-container button {
         margin: 0 10px;
         /* Khoảng cách giữa các nút */
      }
   </style>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>

<body>
   <h2 class="title_MAIN"> Chương trình khuyến mãi <i class="fa-solid fa-arrow-trend-up"></i> Thêm </h2>
   <div class="rap_container">

      <div class="container-fluid mt-3">
         <!-- <h4 class="mb-3" style="text-align: center;">Thêm chương trình khuyến mãi</h4> -->
         <form method="POST" action="">
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Mã chương trình khuyến mãi</label>
                  <input type="text" class="form-control" placeholder="Mã chương trình khuyến mãi" name="txtMa" required>
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Tên chương trình khuyến mãi</label>
                  <input type="text" class="form-control" placeholder="Tên chương trình khuyến mãi" name="txtTen" required>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Ngày bắt đầu</label>
                  <input type="date" name="ngayBatDau" id="" required>
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Ngày kết thúc</label>
                  <input type="date" name="ngayKetThuc" id="" required>
               </div>
            </div>
            <div class="form-group">
               <label class="font-weight-bold">Mô tả</label>
               <textarea class="form-control" rows="3" placeholder="Mô tả" name="txtMoTa"></textarea>
            </div>

            <div class="button-container">
               <button class="btn btn-success" type="submit" name="btnThem">Thêm mới</button>
               <button class="btn btn-danger"> <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLyKhuyenMai   " style="color: white; text-decoration: none;">Hủy</a></button>
            </div>
         </form>
      </div>
   </div>

</body>

</html>