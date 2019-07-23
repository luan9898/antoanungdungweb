<?php
$action = get_param('action');
//---------Thực hiện lệnh xoá nếu chọn xoá---------
if ($action == "del") {

    $ma_nv = $_GET['catID'];
    $deleteSQL1 = "DELETE FROM tlb_nhanvien WHERE ma_nhan_vien='" . $ma_nv . "'";
    $deleteSQL2 = "DELETE FROM tlb_nguoidung WHERE ma_nhan_vien='" . $ma_nv . "'";
    $deleteSQL3 = "DELETE FROM tlb_congviec WHERE ma_nhan_vien='" . $ma_nv . "'";
    mysqli_select_db($Myconnection, $database_Myconnection);
    $Result1 = mysqli_query($Myconnection, $deleteSQL1) or die(mysqli_error($Myconnection));
    $Result2 = mysqli_query($Myconnection, $deleteSQL2) or die(mysqli_error($Myconnection));
    $Result3 = mysqli_query($Myconnection, $deleteSQL3) or die(mysqli_error($Myconnection));
    echo '<script language="javascript">alert("Xóa thành công");</script>';
}
?>

<?php
$keyword = get_param('keyword');
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCdanh_sach = "SELECT * FROM tlb_nhanvien";

$query_RCdanh_sach1 = "SELECT * FROM tlb_congviec";
if ($keyword != '') {
    $query_RCdanh_sach .= " Where ho_ten like '%" . $keyword . "%'";
}

$RCdanh_sach = mysqli_query($Myconnection, $query_RCdanh_sach) or die(mysqli_error($Myconnection));

$row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach);

$totalRows_RCdanh_sach = mysqli_num_rows($RCdanh_sach);




$RCdanh_sach1 = mysqli_query($Myconnection, $query_RCdanh_sach1) or die(mysqli_error($Myconnection));

$row_RCdanh_sach1 = mysqli_fetch_assoc($RCdanh_sach1);

$totalRows_RCdanh_sach1 = mysqli_num_rows($RCdanh_sach1);

    ?>
    <div style="padding:10px; text-align:right;">
        <form name="fsearch">
            <input type="text" name="keyword" value="" />
            <input type="submit" value="Tìm kiếm" />
        </form>
    </div>
    <?php
    if ($keyword != '') {
        echo '<div id="tieude2">Kết quả tìm nhân viên có tên "' . $keyword . '"</div>';
    }
    ?>
<table class="tablebg" border="0" width="800" align="center" cellpadding="1" cellspacing="1">
    <tr>
        <th width="60" rowspan="2" align="center">Mã NV</th>
        <th width="220" rowspan="2" align="center">Họ Tên Giảng Viên</th>
        <th width="90" rowspan="2" align="center">Điện Thoại</th>
        <th width="150" rowspan="2" align="center">EMAIL</th>
        <th colspan="2" align="center">Tác Vụ</th>
    </tr>
    <tr class="tieudeds">
        <td align="center" bgcolor="#4E7B6E">Thông tin cv</td>
        <td align="center" bgcolor="#4E7B6E">Xóa</td>
    </tr>

    <?php do { ?>
        <tr class="row">
            <td class="row1" width="100" align="left"><a href="chi_tiet_nhan_vien.php?catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>"><?php echo $row_RCdanh_sach['ma_nhan_vien']; ?></a></td>
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['ho_ten']; ?></td>
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['dt_di_dong']; ?></td>
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['email']; ?></td>
            <td class="row1" width="113" align="left"><a href="index.php?require=cap_nhat_thong_tin_cong_viec.php&catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>&title=Thông tin">Xem chi tiết</a></td>
            <td class="row1" width="113" align="left"><a href="index.php?require=danh_sach_nhan_vien.php&catID=<?php echo $row_RCdanh_sach['ma_nhan_vien'];?>&action=del" onclick="return confirm('Bạn có chắc chắn xóa không ?')" >Xóa</a></td>
            <!-- <td class="row1" width="113" align="left"><a href="index.php?require=cap_nhat_thong_tin_cong_viec.php&catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>&title=Thông tin công việc">Xóa</a></td> -->
        </tr>
    <?php } while ($row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach)); ?>
</table>
<?php
mysqli_free_result($RCdanh_sach);
?>