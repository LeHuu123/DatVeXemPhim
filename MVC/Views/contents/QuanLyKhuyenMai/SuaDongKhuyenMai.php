<?php

$ngayBatDau1 = "";
$ngayKetThuc1 = "";
if(isset( $_SESSION['KM_ngayBatDau'])){
  $ngayBatDau1 =  $_SESSION['KM_ngayBatDau'];
}

if(isset( $_SESSION['KM_ngayKetThuc'])){
  $ngayKetThuc1 =  $_SESSION['KM_ngayKetThuc'];
}
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_Tap_Lon')
   or die('Lỗi kết nối'); 
$idKhuyenMai = $_GET['idKhuyenMai'];
$idChuongTrinhKhuyenMai = $_GET['idChuongTrinhKhuyenMai'];
$sqlTK =  "SELECT * FROM dongkhuyenmai WHERE idKhuyenMai = '$idKhuyenMai' AND idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
$data = mysqli_query($con, $sqlTK);
// Xử lý nút lưu
if (isset($_POST['btnLuu'])) {
   $idKhuyenMai = $_POST['txtMa'];
   $soLuongDungToiDa = $_POST['soLuongDungToiDa'];
   $soLuongDungToiDaTrenNgay = $_POST['soLuongDungToiDaTrenNgay'];
   $ngayBatDau = $_POST['ngayBatDau'];
   $ngayKetThuc = $_POST['ngayKetThuc'];
   $moTa = $_POST['txtMoTa'];
   $loaiKhuyenMai = $_POST['txtLoai'];
   $soLuongToiThieu = $_POST['txtSoLuongToiThieu'];
   $soLuongTang = $_POST['txtSoLuongTang'];
   $donGiaToiThieu = $_POST['txtDonGiaToiThieu'];
   $giaTriGiam = $_POST['txtGiaTriGiam'];

   if($ngayBatDau < $ngayBatDau1 || $ngayKetThuc > $ngayKetThuc1){
      echo "<script>alert('Nhập sai ngày!')</script>";
   }
   else if ($ngayBatDau > $ngayKetThuc) {
      echo "<script>alert('Nhập sai ngày!')</script>";
   } else
        if ($soLuongDungToiDa == '') {
      echo "<script>alert('Phải nhập số lượng tối đa!')</script>";
   } else
         if ($soLuongDungToiDaTrenNgay == '') {
      echo "<script>alert('Phải nhập số lượng KH sử dụng tối đa trên ngày!')</script>";
   } else
      if ($loaiKhuyenMai == 'Chọn...') {
         
      echo "<script>alert('Bạn chưa chọn loại khuyến mãi! ')</script>" ;
   } else {
      $sql = "UPDATE dongkhuyenmai SET moTa = '$moTa',  loaiKhuyenMai = '$loaiKhuyenMai', soLuongToiThieu = '$soLuongToiThieu',soLuongTang = '$soLuongTang',donGiaToiThieu = '$donGiaToiThieu',giaTriGiam = '$giaTriGiam',ngayBatDau = '$ngayBatDau', ngayKetThuc = '$ngayKetThuc',soLuongDungToiDa = '$soLuongDungToiDa',soLuongDungToiDaTrenNgay = '$soLuongDungToiDaTrenNgay' WHERE idKhuyenmai = '$idKhuyenMai' AND idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
      $kq = mysqli_query($con, $sql);
      if ($kq) {
         echo " <script>
                alert('Sửa thành công!')
            </script>";
         $sqlTK =  "SELECT * FROM dongkhuyenmai WHERE idKhuyenMai = '$idKhuyenMai' AND idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
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
   echo "<script>
         window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachDongKhuyenMai&idChuongTrinhKhuyenMai=$idChuongTrinhKhuyenMai'; 
     </script>";
   exit;
}


?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>Form Example</title>
   <style>
      .button-container {
         margin-top: 20px ;
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
   <h2 class="title_MAIN"> Thông tin chương trình khuyến mãi <i class="fa-solid fa-arrow-trend-up"></i>Cập nhật</h2>
   <div class="rap_container">
      <div class="container-fluid mt-3">
         <h4 class="mb-3" style="text-align: center;">Sửa khuyến mãi</h4>
         <form method="POST" action="">
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <?php
                  if (isset($data) && $data != null) {
                     while ($row = mysqli_fetch_array($data)) {
                  ?>
                        <label class="font-weight-bold">Mã khuyến mãi</label>
                        <input type="text" class="form-control" placeholder="Mã chương trình khuyến mãi" name="txtMa" value="<?php echo $row['idKhuyenMai'] ?>" readonly>
               </div>

               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Loại khuyến mại</label>
                  <select class="form-control" name="txtLoai" onchange="showGiftFields(this)">
                     <option >Chọn...</option>
                     <option value="Khuyến mãi tặng sản phẩm" <?php if ($row['loaiKhuyenMai'] == 'Khuyến mãi tặng sản phẩm') echo 'selected'; ?>>Khuyến mãi tặng sản phẩm</option>
                     <option value="Khuyến mãi giảm tiền" <?php if ($row['loaiKhuyenMai'] == 'Khuyến mãi giảm tiền') echo 'selected'; ?>>Khuyến mãi giảm tiền</option>
                  </select>
               </div>
            </div>
            <div id="giftFields" style="display: none;">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng tối thiểu</label>
                  <input type="number" class="form-control" placeholder="Số lượng tối thiểu" name="txtSoLuongToiThieu" required value="<?php echo $row['soLuongToiThieu'] ?>">
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng tặng</label>
                  <input type="number" class="form-control" placeholder="Số lượng tặng" name="txtSoLuongTang" required value="<?php echo $row['soLuongTang'] ?>">
               </div>
            </div>

            <div id="discountFields" style="display: none;">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Đơn giá tối thiểu</label>
                  <input type="number" class="form-control" placeholder="Đơn giá tối thiểu" name="txtDonGiaToiThieu" required value="<?php echo $row['donGiaToiThieu'] ?>">
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Giá trị giảm</label>
                  <input type="number" class="form-control" placeholder="Phần trăm giảm" name="txtGiaTriGiam" required value="<?php echo $row['giaTriGiam'] ?>">
               </div>
            </div>

            <script>
               document.addEventListener("DOMContentLoaded", function() {
                  var txtLoai = document.querySelector("[name='txtLoai']");
                  showGiftFields(txtLoai);
               });

               function showGiftFields(selectElement) {
                  var giftFields = document.getElementById("giftFields");
                  var discountFields = document.getElementById("discountFields");
                  console.log(giftFields);
                  if (selectElement.value === "Khuyến mãi tặng sản phẩm") {
                     giftFields.style.display = "block";
                     discountFields.style.display = "none";
                  } else if (selectElement.value === "Khuyến mãi giảm tiền") {
                     giftFields.style.display = "none";
                     discountFields.style.display = "block";
                  } else {
                     giftFields.style.display = "none";
                     discountFields.style.display = "none";
                  }
               }
            </script>


            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Ngày bắt đầu</label>
                  <input type="date" name="ngayBatDau" id="" value="<?php echo $row['ngayBatDau'] ?>">
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Ngày kết thúc</label>
                  <input type="date" name="ngayKetThuc" id="" value="<?php echo $row['ngayKetThuc'] ?>">
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng tối đa</label>
                  <input type="number" min="0" class="form-control" placeholder="Số lượng" name="soLuongDungToiDa" value="<?php echo $row['soLuongDungToiDa'] ?>">
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng KH áp dụng tối đa trên 1 ngày</label>
                  <input type="number" min="0" class="form-control" placeholder="Số lượng" name="soLuongDungToiDaTrenNgay" value="<?php echo $row['soLuongDungToiDaTrenNgay'] ?>">
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