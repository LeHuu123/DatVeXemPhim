<?php


$arr_sort = [];
$r['id'] = "";
$r['image'] = "";
$idSc = [];
$ngayBatDau = "";
$ngayKetThuc = "";
$chonNgay = "";
if (isset($listPhim) && $listPhim != null) {
    $i = 0;
    while ($row = mysqli_fetch_array($listPhim)) {
        if ($row['trangThai'] == 0) {
            $checkTrangThai = false;
        }
        $a =  ($row['gioBatDau']) . strftime("%H:%M");
        $a = explode(":", $a);
        $giobatdau = $a[0] . ":" . $a[1];
        $arr_sort += [$row["id"] => "$giobatdau"];
        $r['id'] = $row['id'];
        // $r['id'] = $row['id'];
        $r['image'] =  $row['image'];
        $ngayBatDau = $row['ngayBatDau'];
        $ngayKetThuc = $row['ngayKetThuc'];
    }
}

if (isset($listSuatChieu) && $listSuatChieu != null) {
    $i = 0;
    while ($row = mysqli_fetch_array($listSuatChieu)) {
        $a =  ($row['thoiGianBatDau1']) . strftime("%H:%M");
        $a = explode(":", $a);
        $giobatdau1 = $a[0] . ":" . $a[1];
        $arr_sort += [$row["maLichChieu"] => "$giobatdau1"];
    }
}

// asort($arr_sort);
// echo "<pre>";
// print_r($arr_sort);
// echo "</pre>";

$arr_veDaDat = $_SESSION['veDaDat_list'];
// echo "<pre>";
// print_r($arr_veDaDat);
// echo "</pre>";

// $arr_dem = [100000];
// if (isset($arr_veDaDat)) {
//     while ($row = mysqli_fetch_array($arr_veDaDat)) {
//         $ngayDat = explode(",", $row['suatChieu'])[0];
//         $format = 'G:i';
//         // echo $ngayDat;
//         $tmp = (trim((explode("-", explode(",", $row['suatChieu'])[1])[0])));
//         $arr_time = explode(":", $tmp);
//         $thoiGianDat = $arr_time[0] . ":" . $arr_time[1];
//         echo $thoiGianDat . " -  -"; 
//         foreach ($arr_sort as $key => $value) {
//             if($thoiGianDat == $value){
//                 echo $value . " - ";
//             }
//         }
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bai_Tap_Lon_Web/Public/css/styleSuatChieu.css">
    <title>Document</title>


</head>

<body>
    <div class="">
        <div class="suatChieu">
            <div class="booking__list2">
                <p class="booking__film"> DOREMON THE MOVIE: NOBITA'S SKY UPOPIA 2023 </p>

                <div class="booking__date">

                    <?php
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $ngayHienTai = date('Y-m-d');

                    $ar_date = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                    // $ngayBatDau = '2023-09-25';
                    // $ngayKetThuc = '2023-10-1';
                    $thuConlai = "";

                    for ($i = 0; $i < count($ar_date); $i++) {
                        if (date('l', strtotime($ngayHienTai)) == $ar_date[$i]) {
                            $thuConlai = (8 - ($i + 2)) + 1;
                        }
                    }

                    $i = 0;
                    while (($ngayBatDau) <= ($ngayKetThuc)) {
                        if ($ngayBatDau >= $ngayHienTai) {
                            $thu = date('l', strtotime($ngayBatDau));
                            $ngay = date('d', strtotime($ngayBatDau));
                            // echo $ngayBatDau;
                            if ($ngayBatDau == $ngayHienTai) {
                                $thu = "Today";
                            }
                            if ($i >= $thuConlai) {
                                break;
                            }
                            $i++;
                    ?>
                            <div check='1' class="booking__box" ngay='<?php echo  $ngayBatDau ?>'>

                                <div ngay='<?php echo  $ngayBatDau ?>' class="booking__day">
                                    <p style="color: white;" ngay='<?php echo  $ngayBatDau ?>'> <?php echo  $ngay ?> </p>
                                </div>

                                <div ngay='<?php echo  $ngayBatDau ?>' class="booking__rank">
                                    <p ngay='<?php echo  $ngayBatDau ?>'> <?php echo  $thu ?> </p>
                                </div>
                            </div>

                    <?php
                        }
                        $ngayBatDau = date('Y-m-d', strtotime($ngayBatDau . ' + 1 days'));
                    }

                    ?>

                </div>

                <div class="info_color">

                    <div class="info_item">
                        <div class="co white"></div>
                        <p>Còn ghế</p>
                    </div>

                    <div class="info_item">
                        <div class="co black"> </div>
                        <p>Quá giờ</p>
                    </div>

                    <div class="info_item">
                        <div class="co red"></div>
                        <p>Hết ghế</p>
                    </div>






                </div>



                <div class="booking__list3">

                    <img src="http://localhost/Bai_Tap_Lon_Web/upload_files/<?php echo $r['image'] ?>" class="booking__image" alt="">

                    <div class="booking__hourlist">

                        <!-- 2  -->
                        <?php
                        $id = "";
                        $dem = '';
                        foreach ($arr_sort as $key => $value) {

                            if (isset($arr_veDaDat)) {
                                while ($row = mysqli_fetch_array($arr_veDaDat)) {
                                    $ngayDat = $row['suatChieu'];
                                    $dem .= $ngayDat . " " . "," . $row['soGhe'] . "!";
                                }
                            }
                        ?>
                            <?php if ($key == $r['id']) {
                                // if (isset($arr_veDaDat)) {
                                //     while ($row = mysqli_fetch_array($arr_veDaDat)) {
                                //         $ngayDat = explode(",", $row['suatChieu'])[0];
                                //         $ngayDat = $row['suatChieu'];

                                //         // echo $ngayDat;

                                //         // // echo $ngayDat;
                                //         $tmp = (trim((explode("-", explode(",", $row['suatChieu'])[1])[0])));
                                //         $arr_time = explode(":", $tmp);
                                //         $thoiGianDat = $arr_time[0] . ":" . $arr_time[1];
                                //         if($thoiGianDat == $value){
                                //            $dem .= $ngayDat . " " . "," . $row['soGhe'] . "!";
                                //         }
                                //     }
                                // }
                                $id = $r['id'];
                            ?>
                                <div class="booking__hour">
                                    <a class="gio color_main" checkSoLuongGhe='<?php echo $dem ?>' checkPhim='0' id='<?php echo  $r['id'] ?>' checkGhe="1" checkHover="0" checkClick="1"> <?php echo $value ?> </a>
                                </div>
                            <?php
                            } else {

                            ?>
                                <div class="booking__hour">
                                    <a class="gio color_main" checkSoLuongGhe='<?php echo $dem ?>' id='<?php echo $r['id'] ?>' checkPhim='1' checkGhe="1" idSuatChieu='<?php echo $key ?>' checkHover="0" checkClick="1"> <?php echo $value ?> </a>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>

                </div>
            </div>

            <div class="quayLai">
                <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe" id="pageDatVe" target="_top"> Quay lại </a>
            </div>
        </div>
        <script type="module" src="http://localhost/Bai_Tap_Lon_Web/Public/Js/scriptSuatChieu.js"></script>

</body>

</html>