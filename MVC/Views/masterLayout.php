<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
    <title>Document</title>
</head>

<body>

    <style>
        body {
            background-color: #f5f6fa !important;
            background: #f5f6fa;
        }

        .title_MAIN {
            /* position: sticky;
            z-index: 9999;
            top: 0; */
            background-color: #3A8FB5;
            margin: 0;
            padding: 10px 20px;
            margin-bottom: 50px;
            font-size: 22px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        * {
            font-family: 'Lora', serif;
        }

        .content {
            padding-left: 250px;
            /* padding-right: 30px;
            padding-top: 50px;  */
            /* margin-left: 300px; */
            /* margin-right: 30px; */
            /* margin-top: 50px; */

        }

        .rap_container {
            padding-left: 50px;
        }
    </style>

    <?php
    $this->view("block/sidebar");

    ?>
    <div class="content">
        <?php
        if (isset($page)) {

            // quan ly dat ve 
            if ($page == 'DatVe') {
                $this->view("contents/DatVe/DatVe", $content);
            } else if ($page == 'ThanhCong') {
                $this->view("contents/DatVe/DatVeThanhCong");
            }

            if ($page == 'VeDaDat') {
                $this->view("contents/VeDaDat/VeDaDat", $content);
            }

            if ($page == 'HoaDonTra') {
                $this->view("contents/HoaDonTra/HoaDonTra", $content);
            }
            // quan ly phim 
            if ($page == 'QuanLyPhim') {
                $this->view("contents/QuanLyPhim/index");
            }
            if ($page == 'QuanLySuatChieu') {
                $this->view("contents/QuanLySuatChieu/indexSuatChieu");
            }
            if ($page == 'ThemPhim') {
                $this->view("contents/QuanLyPhim/insert_phim");
            }
            if ($page == 'delete_phim') {
                $this->view("contents/QuanLyPhim/delete_phim");
            }
            if ($page == 'update_phim') {
                $this->view("contents/QuanLyPhim/update_phim");
            }

            // quan ly san pham
            if ($page == 'QuanLySanPham') {
                $this->view("contents/SanPham/DanhSachSanPham");
            }
            if ($page == 'Them_SanPham') {
                $this->view("contents/SanPham/ThemSanPham");
            }
            if ($page == 'Sua_SanPham') {
                $this->view("contents/SanPham/SuaSanPham");
            }
            if ($page == 'Xoa_SanPham') {
                $this->view("contents/SanPham/XoaSanPham");
            }

            // quan ly khuyen mai
            // chuong trinh khuyen ma
            if ($page == 'QuanLyKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/DanhSachChuongTrinhKhuyenMai");
            }
            if ($page == 'DanhSachDongKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/DanhSachDongKhuyenMai");
            }
            if ($page == 'ThemChuongTrinhKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/ThemChuongTrinhKhuyenMai");
            }
            if ($page == 'SuaChuongTrinhKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/SuaChuongTrinhKhuyenMai");
            }
            if ($page == 'XoaChuongTrinhKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/XoaChuongTrinhKhuyenMai");
            }

            // dong khuyen mai
            if ($page == 'ThemDongKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/ThemDongKhuyenMai");
            }
            if ($page == 'SuaDongKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/SuaDongKhuyenMai");
            }
            if ($page == 'XoaDongKhuyenMai') {
                $this->view("contents/QuanLyKhuyenMai/XoaDongKhuyenMai");
            }

            // quan ly tai khoan
            // nhan vien
            if ($page == 'DanhSachNhanVien') {
                $this->view("contents/NhanVien/DanhSachNhanVien");
            }
            if ($page == 'ThemNhanVien') {
                $this->view("contents/NhanVien/ThemNhanVien");
            }
            if ($page == 'SuaNhanVien') {
                $this->view("contents/NhanVien/SuaNhanVien");
            }
            if ($page == 'XoaNhanVien') {
                $this->view("contents/NhanVien/XoaNhanVien");
            }


            // khach hang
            if ($page == 'DanhSachKhachHang') {
                $this->view("contents/KhachHang/DanhSachKhachHang");
            }
            if ($page == 'ThemKhachHang') {
                $this->view("contents/KhachHang/ThemKhachHang");
            }
            if ($page == 'SuaKhachHang') {
                $this->view("contents/KhachHang/SuaKhachHang");
            }
            if ($page == 'XoaKhachHang') {
                $this->view("contents/KhachHang/XoaKhachHang");
            }
        }


        ?>
    </div>


    <!-- bootstrap  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->

</body>

</html>