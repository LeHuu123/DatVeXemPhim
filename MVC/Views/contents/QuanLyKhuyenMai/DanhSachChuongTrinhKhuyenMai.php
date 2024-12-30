<?php
// include_once './Classes/PHPExcel.php';
// include_once './Classes/PHPExcel/IOFactory.php';
$this->view("contents/QuanLyKhuyenMai/Classes/PHPExcel");
$this->view("contents/QuanLyKhuyenMai/Classes/PHPExcel/IOFactory");
//B1: Tạo kết nối đến DB
$con = mysqli_connect('localhost:3367', 'root', '', 'Bai_Tap_Lon')
    or die('Lỗi kết nối');
//B2: Tạo và thực hiện truy vấn
$sql = "SELECT * FROM chuongtrinhkhuyenmai";
$data = mysqli_query($con, $sql);
//B4: Đóng kết nối
//mysqli_close($con);
// Tìm kiếm
$currentDate = date('Y-m-d');
$idChuongTrinhKhuyenMai = '';
$tenChuongTrinhKhuyenMai = '';
if (isset($_POST['btnTimKiem'])) {
    $idChuongTrinhKhuyenMai = $_POST['txtMa'];
    $tenChuongTrinhKhuyenMai = $_POST['txtTen'];
    $sqlTK = "SELECT * FROM  chuongtrinhkhuyenmai WHERE idChuongTrinhKhuyenMai LIKE '%$idChuongTrinhKhuyenMai%' and tenChuongTrinhKhuyenMai LIKE '%$tenChuongTrinhKhuyenMai%'";
    $data = mysqli_query($con, $sqlTK);
}
if (isset($_POST['btnXuatExcel'])) {
    //code xuất excel
    $objExcel = new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('DSSP');
    $rowCount = 1;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('A' . $rowCount, 'Mã chương trình khuyến mãi');
    $sheet->setCellValue('B' . $rowCount, 'Tên chương trình khuyến mãi');
    $sheet->setCellValue('C' . $rowCount, 'Ngày bắt đầu');
    $sheet->setCellValue('D' . $rowCount, 'Ngày kết thúc');
    $sheet->setCellValue('E' . $rowCount, 'Mô tả');
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
    //gán màu nền
    $sheet->getStyle('A1:E1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $idChuongTrinhKhuyenMai = $_POST['txtMa'];
    $tenChuongTrinhKhuyenMai = $_POST['txtTen'];
    $ngayBatDau = $_POST['ngayBatDau'];
    $ngayKetThuc = $_POST['ngayKetThuc'];
    $moTa = $_POST['txtMoTa'];
    $sqlTK = "SELECT * FROM  chuongtrinhkhuyenmai WHERE idChuongTrinhKhuyenMai LIKE '%$idChuongTrinhKhuyenMai%' and tenChuongTrinhKhuyenMai LIKE '%$tenChuongTrinhKhuyenMai%'";
    //$sqlTK = "SELECT * FROM loaisach ";
    $data = mysqli_query($con, $sqlTK);
    // $msv=$_POST['txtMaLoai'];
    // $ht=$_POST['txtTenLoai'];
    //$ml=$_POST['txtMoTa'];
    //$kq=$this->dssv->timKiem($maLoai,$tenLoai,$moTa);

    while ($row = mysqli_fetch_array($data)) {
        $rowCount++;
        $sheet->setCellValue('A' . $rowCount, $row['idChuongTrinhKhuyenMai']);
        $sheet->setCellValue('B' . $rowCount, $row['tenChuongTrinhKhuyenMai']);
        $sheet->setCellValue('C' . $rowCount, $row['ngayBatDau']);
        $sheet->setCellValue('D' . $rowCount, $row['ngayKetThuc']);
        $sheet->setCellValue('E' . $rowCount, $row['moTa']);
    }
    //Kẻ bảng 
    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );
    $sheet->getStyle('A1:' . 'E' . ($rowCount))->applyFromArray($styleArray);
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

    <h2 class="title_MAIN">Chương trình khuyến mãi </h2>
    <div class="rap_container">
        <div class="">

            <form method="POST" action="">
                <!-- <h4 class="mb-3" style="text-align: center;">Quản lý chương trình khuyến mãi </h4> -->

                <div class="container">
                    <div class="border rounded">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã chương trình khuyến mãi</span>
                            </div>
                            <input type="text" class="form-control" id="txtMa" name="txtMa" value="<?php echo $idChuongTrinhKhuyenMai; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tên chương trình khuyến mãi</span>
                            </div>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo $tenChuongTrinhKhuyenMai; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; text-align: center;" name="btnTimKiem">🔎Tìm kiếm</button>
                    </div>
                </div>

        </div>

        <div class="button-container">
            <button class="btn btn-success"> <a href="http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=ThemChuongTrinhKhuyenMai" style="color: white; text-decoration: none;">➕Thêm mới</a></button>
            <button class="btn btn-primary" name="btnXuatExcel">📤Xuất excel</button>
        </div>

        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Mã chương trình khuyến mãi</th>
                <th>Tên chương trình khuyến mãi</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Mô tả</th>
            </tr>
            <?php
            //B3: xử lý kết quả truy vấn: Hiển thị lên các dòng của bảng
            if (isset($data) && $data != null) {
                $i = 0;
                while ($row = mysqli_fetch_array($data)) {
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

                        <td><a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachDongKhuyenMai&idChuongTrinhKhuyenMai=<?php echo $row['idChuongTrinhKhuyenMai'] ?>"><?php echo $row['idChuongTrinhKhuyenMai'] ?></a></td>
                        <!-- <td><a href="http://localhost/Bai_Tap_Lon/DanhSachDongKhuyenMai.php?idChuongTrinhKhuyenMai=<?php echo $row['idChuongTrinhKhuyenMai'] ?>"><?php echo $row['idChuongTrinhKhuyenMai'] ?></a></td> -->
                        <td><?php echo $row['tenChuongTrinhKhuyenMai'] ?></td>
                        <td><?php echo $row['ngayBatDau'] ?></td>
                        <td><?php echo $row['ngayKetThuc'] ?></td>
                        <td><?php echo $trangThai ?></td>
                        <td><?php echo $row['moTa'] ?></td>
                        <td>


                            <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=SuaChuongTrinhKhuyenMai&idChuongTrinhKhuyenMai=<?php echo $row['idChuongTrinhKhuyenMai'] ?>">✏</a> &nbsp;&nbsp;&nbsp;
                            <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=XoaChuongTrinhKhuyenMai&idChuongTrinhKhuyenMai=<?php echo $row['idChuongTrinhKhuyenMai'] ?>">❌</a> &nbsp;&nbsp;&nbsp;
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