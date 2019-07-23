<?php
require_once('include/function.php');
require_once('Connections/Myconnection.php');

$submit = get_param('submit');
if ($submit <> "") {
	//$ma_nhan_vien=get_param('ma_nhan_vien');
	$mat_khau = md5(get_param('mat_khau'));
	// Lọc dữ liệu chống tấn công SQL
	$ma_nhan_vien = mysqli_real_escape_string($Myconnection, get_param('ma_nhan_vien'));



	mysqli_select_db($Myconnection, $database_Myconnection);
	$query_RCNguoidung = "SELECT * FROM tlb_nguoidung WHERE ma_nhan_vien = '" . $ma_nhan_vien . "' AND mat_khau = '" . $mat_khau . "'";

	$RCNguoidung = mysqli_query($Myconnection, $query_RCNguoidung) or die(mysqli_error($Myconnection));
	$row_RCNguoidung = mysqli_fetch_assoc($RCNguoidung);
	$totalRows_RCNguoidung = mysqli_num_rows($RCNguoidung);
	$rule_id = $row_RCNguoidung['rule_id'];
	mysqli_free_result($RCNguoidung);
	//Nếu thông tin đăng nhập không đúng, số dòng dữ liệu truy vấn =0
	if ($totalRows_RCNguoidung == 0) {
		echo '<script language="javascript">alert("Vui lòng nhập lại !");</script>';
		location("dang_nhap.php");
	}
	//Nếu đăng nhập thành công sẽ phân quyền và lưu lại Session
	else {
		if ($rule_id == 0) // Admin
		{
			$_SESSION['logged-in'] = true;
			$_SESSION['ma_nhan_vien'] = $row_RCNguoidung['ma_nhan_vien'];
			$_SESSION['rule_id'] = "Admin";
			echo "Đăng nhập thành công";
			$url = "index.php";
			location($url);
			exit;
		}
		if ($rule_id == 1) // User
		{
			$_SESSION['logged-in'] = true;
			$_SESSION['ma_nhan_vien'] = $row_RCNguoidung['ma_nhan_vien'];
			$_SESSION['rule_id'] = "User";
			echo "Đăng nhập thành công";
			echo $_SESSION['id_nv'];
			$url = "user.php";
			location($url);
			exit;
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Quản lý nhân sự</title>

<body style="margin-top:100px;">
	<form action="dang_nhap.php" method="post" name="form1" id="form1">
		<div style="border:#F00 solid 1px; width:300px; margin:auto">
			<div style="background:#F00; color:#FFF; text-align:center; padding: 5px 0px 5px 0px"><strong>Đăng nhập hệ thống</strong></div>
			<table width="255" align="center">
				<tr valign="baseline">
					<td nowrap="nowrap" align="right">Tên đăng nhập:</td>
					<td><input type="text" name="ma_nhan_vien" value="" size="24" /></td>
				</tr>
				<tr valign="baseline">
					<td nowrap="nowrap" align="right">Mật khẩu:</td>
					<td><input type="password" name="mat_khau" value="" size="24" /></td>
				</tr>
				<tr valign="baseline">
					<td nowrap="nowrap" align="right">&nbsp;</td>
					<td><input name="submit" type="submit" value="Đăng nhập" /></td>
				</tr>
			</table>
		</div>
	</form>
</body>