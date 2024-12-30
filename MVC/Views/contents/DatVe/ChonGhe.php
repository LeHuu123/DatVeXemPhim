<?php

$arr_ghe = [];
$ghe = "";
$ngayHienTai = "";
$thoiGianBatDau = "";
$thoiGianKetThuc = "";
$phongChieu = "";
if (isset($_SESSION['ngayHienTai'])) {
    $ngayHienTai = $_SESSION['ngayHienTai'];
}

if ($_SESSION['thoiGianBatDau'] . trim("") != "") {
    $thoiGianBatDau =  $_SESSION['thoiGianBatDau'];
}
if ($_SESSION['thoiGianKetThuc'] . trim("") != "") {
    $thoiGianKetThuc =  $_SESSION['thoiGianKetThuc'];
}

if ($_SESSION['gioBatDau'] . trim("") != "") {
    $thoiGianBatDau =  $_SESSION['gioBatDau'];
}
if ($_SESSION['gioKetThuc'] . trim("") != "") {
    $thoiGianKetThuc =  $_SESSION['gioKetThuc'];
}
if ($_SESSION['phongChieu'] . trim("") != "") {
    $phongChieu =  $_SESSION['phongChieu'];
}
$arr_veDaDat = $_SESSION['veDaDat_list'];
// var_dump($ngayHienTai);

$arr_sc = [];
$suatChieu = "";
if (isset($arr_veDaDat) && $arr_veDaDat != null) {
    $i = 0;
    while ($row = mysqli_fetch_array($arr_veDaDat)) {

        if (strcmp(trim($phongChieu, " "), trim($row['phong'], " ")) == 0) {
            $arr_sc = explode(",", $row['suatChieu']);
            if (strcmp(trim($arr_sc[0], " "), trim($ngayHienTai, " ")) == 0) {
                $arr_gio = explode("-", $arr_sc[1]);
                if (
                    strcmp(trim($arr_gio[0], " "), trim($thoiGianBatDau, " ")) == 0 &&
                    strcmp(trim($arr_gio[1], " "), trim($thoiGianKetThuc, " ")) == 0
                ) {
                    $ghe .= " " .  ($row['soGhe']);
                }
               
            }
        }
    }
}
$arr_sc = explode(",",  $suatChieu);

// echo"";


// for($i = 0 ; $i < count($arr_sc) ; $i+=2){
//         echo $arr_sc[$i] . "<br>";
//         if()
// }

$str = str_replace("-", "", "$ghe");


// echo "ssssssssssssssss" .  $ngayHienTai . " - " . $thoiGianBatDau . " , " . $thoiGianKetThuc;
$arr_ghe = explode(" ", $str);





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
        .chonGhe {
            /* margin-left: 300px; */
            display: flex;
        }

        table {
            display: flex;
            justify-content: center;
        }

        .ghe__title {
            margin: 0;
            margin-bottom: 20px;
        }


        .chonGhe h2 {
            text-align: center;
        }

        .ghe__item,
        .ghe__number {
            display: flex;
            border: 1px solid black;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 40px;
            margin: 5px;
            cursor: pointer;
        }

        .ghe__kyTu {
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: context-menu;
            width: 100%;
            height: 100%; 
            color: gray;
        }

        .ghe__number {
            cursor: context-menu;
            color: gray;
            border: 0;
        }

        .ghe__item i {
            font-size: 15px;
            margin: 0 2px;
        }
    </style>
    <div class="chonGhe">
        <table>
            <tr>
                <td colspan="9">
                    <h2 class="ghe__title"> Màn Hình </h2>
                </td>
            </tr>
            <tr>
                <?php

                for ($i = 0; $i <= 9; $i++) {
                ?>
                    <td>
                        <div class=" ghe__number">
                            <?php
                            if ($i == 0)
                                echo "STT";
                            else echo $i;
                            ?>
                        </div>
                    </td>
                <?php
                }
                ?>
            </tr> 
            <!-- ghe 1 -->
            <?php
            for ($i = 0; $i < 8; $i++) {
                $char = 65 + $i;
            ?>
                <tr>
                    <?php

                    for ($j = 0; $j <= 9; $j++) {
                    ?>
                        <td>

                            <div class='ghe__item ' soGhe="<?php echo chr($char) . $j ?>" <?php
                                                                                            for ($k = 0; $k < count($arr_ghe); $k++) {
                                                                                                $so = chr($char) . $j;
                                                                                                if (strcmp($so . trim(""), $arr_ghe[$k] . trim("")) == 0) {
                                                                                                    echo 'daDat = "1" ';
                                                                                                }
                                                                                            }
                                                                                            ?> check="1" price="<?php if (isset($_SESSION['giaVe'])) {
                                                                                                                    echo $_SESSION['giaVe'];
                                                                                                                } ?>" number=<?php echo $j ?> char="<?php echo chr($char) ?>">
                                <?php
                                if ($j == 0)
                                    echo '<div class = "ghe__kyTu">' . chr($char) . '</div>';
                                else
                                    echo '<i class="fa-solid fa-couch "></i>';
                                ?>
                            </div>
                        </td>
                    <?php
                    }

                    ?>
                </tr>
            <?php
            }
            ?>


        </table>


    </div>





    <!-- <script  type="module" src="http://localhost:81/Bai_Tap_Lon_Web/Public/Js/scriptChonGhe.js">   </script> -->

</body>

</html>