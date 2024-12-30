<?php
$_SESSION['thoiGianBatDau'] = "";
$_SESSION['thoiGianKetThuc'] = "";
$_SESSION['gioBatDau'] = "";
$_SESSION['gioKetThuc'] = "";
$_SESSION['phongChieu'] = "";

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
        .ThongTin {
            background-color: white;
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            display: inline-block;
            border-radius: 10px;
        }

        .ThongTin a {
            color: black;
            margin: 0;
        }

        .ThongTin img {
            width: 350px;
            aspect-ratio: 2/1;
            object-fit: fill;
        }

        .ThongTin__list {
            display: flex;
            flex-direction: column;
        }

        .ThongTin__item {
            display: inline-flex;
            margin-bottom: 20px;
        }

        .ThongTin__titleSub {
            font-size: 17px !important;
            font-weight: 500;
            width: 100%;
        }

        .ThongTin__item p {
            margin: 0;
        }

        .ThongTin__title {
            width: 120px;
        }

        .ThongTin input , textarea{
            border: 0;
            font-size: 15px;
            outline: none;
            /* width: 100%; */
            
        }

        .dis{
            pointer-events:none;
        }

        .ThongTin .submit {
            display: inline-block;
            padding: 5px 20px;
            background-color: aqua;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 20px;
        }

        .ThongTin .submit:hover {
            background-color: rgba(0, 255, 255, 0.455);

        }

        .soGhe {
            width: 220px;
            word-wrap: break-word;
        }

        .ThongTin .disble_tr {
            background-color: aqua;
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
        }

        .ThongTin .displayRe {
            position: relative;
        }

        .a {
            width: 100%;
        }
    </style>
    <div class="ThongTin">

        <form action="" method="post">
            <table class="displayRe">

                <?php
                if (isset($id) && $id != null) {
                    $i = 0;
                    while ($row = mysqli_fetch_array($id)) {
                        $_SESSION['idPhim'] = $row['id'];
                        $_SESSION['phongChieu'] = $row['phongChieu'];

                ?>

                        <!-- 1  -->
                        <tr>
                            <td colspan="2">
                                <img src="http://localhost//Bai_Tap_Lon_Web/upload_files/<?php echo $row['image'] ?>" alt="">
                            </td>
                        </tr>

                        <!-- 2 -->
                        <tr>
                            <td colspan="2">
                                <input   name='txtTen' class="ThongTin__titleSub dis" value='<?php echo $row["tenPhim"] ?> '> </input>
                            </td>
                        </tr>

                        <!-- id phim -->
                        <tr class="disble_tr">
                            <td>
                                <p class="ThongTin__title">id phim</p>
                            </td>

                            <td>
                                <input  type="text" value="<?php echo $row["id"] ?>" name="txtIdphim">
                            </td>
                        </tr>

                        <!-- 3  -->
                        <tr>
                            <td>
                                <p class="ThongTin__title">Rạp</p>
                            </td>

                            <td>
                                <input class="dis" type="text" value="CGV" name="txtRap">
                            </td>
                        </tr>

                        <!-- 4  -->
                        <tr>
                            <td>
                                <p class="ThongTin__title">Phòng </p>
                            </td>
                            <td>
                                <input class="dis" type="text" value="<?php echo $row["phongChieu"] ?>" name="txtPhong">
                            </td>
                        </tr>

                        <!-- 5  -->
                        <tr>
                            <td>
                                <p class="ThongTin__title">Suất chiếu </p>
                            </td>
                            <?php
                            if (isset($listSuatChieu) && $listSuatChieu != null) {

                                // echo "<pre>";
                                // print_r(mysqli_fetch_array($listSuatChieu));
                                // echo "</pre>";
                                while ($r = mysqli_fetch_array($listSuatChieu)) {
                                    if (isset($idSuatChieu)) {
                                        if ($idSuatChieu == $r['maLichChieu']) {
                                            $_SESSION['thoiGianBatDau'] = $r['thoiGianBatDau1'];
                                            $_SESSION['thoiGianKetThuc'] = $r['thoiGianKetThuc1'];
                            ?>
                                            <td>
                                                <!-- <input type="text" value=" <?php
                                                                                echo  $_SESSION['ngayHienTai'] . ' , ' . $r['thoiGianBatDau1'] . " - " . $r['thoiGianKetThuc1'];
                                                                                ?>" name="txtSuatChieu"> -->

                                                <textarea class="dis" type="text" value=" <?php
                                                                            echo $_SESSION['ngayHienTai'] . ' , ' . $r['thoiGianBatDau1'] . " - " . $r['thoiGianKetThuc1'];
                                                                            ?>" name="txtSuatChieu"><?php
                                                                            echo  $r['thoiGianBatDau1'] . " - " . $r['thoiGianKetThuc1'] . ' , ' . $_SESSION['ngayHienTai'] ;
                                                                            ?> </textarea>
                                            </td>
                                            <?php
                                            break;
                                            ?>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            <?php

                            } else {
                                $_SESSION['gioBatDau'] = $row['gioBatDau'];
                                $_SESSION['gioKetThuc'] = $row['gioKetThuc'];
                            ?>
                                <td>
                                    <input class="dis" type="text" value="<?php echo $_SESSION['ngayHienTai'] . ' , ' . $row['gioBatDau'] . " - " . $row['gioKetThuc'] ?>" name="txtSuatChieu">
                                </td>

                            <?php
                            }
                            ?>
                        </tr>

                        <!-- 6  -->
                        <tr>
                            <td>
                                <p class="ThongTin__title">Combo</p>
                            </td>
                            <td>
                                <input class="dis" type="text" value="<?php if (isset($_SESSION['comBo'])) echo $_SESSION["comBo"];
                                                            else echo "Không có" ?>" id="comBo" name="txtComBo">
                            </td>
                        </tr>

                        <!-- 7  -->
                        <tr>
                            <td>
                                <p class="ThongTin__title">Ghế</p>
                            </td>
                            <td>
                                <input class="dis" type="text" class="soGhe" id="soGhe" name="txtGhe" value="<?php if (isset($_SESSION["soGhe"])) echo $_SESSION["soGhe"];
                                                                                                    else echo "Trống" ?>">
                            </td>
                        </tr>

                        <!-- 8 -->
                        <tr>
                            <td>
                                <p class="ThongTin__title">Tổng</p>
                            </td>
                            <td>
                                <input class="dis" type="text" class="soGhe" id="ThongTin__price" class="ThongTin__price" name="txtTong" value="<?php if (isset($_SESSION["price"])) echo $_SESSION["price"];
                                                                                                                                        else echo "0" ?>">
                                <!-- <p> <span class="ThongTin__price"> 0 </span> VNĐ </p> -->

                            </td>

                        </tr>

                        <tr>
                            <?php
                            if (isset($pageChonGhe)) {
                                if ($pageChonGhe == "ChonGhe" && !isset($pageComBo)) {
                            ?>
                                    <td>
                                        <input id="submit_ChonGhe" class="submit" type="submit" name="btnTiepTuc" value="Tiếp tục">
                                    </td>
                                <?php
                                } else if ($pageComBo == "ComBo") {

                                ?>
                                    <td>
                                        <input class="submit" type="submit" name="btnQuayLai" value="Quay lại">
                                    </td>
                                    <td>
                                        <input class="submit" type="submit" name="btnTiepTucThanhToan" value="Tiếp tục">
                                    </td>


                                <?php
                                }
                            }
                            if (isset($page)) {
                                if ($page == "thanhToan") {
                                ?>
                                    <td>
                                        <input class="submit" id='btnQuayLaiThanhToan' type="submit" name="btnQuayLaiThanhToan" value="Quay lại">
                                    </td>
                            <?php
                                }
                            }
                            ?>
                        </tr>

                <?php

                    }
                }

                ?>
            </table>
        </form>
    </div>

</body>

</html>