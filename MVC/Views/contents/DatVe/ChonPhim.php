<?php
echo "<pre>";
// print_r(mysqli_fetch_array($data));
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <style>
        .ChonPhim {
            /* margin-left: 300px; */
        }

        .ChonPhim .phim_list {
            margin-top: 80px;
            display: flex;
            /* justify-content: space-between; */
            flex-wrap: wrap;
        }

        .ChonPhim .phim_item {
            width: calc(100%/4 - 20px);
            margin-right: 20px;
        }

        .ChonPhim .phim_item .phim_title {
            margin: 0;
            padding: 20px 0;
        }

        .ChonPhim .phim_list img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .ChonPhim a {
            text-decoration: none;
            color: black;
        }

        .tenPhim,
        .kiemPhim {
            outline: none;
            width: 300px;
            padding: 5px;
        }

        .kiemPhim {
            margin-left: 20px;
            width: 90px;
        }
    </style>
    <div class="ChonPhim"> 
        <form  method="post">
            <table>
                <tr>
                    <td>
                        <input class="tenPhim" type="text" name="txtPhim" placeholder="Nhập tên phim...">
                    </td>
                    <td>
                        <!-- <a href="http://localhost:81/Bai_Tap_Lon_Web/home/index/?page=DatVe&tenPhim=">Tìm kiếm</a> -->
                        <input class="kiemPhim" type="submit" name="txtTimKiemPhim" value="Tìm kiếm">
                    </td>
                </tr>
            </table>
        </form>


        <div class="phim_list">

        <?php
            if (isset($data) && $data != null) {
                $i = 0;
                while ($row = mysqli_fetch_array($data)) {
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $ngayHienTai = date('Y-m-d');
                        if( $row['ngayKetThuc'] >= $ngayHienTai){
                        if($row['trangThai'] != 0){
                            
                            echo '
                                    <div class="phim_item">
                            ' . 
                            
                       '<a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe&pageDatVe=chonSuatChieu&idPhim='. $row['id'] . '&gia=' . $row['giaVe'] . '"> '
                            
                       .'<img src="http://localhost//Bai_Tap_Lon_Web/upload_files/' . $row['image'] .'"' . 'alt="">'
                        .' <h3 class="phim_title">'.
                        $row['tenPhim']  
                       . '
                       </h3>
                        </a>
                     </div>';
                        }
                    }
                }
            }
            ?>
           

        </div>
    </div>

    <script type="module" src="http://localhost/Bai_Tap_Lon_Web/Public/js/scripChonPhim.js">
        ;
    </script>
</body>

</html>