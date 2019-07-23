<?php
//----------Kết nối CSDL
require_once('include/function.php');
require_once('Connections/Myconnection.php');
//----------Kiểm tra phiên làm việc của User
if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true || $_SESSION['rule_id'] != "User") {
    header('Location: dang_nhap.php');
    exit;
}
$title = get_param('title');
if ($title == "") $title = 'Danh sách công việc của bạn';
?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quản lý công việc khoa ATTT</title>
    <link rel="stylesheet" type="text/css" href="js/superfish/css/superfish.css" media="screen">
    <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="js/superfish/js/hoverIntent.js"></script>
    <script type="text/javascript" src="js/superfish/js/superfish.js"></script>
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/main1.css" rel="stylesheet" type="text/css" /> -->
    <link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="topbar">
        <div class="wrapper">
            <ul class="sf-menu">
                <li class="current">
                    <a href="#a">Hệ thống</a>
                    <ul>
                        
                        <li><a href="dang_nhap.php">Đăng nhập</a></li>
                        <li class="current"><a href="dang_xuat.php">Đăng xuất</a></li>
                    </ul>
                </li>
                
            </ul>
            <!-- <div class="topnav">

                <a href="">Welcome <?php echo $_SESSION['ma_nhan_vien'] . " | " . $_SESSION['rule_id']; ?></a>
                <a href="dang_xuat.php" style="float:right">Đăng xuất</a>
                <a href="user.php" style="float:right">Danh sách công việc</a>

            </div> -->

            <span class="hello"><strong>Welcome <?php echo  $_SESSION['ma_nhan_vien'] . " | " . $_SESSION['rule_id'] . ", " . Date("l F d, Y"); ?></strong></span>
        </div>
    </div>
    <div class="top_space"></div>
    <div class="wrapper">
        <table align="center" width="980" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2"><img width="978" src="images/bn.jpg" /></td>
            </tr>
            <tr>

                <td width="797" valign="top">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <div id="tieude2"><?php echo $title; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php
                                $require = get_param('require');
                                if ($require == "") {
                                    $require = "user/user_chi_tiet_cong_viec.php";
                                }
                                require_once $require;
                                ?>
                            </td>
                        </tr>
                        
                    </table>
                </td>
                <td class="row4" width="170" valign="top">
                    <table width="100%" border="0" cellspacing="1" cellpadding="10">
                    
                        <tr>
                            <td class="row3"><a href="user.php">Công việc</a></td>
                        </tr>
                      </tr> 
                        <tr>
                            <td class="row3"><a href="user.php?require=user/user_chi_tiet_thong_tin.php&title=Thông tin cá nhân">Thông tin</a></td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        </td>
        </tr>
        <tr>
            <td colspan="">
                <table class="footer" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                        <td>© 2019 Học viện kĩ thuật mật mã.</td>
                        <td>CLC01. Hoang Thi Quynh Anh - Hoang Dang Luan.</td>

                    </tr>
                </table>
            </td>
        </tr>
        </table>
    </div>


</body>

</html>