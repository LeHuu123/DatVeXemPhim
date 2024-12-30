<?php
//   session_start();
$_SESSION["idNhanVien"] = "";
$_SESSION["tenNhanVienDn"] = "";
$_SESSION["chucVu"] = "";
$conn = mysqli_connect('localhost:3367', 'root', '', 'bai_tap_lon') or die('Lỗi kết nối');
if (isset($_POST['btnDangNhap'])) {


    // Lấy thông tin đăng nhập từ form
    $tenDangNhap = $_POST['txtTenDangNhap'];
    $matKhau = $_POST['txtMatKhau'];

    // Truy vấn để kiểm tra thông tin đăng nhập
    $sql = " SELECT * FROM taiKhoan WHERE tenDangNhap = '$tenDangNhap' AND matKhau = '$matKhau' ";
    $sql1 = "SELECT * FROM nhanvien WHERE tenTaiKhoan = '$tenDangNhap' AND matKhau = '$matKhau' ";

    // $result = $conn->query($sql);
    $result1 = $conn->query($sql1);
    $result =  mysqli_query($conn, $sql);
   
    $check = true;

    // echo "<pre>";
    // print_r(mysqli_fetch_array($result));
    // echo "</pre>";
    // echo "asdsadsadasdsadsadsadsadsadasd";

    
    // Kiểm tra kết quả truy vấn
    if ($result->num_rows > 0) {

            $_SESSION["idNhanVien"] = -1;
            $_SESSION["tenNhanVienDn"] = "Admin";
            $_SESSION["chucVu"] = "Quản lý";
        // Đăng nhập thành công
        echo "<script>alert('Đăng nhập thành công!')</script>";
        header("Location: http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe");
        exit();
    } 
    // else {
    //     // Đăng nhập thất bại
    //     echo "<script>alert('Đăng nhập thất bại!')</script>";
    // }

   
     if ($result1->num_rows > 0) {

        while ($row = mysqli_fetch_array($result1)) {
            $_SESSION["idNhanVien"] = $row['idNhanVien'];
            $_SESSION["tenNhanVienDn"] = $row['tenNhanVien'];
            $_SESSION["chucVu"] = $row['chucVu'];
        }

        // Đăng nhập thành công
        echo "<script>alert('Đăng nhập thành công!')</script>";
        header("Location:http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe");
        exit();
    } else {
        // Đăng nhập thất bại
        echo "<script>alert('Đăng nhập thất bại!')</script>";
    }

   
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <title></title>

 
    <style>
        .body {
            /* background-image: url("https://toplist.vn/images/800px/-1060239.jpg"); */
            background-image: url("https://png.pngtree.com/background/20220714/original/pngtree-mountain-sunset-minimalist-landscape-scenery-wallpaper-full-hd-4k-8k-images-picture-image_1604211.jpg");

            /* background: url('../images/bg.jpeg'); */
            background-size: cover;

            /* background-position-y: -80px; */
            font-size: 16px;
        }

        #wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #form-login {
            max-width: 400px;
            border-radius: 5px;
            /* background: rgba(0, 0, 0, 0.8); */
            /* background-color: black; */
            /* opacity: 0.2; */
            flex-grow: 1;
            padding: 30px 30px 40px;
            box-shadow: 0px 0px 17px 2px rgba(255, 255, 255, 0.8);
        }

        .form-heading {
            font-size: 25px;
            color: #f5f5f5;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            border-bottom: 1px solid #fff;
            margin-top: 15px;
            margin-bottom: 20px;
            display: flex;
        }

        .form-group i {
            color: #fff;
            font-size: 14px;
            padding-top: 5px;
            padding-right: 10px;
        }

        .form-input {
            background: transparent;
            border: 0;
            outline: 0;
            color: #f5f5f5;
            flex-grow: 1;
        }

        .form-input::placeholder {
            color: #f5f5f5;
        }

        #eye i {
            padding-right: 0;
            cursor: pointer;
        }

        .form-submit {
            background: transparent;
            border: 1px solid #f5f5f5;
            color: #fff;
            width: 100%;
            text-transform: uppercase;
            padding: 6px 10px;
            transition: 0.25s ease-in-out;
            margin-top: 30px;
        }

        .form-submit:hover {
            border: 1px solid #54a0ff;
        }
    </style>

</head>

<body class="body">
    <div id="wrapper">
        <form method="POST" action="" id="form-login">
            <h1 class="form-heading">ĐĂNG NHẬP</h1>
            <div class="form-group">
                <i class="far fa-user"></i>
                <input type="text" class="form-input" placeholder="Tên đăng nhập" name="txtTenDangNhap">
            </div>
            <div class="form-group">
                <i class="fas fa-key"></i>
                <input type="password" id="password" class="form-input" placeholder="Mật khẩu" name="txtMatKhau">
                <div id="eye">
                    <i class="far fa-eye"></i>
                </div>
            </div>
            <input type="submit" value="Đăng nhập" class="form-submit" name="btnDangNhap">
        </form>
    </div>
 
</body>



<script>
    var ey = document.querySelector("#eye");
    var password = document.querySelector("#password");
    console.log(ey);
    var i = 0;
    ey.addEventListener("click", () => {
        if (i % 2 == 0) {
            password.setAttribute("type", "text");
        } else {
            password.setAttribute("type", "password");
        }
        i++;
    })
</script>


<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="js/app.js"></script>
    <script>
        $(Document).ready(function() {
            $('#eye').click(function() {
                $(this).toggleClass('open');
                $(this).children('i').toggleClass('fa-eye-slash fa-eye');
                if ($(this).hasClass('open')) {
                    $(this).prev().attr('type', 'password');
                } else {
                    $(this).prev().attr('type', 'text');
                }
            });

        });
    </script> -->

</html>