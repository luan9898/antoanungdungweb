<?php require_once('Connections/Myconnection.php'); ?>
<?php
$table = get_param('table');
$title = get_param('title');
$ma_nv = get_param('catID');
// $column = get_param('column');
// $ma_column = $column . "_id";
// $ten_column = "ten_" . $column;
 $action = get_param('action');

// print_r($ten_column);
//Thực hiện lệnh xoá nếu chọn xoá
if ($action == "del") {
    $ma_nv = $_GET['catID'];
    //$ma_column = $column . "_id";
    $deleteSQL = "DELETE FROM tlb_nguoidung WHERE id='$ma_nv'";


    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $deleteSQL) or die(mysqli_error($Myconnection));

    $deleteGoTo = "them_nguoi_dung.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    sprintf("Location: %s", $deleteGoTo);
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

    $ma_nhan_vien       = isset($_POST['ma_nhan_vien']) ? ($_POST['ma_nhan_vien']) : '';
    $rule_id            = isset($_POST['rule_id']) ? ($_POST['rule_id']) : '';
    //-------------Update vào bảng chi tiet cong viec-------------
    $updateSQL = "UPDATE tlb_nguoidung SET ma_nhan_vien='" . $ma_nhan_vien . "' , rule_id='" . $rule_id . "' WHERE id='".$ma_nv."'";
   
    
    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $updateSQL) or die(mysqli_error($Myconnection));
   
    $updateGoTo = "them_nguoi_dung.php";
    echo '<script language="javascript">alert("Cập nhật thành công");</script>';
    sprintf("Location: %s", $updateGoTo);
}
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCNguoidung_DS = "SELECT * FROM tlb_nguoidung ";
$RCNguoidung_DS = mysqli_query($Myconnection, $query_RCNguoidung_DS) or die(mysqli_error($Myconnection));
//print_r($RCNguoidung_DS);
$row_RCNguoidung_DS = mysqli_fetch_assoc($RCNguoidung_DS);
$totalRows_RCNguoidung_DS = mysqli_num_rows($RCNguoidung_DS);

?>
<table width="800" border="0" cellspacing="1" cellpadding="0" align="center">
    <tr>
        <td class="row2" width="500" valign="top">
            <table width="500" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <th width="25">Stt</th>
                    <th width="100">Tên người dùng</th>
                    <th width="210">Role</th>
                    <th width="35">&nbsp;</th>
                    <th width="35">&nbsp;</th>
                </tr>
                <?php
                $stt = 1;
                do { ?>
                    <tr>
                        <td class="row1"><?php echo $stt; ?></td>
                        <td class="row1"><?php echo $row_RCNguoidung_DS["ma_nhan_vien"]; ?></td>
                        <td class="row1"><?php echo $row_RCNguoidung_DS["rule_id"] ==0 ?"Admin":"User"; ?></td>
                        <td class="row1"><a href="index.php?require=cap_nhat_nguoi_dung.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCNguoidung_DS["id"]; ?>&title=<?php echo $title; ?>">Sửa</a></td>
                        <td class="row1"><a href="index.php?require=cap_nhat_nguoi_dung.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCNguoidung_DS["id"]; ?>&title=<?php echo $title; ?>&action=del">Xoá</a></td>
                    </tr>
                    <?php $stt = $stt + 1; ?>
                <?php } while ($row_RCNguoidung_DS = mysqli_fetch_assoc($RCNguoidung_DS)); ?>
            </table>
        </td>
        <td class="row2" width="260" align="center" valign="top">
            <?php
            mysqli_select_db($Myconnection, $database_Myconnection);
            $query_RCNguoidung_CN = "SELECT * FROM tlb_nguoidung where  id = '$ma_nv'";
            $RCNguoidung_CN = mysqli_query($Myconnection, $query_RCNguoidung_CN) or die(mysqli_error($Myconnection));
            $row_RCNguoidung_CN = mysqli_fetch_assoc($RCNguoidung_CN);
            $totalRows_RCNguoidung_CN = mysqli_num_rows($RCNguoidung_CN);
            ?>
            <form action="" method="post" name="form1" id="form1">
                <table width="260" align="center">
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="left">Tên người dùng :</td>
                        <td><input type="text" name="ma_nhan_vien" value="<?php echo $row_RCNguoidung_CN["ma_nhan_vien"]; ?>" readonly="readonly" size="24" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="left">Role :</td>
                        <td><input type="text" name="rule_id" value="<?php echo $row_RCNguoidung_CN["rule_id"]; ?>" size="24" /></td>
                    </tr>
                 
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="left">&nbsp;</td>
                        <td><input type="submit" value=":|: Cập nhật :|:" /></td>
                    </tr>
                </table>
                <input type="hidden" name="MM_update" value="form1" />
            </form>
        </td>
    </tr>
</table>
<?php
mysqli_free_result($RCNguoidung_CN);
mysqli_free_result($RCNguoidung_DS);
?>