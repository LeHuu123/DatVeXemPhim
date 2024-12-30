<?php
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_Tap_Lon')
   or die('Lỗi kết nối');
$idChuongTrinhKhuyenMai = $_GET['idChuongTrinhKhuyenMai'];
$sqlTK = "SELECT * FROM chuongtrinhkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai' ";
$data = mysqli_query($con, $sqlTK);
// Xử lý nút lưu
if (isset($_POST['btnLuu'])) {
   $idChuongTrinhKhuyenMai = $_POST['txtMa'];
   $tenChuongTrinhKhuyenMai = $_POST['txtTen'];
   $ngayBatDau = $_POST['ngayBatDau'];
   $ngayKetThuc = $_POST['ngayKetThuc'];
   $moTa = $_POST['txtMoTa'];
   if ($ngayBatDau > $ngayKetThuc) {
      echo "<script>alert('Nhập sai ngày!')</script>";
   } else
        if ($tenChuongTrinhKhuyenMai == '') {
      echo "<script>alert('Phải nhập tên chương trình khuyến mãi!')</script>";
   } else {
      $sql = "UPDATE chuongtrinhkhuyenmai SET tenChuongTrinhKhuyenMai = '$tenChuongTrinhKhuyenMai', ngayBatDau = '$ngayBatDau', ngayKetThuc = '$ngayKetThuc', moTa = '$moTa'  WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
      $kq = mysqli_query($con, $sql);
      if ($kq) {
         echo " <script>
                alert('Sửa thành công!')
            </script>";
         $sqlTK = "SELECT * FROM chuongtrinhkhuyenmai WHERE idchuongtrinhkhuyenmai = '$idChuongTrinhKhuyenMai' ";
         $data = mysqli_query($con, $sqlTK);
      } else {
         echo " <script> 
                alert('Sửa thất bại!')
            </script>";
      }
   }
}
// Xử lý nút back
if (isset($_POST['btnBack'])) {
   // header("Location: DanhSachChuongTrinhKhuyenMai.php");
   $this->view("contents/QuanLyKhuyenMai/DanhSachChuongTrinhKhuyenMai");
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
   <h2 class="title_MAIN"> Chương trình khuyến mãi <i class="fa-solid fa-arrow-trend-up"></i>Cập nhật</h2>
   <div class="rap_container">
      <div class="container-fluid mt-3">
         <!-- <h4 class="mb-3"  style="text-align: center;">Sửa dòng khuyến mãi</h4> -->
         <form method="POST" action="">
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <?php
                  if (isset($data) && $data != null) {
                     while ($row = mysqli_fetch_array($data)) {
                  ?>
                        <label class="font-weight-bold">Mã chương trình khuyến mãi</label>
                        <input type="text" class="form-control" placeholder="Mã chương trình khuyến mãi" name="txtMa" value="<?php echo $row['idChuongTrinhKhuyenMai'] ?>" readonly>
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Tên chương trình khuyến mãi</label>
                  <input type="text" class="form-control" placeholder="Tên chương trình khuyến mãi" name="txtTen" value="<?php echo $row['tenChuongTrinhKhuyenMai'] ?>">
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Ngày bắt đầu</label>
                  <input type="date" name="ngayBatDau" id="" value="<?php echo $row['ngayBatDau'] ?>" required>
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Ngày kết thúc</label>
                  <input type="date" name="ngayKetThuc" id="" value="<?php echo $row['ngayKetThuc'] ?>" required>
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
         <button class="btn btn-warning" type="submit" name="btnBack">Trở về</button>
      </div>
         </form>
      </div>
   </div>

</body>

</html>