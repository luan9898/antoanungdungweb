<?php require_once('Connections/Myconnection.php'); ?>
<?php
$table = get_param('table');
$title = get_param('title');
$ma_nv = get_param('catID');
$column = get_param('column');
$ma_column = $column . "_id";
$ten_column = "ten_" . $column;
$action = get_param('action');

// print_r($ten_column);
//Thực hiện lệnh xoá nếu chọn xoá
if ($action == "del") {
    $ma_nv = $_GET['catID'];
    $ma_column = $column . "_id";
    $deleteSQL = "DELETE FROM $table WHERE $ma_column='$ma_nv'";


    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $deleteSQL) or die(mysqli_error($Myconnection));

    $deleteGoTo = "them_danh_muc.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    sprintf("Location: %s", $deleteGoTo);
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
    // $cong_viec_id     = isset($_POST['cong_viec_id ']) ? ($_POST['cong_viec_id ']) : '';
    $ten_cong_viec    = isset($_POST['ten_cong_viec']) ? ($_POST['ten_cong_viec']) : '';
    $mo_ta            = isset($_POST['mo_ta_cong_viec']) ? ($_POST['mo_ta_cong_viec']) : '';
    //-------------Update vào bảng chi tiet cong viec-------------
    $updateSQL = "UPDATE tbl_cong_viec_ct SET ten_cong_viec='" . $ten_cong_viec . "' , mo_ta_cong_viec='" . $mo_ta . "' WHERE cong_viec_id='".$ma_nv."'";
   
    
    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $updateSQL) or die(mysqli_error($Myconnection));
   
    $updateGoTo = "them_danh_muc.php";
    echo '<script language="javascript">alert("Cập nhật thành công");</script>';
    sprintf("Location: %s", $updateGoTo);
}
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCDanhmuc_DS = "SELECT * FROM tbl_cong_viec_ct ";
$RCDanhmuc_DS = mysqli_query($Myconnection, $query_RCDanhmuc_DS) or die(mysqli_error($Myconnection));
//print_r($RCDanhmuc_DS);
$row_RCDanhmuc_DS = mysqli_fetch_assoc($RCDanhmuc_DS);
$totalRows_RCDanhmuc_DS = mysqli_num_rows($RCDanhmuc_DS);
//print_r($row_RCDanhmuc_DS);
?>
<table width="800" border="0" cellspacing="1" cellpadding="0" align="center">
    <tr>
        <td class="row2" width="500" valign="top">
            <table width="500" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <th width="25">Stt</th>
                    <th width="100">Mã công việc</th>
                    <th width="210">Tên công việc</th>
                    <th width="210">Miêu tả công việc</th>
                    <th width="35">&nbsp;</th>
                    <th width="35">&nbsp;</th>
                </tr>
                <?php
                $stt = 1;
                do { ?>
                    <tr>
                        <td class="row1"><?php echo $stt; ?></td>
                        <td class="row1"><?php echo $row_RCDanhmuc_DS["cong_viec_id"]; ?></td>
                        <td class="row1"><?php echo $row_RCDanhmuc_DS["ten_cong_viec"]; ?></td>
                        <td class="row1"><?php echo $row_RCDanhmuc_DS["mo_ta_cong_viec"]; ?></td>
                        <td class="row1"><a href="index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCDanhmuc_DS[$ma_column]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>">Sửa</a></td>
                        <td class="row1"><a href="index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCDanhmuc_DS[$ma_column]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=del">Xoá</a></td>
                    </tr>
                    <?php $stt = $stt + 1; ?>
                <?php } while ($row_RCDanhmuc_DS = mysqli_fetch_assoc($RCDanhmuc_DS)); ?>
            </table>
        </td>
        <td class="row2" width="260" align="center" valign="top">
            <?php
            mysqli_select_db($Myconnection, $database_Myconnection);
            $query_RCDanhmuc_CN = "SELECT * FROM $table where $ma_column = '$ma_nv'";
            $RCDanhmuc_CN = mysqli_query($Myconnection, $query_RCDanhmuc_CN) or die(mysqli_error($Myconnection));
            $row_RCDanhmuc_CN = mysqli_fetch_assoc($RCDanhmuc_CN);
            $totalRows_RCDanhmuc_CN = mysqli_num_rows($RCDanhmuc_CN);
            ?>
            <form action="" method="post" name="form1" id="form1">
                <table width="260" align="center">
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="left">Mã công việc :</td>
                        <td><input type="text" name="cong_viec_id" value="<?php echo $row_RCDanhmuc_CN["cong_viec_id"]; ?>" readonly="readonly" size="24" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="left">Tên công việc :</td>
                        <td><input type="text" name="ten_cong_viec" value="<?php echo $row_RCDanhmuc_CN["ten_cong_viec"]; ?>" size="24" /></td>
                    </tr>
                    <tr valign="baseline">
                        <td nowrap="nowrap" align="left">Miêu tả công việc :</td>
                        <td><input type="text" name="mo_ta_cong_viec" value="<?php echo $row_RCDanhmuc_CN["mo_ta_cong_viec"]; ?>" size="24" /></td>
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
mysqli_free_result($RCDanhmuc_CN);
mysqli_free_result($RCDanhmuc_DS);
?>