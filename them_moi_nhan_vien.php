<?php
error_reporting(E_ALL);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  
    $insertSQL = sprintf(
        "INSERT INTO tlb_nhanvien (ma_nhan_vien, ho_ten, gioi_tinh, dt_di_dong, email, ngay_sinh, dia_chi) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
        get_param('ma_nhan_vien'),
        get_param('ho_ten'),
        get_param('gioi_tinh'),
        get_param('dt_di_dong'),
        get_param('email'),
        get_param('ngay_sinh'),
        get_param('dia_chi'));



    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $insertSQL) or die(mysqli_error($Myconnection));
    $insertGoTo = "danh_sach_nhan_vien.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    //thêm mới thành công chuyển sang nhập công việc
    $ma_nv = get_param('ma_nhan_vien');
    if ($ma_nv <> "") {
        $url = "index.php?require=them_moi_cong_viec.php&catID=$ma_nv&title=Thêm mới công việc";
        location($url);
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>thêm mới nhân viên</title>
    <style type="text/css">
      
        body,
        td,
        th {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }

        .left {
            padding-left: 160px;
        }
        
    </style> 
</head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
    <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table class="row2" width="800" align="center" cellpadding="2" cellspacing="2" bgcolor="#66CCFF">
            <tr valign="baseline">
                <td width="127" align="left" nowrap="nowrap" class="left">Mã nhân viên *:</td>
                <td width="227"><input type="text" name="ma_nhan_vien" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left" class="left">Họ và tên *</td>
                <td><input type="text" name="ho_ten" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="left" class="left" >Ngày sinh:</td>
                <td><input type="date" name="ngay_sinh" value="" size="25" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left" class="left">Giới tính</td>
                <td><select name="gioi_tinh">
                        <option value="1" <?php if (!(strcmp(1, ""))) {
                                                echo "SELECTED";
                                            } ?>>Nam</option>
                        <option value="0" <?php if (!(strcmp(0, ""))) {
                                                echo "SELECTED";
                                            } ?>>Nữ</option>
                    </select></td>
                
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left" class="left">Điện thoại dd:</td>
                <td><input type="tel" name="dt_di_dong" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left"class="left">Email:</td>
                <td><input type="email" name="email" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left" class="left">Địa chỉ:</td>
                <td colspan="3"><input type="text" name="dia_chi" value="" size="32" /></td>
            </tr>
            
           
            <tr valign="baseline">
                <td nowrap="nowrap" align="left">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
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