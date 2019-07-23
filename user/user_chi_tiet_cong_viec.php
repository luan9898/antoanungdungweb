<?php
mysqli_select_db($Myconnection, $database_Myconnection);
$ma_nv = $_SESSION['ma_nhan_vien'];
//  print_r($ma_nv);
//$query_RCdanh_sach = "SELECT * FROM tb_congviec as a,tlb_cong_viec_chi_tiet  as b, tlb_trang_thai as c Where a.trang_thai=c.trang_thai and a.id_cong_viec=b.id_cong_viec and ma_nhan_vien='$ma_nv' group by a.id_cong_viec";
$query_RCdanh_sach = "select * from tbl_cong_viec_ct as ctcv join tlb_congviec as cv on ctcv.cong_viec_id = cv.cong_viec_id join tlb_nhanvien as nv on nv.ma_nhan_vien = cv.ma_nhan_vien where nv.ma_nhan_vien = '$ma_nv'";


$RCdanh_sach = mysqli_query($Myconnection, $query_RCdanh_sach) or die(mysqli_error($Myconnection));
//print_r($RCdanh_sach);
$row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach);
$totalRows_RCdanh_sach = mysqli_num_rows($RCdanh_sach);
//print_r(totalRows_RCdanh_sach);
?>
<!----------Form hiển thị chi tiết công viẹc-------------------->
<table class="tablebg" border="1" width="auto" height='100px' align="center" cellpadding="1" cellspacing="1">
    <tr>
        <th width="10%" rowspan="1" align="center">công_việc_ID </th>
        <th width="25%" rowspan="1" align="center">Tên công việc</th>
        <th width="30%" rowspan="1" align="center">Mô tả công việc</th>
        <th width="12%" rowspan="1" align="center">Ngày bắt đầu</th>
        <th width="12%" rowspan="1" align="center">Ngày kết thúc</th>
        <!-- <th width="10%" rowspan="1" align="center">Trạng thái</th>
        <th width="10%" rowspan="1" align="center">Tài liệu đính kèm</th> -->
        <th width="20%" rowspan="1" align="center">Cập nhật</th>
    </tr>
    <?php do { ?>
        <tr class="row8">
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['cong_viec_id']; ?>
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['ten_cong_viec']; ?></td>
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['mo_ta_cong_viec']; ?></td>
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['ngay_bat_dau']; ?></td>
            <td class="row1" align="left"><?php echo $row_RCdanh_sach['ngay_ket_thuc']; ?></td>
            <!-- <td class="row1" align="left"><?php echo $row_RCdanh_sach['mo_ta_trang_thai']; ?></td> -->
          
            <td class="row1" align="left"><a href="user.php?require=application/user/user_cap_nhat_cong_viec.php&catID=<?php echo $row_RCdanh_sach['id_cong_viec']; ?>">Cập nhật</a></td>
        </tr>
    <?php } while ($row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach)); ?>
</table>
<?php
mysqli_free_result($RCdanh_sach);
?>