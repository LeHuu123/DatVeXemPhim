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
$con = mysqli_connect('localhost:3367', 'root', '', 'Bai_Tap_Lon') or die('Lỗi kết nối');
// Tạo và thực hiện chèn dữ liệu vào bảng chuongtrinhkhuyenmai
$idKhuyenMai = '';
$moTa = '';
$ngayBatDau = '';
$ngayKetThuc = '';
$trangThai = '';
$loaiKhuyenMai = '';
$soLuongToiThieu = '';
$soLuongTang = '';
$donGiaToiThieu    = '';
$giaTriGiam    = '';
$soLuongDungToiDa = '';
$soLuongDungToiDaTrenNgay = '';

$idChuongTrinhKhuyenMai = $_GET['idChuongTrinhKhuyenMai'];
$sql2 = "SELECT * FROM dongkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
$data2 = mysqli_query($con, $sql2);





if (isset($_POST['btnThem'])) {
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
   // Kiểm tra dữ liệu rỗng

   if($ngayBatDau < $ngayBatDau1 || $ngayKetThuc > $ngayKetThuc1){
      echo "<script>alert('Nhập sai ngày!')</script>";
   }
   else
   if ($loaiKhuyenMai == '' || $loaiKhuyenMai == 'Chọn...') {
      echo "<script>alert('Phải nhập loại khuyến mãi!')</script>";
      // include_once './ThemDongKhuyenMai.php';
   } else 
         if ($ngayBatDau > $ngayKetThuc) {
      echo "<script>alert('Nhập sai ngày!')</script>";
      // include_once './ThemDongKhuyenMai.php';
   } else {
      // Kiểm tra trùng mã
      $sql1 = "SELECT * FROM dongkhuyenmai WHERE idKhuyenMai = '$idKhuyenMai' and  idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
      $kq1 = mysqli_query($con, $sql1);

      if (mysqli_num_rows($kq1) <= 0) {
         $sql = "INSERT INTO dongkhuyenmai (`idChuongTrinhKhuyenMai`, `idKhuyenMai`, `moTa`, `loaiKhuyenMai`, `soLuongToiThieu`, `soLuongTang`, `donGiaToiThieu`, `giaTriGiam`, `ngayBatDau`, `ngayKetThuc`, `trangThai`, `soLuongDungToiDa`, `soLuongDungToiDaTrenNgay`) VALUES ('$idChuongTrinhKhuyenMai', '$idKhuyenMai', '$moTa', '$loaiKhuyenMai', '$soLuongToiThieu','$soLuongTang','$donGiaToiThieu','$giaTriGiam','$ngayBatDau', '$ngayKetThuc', '$trangThai', '$soLuongDungToiDa', '$soLuongDungToiDaTrenNgay')";
         $kq = mysqli_query($con, $sql);
         if ($kq) {
            echo "<script>alert('Thêm thành công!')</script>";
         } else {
            echo "<script>alert('Thêm thất bại!')</script>";
         }
      } else {
         echo "<script>alert('Trùng mã khuyến mãi!')</script>";
      }
   }
}

?>
</script>
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

      .highlight {
         font-weight: bold;
         color: red;
      }
   </style>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>

<body>
   <h2 class="title_MAIN"> Thông tin chương trình khuyến mãi <i class="fa-solid fa-arrow-trend-up"></i>Thêm</h2>
   <div class="rap_container">
      <div class="container-fluid mt-3">
         <h4 class="mb-3" style="text-align: center;">Thêm dòng khuyến mãi: </h4>
         <form method="POST" action="">
            <table>
               <!-- <?php
                     // B3: Xử lý kết quả truy vấn: Hiển thị lên các dòng của bảng
                     if (isset($data2) && $data2 != null) {
                        $row = mysqli_fetch_array($data2);
                        // Chỉ lấy dòng đầu tiên
                     ?>
        <tr>
        <td><span class="font-weight-bold">Mã chương trình khuyến mãi: </span><span class="highlight"><?php echo $row['idChuongTrinhKhuyenMai']; ?></span></td> 
        </tr>
        <?php
                     }
         ?> -->
            </table>
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Mã khuyến mãi</label>
                  <input type="text" class="form-control" placeholder="Mã khuyến mãi" name="txtMa" required>
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Loại khuyến mại</label>
                  <select class="form-control" name="txtLoai" onchange="showGiftFields(this)">
                     <option selected>Chọn...</option>
                     <option>Khuyến mãi tặng sản phẩm</option>
                     <option>Khuyến mãi giảm tiền</option>
                  </select>
               </div>
            </div>


            <div id="giftFields" style="display: none;">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng tối thiểu</label>
                  <input type="number" class="form-control" placeholder="Số lượng tối thiểu" name="txtSoLuongToiThieu">
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng tặng</label>
                  <input type="number" class="form-control" placeholder="Số lượng tặng" name="txtSoLuongTang">
               </div>
            </div>

            <div id="discountFields" style="display: none;">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Đơn giá tối thiểu</label>
                  <input type="number" class="form-control" placeholder="Đơn giá tối thiểu" name="txtDonGiaToiThieu">
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Giá trị giảm</label>
                  <input type="number" class="form-control" placeholder="Phần trăm giảm" name="txtGiaTriGiam">
               </div>
            </div>

            <script>
               function showGiftFields(selectElement) {
                  var giftFields = document.getElementById("giftFields");

                  if (selectElement.value === "Khuyến mãi tặng sản phẩm") {
                     giftFields.style.display = "block";
                  } else if (selectElement.value === "Khuyến mãi giảm tiền") {
                     discountFields.style.display = "block";
                     giftFields.style.display = "none";
                  } else {
                     discountFields.style.display = "none";
                     giftFields.style.display = "none";
                  }
               }
            </script>
            </table>
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
            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng tối đa</label>
                  <input type="number" class="form-control" placeholder="Số lượng" name="soLuongDungToiDa" min="0" required>
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng KH áp dụng tối đa trên 1 ngày</label>
                  <input type="number" class="form-control" placeholder="Số lượng" name="soLuongDungToiDaTrenNgay" min="0" required>
               </div>
            </div>
            <div class="form-group">
               <label class="font-weight-bold">Mô tả</label>
               <textarea class="form-control" rows="3" placeholder="Mô tả" name="txtMoTa"></textarea>
            </div>

            <div class="button-container">
               <button class="btn btn-success" type="submit" name="btnThem">Thêm mới</button>
               <button class="btn btn-danger"> <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachDongKhuyenMai&idChuongTrinhKhuyenMai=<?php echo $idChuongTrinhKhuyenMai; ?>" style="color: white; text-decoration: none;">Hủy</a></button>
            </div>
         </form>
      </div>
   </div>
</body>

</html>