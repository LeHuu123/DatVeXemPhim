<?php

//  echo "sadsadsaddddddddddddasssssssssssssssdsadasd " .$_SESSION["idNhanVien"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/Bai_Tap_Lon_Web/Public/css/styleSidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<style>
    .info{
        display: flex;
        /* flex-direction: column; */
        justify-content: center;
        padding-bottom: 10px;
        margin-bottom: 10px;
        border-bottom: 1px solid white ;
    }
    .imageSiba img{
        width: 80px;
        text-align: center;
        object-fit: cover;
        margin-bottom: 10px;
        border-radius: 50%;
    }
    .imageSiba{
        text-align: center;
    }
    .tenNhanVien{
        color: white;
        font-size: 20px;
    }
    .chucVu{
        color: white;
    }
    .display_sibar{
        visibility: hidden;
    }
</style>
<body>
    <div class="sidebar" id="sidebar">

        <div class="info">
            <div class="imageSiba">
                <img class="" src="https://vapa.vn/wp-content/uploads/2022/12/anh-dai-dien-dep-001.jpg" alt="">
            </div>
            <div class="info1">
                <p class="tenNhanVien"> <?php  if(isset( $_SESSION["tenNhanVienDn"])) echo  $_SESSION["tenNhanVienDn"]?> </p>
                <p class="chucVu"> <?php if(isset( $_SESSION["chucVu"])) echo   $_SESSION["chucVu"]?> </p>
            </div>
            
            
        </div>
        <div class="item_main">
            
            <div class="item " id="item_datVe">
                <div class="titleMain">
                    <h4 id='titleDatVe' class="title1"> Đặt vé </h4>
                    <i class="icon icon-01-ve fa-solid fa-angle-down"></i>
                    <i class="icon icon-02-ve icon-02 fa-solid fa-angle-up"></i>
                </div> 
                <div class="sidebar__list" id = "sidebar_datve">
                    <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe" id = "pageDatVe" target="_top"> Đặt vé </a>
                    <!-- <a href="http://localhost:81/Bai_Tap_Lon_Web/DatVe/index/?page=DatVe" id = "pageDatVe" target="_top"> Đặt vé </a> -->
                    <a href="http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=VeDaDat" > Vé đã đặt </a>
                    <a href="http://localhost/Bai_Tap_Lon_Web/VeDaDat/index/?page=HoaDonTra"> Hóa đơn trả </a>
                </div>
            </div>
        </div>

    
        <div class="item_main">
            <div class="item " id="item_phim">
                <div class="titleMain">
                    <h4 id='titlePhim' class="title1">Quản lý phim </h4>
                    <i class="icon icon-01-phim fa-solid fa-angle-down"></i>
                    <i class="icon icon-02-phim icon-02 fa-solid fa-angle-up"></i>
                </div>
                <div class="sidebar__list">
                    <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLyPhim"> Danh sách phim </a>
                    <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLySuatChieu"> Quản lý suất chiếu </a>
                </div>
            </div>
        </div>

        <div class="item_main">
            <div class="item " id="item_sanPham">
                <div class="titleMain">
                    <h4 id='titleSp' class="title1">Quản lý sản phẩm </h4>
                    <i class="icon icon-01-sp fa-solid fa-angle-down"></i>
                    <i class="icon icon-02-sp icon-02 fa-solid fa-angle-up"></i>
                </div>
                <div class="sidebar__list">
                    <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLySanPham"> Sản phẩm </a>
                </div>
            </div>
        </div>

         
        <div class="item_main">
            <div class="item " id="item_KhuyenMai">
                <div class="titleMain">
                     <h4 id='titleKm' class="title1">Quản lý Khuyến mãi </h4>
                    <i class="icon icon-01-km fa-solid fa-angle-down"></i>
                    <i class="icon icon-02-km icon-02 fa-solid fa-angle-up"></i>
                </div>
                <div class="sidebar__list">
                    <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=QuanLyKhuyenMai"> Khuyến mãi </a>
                </div>
            </div>
        </div>

        <div class="item_main">
            <div class="item " id="item_taiKhoan">
                <div class="titleMain">
                    <h4 id='titleTk' class="title1">Quản lý tài khoản </h4>
                    <i class="icon icon-01-tk fa-solid fa-angle-down"></i>
                    <i class="icon icon-02-tk icon-02 fa-solid fa-angle-up"></i>
                </div>
                <div class="sidebar__list">
                    <a class="<?php if($_SESSION["idNhanVien"] != "-1"){ echo "display_sibar" ;} ?> " href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachNhanVien"> Nhân viên </a>
                    <a href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DanhSachKhachHang"> Khách hàng </a>
                </div>
            </div>
        </div>
 
  
        <div class="item_DangNhap">
            <div class="item " id="item_taiKhoan">
                <div class="">
                    <a  href="http://localhost/Bai_Tap_Lon_Web/home/DangNhap/?page=DangNhap" class="dangXuat">Đăng xuất </a>
                </div>
               
            </div>
        </div>
        
    </div>

    <script  type="module" src="http://localhost/Bai_Tap_Lon_Web/Public/Js/scriptSidebar.js">   </script>
    <script  type="module" src="http://localhost/Bai_Tap_Lon_Web/Public/Js/base.js">   </script>





</body>

</html>