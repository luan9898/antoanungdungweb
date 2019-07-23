<?php
$ma_nv = $_GET['catID'];


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    $ht = $_POST['ho_ten'];
    $gt = $_POST['gioi_tinh'];
    $sdt = $_POST['dt_di_dong'];
    $em = $_POST['email'];
    $ns = $_POST['ngay_sinh'];
    $dc = $_POST['dia_chi'];
    $nv = $_POST['nghi_viec'];
    //bat dau cập nhật
    $updateSQL = sprintf("UPDATE tlb_nhanvien SET ho_ten='$ht', gioi_tinh='$gt', dt_di_dong='$sdt', email='$em', ngay_sinh='$ns', dia_chi='$dc',  nghi_viec='$nv' WHERE ma_nhan_vien='$ma_nv'");


    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $updateSQL) or die(mysqli_error($Myconnection));

    $updateGoTo = "danh_sach_nhan_vien.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
        $updateGoTo .= $_SERVER['QUERY_STRING'];
    }
    location($$updateGoTo);
}

mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCcapnhat_congviec = "SELECT * FROM tlb_congviec where ma_nhan_vien = '$ma_nv'";
$RCcapnhat_congviec = mysqli_query($Myconnection, $query_RCcapnhat_congviec) or die(mysqli_error());
$row_RCcapnhat_congviec = mysqli_fetch_assoc($RCcapnhat_congviec);
$totalRows_RCcapnhat_congviec = mysqli_num_rows($RCcapnhat_congviec);
$query_RCcapnhat_nhanvien = "SELECT * FROM tlb_nhanvien where ma_nhan_vien = '$ma_nv'";
$RCcapnhat_nhanvien = mysqli_query($Myconnection, $query_RCcapnhat_nhanvien) or die(mysqli_error());
$row_RCcapnhat_nhanvien = mysqli_fetch_assoc($RCcapnhat_nhanvien);
$totalRows_RCcapnhat_nhanvien = mysqli_num_rows($RCcapnhat_nhanvien);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     
</head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table class="row6" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            </tr>
        </table>
        <table class="row2" width="695" align="center" cellpadding="2" cellspacing="2" bgcolor="#66CCFF">
            <tr valign="baseline">
                <td width="115" align="left" nowrap="nowrap">Mã nhân viên:</td>
                <td width="318"><?php echo $row_RCcapnhat_congviec['ma_nhan_vien']; ?></td>
                <td align="left" nowrap="nowrap">Tình trạng:</td>
                <td width="100">
                    <?php
                    if ($row_RCcapnhat_nhanvien['nghi_viec'] == 0) {
                        ?>
                        <select disabled name="nghi_viec">
                            <option selected="selected" value="0">Chưa hoàn thành </option>
                            <option value="1">Đã hoàn thành </option>
                        </select>
                    <?php
                    } else {
                        ?>
                        <select disabled name="nghi_viec">
                            <option selected="selected" value="1">Đã hoàn thành </option>
                            <option value="0">Chưa hoàn thành </option>
                        </select>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left">Họ và tên:</td>
                <td><?php echo htmlentities($row_RCcapnhat_congviec['ho_ten'], ENT_COMPAT, 'utf-8'); ?></td>
                <td nowrap="nowrap" align="left">Giới tính:</td>
                <td><select name="gioi_tinh">
                        <option value="1" <?php if (!(strcmp(1, htmlentities($row_RCcapnhat_nhanvien['gioi_tinh'], ENT_COMPAT, 'utf-8')))) {
                                                echo "SELECTED";
                                            } ?>>Nam</option>
                        <option value="0" <?php if (!(strcmp(0, htmlentities($row_RCcapnhat_nhanvien['gioi_tinh'], ENT_COMPAT, 'utf-8')))) {
                                                echo "SELECTED";
                                            } ?>>Nữ</option>
                    </select></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left">Ngày bắt đầu :</td>
                <td><?php echo htmlentities($row_RCcapnhat_congviec['ngay_bat_dau'], ENT_COMPAT, 'utf-8'); ?></td>
                <td nowrap="nowrap">Ngày kết thúc: </td>
                <td><input type = "date" name="ngay_ket_thuc" value="<?php echo htmlentities($row_RCcapnhat_congviec['ngay_ket_thuc'], ENT_COMPAT, 'utf-8'); ?>" size="40" style="text-align:left;" /></td>
            </tr>

            <tr valign="baseline">
                <td nowrap="nowrap" align="left">Email:</td>
                <td><input type="email" name="email" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['email'], ENT_COMPAT, 'utf-8'); ?>" size="37" style="text-align:left;" /></td>

                <td nowrap="nowrap" align="left">Di động:</td>
                <td><input type="tel" name="dt_di_dong" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['dt_di_dong'], ENT_COMPAT, 'utf-8'); ?>" size="37" style="text-align:left;" /></td>
            </tr>

            <tr valign="baseline">
                <td nowrap="nowrap" align="left">Công việc id:</td>
                <td><?php if ($row_RCcapnhat_nhanvien['ma_nhan_vien'] == $row_RCcapnhat_congviec['ma_nhan_vien']) echo $row_RCcapnhat_congviec['cong_viec_id']; ?></td>
                <td nowrap="nowrap" align="left">Chức vụ id:</td>
                <td><?php if ($row_RCcapnhat_nhanvien['ma_nhan_vien'] == $row_RCcapnhat_congviec['ma_nhan_vien']) echo $row_RCcapnhat_congviec['chuc_vu_id']; ?></td>
            </tr>
            
            <tr valign="baseline">
                <td nowrap="nowrap" align="left">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr valign="baseline">
                <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value=":|: Cập nhật :|:" /></td>
            </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
        <input type="hidden" name="ma_nhan_vien" value="<?php echo $row_RCcapnhat_nhanvien['ma_nhan_vien']; ?>" />
    </form>
    <p>&nbsp;</p>
</body>

</html>
