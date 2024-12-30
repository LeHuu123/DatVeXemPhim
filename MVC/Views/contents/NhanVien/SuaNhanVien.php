<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
    or die('Lỗi kết nối');



$idNhanVien = $_GET['idNhanVien'];

$sqlTK = "SELECT * FROM nhanvien WHERE idNhanVien = '$idNhanVien' ";
$data = mysqli_query($con, $sqlTK);
// Xử lý nút lưu


if (isset($_POST['btnLuu'])) {
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

    if ($tenTaiKhoan == '') {
        echo "<script>alert('Phải nhập tên tài khoản!')</script>";
        
    } else  
            if (strlen($matKhau) < 8) {
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
                    if ($chucVu == '') {
        echo "<script>alert('Phải nhập chức vụ')</script>";
        
    } else        
                    if ($soDienThoai == '') {
        echo "<script>alert('Phải nhập số điện thoại')</script>";
        
    } else if ($ngaySinh > $currentDate) {
        echo "<script>alert('Ngày sinh phải nhỏ hơn ngày hiện tại')</script>";
     } 
    else {



        $sql = "UPDATE nhanvien SET tenNhanVien = '$tenNhanVien', gioiTinh = '$gioiTinh', ngaySinh = '$ngaySinh', diachi = '$diaChi', soDienThoai = '$soDienThoai', chucVu = '$chucVu', tenTaiKhoan = '$tenTaiKhoan', matKhau = '$matKhau' WHERE idNhanVien = '$idNhanVien'";
        $kq = mysqli_query($con, $sql);
        if ($kq) {
            echo " <script>
                            alert('Sửa thành công!')
                           </script>";

            $sqlTK = "SELECT * FROM nhanvien WHERE idNhanVien = '$idNhanVien' ";
            $data = mysqli_query($con, $sqlTK);
        } else {
            echo " <script>
                            alert('Sửa thất bại!')
                            </script>";
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
    <h2 class="title_MAIN"> Quản lý nhân viên <i class="fa-solid fa-arrow-trend-up"></i> Cập nhật </h2>
    <div class="rap_container">
        <div class="container-fluid mt-3">
            <h4 class="mb-3" style="text-align: center;">Sửa nhân viên</h4>

            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group col-sm-6">


                        <?php
                        if (isset($data) && $data != null) {
                            while ($row = mysqli_fetch_array($data)) {
                        ?>


                                <label class="font-weight-bold">Mã nhân viên</label>
                                <input type="text" class="form-control" placeholder="Mã nhân viên" name="txtMaNhanVien" value="<?php echo $row['idNhanVien'] ?>" readonly>

                    </div>

                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Tên nhân viên</label>
                        <input type="text" class="form-control" placeholder="Tên nhân viên" name="txtTenNhanVien" value="<?php echo $row['tenNhanVien'] ?>">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-sm-4">
                        <label class="font-weight-bold">Giới tính</label>
                        <select class="form-control" name="txtGioiTinh">
                            <option selected>Chọn...</option>
                            <option value="Nam" <?php if ($row['gioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value="Nữ" <?php if ($row['gioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                            <option value="Khác" <?php if ($row['gioiTinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
                        </select>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Địa chỉ</label>
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="txtDiaChi" value="<?php echo $row['diaChi'] ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Số điện thoại</label>
                        <input type="number" class="form-control" placeholder="Số điện thoại" name="txtSoDienThoai" value="<?php echo $row['soDienThoai'] ?>">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Chức vụ</label>
                        <input type="text" class="form-control" readonly placeholder="Chức vụ" name="txtChucVu" value="<?php echo $row['chucVu'] ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Ngày sinh</label>
                        <input type="date" class="form-control" name="txtNgaySinh" value="<?php echo $row['ngaySinh'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Tên đăng nhập</label>
                        <input type="text" class="form-control" placeholder="Tên đăng nhập" name="txtTenTaiKhoan" value="<?php echo $row['tenTaiKhoan'] ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Mật khẩu</label>
                        <input type="text" class="form-control" name="txtMatKhau" value="<?php echo $row['matKhau'] ?>">
                    </div>
                </div>


        <?php
                            }
                        }
        ?>

        <div class="button-container">
            <button class="btn btn-success" type="submit" name="btnLuu">Lưu</button>
            <button class="btn btn-danger"> <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachNhanVien" style="color: white; text-decoration: none;">Hủy</a></button>
        </div>

            </form>


        </div>
    </div>

</body>


</html>