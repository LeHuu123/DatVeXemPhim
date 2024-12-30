<?php
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_Tap_Lon')
   or die('Lỗi kết nối');
$maSanPham = $_GET['idSanPham'];
$sqlTK = "SELECT * FROM sanpham WHERE idSanPham = '$maSanPham' "; 
$data = mysqli_query($con, $sqlTK);
// Xử lý nút lưu
if (isset($_POST['btnLuu'])) {
   $maSanPham = $_POST['txtMa'];
   $tenSanPham = $_POST['txtTen'];
   $loaiSanPham = $_POST['txtLoai'];
   $giaTien = $_POST['txtGia'];
   $moTa = $_POST['txtMoTa'];
   $soLuong = $_POST['txtSoLuong'];
   $sql = "UPDATE sanpham SET tenSanPham = '$tenSanPham', loaiSanPham = '$loaiSanPham', giaTien = '$giaTien', moTa = '$moTa' , soLuong = '$soLuong' WHERE idSanPham = '$maSanPham'";
   $kq = mysqli_query($con, $sql);
   if ($kq) {
      echo " <script>
                alert('Sửa thành công!')
            </script>";
      $sqlTK = "SELECT * FROM sanpham WHERE idSanPham = '$maSanPham' ";
      $data = mysqli_query($con, $sqlTK);
   } else {
      echo " <script>
                alert('Sửa thất bại!')
            </script>";
   }
}
// Xử lý nút back
if (isset($_POST['btnBack'])) {
   header("Location: DanhSachSanPham.php");
   exit();
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
   <h2 class="title_MAIN"> Quản lý sản phẩm <i class="fa-solid fa-arrow-trend-up"></i> Cập nhật </h2>
   <div class="rap_container">
      <div class="container-fluid mt-3">
         <!-- <h4 class="mb-3"  style="text-align: center;">Sửa sản phẩm</h4> -->
         <form method="POST" action="">
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <?php
                  if (isset($data) && $data != null) {
                     while ($row = mysqli_fetch_array($data)) {
                  ?>
                        <label class="font-weight-bold">Mã sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Mã sản phẩm" name="txtMa" value="<?php echo $row['idSanPham'] ?>" readonly>
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Tên sản phẩm</label>
                  <input type="text" class="form-control" placeholder="Tên sản phẩm" name="txtTen" value="<?php echo $row['tenSanPham'] ?>">
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Loại sản phẩm</label>
                  <select class="form-control" name="txtLoai">
                     <option value="">Chọn...</option>
                     <option value="Đồ ăn vặt" <?php if ($row['loaiSanPham'] == 'Đồ ăn vặt') echo 'selected'; ?>>Đồ ăn vặt</option>
                     <option value="Nước uống" <?php if ($row['loaiSanPham'] == 'Nước uống') echo 'selected'; ?>>Nước uống</option>
                  </select>
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Giá tiền (VNĐ)</label>
                  <input type="text" class="form-control" placeholder="Giá tiền" name="txtGia" value="<?php echo $row['giaTien'] ?>">
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng</label>
                  <input type="number" class="form-control" placeholder="Số lượng" name="txtSoLuong" value="<?php echo $row['soLuong'] ?>">
               </div>
            </div>
            <div class="form-group">
               <label class="font-weight-bold" class="font-weight-bold">Mô tả</label>
               <textarea class="form-control" rows="3" placeholder="Mô tả" name="txtMoTa"><?php echo $row['moTa']; ?></textarea>
            </div>

      <?php
                     }
                  }
      ?>
      <div class="button-container">
         <button class="btn btn-success" type="submit" name="btnLuu">Lưu</button>
         <button class="btn btn-warning" type="submit" name="btnBack"><a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLySanPham" style="color: white; text-decoration: none;">Trở về</a></button>
      </div>
         </form>
      </div>
   </div>

</body>

</html>