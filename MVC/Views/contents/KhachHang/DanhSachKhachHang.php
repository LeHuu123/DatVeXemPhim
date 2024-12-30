<?php
// include_once './Classes/PHPExcel.php';
// include_once './Classes/PHPExcel/IOFactory.php';

//B1: Tạo kết nối đến DB
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
    or die('Lỗi kết nối');



//B2: Tạo và thực hiện truy vấn


$sql = "SELECT * FROM khachhang";
$data = mysqli_query($con, $sql);

$idKhachHang = '';
$tenKhachHang = '';
if (isset($_POST['btnTimKiem'])) {
    $idKhachHang = $_POST['txtMaKhachHang'];
    $tenKhachHang = $_POST['txtTenKhachHang'];
    $sqlTK = "SELECT * FROM khachhang WHERE idKhachHang LIKE '%$idKhachHang%' and tenKhachHang LIKE '%$tenKhachHang%'";
    $data = mysqli_query($con, $sqlTK);
}




use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// if (isset($_POST["btnXuatExcel"])) {

if (isset($_POST['btnXuatExcel'])) {
    // Header row
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $patient = array();
    while ($row = mysqli_fetch_assoc($data)) {      
            array_push($patient, $row);
    }

    $headerRowData = ['Mã khách hàng','Tên khách hàng','Địan chỉ','Số điện thoại','Email','Ngày sinh','Giới tính','Tên tài khoản','Mật khẩu','Ngày đăng ký','Ngày cập nhật'];
    $columnIndex = 1;
    foreach ($headerRowData as $headerCell) {
        $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex) . '1';
        $sheet->setCellValue($cellCoordinate, $headerCell);
        $columnIndex++;
    }
    // Data rows
    $dataRow = 2;
    foreach ($patient as $rowData) {
        $columnIndex = 1;
        foreach ($rowData as $propertyValue) {
            $cellCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnIndex) . $dataRow;
            $sheet->setCellValue($cellCoordinate, $propertyValue);
            $columnIndex++;
        }
        $dataRow++;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save('khachHang.xlsx');
    echo "<script>
        alert('Xuất excel thành công !');
        window.location.href = 'http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=HoaDonTra'; 
        </script>";

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
    <h2 class="title_MAIN">Quản lý khách hàng</h2>
    <div class="rap_container">
        <div>
            <form method="POST" action="">
                <!-- <h3 class="mb-3" style="text-align: center;">Quản lý khách hàng</h3> -->

                <div class="container">
                    <div class="border rounded">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã khách hàng</span>
                            </div>
                            <input type="text" class="form-control" id="txtMaKhachHang" name="txtMaKhachHang" value="<?php echo $idKhachHang; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tên khách hàng</span>
                            </div>
                            <input type="text" class="form-control" id="txtTenKhachHang" name="txtTenKhachHang" value="<?php echo $tenKhachHang; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; text-align: center;" name="btnTimKiem">🔎Tìm kiếm</button>
                    </div>
                </div>

        </div>

        <div class="button-container">
            <button class="btn btn-success"> <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=ThemKhachHang" style="color: white; text-decoration: none;">➕Thêm mới</a></button>
            <button class="btn btn-primary" name="btnXuatExcel">📤Xuất excel</button>
        </div>

        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Mã khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
            
                <th>Mật khẩu</th>
                <th>Ngày đăng kí</th>
                <th>Ngày cập nhật</th>
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
                        <td><?php echo $row['idKhachHang'] ?></td>
                        <td><?php echo $row['tenKhachHang'] ?></td>
                        <td><?php echo $row['diaChi'] ?></td>
                        <td><?php echo $row['soDienThoai'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['ngaySinh'] ?></td>
                        <td><?php echo $row['gioiTinh'] ?></td>
                        
                        <td><?php echo $row['matKhau'] ?></td>
                        <td><?php echo $row['ngayDangKy'] ?></td>
                        <td><?php echo $row['ngayCapNhat'] ?></td>

                        <td>

                            <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=SuaKhachHang&idKhachHang=<?php echo $row['idKhachHang'] ?>">✏</a> &nbsp;&nbsp;&nbsp;
                            <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=XoaKhachHang&idKhachHang=<?php echo $row['idKhachHang'] ?>">❌</a> &nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        </form>
    </div>
    </div>

</body>

</html>