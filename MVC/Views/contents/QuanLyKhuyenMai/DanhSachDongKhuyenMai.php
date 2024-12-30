<?php
// Chương trình khuyến mãi
// Tạo kết nối đến database
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_Tap_Lon')
    or die('Lỗi kết nối');
$idChuongTrinhKhuyenMai = isset($_GET['idChuongTrinhKhuyenMai']) ? $_GET['idChuongTrinhKhuyenMai'] : '';
//$idChuongTrinhKhuyenMai = $_GET['idChuongTrinhKhuyenMai'];
$sqlTK = "SELECT * FROM chuongtrinhkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai' ";
$data = mysqli_query($con, $sqlTK);


// lay ngay bat dau va ngay ket thuc
$sqlTK1 = "SELECT * FROM chuongtrinhkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai' ";
$data1 = mysqli_query($con, $sqlTK1);
if (isset($data1) && $data1 != null) {
    while ($row = mysqli_fetch_array($data1)) {
       $_SESSION['KM_ngayBatDau'] =  $row['ngayBatDau'];
       $_SESSION['KM_ngayKetThuc'] = $row['ngayKetThuc'];
    }
 }

 

// Xử lý nút back
if (isset($_POST['btnBack'])) {
    header("Location: DanhSachChuongTrinhKhuyenMai.php");
    // $this->view("contents/QuanLyKhuyenMai/DanhSachDongKhuyenMai");
    exit();
}

// Dòng khuyến mãi

// include_once './Classes/PHPExcel.php';
// include_once './Classes/PHPExcel/IOFactory.php';

$this->view("contents/QuanLyKhuyenMai/Classes/PHPExcel");
$this->view("contents/QuanLyKhuyenMai/Classes/PHPExcel/IOFactory");
//B2: Tạo và thực hiện truy vấn
//$idChuongTrinhKhuyenMai = 1; // Giá trị idChuongTrinhKhuyenMai cần lấy
$sql2 = "SELECT * FROM dongkhuyenmai WHERE idChuongTrinhKhuyenMai = '$idChuongTrinhKhuyenMai'";
$data2 = mysqli_query($con, $sql2);

//B4: Đóng kết nối
//mysqli_close($con);
// Tìm kiếm
$currentDate = date('Y-m-d');
$idKhuyenMai = '';
if (isset($_POST['btnTimKiem'])) {
    $idKhuyenMai = $_POST['txtMa'];
    $sqlTK2 = "SELECT * FROM  dongkhuyenmai WHERE idKhuyenMai LIKE '%$idKhuyenMai%'";
    $data2 = mysqli_query($con, $sqlTK2);
}
if (isset($_POST['btnXuatExcel'])) {
    //code xuất excel
    $objExcel = new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('DSKM');
    $rowCount = 1;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A' . $rowCount, 'Mã chương trình khuyến mãi');
    $sheet->setCellValue('B' . $rowCount, 'Mã khuyến mãi');
    $sheet->setCellValue('C' . $rowCount, 'Loại khuyến mãi');
    $sheet->setCellValue('D' . $rowCount, 'Ngày bắt đầu');
    $sheet->setCellValue('E' . $rowCount, 'Ngày kết thúc');
    $sheet->setCellValue('F' . $rowCount, 'Trạng thái');
    $sheet->setCellValue('G' . $rowCount, 'Số lượng tối đa');
    $sheet->setCellValue('H' . $rowCount, 'Số lượng KH dùng tối đa trên ngày');
    $sheet->setCellValue('I' . $rowCount, 'Mô tả');
    // $sheet->setCellValue('D'.$rowCount,'Giới tính');
    // $sheet->setCellValue('E'.$rowCount,'Địa chỉ');
    // $sheet->setCellValue('F'.$rowCount,'Điện thoại');
    // $sheet->setCellValue('G'.$rowCount,'Mã lớp');
    // $sheet->setCellValue('H'.$rowCount,'Tên lớp');
    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);

    //gán màu nền
    $sheet->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $idKhuyenMai = $_POST['txtMa'];
    $sqlTK2 = "SELECT * FROM  dongkhuyenmai WHERE idKhuyenMai LIKE '%$idKhuyenMai%'";
    //$sqlTK = "SELECT * FROM loaisach ";
    $data2 = mysqli_query($con, $sqlTK2);
    // $msv=$_POST['txtMaLoai'];
    // $ht=$_POST['txtTenLoai'];
    //$ml=$_POST['txtMoTa'];
    //$kq=$this->dssv->timKiem($maLoai,$tenLoai,$moTa);

    while ($row = mysqli_fetch_array($data2)) {
        $rowCount++;
        $sheet->setCellValue('A' . $rowCount, $row['idChuongTrinhKhuyenMai']);
        $sheet->setCellValue('B' . $rowCount, $row['idKhuyenMai']);
        $sheet->setCellValue('C' . $rowCount, $row['loaiKhuyenMai']);
        $sheet->setCellValue('D' . $rowCount, $row['ngayBatDau']);
        $sheet->setCellValue('E' . $rowCount, $row['ngayKetThuc']);
        $sheet->setCellValue('F' . $rowCount, $row['trangThai']);
        $sheet->setCellValue('G' . $rowCount, $row['soLuongDungToiDa']);
        $sheet->setCellValue('H' . $rowCount, $row['soLuongDungToiDaTrenNgay']);
        $sheet->setCellValue('I' . $rowCount, $row['moTa']);
    }
    //Kẻ bảng 
    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );
    $sheet->getStyle('A1:' . 'I' . ($rowCount))->applyFromArray($styleArray);
    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $fileName = 'ExportExcel.xlsx';
    $objWriter->save($fileName);
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($fileName));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($fileName);
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

        .hoat-dong {
            color: green;
            /* Màu xanh cho trạng thái "Hoạt động" */
        }

        .ngung-hoat-dong {
            color: red;
            /* Màu đỏ cho trạng thái "Ngưng hoạt động" */
        }

        .chua-hoat-dong {
            color: black;
            /* Màu đen cho trạng thái "Chưa hoạt động" */
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>

<body>
    <h2 class="title_MAIN">Thông tin chương trình khuyến mãi</h2>
    <div class="rap_container">
        <div class="container-fluid mt-3">
            <!-- <h4 class="mb-3" style="text-align: center;">Thông tin chương trình khuyến mãi</h4> -->
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
                        <input type="text" class="form-control" placeholder="Tên chương trình khuyến mãi" name="txtTen" value="<?php echo $row['tenChuongTrinhKhuyenMai'] ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label class="font-weight-bold">Ngày bắt đầu</label>
                        <input type="date" name="ngayBatDau" id="" value="<?php echo $row['ngayBatDau'] ?>" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="font-weight-bold">Ngày kết thúc</label>
                        <input type="date" name="ngayKetThuc" id="" value="<?php echo $row['ngayKetThuc'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" class="font-weight-bold">Mô tả</label>
                    <textarea readonly class="form-control" rows="3" placeholder="Mô tả" name="txtMoTa"><?php echo $row['moTa']; ?></textarea>
                </div>

        <?php
                            }
                        }
        ?>
        <div class="button-container">
            <!-- <button class="btn btn-warning" type="submit" name="btnBack">Trở về</button> -->
            <a class="btn btn-warning" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLyKhuyenMai">Trở về</a>
        </div>


        <h6 class="mb-3" style="text-align: center;">Quản lý các dòng khuyến mãi </h6>

        <div class="container">
            <div class="border rounded">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mã khuyến mãi</span>
                    </div>
                    <input type="text" class="form-control" id="txtMa" name="txtMa" value="<?php echo $idKhuyenMai; ?>">
                </div>

                <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; text-align: center;" name="btnTimKiem">🔎Tìm kiếm</button>
            </div>
        </div>

        </div>

        <div class="button-container">
            <button style='padding: 0;' class="btn btn-success">

                <a href="http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=ThemDongKhuyenMai&idChuongTrinhKhuyenMai=<?php echo $idChuongTrinhKhuyenMai; ?>" style="padding: 5px 30px;   display: inline-block; color: white; text-decoration: none;">➕Thêm mới</a>
            </button>
            <button class="btn btn-primary" name="btnXuatExcel">📤Xuất excel</button>
        </div>

        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Mã chương trình khuyến mãi</th>
                <th>Mã khuyến mãi</th>
                <th>Loại khuyến mãi</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Số lượng</th>
                <th>Số lượng KH áp dụng tối đa trên 1 ngày</th>
                <th>Mô tả</th>
            </tr>
            <?php
            //B3: xử lý kết quả truy vấn: Hiển thị lên các dòng của bảng
            if (isset($data2) && $data2 != null) {
                $i = 0;
                while ($row = mysqli_fetch_array($data2)) {
                    $trangThai = '';
                    // Kiểm tra trạng thái của chương trình
                    if ($currentDate >= $row['ngayBatDau'] && $currentDate <= $row['ngayKetThuc']) {
                        $trangThai = '<font color="green">Đang hoạt động</font>';
                    } elseif ($currentDate > $row['ngayKetThuc']) {
                        $trangThai = '<font color="red">Ngưng hoạt động</font>';
                    } else {
                        $trangThai = '<font color="blue">Chưa hoạt động</font>';
                    }
            ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?php echo $row['idChuongTrinhKhuyenMai'] ?></td>
                        <td><?php echo $row['idKhuyenMai'] ?></td>
                        <td><?php echo $row['loaiKhuyenMai'] ?></td>
                        <td><?php echo $row['ngayBatDau'] ?></td>
                        <td><?php echo $row['ngayKetThuc'] ?></td>
                        <td><?php echo $trangThai ?></td>
                        <td><?php echo $row['soLuongDungToiDa'] ?></td>
                        <td><?php echo $row['soLuongDungToiDaTrenNgay'] ?></td>
                        <td><?php echo $row['moTa'] ?></td>
                        <td>
                            <a href="http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=SuaDongKhuyenMai&idKhuyenMai=<?php echo $row['idKhuyenMai']; ?>&idChuongTrinhKhuyenMai=<?php echo $row['idChuongTrinhKhuyenMai']; ?>">✏</a> &nbsp;&nbsp;&nbsp;
                            <a href="http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=XoaDongKhuyenMai&idKhuyenMai=<?php echo $row['idKhuyenMai']; ?>&idChuongTrinhKhuyenMai=<?php echo $row['idChuongTrinhKhuyenMai']; ?>">❌</a>
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