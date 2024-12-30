<?php
$id = $_GET['id'];
$connect = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon') or die("Lỗi kết nối");

// Select data from the database based on the provided ID
$query = "SELECT * FROM `phim` WHERE id=$id";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

// Store the retrieved values in variables
$tenphim = $row['tenPhim'];
$thoiluong = $row['thoiLuong'];
$ngayphathanh = $row['ngayPhatHanh'];
$ngayketthuc = $row['ngayKetThuc'];
$ngaybatdau = $row['ngayBatDau'];
$giobatdau = $row['gioBatDau'];
$gioketthuc = $row['gioKetThuc'];
$phongchieu = $row['phongChieu'];
$trangthai = $row['trangThai'];
$anh = $row['image'];
mysqli_close($connect);
if (isset($_POST['btnSua'])) {
    $connect = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon') or die("Lỗi kết nối");

    // Get values from input text and number
    $tenphim = $_POST['txtTenPhim'];
    $thoiluong = $_POST['txtThoiLuong'];
    $ngayphathanh = $_POST['txtNgayPhatHanh'];
    $ngaybatdau = $_POST['txtNgayBatDau'];
    $ngayketthuc = $_POST['txtNgayKetThuc'];
    $giobatdau = $_POST['txtGioBatDau'];
    $gioketthuc = $_POST['txtGioKetThuc'];
    $phongchieu = $_POST['txtPhongChieu'];
    $trangthai = $_POST['txtTrangThai'];

    // $anh = $_POST['txtAnh'];

    $anh = basename($_FILES["txtAnh"]["name"]);
    $target_dir = "upload_files/";
    $target_file = $target_dir . $anh;
    if (move_uploaded_file($_FILES["txtAnh"]["tmp_name"], $target_file)) {
        // echo "them anh thanh cong"; 
    } else {
        // echo "them anh that bai";
    }
    if($anh.trim('') == ''){
        $anh = $row['image'];
    }

    echo "anh " . $anh;
    // kiểm tra ngày
    if ($ngayphathanh > $ngayketthuc || $ngayphathanh > $ngaybatdau || $ngayketthuc < $ngaybatdau) {
        echo "<script>alert(' Vui lòng kiểm tra lại ngày.')</script>";
    } else {
        // Kiểm tra tên phim tồn tại
        $checkQuery = "SELECT id FROM `phim` WHERE tenPhim='$tenphim' AND id != $id";
        $checkResult = mysqli_query($connect, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "<script>alert('Tên phim đã tồn tại')</script>";
        } else {
            // Kiểm tra trùng lịch
            $overlapQuery = "SELECT id FROM `phim` 
                             WHERE phongChieu='$phongchieu' AND id != $id
                             AND (
                                ('$giobatdau' BETWEEN gioBatDau AND gioKetThuc) OR ('$gioketthuc' BETWEEN gioBatDau AND gioKetThuc)
                             )";
            $overlapResult = mysqli_query($connect, $overlapQuery);

            if (mysqli_num_rows($overlapResult) > 0) {
                echo "<script>alert('Lịch chiếu trùng với phim khác trong cùng phòng chiếu và thời gian.')</script>";
            } else {
                // cập nhật
                $query = "UPDATE `phim` SET `tenPhim`='$tenphim',`image`='$anh',`thoiLuong`='$thoiluong', `ngayPhatHanh`='$ngayphathanh',`ngayBatDau`='$ngaybatdau',`ngayKetThuc`='$ngayketthuc',`gioBatDau`='$giobatdau',`gioKetThuc`='$gioketthuc',`phongChieu`='$phongchieu', `trangThai`='$trangthai'  WHERE id= $id";
                $result = mysqli_query($connect, $query);

                if ($result) {
                    echo "<script>alert('Cập nhật thành công')</script>";
                    $this->view("contents/QuanLyPhim/index");
                    exit;
                } else {
                    echo "<script>alert('Data Not Updated!')</script>";
                }
            }
        }
    }

    mysqli_close($connect);
} else {
    // $connect = mysqli_connect('localhost', 'root', '', 'bai_tap_lon') or die("Lỗi kết nối");

    // // Select data from the database based on the provided ID
    // $query = "SELECT * FROM `phim` WHERE id=$id";
    // $result = mysqli_query($connect, $query);
    // $row = mysqli_fetch_assoc($result);

    // // Store the retrieved values in variables
    // $tenphim = $row['tenPhim'];
    // $thoiluong = $row['thoiLuong'];
    // $ngayphathanh = $row['ngayPhatHanh'];
    // $ngayketthuc = $row['ngayKetThuc'];
    // $ngaybatdau = $row['ngayBatDau'];
    // $giobatdau = $row['gioBatDau'];
    // $gioketthuc = $row['gioKetThuc'];
    // $phongchieu = $row['phongChieu'];
    // $trangthai = $row['trangThai'];
    // $anh = $row['image'];
    // mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <style>
        .update .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .update h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .update table {
            width: 100%;
        }

        .update table td {
            padding: 10px 0;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="file"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .update .luu {
            display: block;
            width: 40%;
            padding: 10px;
            background-color: #0E76FF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .update .luu:hover {
            background-color: #FF5722;
        }

        .update .cursor:hover {
            cursor: no-drop;
        }

        .update .back-button {
            position: absolute;

            background-color: #0E76FF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            padding: 0px 5px;
            text-align: center;
            cursor: pointer;

            text-decoration: none;
        }

        .update .back-button:hover {
            background-color: #0E76FF;
        }
    </style>
    </head>

    <body>
    <h2 class="title_MAIN"> Quản lý phim  <i class="fa-solid fa-arrow-trend-up"></i> Cập Nhật  </h2>
    <div class="rap_container">
        <div class="update">
            <div class="container" style="position:relative; margin-top: 40px">

                <a style="position:absolute; right:50px; top:40px" class="back-button" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLyPhim">X</a>

                <!-- <h3>CẬP NHẬT PHIM</h3> -->
                <form method="post" action="" enctype="multipart/form-data">
                    <table>

                        <tr>
                            <td>Mã Phim:</td>
                            <td>
                                <input min="1" required class="cursor" disabled readonly type="number" name="txtId" value="<?php echo $id ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Tên Phim:</td>
                            <td>
                                <input type="text" name="txtTenPhim" value="<?php echo $tenphim ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Ảnh:</td>
                            <td>
                                <br>
                                <input type="text" readonly value="<?php echo $anh; ?>">
                                <br>
                                <label for="newImage">Chọn ảnh mới: </label>
                                <input type="file" name="txtAnh" value="<?php echo $anh;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Thời Lượng:</td>
                            <td>
                                <input min="1" required type="number" name="txtThoiLuong" value="<?php echo $thoiluong ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày Phát Hành:</td>
                            <td>
                                <input type="date" name="txtNgayPhatHanh" value="<?php echo $ngayphathanh ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày Bắt Đầu:</td>
                            <td>
                                <input type="date" name="txtNgayBatDau" value="<?php echo $ngaybatdau ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày Kết Thúc:</td>
                            <td>
                                <input type="date" name="txtNgayKetThuc" value="<?php echo $ngayketthuc ?>">
                            </td>
                        </tr>
                        <tr>
                             <td>Thời Gian Chiếu:</td>
                            <td>
                                <div>Giờ bắt đầu</div>
                                <input type="time" name="txtGioBatDau" value="<?php echo date('H:i', strtotime($giobatdau)); ?>">
                            </td>

                            <td>
                                <div>Giờ kết thúc</div>
                                <input type="time" name="txtGioKetThuc" value="<?php echo date('H:i', strtotime($gioketthuc)); ?>">
                            </td>
                        </tr>


                        <tr>
                            <td>Phòng Chiếu:</td>
                            
                            <td>
                                <select name="txtPhongChieu" id="">
                                    <option value="A1" <?php echo ($phongchieu == "A1") ? 'selected' : ''; ?>>A1</option>
                                    <option value="A2" <?php echo ($phongchieu == "A2") ? 'selected' : ''; ?>>A2</option>
                                    <option value="A3" <?php echo ($phongchieu == "A3") ? 'selected' : ''; ?>>A3</option>
                                    <option value="A4" <?php echo ($phongchieu == "A4") ? 'selected' : ''; ?>>A4</option>
                                    <option value="A5" <?php echo ($phongchieu == "A5") ? 'selected' : ''; ?>>A5</option>
                                    <option value="A6" <?php echo ($phongchieu == "A6") ? 'selected' : ''; ?>>A6</option>
                                    <option value="A7" <?php echo ($phongchieu == "A7") ? 'selected' : ''; ?>>A7</option>
                                    <option value="A8" <?php echo ($phongchieu == "A8") ? 'selected' : ''; ?>>A8</option>
                                    <option value="A9" <?php echo ($phongchieu == "A9") ? 'selected' : ''; ?>>A9</option>
                                    <option value="A10" <?php echo ($phongchieu == "A10") ? 'selected' : ''; ?>>A10</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Trạng Thái:</td>
                            <td>

                                <input id="g" required type="radio" name="txtTrangThai" value="1" <?php echo ($trangthai == true) ? 'checked' : ''; ?>>
                                <label for="g">hoạt động</label>
                            </td>
                            <td>

                                <input id="h" required type="radio" name="txtTrangThai" value="0" <?php echo ($trangthai == false) ? 'checked' : ''; ?>>
                                <label for="h">chưa hoạt động</label>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="luu" type="submit" name="btnSua" value="Cập Nhật">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        </div>
    </body>

</html>