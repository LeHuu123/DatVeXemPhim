<?php
// include_once './Classes/PHPExcel.php';
// include_once './Classes/PHPExcel/IOFactory.php';

//B1: Tạo kết nối đến DB
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
    or die('Lỗi kết nối');



//B2: Tạo và thực hiện truy vấn


$sql = "SELECT * FROM nhanvien";
$data = mysqli_query($con, $sql);

$idNhanVien = '';
$tenNhanVien = '';
$gioiTinh = '';
if (isset($_POST['btnTimKiem'])) {
    $idNhanVien = $_POST['txtMaNhanVien'];
    $tenNhanVien = $_POST['txtTenNhanVien'];
    $gioiTinh = $_POST['txtGioiTinh'];
    $sqlTK = "SELECT * FROM nhanvien WHERE idNhanVien LIKE '%$idNhanVien%' and tenNhanVien LIKE '%$tenNhanVien%' and gioiTinh LIKE '%$gioiTinh%'";
    $data = mysqli_query($con, $sqlTK);
}

if (isset($_POST['btnHienThi'])) {
    $sqlHT = "SELECT * FROM nhanvien ";
    $data = mysqli_query($con, $sqlHT);
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: right;
            align-items: center;
            margin-bottom: 20px;
            /* Thêm khoảng cách dưới container nếu cần */
        }

        .button-container button {
            margin: 0 10px;
            /* Khoảng cách giữa các nút */
        }
    </style>
</head>

<body>
    <h2 class="title_MAIN"> Quản lý nhân viên </h2>
    <div class="rap_container">
        <form method="POST" action="">
            <!-- <h3 class="mb-3" style="text-align: center;">Quản lý nhân viên</h3> -->
            <div class="container">
                <div class="border rounded">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mã nhân viên</span>
                        </div>
                        <input type="text" class="form-control" id="txtMaNhanvien" name="txtMaNhanVien" value="<?php echo $idNhanVien; ?>">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tên nhân viên</span>
                        </div>
                        <input type="text" class="form-control" id="txtTenNhanVien" name="txtTenNhanVien" value="<?php echo $tenNhanVien; ?>">
                    </div>

                   
                    <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; text-align: center; margin-bottom: 20px" name="btnTimKiem">🔎Tìm kiếm</button>
                    <!-- <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; text-align: center;" name="btnHienThi" >Hiển thị danh sách</button> -->

                </div>
            </div>

    </div>

    <div class="button-container">
        <button class="btn btn-success"> <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=ThemNhanVien" style="color: white; text-decoration: none;">➕Thêm mới</a></button>
    </div>

    <table class="table table-striped">
        <tr>
            <th>STT</th>
            <th>Mã nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Chức vụ</th>
            <th>Tên đăng nhập</th>
            <th>Mật khẩu</th>
            <th>Chức năng</th>


        </tr>
        <?php
        //B3: xử lý kết quả truy vấn: Hiển thị lên các dòng của bảng
        if (isset($data) && $data != null) {
            $i = 0;
            while ($row = mysqli_fetch_array($data)) {
        ?>
                <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $row['idNhanVien'] ?></td>
                    <td><?php echo $row['tenNhanVien'] ?></td>
                    <td><?php echo $row['gioiTinh'] ?></td>
                    <td><?php echo $row['ngaySinh'] ?></td>
                    <td><?php echo $row['diaChi'] ?></td>
                    <td><?php echo $row['soDienThoai'] ?></td>
                    <td><?php echo $row['chucVu'] ?></td>
                    <td><?php echo $row['tenTaiKhoan'] ?></td>
                    <td><?php echo $row['matKhau'] ?></td>
                    <td>
                        <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=SuaNhanVien&idNhanVien=<?php echo $row['idNhanVien'] ?>" >✏</a> &nbsp;&nbsp;&nbsp;
                        <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=XoaNhanVien&idNhanVien=<?php echo $row['idNhanVien'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?');">❌</a> &nbsp;&nbsp;&nbsp;
                    </td>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>
</form>

</div>

</html>