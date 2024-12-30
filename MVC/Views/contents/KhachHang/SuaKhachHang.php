<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
    or die('Lỗi kết nối');



$idKhachHang = $_GET['idKhachHang'];

$sqlTK = "SELECT * FROM khachhang WHERE idKhachHang = '$idKhachHang' ";
$data = mysqli_query($con, $sqlTK);
// Xử lý nút lưu


if (isset($_POST['btnLuu'])) {
    $idKhachHang = $_POST['txtMaKhachHang'];
    $tenKhachHang = $_POST['txtTenKhachHang'];
    $diaChi = $_POST['txtDiaChi'];
    $soDienThoai = $_POST['txtSoDienThoai'];
    $email = $_POST['txtEmail'];
    $ngaySinh = $_POST['txtNgaySinh'];
    $gioiTinh = $_POST['txtGioiTinh'];
    $tenTaiKhoan = $_POST['txtTenTaiKhoan'];
    $matKhau = $_POST['txtMatKhau'];
    $ngayDangKy = $_POST['txtNgayDangKy'];
    $ngayCapNhat = $_POST['txtNgayCapNhat'];

    $ngayCapNhat = date('Y-m-d');





    // $sql = "UPDATE khachhang SET tenKhachHang = '$tenKhachHang', diachi = '$diaChi', soDienThoai = '$soDienThoai', email = '$email' , ngaySinh = '$ngaySinh', gioiTinh = '$gioiTinh', tenTaiKhoan = '$tenTaiKhoan', matKhau = '$matKhau',ngayDangKy = '$ngayDangKy', ngayCapNhat = '$ngayCapNhat'  WHERE idKhachHang = '$idKhachHang'";
    // $kq = mysqli_query($con,$sql);
    // if($kq)
    // {
    //     echo" <script>
    //     alert('Sửa thành công!')
    //    </script>";

    // $sqlTK = "SELECT * FROM khachhang WHERE idKhachHang = '$idKhachHang' ";
    // $data = mysqli_query($con, $sqlTK);

    // }
    // else
    // {
    //     echo" <script>
    //     alert('Sửa thất bại!')
    //     </script>"; 
    // } 





    if (strlen($matKhau) < 8) {
        echo "<script>alert('Mật khẩu phải nhiều hơn 8 ký tự!')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($tenKhachHang == '') {
        echo "<script>alert('Phải nhập tên khách hàng!')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($diaChi == '') {
        echo "<script>alert('Phải nhập địa chỉ')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($soDienThoai == '') {
        echo "<script>alert('Phải nhập số điện thoại')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($email == '') {
        echo "<script>alert('Phải nhập email')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($ngaySinh == '') {
        echo "<script>alert('Phải nhập ngày sinh')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($gioiTinh == '') {
        echo "<script>alert('Phải nhập giới tính')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($tenTaiKhoan == '') {
        echo "<script>alert('Phải nhập tên tài khoản')</script>";
        //include_once './ThemKhachHang.php';
    } else        
                if ($matKhau == '') {
        echo "<script>alert('Phải nhập mật khẩu')</script>";
        //include_once './ThemKhachHang.php';
    } else {
        $sql = "UPDATE khachhang SET tenKhachHang = '$tenKhachHang', diachi = '$diaChi', soDienThoai = '$soDienThoai', email = '$email' , ngaySinh = '$ngaySinh', gioiTinh = '$gioiTinh', tenTaiKhoan = '$tenTaiKhoan', matKhau = '$matKhau',ngayDangKy = '$ngayDangKy', ngayCapNhat = '$ngayCapNhat'  WHERE idKhachHang = '$idKhachHang'";
        $kq = mysqli_query($con, $sql);
        if ($kq) {
            echo " <script>
                        alert('Sửa thành công!')
                       </script>";

            $sqlTK = "SELECT * FROM khachhang WHERE idKhachHang = '$idKhachHang' ";
            $data = mysqli_query($con, $sqlTK);
        } else {
            echo " <script>
                        alert('Sửa thất bại!')
                        </script>";
        }
    }
}



if (isset($_POST['btnBack'])) {
    echo "<script>
        window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachKhachHang'; 
        </script>";

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
    <h2 class="title_MAIN"> Quản lý khách hàng <i class="fa-solid fa-arrow-trend-up"></i> Cập nhật </h2>
    <div class="rap_container">
        <div class="container-fluid mt-3">
            <!-- <h4 class="mb-3" style="text-align: center;">Sửa khách hàng</h4> -->

            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group col-sm-6">


                        <?php
                        if (isset($data) && $data != null) {
                            while ($row = mysqli_fetch_array($data)) {
                        ?>


                                <label class="font-weight-bold">Mã khách hàng</label>
                                <input type="text" class="form-control" placeholder="Mã khách hàng" name="txtMaKhachHang" value="<?php echo $row['idKhachHang'] ?>" readonly>

                    </div>

                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Tên khách hàng</label>
                        <input type="text" class="form-control" placeholder="Tên khách hàng" name="txtTenKhachHang" value="<?php echo $row['tenKhachHang'] ?>">
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
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="txtSoDienThoai" value="<?php echo $row['soDienThoai'] ?>">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="txtEmail" value="<?php echo $row['email'] ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Ngày sinh</label>
                        <input type="date" class="form-control" name="txtNgaySinh" value="<?php echo $row['ngaySinh'] ?>">
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Tên tài khoản</label>
                        <input type="text" class="form-control" placeholder="Tên tài khoản" name="txtTenTaiKhoan" value="<?php echo $row['tenTaiKhoan'] ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Mật khẩu</label>
                        <input type="text" class="form-control" placeholder="Mật khẩu" name="txtMatKhau" value="<?php echo $row['matKhau'] ?>">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Ngày đăng ký</label>
                        <input type="date" class="form-control" placeholder="Ngày đăng ký" name="txtNgayDangKy" value="<?php echo $row['ngayDangKy'] ?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="font-weight-bold">Ngày cập nhật</label>
                        <input type="date" class="form-control" name="txtNgayCapNhat" value="<?php echo $row['ngayCapNhat'] ?>" readonly>
                    </div>
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