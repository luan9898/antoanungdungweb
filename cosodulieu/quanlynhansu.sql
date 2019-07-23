-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 30, 2019 lúc 06:08 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlynhansu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cong_viec_ct`
--

CREATE TABLE `tbl_cong_viec_ct` (
  `cong_viec_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ten_cong_viec` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_cong_viec` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cong_viec_ct`
--

INSERT INTO `tbl_cong_viec_ct` (`cong_viec_id`, `ten_cong_viec`, `mo_ta_cong_viec`) VALUES
('9', 'Báo cáo chuyên môn', 'Báo cáo chi tiết chuyên môn'),
('CNTT', 'Hội giảng Lớp Chuyên môn 1', 'Phân công cán bộ tham dự hội giảng'),
('CTHI', 'Kế hoạch chấm thi', 'Chấm thi  AT13, AT14'),
('gth', 'giám thị', 'coi thi at13 at14 '),
('KTT001', 'kế toán trưởng', 'kê khai các khoản chi thu'),
('QTHT', 'Quản Trị Hệ Thống', 'quản lý các phòng máy tầng 4 5 ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tlb_bangcap`
--

CREATE TABLE `tlb_bangcap` (
  `bang_cap_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_bang_cap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tlb_bangcap`
--

INSERT INTO `tlb_bangcap` (`bang_cap_id`, `ten_bang_cap`) VALUES
('dh', 'Đại học '),
('ths', 'Thạc Sĩ '),
('ts', 'Tiến Sĩ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tlb_chucvu`
--

CREATE TABLE `tlb_chucvu` (
  `chuc_vu_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_chuc_vu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tlb_chucvu`
--

INSERT INTO `tlb_chucvu` (`chuc_vu_id`, `ten_chuc_vu`) VALUES
('CNK01', 'Chủ nhiệm khoa'),
('DT001', 'Chủ nhiệm bộ môn '),
('GV001', 'Giảng viên '),
('PCN01', 'Phó chủ nhiệm khoa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tlb_congviec`
--

CREATE TABLE `tlb_congviec` (
  `ma_nhan_vien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_bat_dau` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_ket_thuc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cong_viec_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chuc_vu_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ho_ten` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bang_cap_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tlb_congviec`
--

INSERT INTO `tlb_congviec` (`ma_nhan_vien`, `ngay_bat_dau`, `ngay_ket_thuc`, `cong_viec_id`, `chuc_vu_id`, `ho_ten`, `bang_cap_id`) VALUES
('U1', '2000-02-02', '2018-09-08', 'CNTT', 'CNK01', 'Nguyễn Thị Thương', 'ts'),
('U2', '2019-06-02', '2019-06-03', 'KTT001', 'CNK01', 'Hoàng Đăng Luân', 'dh'),
('U3', '2019-06-02', '2019-07-02', 'KTT001', 'CNK01', 'Bùi Văn Công', 'dh'),
('U4', '2019-05-26', '2019-07-04', 'LT001', 'CNK01', 'Nguyễn Phúc Hiếu', 'ts');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tlb_hinhanh`
--

CREATE TABLE `tlb_hinhanh` (
  `id` mediumint(10) NOT NULL,
  `ten_anh` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tlb_hinhanh`
--

INSERT INTO `tlb_hinhanh` (`id`, `ten_anh`) VALUES
(2, '1318841686.jpg'),
(3, '1318841821.jpg'),
(4, '1318910096.jpg'),
(5, '1318910105.jpg'),
(7, '1318910124.jpg'),
(8, '1318911121.jpg'),
(9, '1318911135.jpg'),
(10, '1318911710.jpg'),
(11, '1318911868.jpg'),
(12, ''),
(13, '1459653476.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tlb_nguoidung`
--

CREATE TABLE `tlb_nguoidung` (
  `id` int(10) NOT NULL,
  `ma_nhan_vien` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mat_khau` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rule_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tlb_nguoidung`
--

INSERT INTO `tlb_nguoidung` (`id`, `ma_nhan_vien`, `mat_khau`, `rule_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0'),
(4, 'U1', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(6, 'U4', '202cb962ac59075b964b07152d234b70', '0'),
(8, 'U3', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(10, 'U2', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(28, 'U5', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(38, 'admin', '21232f297a57a5a743894a0e4a801fc3', '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tlb_nhanvien`
--

CREATE TABLE `tlb_nhanvien` (
  `ma_nhan_vien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL,
  `dt_di_dong` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_sinh` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nghi_viec` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tlb_nhanvien`
--

INSERT INTO `tlb_nhanvien` (`ma_nhan_vien`, `ho_ten`, `gioi_tinh`, `dt_di_dong`, `email`, `ngay_sinh`, `dia_chi`, `nghi_viec`) VALUES
('U2', 'Hoàng Đăng Luân', 1, '1035464', 'luanthuy9898@gmail.com', '2000-12-31', 'nghe an', NULL),
('U3', 'Bùi Văn Công', 1, '19001098', 'buicong123@gmail.com', '1997-02-14', 'ninh bình', NULL),
('U1', 'Nguyễn Thị Thương', 0, '103546', 'thuong98@gmail.com', '1992-02-21', 'nghe an', NULL),
('U5', 'hoàng đăng luân', 1, '0354289494', 'luanthuy9898@gmail.com', '1998-09-08', 'nghe an', NULL),
('U4', 'Nguyễn Phúc Hiếu', 1, '0902395848', 'luanthuy9898@gmail.com', '1997-06-04', 'ha noi', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_cong_viec_ct`
--
ALTER TABLE `tbl_cong_viec_ct`
  ADD PRIMARY KEY (`cong_viec_id`);

--
-- Chỉ mục cho bảng `tlb_bangcap`
--
ALTER TABLE `tlb_bangcap`
  ADD PRIMARY KEY (`bang_cap_id`);

--
-- Chỉ mục cho bảng `tlb_chucvu`
--
ALTER TABLE `tlb_chucvu`
  ADD PRIMARY KEY (`chuc_vu_id`);

--
-- Chỉ mục cho bảng `tlb_congviec`
--
ALTER TABLE `tlb_congviec`
  ADD PRIMARY KEY (`ma_nhan_vien`,`ngay_ket_thuc`);

--
-- Chỉ mục cho bảng `tlb_hinhanh`
--
ALTER TABLE `tlb_hinhanh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tlb_nguoidung`
--
ALTER TABLE `tlb_nguoidung`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tlb_nhanvien`
--
ALTER TABLE `tlb_nhanvien`
  ADD PRIMARY KEY (`ma_nhan_vien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tlb_hinhanh`
--
ALTER TABLE `tlb_hinhanh`
  MODIFY `id` mediumint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tlb_nguoidung`
--
ALTER TABLE `tlb_nguoidung`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
