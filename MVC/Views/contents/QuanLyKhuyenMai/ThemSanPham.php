<?php
    // Tạo kết nối đến database
    $con = mysqli_connect('localhost:3367','root','','Bai_Tap_Lon')
    or die('Lỗi kết nối');
    // Tạo và thực hiện chèn dữ liệu vào bảng loaisach
    $maSanPham='';
    $tenSanPham='';
    $loaiSanPham='';
    $giaTien='';
    $moTa = '';
    $soLuong='';
    if(isset($_POST['btnThem']))
    {
        $maSanPham = $_POST['txtMa'];
        $tenSanPham = $_POST['txtTen'];
        $loaiSanPham = $_POST['txtLoai'];
        $giaTien = $_POST['txtGia'];
        $moTa = $_POST['txtMoTa'];
        $soLuong = $_POST['txtSoLuong'];
        //Kiểm tra dữ liệu rỗng
        
         if($loaiSanPham = 'Chọn...')
         {
            echo "<script>alert('Bạn chưa chọn loại sản phẩm!')</script>";
         }
         else
         {
            // Kiểm tra trùng mã
        $sql1 = "SELECT * FROM sanpham WHERE idSanPham = '$maSanPham'";
        $kq1 = mysqli_query($con,$sql1);
        if(mysqli_num_rows($kq1) <=0 ) // Kiểm tra số dòng
        {
            $sql = "INSERT INTO sanpham VALUES ('$maSanPham','$tenSanPham','$loaiSanPham','$giaTien','$moTa','$soLuong')";
            $kq = mysqli_query($con,$sql);
            if($kq)
            {
                echo" <script>
                alert('Thêm thành công!')
            </script>";
            }
            else
            {
                echo" <script>
                alert('Thêm thất bại!')
            </script>"; 
            } 
        }
        else 
        {
            echo" <script>
                alert('Trùng mã sản phẩm!')
            </script>"; 
        }
        }
      }
        
        //
        
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
  margin-bottom: 30px; /* Thêm khoảng cách dưới container nếu cần */
}

.button-container button {
  margin: 0 10px; /* Khoảng cách giữa các nút */
}
</style>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
   </head>
   <body>
      <div class="container-fluid mt-3" >
         <h4 class="mb-3"  style="text-align: center;">Thêm sản phẩm mới</h4>
         <form method="POST" action="">
            <div class="form-row">
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Mã sản phẩm</label>
                  <input type="text" class="form-control"
                     placeholder="Mã sản phẩm" name = "txtMa" required>
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Tên sản phẩm</label>
                  <input type="text" class="form-control" placeholder="Tên sản phẩm" name = "txtTen" required>
               </div>
            </div>
            <div class="form-row">
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Loại sản phẩm</label>
                  <select class="form-control" name="txtLoai">
                     <option selected>Chọn...</option>
                     <option>Đồ ăn vặt</option>
                     <option>Nước uống</option>
                  </select>
               </div>
               <div class="form-group col-sm-6">
                  <label class="font-weight-bold">Giá tiền (VNĐ)</label>
                  <input type="text" class="form-control" placeholder="Giá tiền" name = "txtGia" required>
               </div>
               <div class="form-row">
               <div class="input-group">
                  <div class="custom-file">
                     <input type="file" class="custom-file-input" id="inputGroupFile04">
                     <label class="custom-file-label" for="inputGroupFile04">Chọn ảnh</label>
                  </div>
               </div>
               <div class="form-group col-sm-4">
                  <label class="font-weight-bold">Số lượng</label>
                  <input type="number" class="form-control" placeholder="Số lượng" name = "txtSoLuong" required>
               </div>
               </div>
               
               
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Mô tả</label>
                <textarea class="form-control" rows="3" placeholder="Mô tả" name = "txtMoTa"></textarea>
            </div>
               
               <div class="button-container">
    <button class="btn btn-success" type="submit" name = "btnThem">Thêm mới</button>
    <button class="btn btn-danger">  <a href="http://localhost/Bai_Tap_Lon/DanhSachSanPham.php?" style="color: white; text-decoration: none;">Hủy</a></button>
</div>
         </form>
      </div>
      
   </body>
</html>