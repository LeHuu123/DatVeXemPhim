<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
   or die('Lỗi kết nối');

$idNhanVien = '';
$tenNhanVien = '';
$diaChi = '';
$soDienThoai = '';
$gioiTinh = '';
$ngaySinh = '';
$chucVu = '';
$tenTaiKhoan = '';
$matKhau = '';
 
if (isset($_POST['btnThem'])) {
   $idNhanVien = $_POST['txtMaNhanVien'];
   $tenNhanVien = $_POST['txtTenNhanVien'];
   $diaChi = $_POST['txtDiaChi'];
   $soDienThoai = $_POST['txtSoDienThoai'];
   $gioiTinh = $_POST['txtGioiTinh'];
   $ngaySinh = $_POST['txtNgaySinh'];
   $chucVu = $_POST['txtChucVu'];
   $tenTaiKhoan = $_POST['txtTenTaiKhoan'];
   $matKhau = $_POST['txtMatKhau'];

   $currentDate = date('Y-m-d'); // Lấy ngày hiện tại
  

   //Kiểm tra dữ liệu rỗng
   if ($tenTaiKhoan == '') {
      echo "<script>alert('Phải nhập tên tài khoản!')</script>";
      
   } else  if (strlen($matKhau) < 8) {
      echo "<script>alert('Mật khẩu phải nhiều hơn  8 ký tự!')</script>";
      
   } else  
        if ($idNhanVien == '') {
      echo "<script>alert('Phải nhập mã nhân viên!')</script>";
      
   } else        
            if ($tenNhanVien == '') {
      echo "<script>alert('Phải nhập tên nhân viên!')</script>";
      
   } else        
            if ($diaChi == '') {
      echo "<script>alert('Phải nhập địa chỉ')</script>";
      
   } else        
            if ($gioiTinh == '') {
      echo "<script>alert('Phải nhập giới tính')</script>";
      
   } else        
            if ($ngaySinh == '') {
      echo "<script>alert('Phải nhập ngày sinh')</script>";
      
   } else        
            if ($soDienThoai == '') {
      echo "<script>alert('Phải nhập số điện thoại')</script>";
     
   } else        
            if ($chucVu == '') {
      echo "<script>alert('Phải nhập chức vụ')</script>";
      
   } else if ($ngaySinh > $currentDate) {
      echo "<script>alert('Ngày sinh phải nhỏ hơn ngày hiện tại')</script>";
   } 
   else {
      $sql1 = "SELECT * FROM nhanvien WHERE idNhanVien = '$idNhanVien' ";
      $kq1 = mysqli_query($con, $sql1);

      $sql2 = "SELECT * FROM nhanvien WHERE tenTaiKhoan = '$tenTaiKhoan' ";
      $kq2 = mysqli_query($con, $sql2);

      

      if (mysqli_num_rows($kq1) <= 0 and mysqli_num_rows($kq2) <= 0) // Kiểm tra số dòng
      {

         $sql = "INSERT INTO nhanvien VALUES ('$idNhanVien','$tenNhanVien','$gioiTinh','$ngaySinh','$diaChi','$soDienThoai','$chucVu','$tenTaiKhoan','$matKhau')";
         $kq = mysqli_query($con, $sql);
         if ($kq) {
            echo " <script>
                            alert('Thêm thành công!')
                            </script>";
         } else {
            echo " <script>
                            alert('Thêm thất bại!')
                            </script>";
         }
      } else {
         if(mysqli_num_rows($kq1) > 0 ){
            echo " <script>
                        alert('Trùng mã nhân viên!')
                    </script>";
                    echo "<script>
                    window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=ThemNhanVien'; 
                    </script>";

         }
         else{
            echo " <script>
                        alert('Đã có tài khoản!')
                    </script>";
                    echo "<script>
                    window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=ThemNhanVien'; 
                    </script>";
         }
         
      }
      echo "<script>
      window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachNhanVien'; 
      </script>";
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
   <h2 class="title_MAIN"> Quản lý nhân viên <i class="fa-solid fa-arrow-trend-up"></i> Thêm </h2>
   <div class="rap_container">
      <div class="container-fluid mt-3">
         <form method="POST" action="">

            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Mã nhân viên</label>
                  <input type="text" class="form-control" placeholder="Mã nhân viên" name="txtMaNhanVien">
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Tên nhân viên</label>
                  <input type="text" class="form-control" placeholder="Tên nhân viên" name="txtTenNhanVien">
               </div>

            </div>

            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Giới tính</label>
                  <select class="form-control" name="txtGioiTinh">
                     <option selected>Chọn...</option>
                     <option>Nam</option>
                     <option>Nữ</option>
                     <option>Khác</option>
                  </select>
               </div>
            </div>

            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Địa chỉ</label>
                  <input type="text" class="form-control" placeholder="Địa chỉ" name="txtDiaChi">
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Số điện thoại</label>
                  <input type="number" class="form-control" placeholder="Số điện thoại" name="txtSoDienThoai">
               </div>
            </div>


            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Chức vụ</label>
                  <input type="text" class="form-control" placeholder="Chức vụ" name="txtChucVu" value = "Nhân viên" readonly >
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Ngày sinh</label>
                  <input type="date" class="form-control" name="txtNgaySinh">
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Tên đăng nhập</label>
                  <input type="text" class="form-control" placeholder="Tên đăng nhập" name="txtTenTaiKhoan">
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Mật khẩu</label>
                  <input type="password" class="form-control" name="txtMatKhau" placeholder="Mật khẩu">
               </div>
            </div>





            <div class="button-container">
               <button class="btn btn-success" type="submit" name="btnThem">Thêm mới</button>
               <button class="btn btn-danger"> <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachNhanVien" style="color: white; text-decoration: none;">Hủy</a></button>
            </div>
         </form>
      </div>
   </div>

</body>

</html>