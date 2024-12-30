<?php

class VeDaDat extends controllers
{ 

    protected $veDaDat;
    protected $data;

    function __construct()
    {
        $this->data = [];
        $this->veDaDat = $this->models("veDaDatMd");
       
    }
 
    function index()
    {
        $this->data['content']['listVeDaDat'] = $this->veDaDat->veDaDat_list();
        $_SESSION['veDaDat_list'] = $this->veDaDat->veDaDat_list();
        $this->hienThi();
        if (isset($_POST['btnTimKiem'])) {
            $id = $_POST["txtMa"];
            $ten = $_POST["txtTen"];
            $this->data['content']['listVeDaDat'] = $this->veDaDat->veDaDat_search($id, $ten);
            $this->hienThi();
        }
        else{
            $this->data['content']['listVeDaDat'] = $this->veDaDat->veDaDat_list();
            $_SESSION['veDaDat_list'] = $this->veDaDat->veDaDat_list();
            $this->hienThi();
        }

        if (isset($_POST['btnLuuTraVe'])) {
            if (isset($_POST['txtIdVe'])) {
                $lyDo =  $_POST['txtLyDo'];
                $idVe = $_POST["txtIdVe"];
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $ngayHienTai = date('Y-m-d H:i:s');
                $check = $this->veDaDat->hoanTraVe($idVe, $ngayHienTai, "0", $lyDo);
                if ($check) {
                    $this->data['content']['listVeDaDat'] = $this->veDaDat->veDaDat_list();
                    $this->hienThi();
                    echo  "<script> confirm('Hoàn trả thành công !')</script>
                    
                    ";

                    echo "<script>
        window.location.href = 'http://localhost/Bai_Tap_Lon_Web/home/index/?page=VeDaDat'; 
        </script>";

                    
                } else {
                    echo  "<script> confirm('Hoàn trả Không thành công !')</script>";
                   
                }
           
            }

          
        }
       


    }

    public function hienThi()
    {
        
        if (isset($_GET['page'])) {
            $this->data['page'] = $_GET['page'];
        }
        $this->view('masterLayout', $this->data);
    }
}
