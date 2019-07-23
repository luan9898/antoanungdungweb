<?php require_once('Connections/Myconnection.php'); ?>
<?php
$title = get_param('title');
$column = get_param('column');
$action = get_param('action');
//Thực hiện lệnh xoá nếu chọn xoá
if ($action=="del")
{
	$ma_nv = $_GET['catID'];
	$ma_column = $column . "id";
	$deleteSQL = "DELETE FROM tlb_nguoidung WHERE $ma_column='$ma_nv'";                     
	
	  mysqli_select_db($Myconnection,$database_Myconnection);
	  $Result1 = mysqli_query($Myconnection,$deleteSQL) or die(mysqli_error($Myconnection));
	
	  $deleteGoTo = "them_danh_muc.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  sprintf("Location: %s", $deleteGoTo);
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$them = get_param('3');if($them=="them"){$them=1;}else{$them=0;}
$sua = get_param('4');if($sua=="sua"){$sua=1;}else{$sua=0;}
$xoa = get_param('5');if($xoa=="them"){$xoa=1;}else{$xoa=0;}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tlb_nguoidung(id,ma_nhan_vien, mat_khau, rule_id) VALUES (NULL,'%s','%s','%s')",get_param('1'),md5(get_param('2')),get_param('3'));

  mysqli_select_db($Myconnection,$database_Myconnection);
  $Result1 = mysqli_query($Myconnection,$insertSQL) or die(mysqli_error($Myconnection));

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table width="800" border="0" cellspacing="1" cellpadding="0" align="center">
  <tr>
    <td class="row2" width="260" align="center" valign="top">
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="255" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="left ">Tên <?php echo $title?> :</td>
            <td><input type="text" name="1" value="" size="20" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap"  align="left ">Mật khẩu:</td>
            <td><input type="password" name="2" value="" size="20" /></td>
          </tr>
          <tr>
                  <td nowrap="nowrap" align="left">Vai trò :</td>
                            <td><select name='3'>
                                    <option value='0'>Admin</option>
                                    <option value='1'>User </option>
                            </td>
                        </tr>
            <td nowrap="nowrap" align="left ">&nbsp;</td>
            <td><input type="submit" value="Thêm mới" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
    <td class="row2" width="500" valign="top"><table width="500" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <th width="25">Stt</th>
        <th width="120">Mã Người dùng</th>
        <th width="150">Tên Người dùng</th>
        <th width="80">Role</th>
        <th width="35">&nbsp;</th>
        <th width="35">&nbsp;</th>
      </tr>
      <?php 
	  	//mysqli_select_db($database_Myconnection, $Myconnection);
		$query_RCDanhmuc_TM = "SELECT id,ma_nhan_vien,rule_id FROM tlb_nguoidung";
		$RCDanhmuc_TM = mysqli_query($Myconnection,$query_RCDanhmuc_TM) or die(mysqli_error($Myconnection));
		$row_RCDanhmuc_TM = mysqli_fetch_assoc($RCDanhmuc_TM);
    $totalRows_RCDanhmuc_TM = mysqli_num_rows($RCDanhmuc_TM);
    // print_r($row_RCDanhmuc_TM);
	  ?>
        <?php 
		$stt =1;
		while ($row = mysqli_fetch_row($RCDanhmuc_TM)) {?>
          <tr>
            <td class="row1"><?php echo $stt;?></td>
            <td class="row1"><?php echo $row[0]; ?></td>
            <td class="row1"><?php echo $row[1]; ?></td>
            <td class="row1"><?php echo ($row[2] == "0" ? "Admin" : "User") ?></td>
            <td class="row1"><a href="index.php?require=cap_nhat_nguoi_dung.php&table=tlb_nguoidung&catID=<?php echo $row[0]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=edit">Sửa</a></td>
            <td class="row1"><a href="index.php?require=them_nguoi_dung.php&table=tlb_nguoidung&catID=<?php echo $row[0]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=del">Xoá</a></td>
          </tr>
          <?php $stt = $stt + 1; ?>
          <?php }  ?>
    </table></td>
  </tr>
</table>
<p></p>
</html>
<?php
mysqli_free_result($RCDanhmuc_TM);
?>
