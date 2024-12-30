<?php
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
    or die('Lỗi kết nối');
$sql = "SELECT * FROM phim";

$data = mysqli_query($con, $sql);
?>

<!-- TIM KIEM -->
<?php
//B1: Tạo kết nối đến DB
$con = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon')
    or die('Lỗi kết nối');
//B2: Tạo và thực hiện truy vấn
$sql = "SELECT * FROM phim";

$data = mysqli_query($con, $sql);
$dx = '';
$hx = '';
if (isset($_POST['btnTimKiem'])) {
    $ten = $_POST['txtTen'];
    $id = $_POST['txtTen'];

    $sql1 = "SELECT * FROM phim WHERE tenPhim LIKE '%$ten%' OR id LIKE '%$id%' ";
    $data = mysqli_query($con, $sql1);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Hello, world!</title>
</head>

<body>

    <style>
        .index input {
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .index button {
            background-color: #0E76FF;
            border: none;
            border-radius: 4px;
            font-size: 20px;
            color: white;
        }

        .index .content__head {
            padding: 20px 0px;
            background-color: white;

        }

        .index .content_right {
            font-weight: bold
        }

        .Content .timphim {
            width: 60%;
            height: 45px
        }

        .index .content__justify {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
        }

        .index .content__date {
            width: 70%;
        }

        .index .content__start {
            width: 40%;
        }

        .index .content__end {
            width: 40%;
        }

        .index .content__table {
            width: 100%;
            margin-top: 20px;
           
        }

        .index .content__body {
            background-color: #ddd;

        }

        .index .content__title {
            margin: 0;
            padding: 20px 18px;
        }

        .index td,
        th {
            padding: 30px;
            text-align: center
        }

        .index td {
            background: white;
            margin-top: 1px;
            border: 1px solid #ddd;
            text-align: center
        }


        .index .td {
            color: green;
            font-weight: bold
        }

        .index .active {
            color: green
        }

        .index .noactive {
            color: red
        }

        .index .flexx {
            align-items: center;
            margin-right: 0px;
            margin-left: 0px;
            justify-content: space-between;
        }
    </style>

    <!-- <div class="content"> -->
    <?php
    //    $this -> view('contents/QuanLyPhim/header');
    ?>

    <h2 class="title_MAIN"> Quản lý phim </h2>
    <div class="rap_container">
        <div class="index">
            <div class="Content">
                <div class="row">
                    <div class="col-12">
                        <div class="content__head">
                            <div class="row">
                                <div class="col-9">
                                    <!-- <h4 class="content_right">Quản lý phim</h4> -->
                                </div>
                                <div class="col-3">
                                    <!-- <div class="content__infor">
                                <div class="row">
                                    <div class="col-6">
                                        <p>Hi, Hung</p>
                                    </div>
                                    <div class="col-6">
                                        <div class="content__icon">
                                            <p>hung le</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="content__body">
                            <h5 class="content__title"></h5>
                            <div class="row flexx">
                                <div class="col-8">
                             <form method="post" action="">
                                <input class="timphim" name="txtTen" placeholder="Nhập tên phim hoặc mã phim..." type="text">
                                <input style="height: 45px; background: #0E76FF; color: white" type="submit" value="Tìm kiếm" name="btnTimKiem">
                            </form>
                                </div>
                                <div class="col-4" style="text-align:right">
                                    <a name="txtThem" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=ThemPhim"><button style="width: 120px;height: 45px; border-radius: 8px " type="button"><i class="fa-regular fa-circle-user"></i>Thêm</button></a>
                                </div>

                            </div>
                            <table class="content__table">
                                <thead>
                                    <tr>
                                        <th>Mã Phim</th>
                                     
                                        <th>Tên Phim</th>
                                        <th>Thời Lượng</th>
                                        <th>Ngày Phát Hành</th>
                                        <th>Ngày Bắt Đầu</th>
                                        <th>Ngày Kết Thúc</th>
                                        <th>Trạng Thái</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <?php
                        //B3: xử lý kết quả truy vấn: Hiển thị lên các dòng của bảng
                        //coppy
                        if (isset($data) && $data != null) {
                            $i = 0;
                            while ($row = mysqli_fetch_array($data)) {
                                ?>
                                <tr>
                                    <td class="td"><?php echo "MOV" . sprintf("%03d", $row['id']); ?></td>
                                    <td ><?php echo $row['tenPhim'] ?></td>
                                    <td><?php echo $row['thoiLuong'] ?> phút</td>
                                    <td><?php echo date('d-m-Y', strtotime($row['ngayPhatHanh'])); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row['ngayBatDau'])); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row['ngayKetThuc'])); ?></td>
                                    <?php if ($row['trangThai']) { ?>
                                        <td style="font-weight:bold" class="active"> Đang hoạt động </td>
                                    <?php } else { ?>
                                        <td class="noactive"> Không hoạt động </td>
                                    <?php } ?>
                                   

                                    
                                            <td>
                                                <a style="color:red;margin-right:10px;text-decoration:none; font-weight:bold" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=delete_phim&id=<?php echo $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?');">Xóa </a>
                                                <a style="color:red;margin-right:10px;text-decoration:none; font-weight:bold" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=update_phim&id=<?php echo $row['id'] ?>">Sửa</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>