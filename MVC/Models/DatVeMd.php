<?php

class DatVeMd extends connectDB{
    protected $a; 
    public function __construct() {
        $this -> a = new connectDB();
    }

    public function dat_ve_list(){
        $sql= "SELECT * FROM phim ";

        return mysqli_query($this -> a-> con,$sql);
    }


    public function san_pham_list(){
        $sql= "SELECT * FROM sanpham ";
        return mysqli_query($this -> a-> con,$sql);
    }

    public function veDaDat_list(){
        $sql= "SELECT * FROM `vedadat` ";
        return mysqli_query($this -> a-> con,$sql);
    }
    public function dat_ve_item($id){
        $sql= "SELECT * FROM phim WHERE id = '$id' ";
        return mysqli_query($this -> a-> con,$sql);
    }

    public function tim_kiem_phim($ten){
        $sql= "SELECT * FROM phim WHERE `tenPhim` LIKE '%$ten%' ";
        return mysqli_query($this -> a-> con,$sql);
    }


    public function get_suat_chieu($id){
        $sql= "SELECT * FROM suatchieu WHERE maPhim = '$id' ";
        return mysqli_query($this -> a-> con,$sql);
    }

    public function veDatDat_ins($khachHang ,   $ngayDat ,  $tenPhim , $tenRap ,$phong , $suatChieu , $tongTien , $sdt , $ghiChu , $comBo , $soGhe , $id , $idnv , $tenNhanVien){
        $sql= "INSERT INTO `vedadat`(`khachHang`, `ngayDat`, `tenPhim`, `tenRap`, `phong`, `suatChieu`, `tongTien`, `soDienThoai`, `ghiChu` , `comBo` ,`soGhe` ,`trangThai` , `idPhim` , `idNhanVien`, `tenNhanVien`) 
        VALUES ('$khachHang','$ngayDat','$tenPhim','$tenRap','$phong','$suatChieu','$tongTien','$sdt','$ghiChu' , '$comBo' , '$soGhe', '1' , '$id' , '$idnv' , '$tenNhanVien')";
        return mysqli_query($this -> a-> con,$sql);
    }


   
}