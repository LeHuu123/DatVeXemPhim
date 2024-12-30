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

        .table td {
            white-space: nowrap;
        }

        .formVeDaDat {
            background-color: #DCDCDC;
            padding-top: 30px;
        }

        .container {
            background-color: transparent;
            border: 0 solid transparent;
        }

        .table .active {
            font-weight: 500;
            color: green;
        }

        .table {
            width: 100%;
            overflow: scroll;
        }



        .table .fa-solid {
            font-size: 20px;
        }

        .input-group-text {
            width: 100px;
        }

        .callTraVe {
            cursor: pointer;
        }

        .table_with {
            /* width: 100vw; */
            background-color: black;
        }

        /* scroll table  */

        #table-wrapper {
            /* position: relative; */
        }

        #table-scroll {
            overflow: auto;
            margin-top: 20px;
        }
        #table-wrapper table {
            width: 100%;

        }
        /* #table-wrapper table thead th  {
            position: absolute;
            top: -20px;
            z-index: 2;
            height: 20px;
            width: 35%;
            border: 1px solid red;
        } */
    </style>
</head>

<body>


    <h2 class="title_MAIN"> Vé đã đặt </h2>
    <div class="rap_container">
        <div class="SanPham">
            <form method="POST" action="" class="formVeDaDat">
                <!-- <h4 class="mb-3" style="text-align: center;">VÉ ĐÃ ĐẶT</h4> -->
                <div class="container">
                    <div class="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Mã vé</span>
                            </div>
                            <input type="text" class="form-control" id="txtMa" name="txtMa" value="" placeholder="Nhập mã vé ...">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tên </span>
                            </div>
                            <input type="text" class="form-control" id="txtTen" name="txtTen" value="" placeholder="Nhập tên phim , tên khách hàng , tên phòng ...">
                        </div>
                        <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto; text-align: center;" name="btnTimKiem">🔎Tìm kiếm</button>
                    </div>
                </div>
        </div>
        <div class="button-container">
            <button class="btn btn-primary" name="btnXuatExcel">📤Xuất excel</button>
        </div>

        <div id="table-wrapper">
            <div id="table-scroll">

                <table class="table table-striped">
                    <tr>
                        <th>Mã Vé</th>
                        <th>Khách Hàng</th>
                        <th>Ngày Đặt</th>
                        <th>Tên Phim</th>
                        <th>Tên rạp</th>
                        <th>Phòng</th>
                        <th>Suất chiếu</th>
                        <th>Số điện thoại</th>
                        <th>Com bo</th>
                        <th>Số ghế</th>
                        <th>Ghi chú</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                    </tr>
                    <?php
                    //B3: xử lý kết quả truy vấn: Hiển thị lên các dòng của bảng
                    if (isset($listVeDaDat) && $listVeDaDat != null) {

                        while ($row = mysqli_fetch_array($listVeDaDat)) {
                            if ($row['trangThai']) {
                    ?>
                                <tr idVe="<?php echo $row['maVe'] ?>" tenKh="<?php echo $row['khachHang'] ?>" soDienThoai="<?php echo $row['soDienThoai'] ?>" tenPhim="<?php echo $row['tenPhim'] ?>" suatChieu="<?php echo $row['suatChieu'] ?>" soGhe="<?php echo $row['soGhe'] ?>" comBo="<?php echo $row['comBo'] ?>" tongTien="<?php echo $row['tongTien'] ?>">
                                    <td class="td"><?php echo "MV" . sprintf("%03d", $row['maVe']); ?></td>
                                    <td><?php echo $row['khachHang'] ?></td>
                                    <td><?php echo $row['ngayDat'] ?> </td>
                                    <td><?php echo $row['tenPhim'] ?> </td>
                                    <td><?php echo $row['tenRap'] ?> </td>
                                    <td><?php echo $row['phong'] ?> </td>
                                    <td><?php echo $row['suatChieu'] ?> </td>
                                    <td><?php echo $row['soDienThoai'] ?> </td>
                                    <td><?php echo $row['comBo'] ?> </td>
                                    <td><?php echo $row['soGhe'] ?> </td>
                                    <td><?php echo $row['ghiChu'] ?> </td>
                                    <td><?php echo $row['tongTien'] ?> </td>

                                    <td class="active"> Đặt thành công </td>
                                    <td>
                                        <a style="color:red;margin-right:10px;text-decoration:none; font-weight:bold"><i class="callTraVe fa-solid fa-rotate-left"></i> </a>
                                    </td>

                                    <!-- <td class="noactive"> Đã trả vé </td>
                        <td>
                            <a style="color:red;margin-right:10px;text-decoration:none; font-weight:bold" href="http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=VeDaDat&idVeDaDat1=<?php echo $row['maVe'] ?>" onclick="return confirm('Bạn có muốn mua lại vé ?');"><i class="fa-solid fa-rotate-left"></i> </a>
                        </td> -->
                                <?php
                            }
                                ?>

                                </tr>
                        <?php
                        }
                    }
                        ?>
                </table>
            </div>
        </div>

        </form>
    </div>


    <style>
        .disble_tr {
            background-color: aqua;
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
        }

        .traVe {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            width: 100vw;
            height: 100vh;
            visibility: hidden;
        }

        .disble_traVe {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100vw;
            height: 100vh;
            visibility: visible;
        }



        .traVe p {
            margin: 0;
        }

        .disbleNone_traVe {
            display: none;
        }

        .disble_traVe {
            position: fixed;
            top: 0;
            z-index: 9999;
            width: 100vw;
            height: 100vh;
            visibility: visible;
        }

        .traVe .formtr {
            display: inline-block;
            position: relative;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
            border-radius: 8px;
            padding: 20px;
            padding-top: 36px;
        }

        .traVe_huy {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            display: inline-block;
            padding: 4px 9px;
            border-radius: 48%;
            background-color: aquamarine;
        }

        .traVe td {
            height: 50px;
            font-size: 16px;

        }


        .traVe input,
        textarea {

            border: 0;
            padding: 0;
            outline: none;
            color: black;
            background-color: white;
        }


        .traVe input:focus {
            border: 0;
        }

        .fomr_traVe {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .traVe .luu {
            margin-top: 20px;
            border-radius: 10px;
            padding: 4px 25px;
            background-color: aqua;
            cursor: pointer;
        }

        .title_traVe {
            text-align: center;
            font-size: 28px;
        }
    </style>




    <div class="traVe_main">
    </div>

    <div class="traVe">
        <div class="fomr_traVe">
            <form class="formtr" method="post" action="">
                <div class="traVe_huy">
                    <i class="fa-brands fa-x-twitter"></i>
                </div>
                <table class="postionRe">
                    <tr>
                        <h4 class="title_traVe">
                            Trả vé
                        </h4>
                    </tr>
                    <tr>
                        <td>
                            <p>Lý do trả hàng: </p>
                        </td>
                        <td>
                            <select name="txtLyDo">
                                <option value="Lý do khác"> Lý do khác </option>
                                <option value="Khách hàng muốn hủy vé"> Khách hàng muốn hủy vé </option>
                                <option value="Khách hàng đặt nhầm suất chiếu"> Khách hàng đặt nhầm suất chiếu </option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h5>
                                Thông tin vé
                            </h5>
                        </td>
                    </tr>

                    <tr class="disble_tr">
                        <td>
                            <p> id</p>
                        </td>
                        <td>
                            <input type="text" id="idVe" readonly name="txtIdVe" value="11">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p> Tên phim </p>
                        </td>
                        <td>
                            <input type="text" id="tenPhim" readonly name="txtPhim" value="kẻ hủy diệt">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p> Suất chiếu </p>
                        </td>

                        <td>
                            <textarea name="txtSuatChieu" readonly id="suatChieu" cols="30" rows="1">2022-02-02 , 15:32:00 - 15:32:00 </textarea>
                            <!-- <input class="wrap" type="text" disabled name="txtSuatChieu" value="2022-02-02 , 15:32:00 - 15:32:00"> -->
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>Số ghế </p>
                        </td>

                        <td>
                            <input id="soGhe" class="wrap" readonly type="text" name="txtSoGhe" value="F4 , A3 ,D4">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>ComBo</p>
                        </td>

                        <td>
                            <input id="comBo" type="text" readonly name="txtComBo" value="Nước">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Tổng tiền </p>
                        </td>

                        <td>
                            <input id="tongTien" type="text" readonly name="txtTongTien" value="99.000">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="luu" type="submit" name="btnLuuTraVe" value="Lưu">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>


    <script src="http://localhost/Bai_Tap_Lon_Web/Public/Js/scriptVeDaDat.js" type="module">
    </script>

</body>


</html>