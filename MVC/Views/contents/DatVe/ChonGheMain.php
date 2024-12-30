<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <style>
        .ChonGheMain__flex {
            margin-right: 100px;
            display: flex;
            justify-content: space-between;
            flex-direction: row-reverse;
            position: relative;
        }

        .quayLai {
            margin-top: 0;
        }

        .quayLai a {
            /* margin-top: -10px; */
            color: black;
        }
    </style>
    <div class="ChonGheMain">
        <div class="ChonGheMain__flex">
            <?php
            $idPhim = -1;
            $data = [];
            $data['id'] = $listPhim;

            if (isset($listSanPham)) {
                $data['listSanPham'] = $listSanPham;
            }

            $data['pageChonGhe'] = $pageChonGhe;
            if (isset($idSuatChieu)) {
                $data['idSuatChieu'] = $idSuatChieu;
                $data['listSuatChieu'] = $listSuatChieu;
            }

            if (isset($pageComBo)) {
                $data['pageComBo'] = $pageComBo;
            }

            $this->view("contents/DatVe/ThongTinChonGhe", $data);

            if ($pageChonGhe == "ChonGhe" && !isset($pageComBo)) {
                $this->view("contents/DatVe/ChonGhe");
            } else if ($pageComBo == "ComBo") {
                $this->view("contents/DatVe/ChonComBo", $data);
            }


            ?>

        </div>

        <?php
        if (!isset($pageComBo)) {
            // echo 'href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe&pageDatVe=chonSuatChieu&idPhim="' . $_SESSION["idPhim"];
            // echo ' <div class="quayLai"> 
            // <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe&pageDatVe=chonSuatChieu&idPhim=" ' . $_SESSION["idPhim"] . 'id="pageDatVe" target="_top"> Quay lại </a>
            // </div>
            // '
        ?>

            <div class="quayLai">
                <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe&pageDatVe=chonSuatChieu&idPhim=<?php echo  $_SESSION['idPhim']; ?>" id="pageDatVe" target="_top"> Quay lại </a>
            </div>

        <?php } ?>
    </div>
    <script src="http://localhost/Bai_Tap_Lon_Web/Public/Js/scriptChonGheMain.js" type="module"></script>
    <!-- <script src="http://localhost/Bai_Tap_Lon_Web/Public/Js/demSoGheDaDat.js" type="module"></script> -->

</body>

</html>