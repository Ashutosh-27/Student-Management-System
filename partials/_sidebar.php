<?php

$isadmin = '';
if ($_SESSION['staffpost'] == 'admin') {
    $isadmin = 'inline-block';
} else {
    $isadmin = 'none';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- BoxIcons CDN -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="main.css"> -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            position: relative;
            min-height: 100vh;
            width: 100vw;
            /* overflow: hidden; */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 70px;
            background-color: #8a2be2;
            padding: 10px 15px;
            z-index: 1000;
            transition: 0.5s;
        }

        .sidebar.active {
            width: 240px;
            transition: 0.5s;
            
        }

        .sidebar .logo_content .logo {
            color: white;
            display: flex;
            height: 50px;
            width: 100px;
            align-items: center;
            opacity: 0;
            pointer-events: none;

        }

        .sidebar.active .logo_content .logo {
            opacity: 1;
            pointer-events: none;
            transition: 0.5s;
        }

        .sidebar .logo_content .logo i {
            font-size: 30px;
            margin-right: 5px;
        }

        .sidebar .logo_content .logo .logo_name {
            font-size: 30px;
            font-weight: 400;
        }

        .sidebar #btn {
            position: absolute;
            color: #fff;
            left: 90%;
            top: 6px;
            font-size: 35px;
            width: 50px;
            height: 50px;
            text-align: center;
            line-height: 50px;
            transform: translateX(-100%);
            transition: 0.2s;
        }

        .sidebar.active #btn {
            font-size: 25px;
            transition: 0.4s;
        }

        .sidebar ul {
            margin-top: 20px;
            padding: 0;

        }

        .sidebar ul li {
            position: relative;
            height: 50px;
            width: 100%;
            margin: 0 5px;
            list-style: none;
            line-height: 50px;
            margin-top: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.4s ease;
            border-radius: 10px;
        }

        .sidebar ul li a:hover {
            color: #000000;
            background-color: #fff;
        }

        .sidebar ul li a i {
            height: 50px;
            width: 50px;
            text-align: center;
            line-height: 50px;
            font-size: 25px;

        }

        .sidebar ul li a .links_name {
            display: none;
            font-size: 2px;
            transition: 0.2s;
        }

        .sidebar.active ul li a .links_name {
            display: inline-block;
            transition: 0.5s;
            font-size: 20px;
        }



        .sidebar ul li a input {
            position: absolute;
            height: 100%;
            width: 100%;
            border-radius: 10px;
            outline: none;
            top: 0;
            border: none;
            padding-left: 50px;
            font-size: 18px;
        }

        .sidebar ul li .bx-search {
            position: absolute;
            z-index: 99;
            color: #000000;
            font-size: 28px;
            top: 0px;
            font-weight: 700;
        }


        .sidebar ul li .tooltip {
            position: absolute;
            left: 50px;
            top: 0;
            transform: translateY(-50%);
            border-radius: 10px;
            height: 35px;
            width: 135px;
            background-color: #fff;
            line-height: 35px;
            text-align: center;
            box-shadow: 0 5px 10px #00000034;
            transition: 0.5s;
            opacity: 0;
            pointer-events: none;
            z-index: 99;
        }

        .sidebar.active ul li .tooltip {
            left: 120px;
        }

        .sidebar ul li:hover .tooltip {
            transition: all 0.5s ease;
            opacity: 1;
            top: 50%;
        }


        .sidebar .profile_content {
            position: absolute;
            color: #fff;
            bottom: 0;
            left: 0px;
            background-color: #4a038d;
            width: 100%;

        }

        .sidebar .profile_content .profile {
            position: relative;
            padding: 10px 6px;
            height: 60px;
            width: 100%;

        }

        .sidebar .profile_content .profile .profile_detail {
            display: flex;
            align-items: center;
        }

        .profile_content .profile .profile_details a {
            color: white;

        }

        .profile_content .profile .profile_details #log_out {
            display: inline-block;
            font-size: 25px;
            margin-left: 18px;
        }

        .profile_content .profile .profile_details .name_job {
            display: none;
            font-weight: 500;
            margin-left: 0px;
        }

        .sidebar.active .profile_content .profile .profile_details .name_job {
            display: inline-block;
        }


        .profile_content .profile b {
            position: absolute;
            /* left: 200px; */
            left: 50%;
            bottom: 5px;
            transform: translateX(-50%);
            min-width: 50px;
            line-height: 50px;
            font-size: 20px;
            display: none;
        }

        .sidebar.active .profile_content .profile b {
            display: inline-block;
        }


        .home_content {
            position: absolute;
            height: 100%;
            width: 100%;
            left: 70px;
            font-size: 25px;
            font-weight: 500;

        }

        .tect {
            padding-top: 20px;
            padding-left: 20px;
            height: 500px;
            background-color: #6e6d6d;
            color: #fff;
            z-index: 90;
        }

        .tect2 {
            padding-top: 20px;
            padding-left: 20px;
            height: 150vh;
            width: 100vw;
            background-color: #fff;
            color: #000000;
        }

        .tect3 {
            padding-top: 20px;
            padding-left: 20px;
            height: 500px;
            width: 100vw;
            background-color: #6e6d6d;
            color: #fff;
        }
    </style>

</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo" style="cursor: pointer;">
                <i class='bx bxl-unity'></i>
                <div class="logo_name">Unity</div>
            </div>
            <i class='bx bx-menu' style="cursor: pointer;" id="btn"></i>
        </div>
        <ul class="nav_list">

            <li>
                <a href="#todos">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Todos</span>
                </a>
                <span class="tooltip">Todos</span>
            </li>
            <li>
                <a href="#notices">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Notice</span>
                </a>
                <span class="tooltip">Notice</span>
            </li>
            <li>
                <a href="#subjectMaterials">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">SubjectMaterials</span>
                </a>
                <span class="tooltip">SubjectMaterials</span>
            </li>
            <li>
                <a href="#assignments">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="links_name">Assignments</span>
                </a>
                <span class="tooltip">Assignments</span>
            </li>

            <li>
                <a href="./teachertodos.php">
                <i class='bx bx-list-ul' ></i>
                    <span class="links_name">Todos</span>
                </a>
                <span class="tooltip">Todos</span>
            </li>

            <div <?php echo "style='display:$isadmin'"?>>
                <li>
                    <a href="#students">
                    <i class='bx bxs-user-badge'></i>
                    <span class="links_name">Students</span>
                    </a>
                    <span class="tooltip">Staff</span>
                </li>
                <li>
                    <a href="#staff">
                    <i class='bx bx-pyramid'></i>
                        <span class="links_name">Staff</span>
                    </a>
                    <span class="tooltip">Staff</span>
                </li>
            </div>

        </ul>

        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <a href="./logout.php">
                        <i class='bx bx-log-out' id="log_out"></i>
                        <b>Logout</b>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- <div class="home_content">
        <div class="tect">Home Content</div>
        <div class="tect2">Mid Content</div>
        <div class="tect3">Footer Content</div>
    </div> -->


    <script>
        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');
        let searchbtn = document.querySelector('.bx-search');
        let home = document.querySelector('.home_content')

        btn.onclick = function() {
            sidebar.classList.toggle('active')
            console.log('clicked')
            if (sidebar.classList.contains('active')) {
                console.log('Buu')
                home.style.left = '240px'
                home.style.transition = '0.5s'
            }
            if (!sidebar.classList.contains('active')) {
                console.log('Buu')
                home.style.left = '70px'
                home.style.transition = '0.5s'
            }
        }

        searchbtn.onclick = function() {
            sidebar.classList.toggle('active')
            if (sidebar.classList.contains('active')) {
                console.log('Buu')
                home.style.left = '240px'
                home.style.transition = '0.5s'
            }
            if (!sidebar.classList.contains('active')) {
                console.log('Buu')
                home.style.left = '70px'
                home.style.transition = '0.5s'
            }
        }
    </script>
</body>

</html>