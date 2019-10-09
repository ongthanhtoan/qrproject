-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 10, 2019 lúc 07:10 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qrproject`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bangiao`
--

CREATE TABLE `bangiao` (
  `bg_MaBG` bigint(20) UNSIGNED NOT NULL,
  `bg_NguoiGiao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bg_NgayGiao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bg_NguoiNhan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bg_NgayNhan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ts_MaTS` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dv_MaDV` tinyint(3) UNSIGNED NOT NULL,
  `p_MaPhong` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `canbo`
--

CREATE TABLE `canbo` (
  `cb_TenDangNhap` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cb_HoTen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cb_KiemKe` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `canbo`
--

INSERT INTO `canbo` (`cb_TenDangNhap`, `cb_HoTen`, `cb_KiemKe`) VALUES
('Administrator', 'Administrator', 0),
('Guest', 'Guest', 0),
('hoaiphuc', 'Hoài Phúc', 1),
('kimthanh', 'Kim Thanh', 1),
('krbtgt', 'krbtgt', 0),
('ongthanhtoan', 'Ong Thanh Toàn', 1),
('thanhtoan', 'Ong Thanh Toan', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvi`
--

CREATE TABLE `donvi` (
  `dv_MaDV` tinyint(3) UNSIGNED NOT NULL,
  `dv_TenDV` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donvi`
--

INSERT INTO `donvi` (`dv_MaDV`, `dv_TenDV`) VALUES
(3, 'Văn phòng'),
(4, 'Đào tạo'),
(5, 'Phần mềm'),
(6, 'Quản trị chất lượng'),
(7, 'Ban Giám đốc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hientrang`
--

CREATE TABLE `hientrang` (
  `ht_MaHT` tinyint(3) UNSIGNED NOT NULL,
  `ht_TenHT` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hientrang`
--

INSERT INTO `hientrang` (`ht_MaHT`, `ht_TenHT`) VALUES
(2, 'Đang sử dụng'),
(3, 'Hư hỏng xin thanh lý'),
(4, 'Hư hỏng chờ sửa chữa'),
(5, 'Mất'),
(6, 'Không nhu cầu sử dụng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

CREATE TABLE `loai` (
  `l_MaLoai` tinyint(3) UNSIGNED NOT NULL,
  `l_TenLoai` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_GhiChu` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`l_MaLoai`, `l_TenLoai`, `l_GhiChu`) VALUES
(2, 'Máy điều hòa nhiệt độ', NULL),
(3, 'Server', NULL),
(4, 'Máy ổn áp, UPS', NULL),
(5, 'Máy tính để bàn, CPU', NULL),
(6, 'Thiết bị mạng', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_03_05_074015_create_loai_table', 1),
(3, '2019_03_05_075703_create_hientrang_table', 1),
(4, '2019_03_05_075823_create_donvi_table', 1),
(5, '2019_03_05_075935_create_phong_table', 1),
(7, '2019_03_24_033027_create_canbo_table', 1),
(9, '2019_03_05_080203_create_taisan_table', 2),
(10, '2019_03_25_072540_create__ban_giao_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `p_MaPhong` tinyint(3) UNSIGNED NOT NULL,
  `p_TenPhong` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`p_MaPhong`, `p_TenPhong`) VALUES
(2, 'Phòng Giáo vụ'),
(3, 'Phòng Văn phòng'),
(4, 'Quản trị hệ thống'),
(5, 'Phòng Kho');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taisan_2019`
--

CREATE TABLE `taisan_2019` (
  `ts_MaTS` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ts_TenTS` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ts_SoLuong` int(11) NOT NULL,
  `ts_NguyenGia` int(11) NOT NULL,
  `ts_Nam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ts_NgayKiemKe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ts_NangCap` text COLLATE utf8mb4_unicode_ci,
  `ts_KiemKe` tinyint(3) UNSIGNED NOT NULL,
  `l_MaLoai` tinyint(3) UNSIGNED NOT NULL,
  `ht_MaHT` tinyint(3) UNSIGNED NOT NULL,
  `cb_TenDangNhap` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ts_HieuLuc` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taisan_2019`
--

INSERT INTO `taisan_2019` (`ts_MaTS`, `ts_TenTS`, `ts_SoLuong`, `ts_NguyenGia`, `ts_Nam`, `ts_NgayKiemKe`, `ts_NangCap`, `ts_KiemKe`, `l_MaLoai`, `ht_MaHT`, `cb_TenDangNhap`, `ts_HieuLuc`) VALUES
('PC01', 'Máy Tính', 10, 10000, '11/28/2019', '04/25/2019', NULL, 1, 3, 3, 'kimthanh', b'0'),
('PC02', 'Máy tính2', 1, 2, '03/02/2011', '12/25/2019', '1as', 0, 3, 6, 'Administrator', b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `HoTen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`HoTen`, `username`, `password`) VALUES
('Ong Thanh Toàn', 'ongthanhtoan', '$2y$10$Gg4E9kmEYJA/4wUWIsCp.unptexkZqqZgW4ho3UlFU6rZEEbicLq6'),
('Hoài Phúc', 'hoaiphuc', '$2y$10$OceHmQ3geariMSAowOEyMOcsyy/D8QNyIxLikEJ29nlgkoTYzMUa2');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bangiao`
--
ALTER TABLE `bangiao`
  ADD PRIMARY KEY (`bg_MaBG`),
  ADD KEY `bangiao_dv_madv_foreign` (`dv_MaDV`),
  ADD KEY `bangiao_p_maphong_foreign` (`p_MaPhong`),
  ADD KEY `bangiao_ts_mats_foreign` (`ts_MaTS`),
  ADD KEY `bangiao_bg_nguoigiao_foreign` (`bg_NguoiGiao`),
  ADD KEY `bangiao_bg_nguoinhan_foreign` (`bg_NguoiNhan`);

--
-- Chỉ mục cho bảng `canbo`
--
ALTER TABLE `canbo`
  ADD PRIMARY KEY (`cb_TenDangNhap`);

--
-- Chỉ mục cho bảng `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`dv_MaDV`);

--
-- Chỉ mục cho bảng `hientrang`
--
ALTER TABLE `hientrang`
  ADD PRIMARY KEY (`ht_MaHT`);

--
-- Chỉ mục cho bảng `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`l_MaLoai`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`p_MaPhong`);

--
-- Chỉ mục cho bảng `taisan_2019`
--
ALTER TABLE `taisan_2019`
  ADD PRIMARY KEY (`ts_MaTS`),
  ADD KEY `taisan_2019_l_maloai_foreign` (`l_MaLoai`),
  ADD KEY `taisan_2019_ht_maht_foreign` (`ht_MaHT`),
  ADD KEY `taisan_2019_cb_tendangnhap_foreign` (`cb_TenDangNhap`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bangiao`
--
ALTER TABLE `bangiao`
  MODIFY `bg_MaBG` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `donvi`
--
ALTER TABLE `donvi`
  MODIFY `dv_MaDV` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `hientrang`
--
ALTER TABLE `hientrang`
  MODIFY `ht_MaHT` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `loai`
--
ALTER TABLE `loai`
  MODIFY `l_MaLoai` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `p_MaPhong` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bangiao`
--
ALTER TABLE `bangiao`
  ADD CONSTRAINT `bangiao_bg_nguoigiao_foreign` FOREIGN KEY (`bg_NguoiGiao`) REFERENCES `canbo` (`cb_TenDangNhap`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bangiao_bg_nguoinhan_foreign` FOREIGN KEY (`bg_NguoiNhan`) REFERENCES `canbo` (`cb_TenDangNhap`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bangiao_dv_madv_foreign` FOREIGN KEY (`dv_MaDV`) REFERENCES `donvi` (`dv_MaDV`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bangiao_p_maphong_foreign` FOREIGN KEY (`p_MaPhong`) REFERENCES `phong` (`p_MaPhong`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bangiao_ts_mats_foreign` FOREIGN KEY (`ts_MaTS`) REFERENCES `taisan_2019` (`ts_MaTS`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `taisan_2019`
--
ALTER TABLE `taisan_2019`
  ADD CONSTRAINT `taisan_2019_cb_tendangnhap_foreign` FOREIGN KEY (`cb_TenDangNhap`) REFERENCES `canbo` (`cb_TenDangNhap`) ON UPDATE CASCADE,
  ADD CONSTRAINT `taisan_2019_ht_maht_foreign` FOREIGN KEY (`ht_MaHT`) REFERENCES `hientrang` (`ht_MaHT`) ON UPDATE CASCADE,
  ADD CONSTRAINT `taisan_2019_l_maloai_foreign` FOREIGN KEY (`l_MaLoai`) REFERENCES `loai` (`l_MaLoai`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
