<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .DVThanhCong {
            display: flex;
            align-items: center;
            flex-direction: column;
            line-height: 48px;
            margin-top: 100px;
        }
        .DVThanhCong .button {
            width: 100px;
            text-align: center;
            padding: 0px 0 ;
            border-radius: 10px;
            background-color: aqua;
            font-size: 17px;
            color: black;
            text-decoration: none;
            display: inline-block;

        }

        .DVThanhCong .button:nth-child(1){
            margin-right: 15px;
        }


        .DVThanhCong i{
            padding: 20px 25px;
            font-size: 40px;
            color: white;
            background-color: green;
            border-radius: 50%;
        }
    </style>

    <div class="DVThanhCong">
        <i class="fa-solid fa-check"></i>
        <h2 class="DVThanhCong__title"> Đặt vé thành công </h2>
        <div class="DVThanhCong__flex">
            <a class="button" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe"> Đặt tiếp </a>
            <a class="button" href="http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe"> Xuẩt excel</a>
            <!-- <button class="button"> Xuẩt excel </button> -->
            <!-- <form action="">
                <input  type="submit" class="button" value="Xuất excel">
            </form> -->
        </div>
    </div>
    
</body>
</html>