<?php 

class Home extends controllers{
    protected $dv;
    protected $data;
    protected $datVe;
    protected $pageComBo;
    public function __construct() {
        $this -> data = [];
        $this -> datVe = $this -> models("DatVeMd");
    }
    function index(){

        $this -> getDataListDatVe();
        $this -> getDataListSanPham();
        $this -> getVeDaDatList();

        if(isset($_GET['NgayHienTai'])){
            $_SESSION['ngayHienTai'] = $_GET['NgayHienTai'];
        }
        $this -> data['content']['page'] = "";
        $this -> data['content']['pageChonGhe'] = "";

        if(isset($_GET['page'])){
            $this -> data['content']['page'] = $_GET['page'];
            $this -> data['page'] = $_GET['page'];
        } 
        if(isset($_GET['pageDatVe'])){
            $this -> data['content']['page'] = $_GET['pageDatVe'];
            if(isset($_GET['gia'])){
                $_SESSION['giaVe'] = $_GET['gia'];
            }
            if(isset($_GET['idPhim'])){
                $this -> getDataIItemDatVe($_GET['idPhim']);
                $this -> getSuatChieu($_GET['idPhim']);
            }
            if(isset($_GET['idSuatChieu'])){
                $this -> data['content']['idSuatChieu'] = $_GET['idSuatChieu'];
            }
        }
        if(isset($_GET['pageChonGhe'])){
           
            $this -> data['content']['pageChonGhe'] = $_GET['pageChonGhe'];
            $this -> tiepTuc();
        }
        if(isset($_POST['btnTiepTucThanhToan'])){
            // $this -> getData();
            $this -> data['content']['page']  = "ThanhToan";
            $this -> FormthanhToan();
        }
 
        //tim kiem phim
        if(isset($_POST['txtTimKiemPhim']))
        {
            $tenPhim = $_POST['txtPhim'];
            $this -> data['content']['data'] = $this -> datVe ->tim_kiem_phim($tenPhim);
        }
        $this -> view('masterLayout' , $this -> data);
    }

    public function getData(){
        $_SESSION["txtSuatChieu"] = ""; 
        $soGhe = $_POST['txtGhe'];
        $_SESSION["soGhe"] =  $soGhe;
        $gia = $_POST['txtTong'];
        $_SESSION["price"] =  $gia;
        $_SESSION["comBo"] = $_POST['txtComBo'];
    }
    public function tiepTuc(){
        $_SESSION["soLuong"] = "0";
        $_SESSION["soGhe"] = "Trống";
        $_SESSION["price"] = "0 Đ";
        $_SESSION["comBo"] = "không có";
        if(isset($_POST['btnTiepTuc'])){
            $this -> getData();
            if($_SESSION["soGhe"].trim("") == "Trống"){

            }
            else{
                $this -> data['content']['pageComBo'] = "ComBo";
            } 
        }
        if(isset($_POST['btnQuayLai'])){
            $this -> getData();
            $this -> data['content']['pageChonGhe'] = $_GET['pageChonGhe'];
        }

        if(isset($_POST['btnQuayLaiThanhToan'])){
            $this -> getData();
            $this -> data['content']['pageComBo'] = "ComBo";
        }

        $_SESSION['soDienThoai']= "";
        $_SESSION['tenKhachHang']= "";
        if(isset($_POST['btnThanhToan'])){
            
            $checkSdt = true;
            $checkTen = true;
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $ngayDat = date('Y-m-d H:i:s');
            $idPhim = $_POST['txtIdphim'];
            $tenPhim = $_POST['txtTen'];
            $tenRap = $_POST['txtRap'];
            $phong = $_POST['txtPhong'];
            $suatChieu = $_POST['txtSuatChieu'];
            $tongTien = $_POST['txtTong'];
            $sdt = "";
            if(isset($_POST['txtSdt'])){
                $sdt = $_POST['txtSdt'];
                $patternSdt = "/0[0-9]{9}$/";
                $_SESSION['soDienThoai'] = $_POST['txtSdt'];
                $checkSdt = preg_match($patternSdt , $sdt);
            }
               
            $khachHang = 'Khách vãng lai';
            if(isset($_POST['txtTenKh'])){
                $khachHang = $_POST['txtTenKh'];
                $patternSdt = "/[a-zA-z]$/";
                $checkTen = preg_match($patternSdt , $khachHang);
                $_SESSION['tenKhachHang'] = $_POST['txtTenKh'];
            }
            $ghiChu = $_POST['txtGhiChu'];
            $comBo =  $_POST['txtComBo'];
            $soGhe =  $_POST['txtGhe'];

            if(!$checkSdt){
                // echo  "<script> alert('Số điện thoại không hợp lệ')</script>";
                $this ->FormthanhToan();
            }
            else if(!$checkTen){
                // echo  "<script> alert('Tên không hợp lệ')</script>";
                $this -> FormthanhToan();
            }
            else{
                $check = $this -> datVe ->veDatDat_ins($khachHang , $ngayDat ,$tenPhim ,$tenRap ,$phong ,$suatChieu ,$tongTien ,$sdt ,$ghiChu , $comBo , $soGhe , $idPhim ,$_SESSION["idNhanVien"] , $_SESSION["tenNhanVienDn"]);
                // $this -> data['page']  = "ThanhCong";
                if($check){
                    $this -> data['page']  = "ThanhCong";
                }
            }
        }
    }

    public function FormthanhToan(){
        $this -> data['content']['page']  = "ThanhToan";
                if(isset($_GET['idPhim'])){
                    $this -> getDataIItemDatVe($_GET['idPhim']);
                }
                $this -> getData();
                $_SESSION["txtSuatChieu"] = $_POST['txtSuatChieu'];
    }
    public function getDataListDatVe(){
        $this -> data['content']['data'] = $this -> datVe -> dat_ve_list();
    }

    public function getDataListSanPham(){
        $this -> data['content']['listSanPham'] = $this -> datVe -> san_pham_list();
    }

    public function getDataIItemDatVe($id){
        $this -> data['content']['listPhim'] = $this -> datVe -> dat_ve_item($id);
    }

    public function getSuatChieu($id){
        
        $this -> data['content']['listSuatChieu'] = $this -> datVe -> get_suat_chieu($id);
    }

    public function getVeDaDatList(){
        $this -> data['content']['listVeDaDat'] = $this -> datVe -> veDaDat_list();
        $_SESSION['veDaDat_list'] = $this -> datVe -> veDaDat_list();
    }
  

    public function DangNhap(){
        if(isset($_GET['page'])){
            $this -> data['page'] = $_GET['page'];
            if( $this -> data['page'] == "DangNhap"){
                $this -> view('contents/DangNhap/DangNhap' );
            }
        } 
    }



}