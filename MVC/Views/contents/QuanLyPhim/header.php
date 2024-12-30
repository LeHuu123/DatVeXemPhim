<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        body{
            margin:0;
        }
        .header {
            background-color: #614BC3;
        }

        .header .header-title img {
            width: 30%;
            padding: 30px;
        }
        .header-nav {
            text-transform: capitalize;
        }

        .header-nav ul {
            list-style: none;
            text-align: center;
            font-size: 20px;
            background-color: #512B81;
            height: 50px;
            line-height: 50px;
            color:#fff;
            margin:0;
        }

        .header-nav ul li {
            display: inline-block;
            width: 200px;
            height:30px;
        }

        .dashboard {
            float: left;
            width: 200px;
            background-color: #35155D;
            color:#fff;
            height: 100vh;
            font-size: 18px;
        }
        .dashboard ul {
            list-style: none;
            padding:0;
        }

        .dashboard ul li {
            width: 100%;
            height: 35px;
            padding: 10px 0;
            text-align: center;
            line-height: 35px;
            border-bottom:1px solid #ccc;
        }

    </style>
</head>

<body>

    <header class="header">
        <div class = "header-title">
            <img src="https://utt.edu.vn/publics/teacher/css/images/logo.png" alt="Logo-utt">
        </div>

        <nav class = "header-nav">
            <ul>
                <li>Trang chủ</li>
                <li>Đăng nhập</li>
                <li>Chức năng </li>
                <li>Thoát </li>
                <li>Liên hệ</li>
            </ul>
        </nav>

        <div class="dashboard">

            <ul>
                <li>Bài tập áp dụng 1</li>
                <li>Bài tập áp dụng 2</li>
                <li>Bài tập áp dụng 3</li>
                <li>Bài tập áp dụng 4</li>
            </ul>

        </div>
    </header>

</body>
</html>
