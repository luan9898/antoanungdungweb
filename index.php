<?php
require_once('include/function.php');
require_once('Connections/Myconnection.php');

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true || $_SESSION['rule_id'] != "Admin") {
    header('Location: dang_nhap.php');
    exit;
}
$title = get_param('title');
if ($title == "") $title = 'Danh sách công việc';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Quản lý công việc khoa ATTT</title>
    <link rel="stylesheet" type="text/css" href="js/superfish/css/superfish.css" media="screen">
    <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="js/superfish/js/hoverIntent.js"></script>
    <script type="text/javascript" src="js/superfish/js/superfish.js"></script>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        jQuery(function() {
            jQuery('ul.sf-menu').superfish();
        });
    </script>
</head>

<body>
    <div id="topbar">
        <div class="wrapper">
            <ul class="sf-menu">
                <li class="current">
                    <a href="#a">Hệ thống</a>
                    <ul>
                        <li><a href="index.php?require=them_nguoi_dung.php&title=Người dùng">Tạo người dùng</a></li>
                        <li><a href="dang_nhap.php">Đăng nhập</a></li>
                        <li class="current"><a href="dang_xuat.php">Đăng xuất</a></li>
                    </ul>
                </li>
                <li><a href="#">Chức năng</a>
                    <ul>
                        <li><a href="#">Nhân Viên</a>
                            <ul>
                                <li><a href="index.php?require=them_moi_nhan_vien.php&title=Thêm mới nhân viên">Thêm mới nhân viên</a></li>
                                <li><a href="index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên">Danh sách nhân viên</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Báo cáo</a></li>
                    </ul>
                </li>
                <li><a href="#">Quản lý</a>
                    <ul>
                        <li><a href="index.php?require=them_danh_muc.php&table=tbl_cong_viec_ct&title=Công việc&column=cong_viec&action=new">Công việc</a></li>
                        <li><a href="index.php?require=them_danh_muc.php&table=tlb_chucvu&title=Chức vụ&column=chuc_vu&action=new">Chức vụ</a></li>
                    </ul>
                </li>
                <li><a href="#">Công cụ</a>
                    <ul>
                        <li><a href="module/backup/backup.php?login=root&pass=vertrigo">Sao lưu</a></li>
                    </ul>
                </li>
            </ul>
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
                <td class="row4" width="170" valign="top">
                    <table width="100%" border="0" cellspacing="1" cellpadding="10">
                        <tr>
                            <td class="row3"><a nowrap="nowrap" href="index.php">Trang chủ</a></td>
                        </tr>
                        <tr>
                            <td class="row3"><a nowrap="nowrap" href="index.php?require=them_nguoi_dung.php&title=Người dùng">Tạo người dùng</a></td>
                        </tr>
                        <tr>
                            <td class="row3"><a nowrap="nowrap" href="index.php?require=them_moi_nhan_vien.php&title=Thêm mới nhân viên">Thêm mới nhân viên</a></td>
                        </tr>
                        <tr>
                            <td class="row3"><a nowrap="nowrap" href="index.php?require=them_danh_muc.php&table=tbl_cong_viec_ct&title=Công việc&column=cong_viec&action=new">Công việc</a></td>
                        </tr>
                        <tr>
                            <td class="row3"><a nowrap="nowrap" href="index.php?require=them_danh_muc.php&table=tlb_chucvu&title=Chức vụ&column=chuc_vu&action=new">Chức vụ</a></td>
                        </tr>

                    </table>
                </td>
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
                                    $require = "danh_sach_nhan_vien.php";
                                }
                                require_once $require; ?>
                            </td>
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
                        <td>CLC01. Hoang Quynh Anh-Hoang Dang Luan.</td>

                    </tr>
                </table>
            </td>
        </tr>
        </table>
    </div>
</body>

</html>
