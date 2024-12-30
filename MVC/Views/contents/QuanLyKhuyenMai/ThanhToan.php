<?php
// Assuming you have a database connection established
$connection=mysqli_connect('localhost:3367','root','','Bai_Tap_Lon')
    or die('Lỗi kết nối');
// Retrieve the promotion codes that satisfy the given criteria
// $query = "SELECT dk.idKhuyenMai
//             FROM dongKhuyenMai dk
//             INNER JOIN thanhToan tt ON dk.ngayBatDau <= tt.ngay
//                                     AND dk.ngayKetThuc >= tt.ngay
//             WHERE (dk.soLuongToiThieu <= tt.soLuong AND dk.donGiaToiThieu <= tt.donGia)
//                OR (dk.soLuongToiThieu <= tt.soLuong AND dk.donGiaToiThieu >= tt.donGia)
//                OR (dk.soLuongToiThieu >= tt.soLuong AND dk.donGiaToiThieu <= tt.donGia)";
$query = "SELECT * FROM dongkhuyenmai";
$result = mysqli_query($connection, $query);


if (isset($_POST['submit'])) {
    $soLuong = $_POST['soLuong'];
    $donGia = $_POST['donGia'];
    $ngay = $_POST['ngay'];

    while ($row = mysqli_fetch_array($result)) {
        $ngayBatDau = $row["ngayBatDau"];
        $ngayKetThuc = $row["ngayKetThuc"];
        if($row["soLuongDungToiDa"] >0)
        {
            if($row["ngayBatDau"] <= $ngay && $row["ngayKetThuc"] >= $ngay)
            {
                //echo $row["ngayBatDau"]." - ".$row["ngayKetThuc"]."<br>";
                if($row["soLuongToiThieu"] <= $soLuong)
                {
                    echo $row["soLuongTang"]."-";
                }
            }
        }
    }
    
}
// if ($result) {
//     // Payment processing logic goes here
//     // ...

//     // Iterate through the retrieved promotion codes
//     $promotionCodes = [];
//     while ($row = mysqli_fetch_array($result)) {
//         $promotionCodes[] = $row['idKhuyenMai'];
//     }
// } else {
//     // Handle query error
//     // ...
// }

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment and Promotion Codes</title>
</head>
<body>
    <h1>Payment and Promotion Codes</h1>

    <form method="POST" action="">
        <label for="soLuong">Số lượng:</label>
        <input type="number" name="soLuong" id="soLuong" required><br>

        <label for="donGia">Đơn giá:</label>
        <input type="number" name="donGia" id="donGia" required><br>

        <label for="ngay">Ngày:</label>
        <input type="date" name="ngay" id="ngay" required><br>

        <button type="submit" name="submit">Process Payment</button>
    </form>

    <?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $soLuong = $_POST['soLuong'];
        $donGia = $_POST['donGia'];
        $ngay = $_POST['ngay'];

        // Display the retrieved promotion codes
        echo "<h2>Promotion Codes:</h2>";
        if (!empty($promotionCodes)) {
            echo "<ul>";
            foreach ($promotionCodes as $code) {
                echo "<li>$code</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No promotion codes found.</p>";
        }
    }
    ?>
</body>
</html>