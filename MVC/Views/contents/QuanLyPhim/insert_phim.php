<?php
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon') or die("Lỗi kết nối");

if (isset($_POST['btnThem'])) {
    $id = $_POST['txtId'];
    $tenphim = $_POST['txtTenPhim'];
    $thoiluong = $_POST['txtThoiLuong'];
    $ngayphathanh = $_POST['txtNgayPhatHanh'];
    $ngayketthuc = $_POST['txtNgayKetThuc'];
    $ngaybatdau = $_POST['txtNgayBatDau'];
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
        echo "them anh that bai";
    }


    $giave = $_POST['txtGiaVe'];

    // Check if the release date is greater than the end date
    if ($ngayphathanh > $ngayketthuc || $ngayphathanh > $ngaybatdau || $ngaybatdau > $ngayketthuc) {
        echo "<script>alert('Vui lòng kiểm tra lại ngày.');</script>";
    } else {
        // Check if the movie ID already exists
        $checkIdQuery = "SELECT id FROM phim WHERE id = '$id'";
        $resultId = mysqli_query($con, $checkIdQuery);

        if (mysqli_num_rows($resultId) > 0) {
            echo "<script>alert('Mã phim đã tồn tại.');</script>";
        } else {
            // Check if the movie name already exists
            $checkNameQuery = "SELECT tenPhim FROM phim WHERE tenPhim = '$tenphim'";
            $resultName = mysqli_query($con, $checkNameQuery);

            if (mysqli_num_rows($resultName) > 0) {
                echo "<script>alert('Tên phim đã tồn tại.');</script>";
            } else {
                // Check for overlapping screenings in the same theater
                $sqlCheckOverlap = $sqlCheckOverlap = "SELECT * FROM phim 
                WHERE phongChieu = '$phongchieu' 
                AND (
                    ('$giobatdau' BETWEEN gioBatDau AND gioKetThuc) OR ('$gioketthuc' BETWEEN gioBatDau AND gioKetThuc)
                )";;

                $resultOverlap = mysqli_query($con, $sqlCheckOverlap);
                if (mysqli_num_rows($resultOverlap) > 0) {
                    echo "<script>alert('Phòng chiếu đã có suất chiếu cùng thời gian.');</script>";
                } else {
                    // Insert the new movie if all checks pass
                    $sql = "INSERT INTO phim(`id`,`tenPhim`,`image`, thoiLuong, ngayPhatHanh,`ngayBatDau`,`ngayKetThuc`,`gioBatDau`,`gioKetThuc`,`phongChieu`,`trangThai`, `giaVe`) 
                            VALUES ('$id','$tenphim','$anh','$thoiluong','$ngayphathanh','$ngaybatdau','$ngayketthuc','$giobatdau','$gioketthuc','$phongchieu','$trangthai', '$giave')";
                    $data = mysqli_query($con, $sql);

                    if ($data) {
                        echo "<script>alert('Thêm phim thành công!');</script>";
                        $this->view("contents/QuanLyPhim/index");
                        exit;
                    } else {
                        echo "<script>alert('Thêm mới thất bại!');</script>";
                    }
                }
            }
        }
    }
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
        /* Your CSS styles here */






        .insert h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;

        }

        .insert table {
            width: 50%;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 0px 10px;
            border-radius: 8px
        }

        .insert table td {
            padding: 10px 0;

        }

        .insert label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        .insert input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        .insert .luu {
            display: block;
            width: 50%;
            background-color: #0E76FF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .insert .luu:hover {
            background-color: #0E76FF;
        }

        .insert .container {
            position: relative;
        }


        .insert .back-button {
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

        .insert .back-button:hover {
            background-color: #0E76FF;
        }
    </style>

    <h2 class="title_MAIN"> Quản lý phim  <i class="fa-solid fa-arrow-trend-up"></i> Thêm phim </h2>
    <div class="rap_container">
        <div class="insert">
            <div class="box-01">
                <form method="post" action="" enctype="multipart/form-data">
                    <table style="position:relative">
                        <tr>
                            <td> <a style="position:absolute; right:30px" class="back-button" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLyPhim">X</a></td>
                        </tr>
                        <tr>
                            <!-- <h3>THÊM PHIM MỚI</h3> -->
                        </tr>
                        <tr>

                            <td>Mã Phim:</td>
                            <td>
                                <input min="1" required type="number" name="txtId">
                            </td>
                        </tr>
                        <tr>
                            <td>Tên Phim:</td>
                            <td>
                                <input required type="text" name="txtTenPhim">
                            </td>
                        </tr>
                        <tr>
                            <td>Ảnh:</td>
                            <td>
                                <input required type="file" name="txtAnh">
                            </td>
                        </tr>
                        <tr>
                            <td>Thời Lượng:</td>
                            <td>
                                <input min="1" required type="number" name="txtThoiLuong">
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày Phát Hành Phim:</td>
                            <td>
                                <input required type="date" name="txtNgayPhatHanh">
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày Bắt Đầu Chiếu:</td>
                            <td>
                                <input required type="date" name="txtNgayBatDau">
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày Kết Thúc:</td>
                            <td>
                                <input required type="date" name="txtNgayKetThuc">
                            </td>
                        </tr>
                        <tr>
                            <td>Thời Gian Chiếu:</td>
                            <td>
                                Giờ bắt đầu
                                <input required type="time" name="txtGioBatDau">
                            </td>

                            <td>
                                Giờ kết thúc
                                <input required type="time" name="txtGioKetThuc">
                            </td>
                        </tr>


                        <tr>
                            <td>Phòng Chiếu:</td>
                            <!-- <td>
                    <input required type="text" name="txtPhongChieu">
                </td> -->
                            <td>
                                <select name="txtPhongChieu" id="">
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="A4">A4</option>
                                    <option value="A5">A5</option>
                                    <option value="A6">A6</option>
                                    <option value="A7">A7</option>
                                    <option value="A8">A8</option>
                                    <option value="A9">A9</option>
                                    <option value="A10">A10</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Trạng Thái:</td>
                            <td>

                                <input id="3" required type="radio" name="txtTrangThai" value="1">
                                <label for="3">hoạt động</label>

                            </td>
                            <td>

                                <input id="4" required type="radio" name="txtTrangThai" value="0">
                                <label for="4">chưa hoạt động</label>

                            </td>
                        </tr>
                        <tr>
                            <td>Giá vé (VND):</td>
                            <td>

                                <input min="0" class="" type="number" name="txtGiaVe">
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="luu" type="submit" name="btnThem" value="THÊM">
                            </td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>