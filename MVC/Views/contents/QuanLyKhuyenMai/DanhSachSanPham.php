<?php 
    include_once './Classes/PHPExcel.php';
    include_once './Classes/PHPExcel/IOFactory.php';
    //B1: Tạo kết nối đến DB
    $con=mysqli_connect('localhost:3367','root','','Bai_Tap_Lon')
    or die('Lỗi kết nối');
    //B2: Tạo và thực hiện truy vấn
    $sql="SELECT * FROM sanpham";
    $data=mysqli_query($con,$sql);
    //B4: Đóng kết nối
    //mysqli_close($con);
    // Tìm kiếm
    $maSanPham='';
    $tenSanPham ='';
    if(isset ($_POST['btnTimKiem']))
    {
        $maSanPham = $_POST['txtMa'];
        $tenSanPham = $_POST['txtTen'];
        $sqlTK = "SELECT * FROM sanpham WHERE idSanPham LIKE '%$maSanPham%' and tenSanPham LIKE '%$tenSanPham%'";
        $data=mysqli_query($con,$sqlTK);
    }
    if(isset($_POST['btnXuatExcel']))
    {
        //code xuất excel
        $objExcel=new PHPExcel();
        $objExcel->setActiveSheetIndex(0);
        $sheet=$objExcel->getActiveSheet()->setTitle('DSSP');
        $rowCount=1;
        //Tạo tiêu đề cho cột trong excel
        $sheet->setCellValue('A'.$rowCount,'Mã sản phẩm');
        $sheet->setCellValue('B'.$rowCount,'Tên sản phẩm');
        $sheet->setCellValue('C'.$rowCount,'Loại sản phẩm');
        $sheet->setCellValue('D'.$rowCount,'Giá tiền');
        $sheet->setCellValue('E'.$rowCount,'Mô tả');
        $sheet->setCellValue('F'.$rowCount,'Số lượng');
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
        //gán màu nền
        $sheet->getStyle('A1:F1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
        //căn giữa
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
        $maSanPham = $_POST['txtMa'];
      $tenSanPham = $_POST['txtTen'];
    //   $loaiSanPham = $_POST['txtLoai'];
    //   $giaTien = $_POST['txtGia'];
    //   $moTa = $_POST['txtMoTa'];
    //   $soLuong = $_POST['txtSoLuong'];
      $sqlTK = "SELECT * FROM sanpham WHERE idSanPham LIKE '%$maSanPham%' and tenSanPham LIKE '%$tenSanPham%'";
        //$sqlTK = "SELECT * FROM loaisach ";
        $data=mysqli_query($con,$sqlTK);
        // $msv=$_POST['txtMaLoai'];
        // $ht=$_POST['txtTenLoai'];
        //$ml=$_POST['txtMoTa'];
        //$kq=$this->dssv->timKiem($maLoai,$tenLoai,$moTa);
       
        while($row=mysqli_fetch_array($data)){
            $rowCount++;
            $sheet->setCellValue('A'.$rowCount,$row['idSanPham']);
            $sheet->setCellValue('B'.$rowCount,$row['tenSanPham']);
            $sheet->setCellValue('C'.$rowCount,$row['loaiSanPham']);
            $sheet->setCellValue('D'.$rowCount,$row['giaTien']);
            $sheet->setCellValue('E'.$rowCount,$row['moTa']);
            $sheet->setCellValue('F'.$rowCount,$row['soLuong']);
        }
        //Kẻ bảng 
        $styleArray=array(
            'borders'=>array(
                'allborders'=>array(
                    'style'=>PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $sheet->getStyle('A1:'.'F'.($rowCount))->applyFromArray($styleArray);
        $objWriter=new PHPExcel_Writer_Excel2007($objExcel);
        $fileName='ExportExcel.xlsx';
        $objWriter->save($fileName);
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Length: '.filesize($fileName));
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
  margin-bottom: 20px; /* Thêm khoảng cách dưới container nếu cần */
}

.button-container button {
  margin: 0 10px; /* Khoảng cách giữa các nút */
}
</style>
</head>
<body>
    <form method="POST" action="">
    <h4 class="mb-3"  style="text-align: center;">Quản lý sản phẩm</h4>

    <div  class="container">
        <div class="border rounded">
        <div class="input-group mb-3">
<div class="input-group-prepend">
        <span class="input-group-text" >Mã sản phẩm</span>
</div>
<input type="text" class="form-control" id="txtMa" name="txtMa" value="<?php echo $maSanPham; ?>">
</div>
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">Tên sản phẩm</span>
</div>
<input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo $tenSanPham; ?>">
</div>
<button type="submit" class="btn btn-primary"style="display: block; margin: 0 auto; text-align: center;"  name="btnTimKiem">🔎Tìm kiếm</button>
</div>
    </div>

        </div>
    
    <div class="button-container">
    <button class="btn btn-success"> <a href="http://localhost/Bai_Tap_Lon/ThemSanPham.php?"  style="color: white; text-decoration: none;">➕Thêm mới</a></button>
    <button class="btn btn-primary" name="btnXuatExcel">📤Xuất excel</button>
</div>

    <table  class="table table-striped">
        <tr>
            <th>STT</th>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Loại sản phẩm</th>
            <th>Giá tiền (VNĐ)</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
        </tr>
        <?php 
                //B3: xử lý kết quả truy vấn: Hiển thị lên các dòng của bảng
                if(isset($data)&&$data!=null){
                    $i=0;
                    while($row=mysqli_fetch_array($data)){
            ?>
                <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $row['idSanPham'] ?></td>
                    <td><?php echo $row['tenSanPham'] ?></td>
                    <td><?php echo $row['loaiSanPham'] ?></td>
                    <td><?php echo $row['giaTien'] ?></td>
                    <td><?php echo $row['moTa'] ?></td>
                    <td><?php echo $row['soLuong'] ?></td>
                    <td>
                        <a href="http://localhost/Bai_Tap_Lon/SuaSanPham.php?idSanPham=<?php echo $row['idSanPham']?>" >✏</a> &nbsp;&nbsp;&nbsp;
                        <a href="http://localhost/Bai_Tap_Lon/XoaSanPham.php?idSanPham=<?php echo $row['idSanPham']?>" >❌</a> &nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
            <?php
                    }
                }
            ?>
    </table>
</body>
    </form>
    
</html>