<?php
require_once('include/function.php');
// require_once('i');
require_once('Connections/Myconnection.php');
//kiểm tra session login đã được khởi tạo chưa
if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
    header('Location:../dang_nhap.php');
    exit;
}
$title = get_param('title');
$ma_nv = $_SESSION["ma_nhan_vien"];

if (isset($_POST['submit'])) {

    $ma_nhan_vien     = isset($_POST['ma_nhan_vien']) ? mysqli_escape_string($Myconnection, $_POST['ma_nhan_vien']) : '';
    $ho_ten           = isset($_POST['ho_ten']) ? ($_POST['ho_ten']) : '';
    $gioi_tinh        = isset($_POST['gioi_tinh']) ? ($_POST['gioi_tinh']) : '';
    $dt_di_dong       = isset($_POST['dt_di_dong']) ? ($_POST['dt_di_dong']) : '';
    $email            = isset($_POST['email']) ? ($_POST['email']) : '';
    $ngay_sinh        = isset($_POST['ngay_sinh']) ? ($_POST['ngay_sinh']) : '';
    $dia_chi          = isset($_POST['dia_chi']) ? ($_POST['dia_chi']) : '';
    $trang_thai       = isset($_POST['nghi_viec']) ? ($_POST['nghi_viec']) : '';
    //cập nhật data vào csdl
    $updateSQL = "UPDATE tlb_nhanvien SET ho_ten='" . $ho_ten . "' , gioi_tinh='" . $gioi_tinh . "', dt_di_dong='" . $dt_di_dong . "', email='" . $email . "', ngay_sinh='" . $ngay_sinh . "', dia_chi='" . $dia_chi . "', nghi_viec='".$trang_thai."' WHERE ma_nhan_vien='" . $ma_nv . "'";
    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $updateSQL) or die(mysqli_error($Myconnection));
    echo '<script language="javascript">alert("Cập nhật thành công");</script>';
}
//truy vấn lấy data từ bảng tlb_nhan_vien
mysqli_select_db($Myconnection, $database_Myconnection);

$query_RCcapnhat_nhanvien = "SELECT * FROM tlb_nhanvien where ma_nhan_vien = '$ma_nv'";
$RCcapnhat_nhanvien = mysqli_query($Myconnection, $query_RCcapnhat_nhanvien) or die(mysqli_error($Myconnection));
$row_RCcapnhat_nhanvien = mysqli_fetch_assoc($RCcapnhat_nhanvien);
$totalRows_RCcapnhat_nhanvien = mysqli_num_rows($RCcapnhat_nhanvien);
?>
<!-------------Form cập nhật thông tin cá nhân-------------------->

<form method="post" id="form1">
    <table class="row2" width="800" align="center" cellpadding="2" cellspacing="2" bgcolor="#c6edf7" style="padding-left: 200px;">
        <tr valign="baseline">
            <td width="100" align="left" nowrap="nowrap">Mã nhân viên:</td>
            <td width="318"><?php echo $row_RCcapnhat_nhanvien['ma_nhan_vien']; ?></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="left">Họ và tên:</td>
            <td><input type="text" name="ho_ten" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['ho_ten'], ENT_COMPAT, 'utf-8'); ?>" size="30" /></td>
        </tr>
        <tr>
            <td align="left">Ngày sinh:</td>
            <td><input type="date" name="ngay_sinh" value="<?php echo $row_RCcapnhat_nhanvien['ngay_sinh']; ?>" size="30" /></td>
        </tr>
        <tr valign="baseline">
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
            <td nowrap="nowrap" align="left">Di động:</td>
            <td><input type="text" name="dt_di_dong" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['dt_di_dong'], ENT_COMPAT, 'utf-8'); ?>" size="30" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="left">Email:</td>
            <td><input type="text" name="email" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['email'], ENT_COMPAT, 'utf-8'); ?>" size="30" /></td>
        </tr>
        <tr valign="baseline">
            <td nowrap="nowrap" align="left">Địa chỉ:</td>
            <td colspan="2"><input type="text" name="dia_chi" value="<?php echo htmlentities($row_RCcapnhat_nhanvien['dia_chi'], ENT_COMPAT, 'utf-8'); ?>" size="30" /></td>
        </tr>
        
        <tr valign="baseline">
            <td align="left" nowrap="nowrap">Tình trạng:</td>
            <td><select name="nghi_viec">
                    <option value="1" <?php if (!(strcmp(1, htmlentities($row_RCcapnhat_nhanvien['nghi_viec'], ENT_COMPAT, 'utf-8')))) {
                                            echo "SELECTED";
                                        } ?>>Đã hoàn thành</option>
                    <option value="0" <?php if (!(strcmp(0, htmlentities($row_RCcapnhat_nhanvien['nghi_viec'], ENT_COMPAT, 'utf-8')))) {
                                            echo "SELECTED";
                                        } ?>>Chưa hoàn thành</option>
                </select></td>
        
        </tr>
        <tr valign="baseline">
            <td colspan="4" align="left" nowrap="nowrap" style="padding-left: 170px; color: red;"><input type="submit" name="submit" value=" Cập nhật" style="background-color: mediumturquoise;font-size: 20px;padding-right: 10px;"/></td>
        </tr>
    </table>
</form>


<?php
//-----------giải phóng bộ nhớ trong PHP
mysqli_free_result($RCcapnhat_nhanvien);
?>