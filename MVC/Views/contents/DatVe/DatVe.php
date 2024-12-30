<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bai_Tap_Lon_Web/Public/css/styleDatVe.css">
    <title>Dat ve</title>
</head>
 
<body>

    <h2 class="title_MAIN"> Đặt vé </h2>
    <div class="rap_container">
        <div class="booking">
            
            <div class="booking__list1">
                <div class="booking__item">
                    <div class="booking__number booking__numberOne">
                        <p> 1 </p>
                    </div>
                    <p class="booking__title"> Chọn phim </p>
                    <div class="booking__beforeOne booking__before"> </div>
                </div>
                <div class="booking__item">
                    <div class="booking__number booking__numberTwo">
                        <p> 2 </p>
                    </div>
                    <p class="booking__title"> Chọn xuất chiếu </p>
                    <div class="booking__beforeTwo booking__before"> </div>
                </div>
                <div class="booking__item">
                    <div class="booking__number booking__numberThree">
                        <p> 3 </p>
                    </div>
                    <p class="booking__title"> Chọn ghế </p>
                    <div class="booking__beforeThree booking__before"> </div>
                </div>
                <div class="booking__item">
                    <div class="booking__number booking__numberFour">
                        <p> 4 </p>
                    </div>
                    <p class="booking__title"> Thanh toán </p>
                </div>
            </div>


        </div>
 
    <?php
    if (isset($page)) {
        $dataGhe = [];
        $dataChonPhim = [];
        if (isset($data)) {
            $dataChonPhim["data"] = $data;
        }
        if (isset($listPhim)) {
            $dataChonPhim["listPhim"] = $listPhim;
        }
        if (isset($listSuatChieu)) {
            $dataChonPhim["listSuatChieu"] = $listSuatChieu;
        }

        if ($page == "chonSuatChieu") {
            $this->view("contents/DatVe/ChonSuatChieu", $dataChonPhim);
        } else if ($page == "DatVe") {
            $this->view("contents/DatVe/ChonPhim", $dataChonPhim);
        } else if ($page == "ChonGheMain") {
            $dataGhe['pageChonGhe'] = $pageChonGhe;
            if (isset($_GET['idSuatChieu'])) {
                $dataGhe['idSuatChieu'] = $idSuatChieu;
                // echo "sdadsadsadsadsad" . $idSuatChieu;
            }
            if (isset($pageComBo)) {
                $dataGhe['pageComBo'] = $pageComBo;
            }
            if (isset($listSanPham)) {
                $dataGhe['listSanPham'] = $listSanPham;
            }
            if (isset($listPhim)) {
                $dataGhe['listPhim'] = $listPhim;
            }
            if (isset($listSuatChieu)) {
                $dataGhe["listSuatChieu"] = $listSuatChieu;
            }
            if (isset($pageComBo)) {
                $dataGhe['pageComBo'] = $pageComBo;
            }
            $this->view("contents/DatVe/ChonGheMain", $dataGhe);
        } else if ($page == "ThanhToan") {
            if (isset($idSuatChieu)) {
                $dataGhe['idSuatChieu'] = $idSuatChieu;
            }
            if (isset($listPhim)) {
                $dataGhe['listPhim'] = $listPhim;
            }
            if (isset($listSuatChieu)) {
                $dataGhe["listSuatChieu"] = $listSuatChieu;
            }
            $this->view("contents/DatVe/ThanhToan", $dataGhe);
        }
    }

    ?>
    </div>



</body>

</html>