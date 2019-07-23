<?php
require_once('include/function.php');
require_once('Connections/Myconnection.php');
$ma_nv = get_param('catID');
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        //$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($Myconnection,$theValue) : mysqli_escape_string($theValue);
        //  $theValue = mysqli_real_escape_string($Myconnection,$theValue);

        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf(
        "INSERT INTO tlb_congviec (ma_nhan_vien, ngay_bat_dau, ngay_ket_thuc, ho_ten, cong_viec_id, chuc_vu_id, bang_cap_id) VALUES (%s, %s, %s, %s, %s, %s, %s)",
        GetSQLValueString(get_param('ma_nhan_vien'), "text"),
        GetSQLValueString(get_param('ngay_bat_dau'), "date"),
        GetSQLValueString(get_param('ngay_ket_thuc'), "date"),
        GetSQLValueString(get_param('ho_ten'), "text"),
        GetSQLValueString(get_param('cong_viec_id'), "text"),
        GetSQLValueString(get_param('chuc_vu_id'), "text"),
        GetSQLValueString(get_param('bang_cap_id'), "text")
    );


    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $insertSQL) or die(mysqli_error($Myconnection));

    $insertGoTo = "danh_sach_nhan_vien.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    //thêm mới công việc xong, chuyển sang trang danh sách nhân viêc
    $url = "index.php";
    location($url);
}

mysqli_select_db($Myconnection, $database_Myconnection);

//Lấy mã nhân viên đưa vào để cập nhật
$query_RCThem_congviec = "SELECT * FROM tlb_nhanvien where ma_nhan_vien= '$ma_nv'";
$RCThem_congviec = mysqli_query($Myconnection, $query_RCThem_congviec) or die(mysqli_error($Myconnection));
$row_RCThem_congviec = mysqli_fetch_assoc($RCThem_congviec);
$totalRows_RCThem_congviec = mysqli_num_rows($RCThem_congviec);
//lay danh sach cong viec khi cap nhat
$query_RCctcongviec = "SELECT * FROM tbl_cong_viec_ct";
$RCctcongviec = mysqli_query($Myconnection, $query_RCctcongviec) or die(mysqli_error($Myconnection));
$row_RCctcongviec = mysqli_fetch_assoc($RCctcongviec);
$totalRows_RCctcongviec = mysqli_num_rows($RCctcongviec);
// danh sach chuc vu
$query_RCChucvu = "SELECT * FROM tlb_chucvu";
$RCChucvu = mysqli_query($Myconnection, $query_RCChucvu) or die(mysqli_error($Myconnection));
$row_RCChucvu = mysqli_fetch_assoc($RCChucvu);
$totalRows_RCChucvu = mysqli_num_rows($RCChucvu);

// lay danh sach bang cap
$query_RCBangcap = "SELECT * FROM tlb_bangcap";
$RCBangcap = mysqli_query($Myconnection, $query_RCBangcap) or die(mysqli_error($Myconnection));
$row_RCBangcap = mysqli_fetch_assoc($RCBangcap);
$totalRows_RCBangcap = mysqli_num_rows($RCBangcap);
// //lay danh sach ngoai ngu
// $query_RCNgoaingu = "SELECT * FROM tlb_ngoaingu";
// $RCNgoaingu = mysqli_query($Myconnection, $query_RCNgoaingu) or die(mysqli_error($Myconnection));
// $row_RCNgoaingu = mysqli_fetch_assoc($RCNgoaingu);
// $totalRows_RCNgoaingu = mysqli_num_rows($RCNgoaingu);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
    <style type="text/css">
      
        body,
        td,
        th {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }

        .left {
            padding-left: 120px;
        }
        
    </style>
</head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table class="row2" width="800" align="center" cellpadding="2" cellspacing="2">
            <tr valign="baseline">
                <td width="80" align="left" nowrap="nowrap" class="left">Mã nhân viên:</td>
                <td width="259"><input type="text" name="ma_nhan_vien" value="<?php echo $row_RCThem_congviec['ma_nhan_vien']; ?>" readonly="readonly" size="32" /></td>
                
            </tr>
            <tr valign="baseline">
                <td width="80" align="left" nowrap="nowrap" class="left">Họ và tên:</td>
                <td width="259"><input type="text" name="ho_ten" value="<?php echo $row_RCThem_congviec['ho_ten']; ?>" readonly="readonly" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left" class="left">Ngày bắt đầu *:</td>
                <td><input type="date" name="ngay_bat_dau" value="" size="25" /></td>
                
            </tr>
            <tr valign="baseline" >
                <td nowrap="nowrap" align="left" class="left">Ngày kết thúc:</td>
                <td><input type="date" name="ngay_ket_thuc" value="" size="25" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left" class="left">Chức vụ:</td>
                <td><select name="chuc_vu_id">
                        <?php
                        do {
                            ?>
                            <option value="<?php echo $row_RCChucvu['chuc_vu_id'] ?>"><?php echo $row_RCChucvu['ten_chuc_vu'] ?></option>
                        <?php
                        } while ($row_RCChucvu = mysqli_fetch_assoc($RCChucvu));
                        ?>
                    </select></td>
            </tr>
            <tr valign="baseline">
                
                <td nowrap="nowrap"align="left" class="left">Bằng cấp:</td>
                <td><select name="bang_cap_id">
                        <?php
                        do {
                            ?>
                            <option value="<?php echo $row_RCBangcap['bang_cap_id'] ?>"><?php echo $row_RCBangcap['ten_bang_cap'] ?></option>
                        <?php
                        } while ($row_RCBangcap = mysqli_fetch_assoc($RCBangcap));
                        ?>
                    </select></td>

            </tr>

            <tr valign="baseline">
                <td nowrap="nowrap" align="left" class="left">Công việc:</td>
                <td><select name="cong_viec_id">
                        <?php
                        do {
                            ?>
                            <option value="<?php echo $row_RCctcongviec['cong_viec_id'] ?>"><?php echo $row_RCctcongviec['ten_cong_viec'] ?></option>
                        <?php
                        } while ($row_RCctcongviec = mysqli_fetch_assoc($RCctcongviec));
                        ?>
                    </select></td>

            </tr>

            <tr valign="baseline">
                <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value="Thêm Mới" /></td>
            </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
</body>

</html>
<?php

?>