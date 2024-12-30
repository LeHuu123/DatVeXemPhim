<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        .ThanhToan {
            /* margin-left: 300px; */
            margin-right: 100px;
        }

        .ThanhToan .ThanhToan__flex {
            display: flex;
            justify-content: space-between;
        }

        .ThanhToan__item td:nth-child(1) {
            width: 150px;
        }

        .ThanhToan__item td:nth-child(2) {
            width: 350px;
        }

        .ThanhToan__item input::placeholder,
        textarea::placeholder {
            padding-left: 3px;
        }

        .ThanhToan__item input,
        textarea,
        select {
            outline: none;
            border: 1px solid gray;
        }

        .ThanhToan__item td {
            height: 60px;
            padding: 10px;
        }

        .ThanhToan__item tr {
            display: block;
            margin-bottom: 30px;
        }

        .ThanhToan__item .khachHang,
        .phone,
        .name,
        .desc {
            border-radius: 5px;
            width: 100%;
            height: 100%;
        }

        .ThanhToan__item .submit {
            margin-top: 30px;
            padding: 8px 30px;
            background-color: aqua;
            border-radius: 5px;
            border: 0;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .ThanhToan__item .submit:hover {
            background-color: rgba(0, 255, 255, 0.455);

        }

        .ThanhToan .submit {
            margin-bottom: 20px;
            display: inline-block;
            padding: 5px 20px;
            background-color: aqua;
            border-radius: 5px;
            font-size: 17px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 20px;
            border: 0;
            ;
        }
        .ThanhToan .submit:hover {
            background-color: rgba(0, 255, 255, 0.455);
        }

        .mess {
            color: red;
            padding: 2px 10px;
            border-radius: 5px;
            margin: 0;
            font-size: 15px;
        }

        .parent_mess {
            position: absolute;
            top: 55px;
            left: 155px;
            width: 350px;
        }
    </style>
    <div class="ThanhToan">

        <form method="post" action="">
            <div class="ThanhToan__flex">

                <?php
                $data = [];
                $data['id'] = $listPhim;

                $data['page'] = "thanhToan";
                if (isset($idSuatChieu)) {
                    $data['listSuatChieu'] = $listSuatChieu;
                    $data['idSuatChieu'] = $idSuatChieu;
                }


                $this->view("contents/DatVe/ThongTinChonGhe", $data);
                ?>
                <div class="ThanhToan__item">
                    <table>
                        <tr class="thanhToan_itemChill">
                            <td>
                                <label for="khachHang">Loại khách </label>
                            </td>
                            <td>
                                <select name="khachHang" id="khachHang" class="khachHang">
                                    <option value="Khách bình thường"> Khách bình thường </option>
                                    <option value="Khách vãng lai">Khách vãng lai </option>
                                </select>
                            </td>
                        </tr>

                        <tr class="thanhToan_itemChill" style="position: relative;">
                            <td>
                                <label for="sdt">Số điện thoại</label>
                            </td>

                            <td class="parent">
                                <input type="text"  class="phone" value="<?php if(isset($_SESSION['soDienThoai'])) echo $_SESSION['soDienThoai']; ?>" name="txtSdt" id="sdt" placeholder="Nhập số điện thoại">

                                <?php
                                $checkSdt = true;
                                if (isset($_POST['txtSdt'])) {
                                    $sdt = $_POST['txtSdt'];
                                    $patternSdt = "/0[0-9]{9}$/";
                                    $checkSdt = preg_match($patternSdt, $sdt);
                                }
                                if (!$checkSdt) {
                                ?>
                                    <div class="parent_mess parent_mess1">
                                        <p class="mess">
                                            Nhập đúng định dạng số điện thoại(Chỉ có chữ số , gồm 10 chữ số và số 0 ở đầu tiên)
                                        </p>
                                    </div>

                                <?php
                                }
                                ?>
                            </td>
                            <td>

                            </td>

                        </tr>

                        <tr class="thanhToan_itemChill" style="position: relative;">
                            <td>
                                <label for="name">Tên khách hàng </label>
                            </td>
                            <td>
                                <input type="text"  class = 'name' value="<?php if(isset($_SESSION['tenKhachHang'])) echo $_SESSION['tenKhachHang']; ?>" class="name" name="txtTenKh" id="name" placeholder="Nhập tên khách hàng">
                                <?php
                                $checkTen = true;
                                if(isset($_POST['txtTenKh'])){
                                    $khachHang = $_POST['txtTenKh'];
                                    $patternSdt = "/[a-zA-z]$/";
                                    $checkTen = preg_match($patternSdt , $khachHang);
                                }
                                if (!$checkTen) {
                                ?>
                                    <div class="parent_mess parent_mess2">
                                        <p class="mess">
                                            Nhập đúng định dạng tên(tên chỉ có chữ in hoa , chữ in thường)
                                        </p>
                                    </div>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="ghiChu">Ghi chú</label>
                            </td>
                            <td>
                                <textarea name="txtGhiChu" class="desc" id="ghiChu" cols="30" rows="3" placeholder="Nhập ghi chú"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>Tạm tính: </p>
                            </td>
                            <td>
                                <p> <?php if (isset($_SESSION["price"])) echo $_SESSION["price"];
                                    else echo "0" ?> </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Thành tiền: </p>
                            </td>
                            <td>
                                 <p> <?php if (isset($_SESSION["price"])) echo $_SESSION["price"];
                                    else echo "0" ?> </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2">
                                <input class="submit" id = 'btnThanhToan' type="submit" name="btnThanhToan" value="Thanh toán">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


        </form>

    </div>

    <!-- <script>
        var ql = document.getElementById('btnThanhToan');
        ql.addEventListener("click" , () => {
            let phone = document.getElementsByClassName('phone');
            console.log(phone);
            phone.required = true;
            let name = document.getElementsByClassName('name');
            name.required = true;
            console.log(name);

        })
    </script> -->


    <form method="post">

    </form>



    <script type="module" src="http://localhost/Bai_Tap_Lon_Web/Public/Js/scriptThanhToan.js"> </script>
</body>

</html>