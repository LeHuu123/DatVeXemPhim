
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        .ComBo {
            /* margin-left: 300px; */
            width: 100%;
        }

        .ComBo__title {
            font-size: 22px;
            color: gray;
        }

        .ComBo__item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .ComBo img {
            width: 70px;
            border-radius: 10px;
            height: auto;
            object-fit: cover;
            margin-right: 20px;
        }

        .ComBo input {
            width: 50px;
        }

        .ComBo__combo {
            display: flex;
            align-items: center;
            width: 40%;
        }

        .ComBo__soLuong,
        .ComBo__donGia,
        .ComBo__tong {
            width: calc(60% / 3);
        }

        .ComBo__list .ComBo__item:nth-child(1) {
            margin-bottom: 30px;
            font-size: 17px;
            font-weight: 600;
        }
    </style>
    <div class="ComBo">
        <h3 class="ComBo__title">
            Chọn bắp / nước
        </h3>
        <div class="ComBo__list">
            <div class="ComBo__item">
                <div class="ComBo__combo">
                    <p> Combo </p>
                </div>
                <div class="ComBo__soLuong">
                    <p> Số lượng </p>
                </div>
                <div class="ComBo__donGia">
                    <p> Đơn giá(VNĐ) </p>
                </div>
                <div class="ComBo__tong">
                    <p> Tổng(VNĐ) </p>
                </div>
            </div>
 
            <?php
            if (isset($listSanPham) && $listSanPham != null) {
                // echo "<pre>";
                // print_r(mysqli_fetch_array($listSanPham));
                // echo "</pre>";
                while ($row = mysqli_fetch_array($listSanPham)) {
                   
            ?>
            
            <div class="ComBo__item" combo="<?php echo $row['tenSanPham'] ?> " donGia="<?php echo $row['giaTien'] ?>" tong="0">
                <div class="ComBo__combo">
                    <img src="http://localhost//Bai_Tap_Lon_Web/upload_files/<?php echo $row['image']?>" alt=" Đây là ảnh của <?php echo $row['tenSanPham'] ?> ">
                    <p class="ComBo__desc"> <?php echo $row['tenSanPham'] ?> </p>
                </div>
                <div class="ComBo__soLuong">
                    <input class="soLuong" type="number" value="0" name="txtSoLuong" min="0">
                </div>
                <div class="ComBo__donGia">
                    <p><?php echo $row['giaTien'] ?>đ</p>
                </div>
                <div class="ComBo__tong">
                    0đ
                </div>
            </div>

            <?php
                }
            }
            ?>

    
        </div>
    </div>


</body>

</html>