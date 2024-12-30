


<!-- gfdgdjgudgdfgurhgreghihghroghreothgiorwytwhtuo4rwtogu -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phim</title>
    <style>
        /* CSS cho bảng phim */
        .qlphongchieu table {
            width: 100%;
            border-collapse: collapse;
        }

        .qlphongchieu table, th, td {
            border: 1px solid #ccc;
        }

        .qlphongchieu  th, td {
            padding: 8px;
            text-align: center;
        }

        .qlphongchieu  th {
            background-color: #f2f2f2;
        }

        /* CSS cho chọn phim */
        .qlphongchieu  select {
            padding: 5px;
        }

        /* CSS cho thông tin phim */
        .movie-info {
            /* margin-top: 20px; */
           
            padding: 10px;
        }

        /* CSS cho hình ảnh phim */
        /* .movie-image {
            max-width: 300px;
            max-height: 300px;
        } */

        /* CSS cho danh sách các ngày chiếu */
        .date-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        /* CSS cho mỗi ngày chiếu */
        .date-item {
            width: 24%;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            
            text-align:center;
            margin-right: 10px;
            box-sizing: border-box;
            border-radius: 5px;
            /* border-radius: 7px 7px 0px 0px */
            background-color: #f2f2f29e

        }
        .date-item strong{
            background-color: #1099F6;
            width:100%;
            display: inline-block;
            height:50px;
            text-align: center;
            display: flex;
    align-items: center;
    justify-content: center;
    color: white;
   
        }
        .qlphongchieu p{
            font-size: 30px
        }
        .thoi-gian-chieu{
            position: absolute;
        }
        .cha{
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            background:#1099F6
        }
        .image{
            height:400px;
            width: 50%;
            padding: 0px 50px;
            
           
        }
        .image img{
            width: 70%;
         
    height: 90%;
    padding: 27px;
    border-radius: 70px
        }
        .information{
            flex: 1;
            /* text-align: center */
            padding: 30px;
            color:white;
            background: #ff000052;
          
        }
        .xemtt{
            background: #1099F6;
            border: 1px;
            padding: 3px;
            border-radius: 3px;
            color: white;
            font-size: 15px
        }
        .xemtt:hover{
            color:#1099F6;
            background: black;
            cursor:pointer
        }
        /* .btnxoa{
            background-color:#1099F6;
            border:1px;
            font-size: 15px;
            color:white; border-radius: 5px; 
            margin-left: 20px


        } */
        .dsphim {
    height: 2px;
    display: inline-block;
    background-color: #ddd;
    width: 100%;
    flex: 1;
}
.two__title {
    text-align: center;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
    </style>
</head>
<body>
<h2 class="title_MAIN"> Quản Lý Lịch Chiếu </h2>
    <div class="rap_container">
    <div class="qlphongchieu">
        <!-- <div class="two__title"> <b class="dsphim"></b><h1 style="text-align:center; font-size: 60px">Quản Lý Lịch Chiếu</h1><b class="dsphim"></b></div> -->
   

    <!-- Form chọn phim -->
    <form method="post">
        <label for="movie-select">Chọn phim:</label>
        <select name="movie_id" id="movie-select">
            <option value="">Chọn phim</option>
            <?php
            // Kết nối đến cơ sở dữ liệu
            $conn = mysqli_connect('localhost', 'root', '', 'bai_tap_lon');

            // Kiểm tra kết nối
            if (!$conn) {
                die("Lỗi kết nối: " . mysqli_connect_error());
            }

            // Truy vấn SQL để lấy danh sách phim
            $sql = "SELECT id, tenPhim FROM phim";
            $result = mysqli_query($conn, $sql);

            // Kiểm tra có dữ liệu không
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $tenPhim = $row['tenPhim'];
                    echo "<option value='$id'>$tenPhim</option>";
                }
            }
            ?>
        </select>
        <input class="xemtt" type="submit" name="submit" value="Xem thông tin">
    </form>

    <!-- Hiển thị thông tin phim -->
    <div class="movie-info">
    <?php
    if (isset($_POST['submit'])) {
        $movieId = $_POST['movie_id'];

        // Truy vấn SQL để lấy thông tin phim
        $sql = "SELECT * FROM phim WHERE id = $movieId";
        $result = mysqli_query($conn, $sql);

        $sql1 = "SELECT suatchieu.thoiGianBatDau1,suatchieu.thoiGianKetThuc1 FROM suatchieu WHERE $movieId = suatchieu.maPhim";
        $result1 = mysqli_query($conn, $sql1);

        $arr = [];
        $i =0;
        while($r = mysqli_fetch_array($result1)){
           
            $arr[$i] = $r[0];
            $i++;
            $arr[$i] = $r[1];
            $i++;
        }
        if (mysqli_num_rows($result) > 0  ) {
          
           
            $row = mysqli_fetch_assoc($result);
            
            $row1 = mysqli_fetch_assoc($result1);
            $tenPhim = $row['tenPhim'];
            $anhPhim = $row['image'];
            $thoiLuong = $row['thoiLuong'];
            $ngayPhatHanh = date('d/m/Y', strtotime($row['ngayPhatHanh']));
            $ngayBatDau = date('d/m/Y', strtotime($row['ngayBatDau']));
            $ngayKetThuc = date('d/m/Y', strtotime($row['ngayKetThuc']));
            $gioBatDau = date('H:i', strtotime($row['gioBatDau']));
            $gioKetThuc = date('H:i', strtotime($row['gioKetThuc']));
            
            $phongChieu = $row['phongChieu'];
            $hoatDong = $row['trangThai']; // Thêm trường hoạt động vào bảng phim

            // Kiểm tra xem phim có hoạt động hay không
            if ($hoatDong == 0) {
                echo "<p class='error-message'>Phim chưa hoạt động!</p>";
            } else {
                // Hiển thị thông tin phim

                echo "<h2 style='text-align:center; font-size: 40px; '>Thông tin phim: $tenPhim</h2>";

                $hienThi =  '<div class = "cha">'
                . '<div class="image">' . "<img src='http://localhost//Bai_Tap_Lon_Web/upload_files/$anhPhim' alt='$tenPhim' class='movie-image'>  </div> "

                . '<div class = "information" >' . " <p>Thời lượng: $thoiLuong phút </p>  
<p> Ngày phát hành: $ngayPhatHanh</p> <p>Ngày bắt đầu: $ngayBatDau</p> <p>Ngày kết thúc: $ngayKetThuc</p> <p>Phòng chiếu: $phongChieu </p></div> </div>";
            // echo "<img src='../qlphongchieu/$anhPhim' alt='$tenPhim' class='movie-image'>";
            // echo "<p>Thời lượng: $thoiLuong phút</p>";
            // echo "<p>Ngày phát hành: $ngayPhatHanh</p>";
            // echo "<p>Ngày bắt đầu: $ngayBatDau</p>";
            // echo "<p>Ngày kết thúc: $ngayKetThuc</p>";
            echo $hienThi;

               
               

                // Hiển thị danh sách các ngày chiếu
               
                echo "<h3>Danh sách các ngày chiếu:</h3>";
                    echo "<div class='date-list'>";
                    $ngayBatDau = strtotime($row['ngayBatDau']);
                    $ngayKetThuc = strtotime($row['ngayKetThuc']);
                    if( mysqli_num_rows($result1) > 0 ){

                    }

                    while ($ngayBatDau <= $ngayKetThuc) {
                       
                        $ngayChieu = date('d/m/Y', $ngayBatDau);
                        $ngayThu = date('l', $ngayBatDau); // Lấy thứ
                        if ($ngayThu == "Sunday") {
                            $ngayThu = "Chủ Nhật";
                        } elseif ($ngayThu == "Monday") {
                            $ngayThu = "Thứ Hai";
                        } elseif ($ngayThu == "Tuesday") {
                            $ngayThu = "Thứ Ba";
                        } elseif ($ngayThu == "Wednesday") {
                            $ngayThu = "Thứ Tư";
                        } elseif ($ngayThu == "Thursday") {
                            $ngayThu = "Thứ Năm";
                        } elseif ($ngayThu == "Friday") {
                            $ngayThu = "Thứ Sáu";
                        } elseif ($ngayThu == "Saturday") {
                            $ngayThu = "Thứ Bảy";
                        }
                        echo "<div class='date-item'>";
                        echo "<strong> ($ngayThu): $ngayChieu</strong><br>";
                       
                        for ($i = 0; $i < count($arr); $i += 2) {
                            $gioBatDau1 = date('H:i', strtotime($arr[$i]));
                            $gioKetThuc1 = date('H:i', strtotime($arr[$i+1]));
                            $uniqueId = "showtime-$i"; // Tạo một ID duy nhất cho mỗi cặp thời gian chiếu và nút xoá
                            echo "<div id='$uniqueId'>";
                            echo "<span style='font-weight:bold;display: inline-block; margin-bottom: 10px'>Thời gian chiếu: $gioBatDau1 - $gioKetThuc1</span>";
                            echo "<button class='btnxoa' style='background-color:#1099F6; border:1px; font-size: 15px; color:white; border-radius: 5px; margin-left: 20px' onclick='hideShowtime(\"$uniqueId\")'>xoá</button><br>";
                            echo "</div>";
                        }

                        echo "<div style='font-weight:bold; margin-bottom: 10px'>Phòng chiếu: $phongChieu</div>";
                        echo "</div>";
                        $ngayBatDau += 86400; // Thêm một ngày (86400 giây) cho ngày chiếu tiếp theo
                    }
                    echo "</div>";
                }
            }
        }
        
        ?>
        </div>

        <!-- Form thêm thời gian chiếu -->
        
            
        <h2>Thêm thời gian chiếu</h2>
        <form method="post">
            <input type="hidden" name="movie_id" value="<?php echo $movieId; ?>">
            <label for="start-time">Thời gian bắt đầu:</label>
            <input type="time" name="start_time" id="start-time" required>
            <label for="end-time">Thời gian kết thúc:</label>
            <input type="time" name="end_time" id="end-time" required>
            <input class="xemtt" type="submit" name="add_showtime" value="Thêm thời gian chiếu">
        </form>
          
        <!-- Hiển thị danh sách thời gian chiếu -->
    <?php
    // Xử lý thêm thời gian chiếu
    
    if (isset($_POST['add_showtime'])) {
        $movieId = $_POST['movie_id'];
        $startTime = $_POST['start_time'];
        $endTime = $_POST['end_time'];

        // Chuyển đổi thời gian từ chuỗi sang định dạng thời gian
        $startTime = date('H:i:s', strtotime($startTime));
        $endTime = date('H:i:s', strtotime($endTime));

        // Kiểm tra xem thời gian chiếu đã tồn tại cho phim này chưa
        $checkSql = "SELECT * FROM suatchieu WHERE maPhim = $movieId AND (('$startTime' BETWEEN thoiGianBatDau1 AND thoiGianKetThuc1) OR ('$endTime' BETWEEN thoiGianBatDau1 AND thoiGianKetThuc1))";
        $resultCheck = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<p class='error-message'>Thời gian chiếu đã tồn tại hoặc trùng lịch với suất chiếu khác!</p>";
        } else {
            // Thêm thời gian chiếu vào cơ sở dữ liệu
            $insertSql = "INSERT INTO suatchieu (maPhim, thoiGianBatDau1, thoiGianKetThuc1) 
                          VALUES ('$movieId', '$startTime', '$endTime')";
            
            if (mysqli_query($conn, $insertSql)) {
                echo "<p class='success-message'>Thêm thời gian chiếu thành công!</p>";
            } else {
                echo "<p class 'error-message'>Lỗi: " . mysqli_error($conn) . "</p>";
            }
        }
    }


    // Đóng kết nối
    mysqli_close($conn);
    ?>
    </div>
        <script>
            // JavaScript function để ẩn thời gian chiếu và nút xoá
            function hideShowtime(uniqueId) {
                var showtimeItem = document.getElementById(uniqueId);
                showtimeItem.style.display = 'none'; // Ẩn cặp thẻ div chứa thời gian chiếu và nút xoá
            }
        </script>
    </div>
    </div>
</body>
</html>
