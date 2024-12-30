<?php
// include_once './Classes/PHPExcel.php';
// include_once '/Classes/PHPExcel/IOFactory.php';
$this->view("contents/SanPham/Classes/PHPExcel");
$this->view("contents/SanPham/Classes/PHPExcel/IOFactory");

//B1: Tạo kết nối đến DB
$con = mysqli_connect('localhost:3367', 'root', '', 'Bai_Tap_Lon')
    or die('Lỗi kết nối');
//B2: Tạo và thực hiện truy vấn
$sql = "SELECT * FROM sanpham";
$data = mysqli_query($con, $sql);
//B4: Đóng kết nối
//mysqli_close($con);
// Tìm kiếm
$maSanPham = '';
$tenSanPham = '';
$loaiSanPham = '';
if (isset($_POST['btnTimKiem'])) {
    $maSanPham = $_POST['txtMa'];
    $tenSanPham = $_POST['txtTen'];
    $loaiSanPham = $_POST['txtLoai'];
    $sqlTK = "SELECT * FROM sanpham WHERE idSanPham LIKE '%$maSanPham%' and tenSanPham LIKE '%$tenSanPham%' and loaiSanPham LIKE '%$loaiSanPham%'";
    $data = mysqli_query($con, $sqlTK);
}

ob_start();

if (isset($_POST['btnXuatExcel'])) {
    



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
<h2 class="title_MAIN"> Quản lý sản phẩm </h2>
    <div class="rap_container">
    <div class="SanPham">
        <form method="POST" action="">
            <!-- <h4 class="mb-3" style="text-align: center;">Quản lý sản phẩm</h4> -->
            <div class="container">
                <div class="border rounded">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mã sản phẩm</span>
                        </div>
                        <input type="text" class="form-control" id="txtMa" name="txtMa" value="<?php echo $maSanPham; ?>">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tên sản phẩm</span>
                        </div>
                        <input type="text" class="form-control" id="txtTen" name="txtTen" value="<?php echo $tenSanPham; ?>">
                    </div>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Loai sản phẩm</span>
                        </div>
                        <input type="text" class="form-control" id="txtTen" name="txtLoai" value="<?php echo $loaiSanPham; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; text-align: center;" name="btnTimKiem">🔎Tìm kiếm</button>
                </div>
            </div>
    </div>
    <div class="button-container">
        <button class="btn btn-success"> <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=Them_SanPham" style="color: white; text-decoration: none;">➕Thêm mới</a></button>
        <button class="btn btn-primary" name="btnXuatExcel">📤Xuất excel</button>
    </div>

    <table class="table table-striped">
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
        if (isset($data) && $data != null) {
            $i = 0;
            while ($row = mysqli_fetch_array($data)) {
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
                        <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=Sua_SanPham&idSanPham=<?php echo $row['idSanPham'] ?>">✏</a> &nbsp;&nbsp;&nbsp;
                        <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=Xoa_SanPham&idSanPham=<?php echo $row['idSanPham'] ?>">❌</a> &nbsp;&nbsp;&nbsp;
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