<?php

class VeDaDatMd  extends connectDB{
    protected $a;

    public function __construct()
    {
        $this -> a = new connectDB();
    }

    public function veDaDat_list(){
        $sql= "SELECT * FROM vedadat ";
        return mysqli_query($this -> a-> con,$sql);
    }



    public function veDaDat_search($id , $ten){
        $sql= "SELECT * FROM vedadat WHERE 1=1 ";
        if(trim($id , " ") != ""){
            $sql .= " AND `maVe` = '$id'";
        }
        if(trim($ten , " ") != ""){
            $sql .= " AND `khachHang` like '%$ten%' ||  `tenPhim` like '%$ten%' ||  `phong` like '%$ten%' ";
        }
        return mysqli_query($this -> a-> con,$sql);
    }

    public function traVe($id , $trangThai){
        $sql= "UPDATE `vedadat` SET `trangThai`='$trangThai' WHERE `maVe` = '$id'";
        return mysqli_query($this -> a-> con,$sql);
    }

    public function hoanTraVe($id , $ngay , $trangThai , $lyDo){
        $sql= "UPDATE `vedadat` SET `trangThai`='$trangThai', `ngayDat`='$ngay' , `lyDo`='$lyDo' WHERE `maVe` = '$id'";
        return mysqli_query($this -> a-> con,$sql);
    } 

  
}

?>