-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 02, 2024 lúc 05:45 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `airtiket_online`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `aircrafts`
--

CREATE TABLE `aircrafts` (
  `id` char(100) NOT NULL,
  `aircraft_name` varchar(255) DEFAULT NULL,
  `airline_id` int(11) DEFAULT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `status` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `aircrafts`
--

INSERT INTO `aircrafts` (`id`, `aircraft_name`, `airline_id`, `seating_capacity`, `status`) VALUES
('1', 'Airbus A321', 1, 185, 'bình thường'),
('2', 'Boeing B787', 1, 246, 'bình thường'),
('3', 'Airbus A320', 1, 146, 'bình thường'),
('4', 'Airbus A321', 2, 185, 'bình thường'),
('5', 'Boeing B787', 2, 246, 'bình thường'),
('6', 'Airbus A320', 2, 146, 'bình thường'),
('7', 'Airbus A321', 3, 185, 'bình thường'),
('8', 'Boeing B787', 3, 246, 'bình thường'),
('9', 'Airbus A320', 3, 146, 'bình thường');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `airlines`
--

CREATE TABLE `airlines` (
  `id` int(11) NOT NULL,
  `airline_name` varchar(150) DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `airlines`
--

INSERT INTO `airlines` (`id`, `airline_name`, `contact_info`) VALUES
(1, 'Vietnam Airline', 'https://www.vietnamairlines.com/vn/vi/vietnam-airlines/about-us'),
(2, 'Vietjet Air', 'https://www.vietjetair.com/company/profile/index.html?lang=vi'),
(3, 'Bamboo Airways', 'https://www.bambooairways.com/vn/vi/bamboo-airways/about-us'),
(4, '', 'fdadasefdd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `airports`
--

CREATE TABLE `airports` (
  `id` int(11) NOT NULL,
  `airport_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `flight_id` int(10) DEFAULT NULL,
  `titket_classes_id` int(11) DEFAULT NULL,
  `airport_id` int(11) DEFAULT NULL,
  `booking_date` char(10) DEFAULT NULL,
  `seat_code` char(20) DEFAULT NULL,
  `total_price` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `flight_id`, `titket_classes_id`, `airport_id`, `booking_date`, `seat_code`, `total_price`) VALUES
(1, 3, 1, 1, NULL, '10/10/2024', '35538586', '10000000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `aircrafts_id` char(1) DEFAULT NULL,
  `flight_number` char(10) DEFAULT NULL,
  `departure_location` varchar(255) DEFAULT NULL,
  `arrival_location` varchar(255) DEFAULT NULL,
  `departure_time` char(10) DEFAULT NULL,
  `arrival_time` char(10) DEFAULT NULL,
  `available_seats` int(11) DEFAULT NULL,
  `departure_date` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `flights`
--

INSERT INTO `flights` (`id`, `aircrafts_id`, `flight_number`, `departure_location`, `arrival_location`, `departure_time`, `arrival_time`, `available_seats`, `departure_date`) VALUES
(1, '1', 'VN321', 'Tp. HCM', 'Hà Nội', '05:00', '07:20', 185, '09/03/2024'),
(2, '2', 'VN206', 'Tp. HCM', 'Hà Nội', '06:00', '08:10', 39, '09/03/2024'),
(3, '3', 'VN210', 'Hà Nội', 'Tp. HCM', '10:00', '12:10', 36, '10/03/2024'),
(4, '1', 'VN321', 'Hà Nội', 'Tp. HCM', '13:00', '14:20', 39, '10/03/2024'),
(5, '2', 'VN206', 'Tp. HCM', 'Hà Nội', '15:00', '17:10', 39, '10/03/2024'),
(6, '3', 'VN210', 'Tp HCM', 'Hà Nội', '18:00', '20:30', 39, '10/03/2024'),
(7, '1', 'VN321', 'Hà Nội', 'Tp. HCM', '06:00', '08:10', 39, '11/03/2024'),
(8, '2', 'VN206', 'Hà Nội', 'Tp. HCM', '09:00', '11:20', 39, '11/03/2024'),
(9, '3', 'VN210', 'Tp. HCM', 'Hà Nội', '12:00', '14:10', 39, '11/03/2024'),
(10, '1', 'VN321', 'Tp. HCM', 'Hà Nội', '15:00', '17:20', 39, '11/03/2024'),
(11, '2', 'VN206', 'Hà Nội', 'Tp. HCM', '05:00', '07:10', 39, '12/03/2024'),
(12, '3', 'VN210', 'Hà Nội', 'Tp. HCM', '08:00', '10:10', 39, '12/03/2024'),
(13, '1', 'VN321', 'Tp. HCM', 'Hà Nội', '11:00', '13:20', 39, '12/03/2024'),
(14, '2', 'VN206', 'Tp. HCM', 'Hà Nội', '14:00', '16:20', 39, '12/03/2024'),
(15, '3', 'VN210', 'Hà Nội', 'Tp. HCM', '08:00', '10:10', 39, '13/03/2024'),
(18, '3', 'VN210', 'Tp. HCM', 'Hà Nội', '17:00', '19:20', 39, '13/03/2024'),
(19, '1', 'VN321', 'Hà Nội', 'Tp. HCM', '05:00', '07:10', 39, '14/03/2024'),
(20, '2', 'VN206', 'Hà Nội', 'Tp. HCM', '09:00', '11:10', 39, '14/03/2024'),
(21, '3', 'VN210', 'Tp. HCM', 'Hà Nội', '12:00', '14:10', 39, '14/03/2024'),
(22, '1', 'VN321', 'Tp. HCM', 'Hà Nội', '15:00', '17:20', 39, '14/03/2024'),
(23, '2', 'VN206', 'Hà Nội', 'Tp. HCM', '06:00', '08:20', 39, '15/03/2024'),
(24, '3', 'VN210', 'Hà Nội', 'Tp. HCM', '10:00', '12:10', 39, '15/03/2024'),
(25, '4', 'VJ156', 'Tp. HCM', 'Hà Nội', '06:00', '08:20', 39, '09/03/2024'),
(26, '5', 'VJ408', 'Tp. HCM', 'Hà Nội', '15:00', '17:30', 39, '09/03/2024'),
(27, '6', 'VJ503', 'Tp. HCM', 'Hà Nội', '05:00', '07:20', 39, '10/03/2024'),
(28, '4', 'VJ156', 'Hà Nội', 'Tp. HCM', '10:00', '12:10', 39, '10/03/2024'),
(29, '5', 'VJ408', 'Hà Nội', 'Tp. HCM', '14:00', '16:20', 39, '10/03/2024'),
(30, '6', 'VJ503', 'Tp. HCM', 'Hà Nội', '19:00', '21:10', 39, '10/03/2024'),
(31, '4', 'VJ156', 'Tp. HCM', 'Hà Nội', '07:00', '09:10', 39, '11/03/2024'),
(32, '5', 'VJ408', 'Hà Nội', 'Tp. HCM', '10:00', '12:20', 39, '11/03/2024'),
(33, '6', 'VJ503', 'Hà Nội', 'Tp. HCM', '15:00', '17:10', 39, '11/03/2024'),
(34, '4', 'VJ156', 'Tp. HCM', 'Hà Nội', '18:00', '20:20', 39, '11/03/2024'),
(35, '5', 'VJ408', 'Tp. HCM', 'Hà Nội', '09:00', '11:10', 39, '12/03/2024'),
(36, '6', 'VJ503', 'Hà Nội', 'Tp. HCM', '12:00', '14:20', 39, '12/03/2024'),
(37, '4', 'VJ156', 'Hà Nội', 'Tp. HCM', '15:00', '17:10', 39, '12/03/2024'),
(38, '5', 'VJ408', 'Tp. HCM', 'Hà Nội', '18:00', '20:20', 39, '12/03/2024'),
(39, '6', 'VJ503', 'Tp. HCM', 'Hà Nội', '06:00', '08:20', 39, '13/03/2024'),
(40, '4', 'VJ156', 'Hà Nội', 'Tp. HCM', '09:00', '11:10', 39, '13/03/2024'),
(41, '5', 'VJ408', 'Hà Nội', 'Tp. HCM', '14:00', '16:10', 39, '13/03/2024'),
(42, '6', 'VJ503', 'Tp. HCM', 'Hà Nội', '19:00', '21:20', 39, '13/03/2024'),
(43, '6', 'VJ503', 'Tp. HCM', 'Hà Nội', '19:00', '21:20', 39, '13/03/2024'),
(44, '4', 'VJ156', 'Tp. HCM', 'Hà Nội', '07:00', '09:20', 39, '14/03/2024'),
(45, '5', 'VJ408', 'Hà Nội', 'Tp. HCM', '10:00', '12:20', 39, '14/03/2024'),
(46, '6', 'VJ503', 'Hà Nội', 'Tp. HCM', '17:00', '19:10', 39, '14/03/2024'),
(47, '4', 'VJ156', 'Tp. HCM', 'Hà Nội', '20:00', '22:10', 39, '14/03/2024'),
(48, '5', 'VJ408', 'Tp. HCM', 'Hà Nội', '05:00', '07:20', 39, '15/03/2024'),
(49, '6', 'VJ503', 'Hà Nội', 'Tp. HCM', '16:00', '18:10', 39, '15/03/2024'),
(50, '7', 'QH342', 'Hà Nội', 'Tp. HCM', '06:00', '08:10', 39, '09/03/2024'),
(51, '8', 'QH102', 'Tp. HCM', 'Hà Nội', '15:00', '17:20', 39, '09/03/2024'),
(52, '9', 'QH206', 'Tp. HCM', 'Hà Nội', '09:00', '11:20', 39, '10/03/2024'),
(53, '8', 'QH102', 'Hà Nội', 'Tp. HCM', '15:00', '17:20', 39, '10/03/2024'),
(54, '9', 'QH206', 'Tp. HCM', 'Hà Nội', '18:00', '20:10', 39, '10/03/2024'),
(55, '7', 'QH342', 'Tp. HCM', 'Hà Nội', '05:00', '07:20', 39, '11/03/2024'),
(56, '8', 'QH102', 'Tp. HCM', 'Hà Nội', '08:00', '10:10', 39, '11/03/2024'),
(57, '9', 'QH206', 'Hà Nội', 'Tp. HCM', '12:00', '14:20', 39, '11/03/2024'),
(58, '7', 'QH342', 'Hà Nội', 'Tp. HCM', '17:00', '19:30', 39, '11/03/2024'),
(59, '8', 'QH102', 'Tp. HCM', 'Hà Nội', '07:00', '09:10', 39, '12/03/2024'),
(60, '9', 'QH206', 'Tp. HCM', 'Hà Nội', '11:00', '13:20', 39, '12/03/2024'),
(61, '7', 'QH342', 'Hà Nội', 'Tp. HCM', '15:10', '16:30', 39, '12/03/2024'),
(62, '8', 'QH102', 'Hà Nội', 'Tp. HCM', '18:00', '20:10', 39, '12/03/2024'),
(63, '9', 'QH206', 'Tp. HCM', 'Hà Nội', '08:00', '10:30', 39, '13/03/2024'),
(64, '7', 'QH342', 'Tp. HCM', 'Hà Nội', '12:00', '14:20', 39, '13/03/2024'),
(65, '8', 'QH102', 'Hà Nội', 'Tp. HCM', '16:00', '18:10', 39, '13/03/2024'),
(66, '9', 'QH206', 'Hà Nội', 'Tp. HCM', '19:00', '21:30', 39, '13/03/2024'),
(67, '7', 'QH342', 'Tp. HCM', 'Hà Nội', '05:00', '07:20', 39, '14/03/2024'),
(68, '8', 'QH102', 'Tp. HCM', 'Hà Nội', '08:00', '10:10', 39, '14/03/2024'),
(69, '9', 'QH206', 'Hà Nội', 'Tp. HCM', '12:00', '14:20', 39, '14/03/2024'),
(70, '7', 'QH342', 'Hà Nội', 'Tp. HCM', '17:10', '19:20', 39, '14/03/2024'),
(71, '8', 'QH102', 'Tp. HCM', 'Hà Nội', '06:00', '08:20', 39, '15/03/2024'),
(72, '9', 'QH206', 'Tp. HCM', 'Hà Nội', '15:00', '17:30', 39, '15/03/2024'),
(73, '9', '1', 'Tp HCM', 'Hà Nội', '12:30', '20:30', 121, '552'),
(74, '9', '1', 'Tp HCM', 'Hà Nội', '12:30', '20:30', 121, '444'),
(75, '8', '1', 'Tp HCM', 'Hà Nội', '12:30', '20:30', 111, '2222222'),
(76, '8', '1', 'Tp HCM', 'Hà Nội', '12:30', '20:30', 111, '2222222'),
(77, '8', '1', 'Tp HCM', 'Japan', '12:30', '20:30', 111, '2222222');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `booking_id` int(10) DEFAULT NULL,
  `payment_date` char(10) DEFAULT NULL,
  `payment_amount` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Quản lý'),
(2, 'Nhân viên'),
(3, 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `titketclasses`
--

CREATE TABLE `titketclasses` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `titketclasses`
--

INSERT INTO `titketclasses` (`id`, `class_name`, `description`) VALUES
(1, 'First Class', 'Hạng nhất'),
(2, 'Business Class', 'Hạng thương gia'),
(3, 'Preminum Class', 'Hạng phổ thông đặc biệt'),
(4, 'Economy Class', 'Hạng phổ thông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `number_phone` char(10) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `username` char(150) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `date_of_birth`, `number_phone`, `email`, `username`, `password`, `role_id`, `create_at`, `update_at`, `gender`) VALUES
(1, 'Thành Lợi', 'Nguyễn Lâm', '09/03/2004', '0766778694', 'thanhloi867@gmail.com', 'HoaNhanNP', '25f9e794323b453885f5181f1b624d0b', 1, '2024-02-28 00:00:00', '2024-02-28 00:00:00', 'Nam'),
(2, 'Anh', 'Dương Quốc', '10/02/2004', '0789456123', 'qanhduong.gamer@gmail.com', 'UnderDog', '6ebe76c9fb411be97b3b0d48b791a7c9', 1, '2024-02-28 00:00:00', '2024-02-28 00:00:00', 'Nam'),
(3, 'Anh Thư', 'Nguyễn Ngọc', '12/02/2004', '0784512963', 'nnat@gmail.com', 'Chidori', '1bbd886460827015e5d605ed44252251', 2, '2024-02-28 00:00:00', '2024-02-28 00:00:00', 'Nữ'),
(4, NULL, NULL, '--', NULL, 'micub@mailinator.com', 'fyqypevevu', '0', 3, '2024-04-01 18:11:25', '2024-04-01 18:11:25', 'Nữ'),
(5, NULL, NULL, '--', NULL, 'pijaq@mailinator.com', 'suvaxazeh', '0', 3, '2024-04-01 18:11:39', '2024-04-01 18:11:39', 'nam'),
(6, 'Tamekah', 'Watson', '1980-Oct-19', '0212525575', 'pijaq@mailinator.com', 'suvaxazeh', '0', 3, '2024-04-01 18:12:45', '2024-04-01 18:12:45', 'Nam'),
(7, 'Ila', 'Carrillo', '1999-Jul-20', '0292393232', 'liwet@mailinator.com', 'jalajodew', '0', 3, '2024-04-01 18:12:51', '2024-04-01 18:12:51', 'Nam'),
(8, 'Mari', 'Wiggins', '2019/07/05', '0123456789', 'jylyxuwi@mailinator.com', 'razuteled', '0', 3, '2024-04-01 18:15:29', '2024-04-01 18:15:29', 'Nam'),
(9, 'Mia', 'Farley', '2001-10-09', '0123456789', 'soci@mailinator.com', 'gydereru', '0', 3, '2024-04-01 18:18:58', '2024-04-01 18:18:58', 'Nam'),
(11, 'Hòa Nhân', 'Nam Phuong', '2024-02-15', '0766778694', 'thanhloi867@gmail.com', 'Test', '12345', 3, '2024-04-01 18:56:50', '2024-04-01 18:56:50', 'Nam'),
(12, 'Hòa Nhân', 'Nam Phuong', '2024-04-03', '0766778694', 'thanhloi867@gmail.com', 'Test1', '$2y$10$CazSWZh/rGQuI1WCg/2Pk.ppd58IGmhN9gPxzeVn44SK2qoo1WtB2', 3, '2024-04-02 05:46:19', '2024-04-02 05:46:19', 'Nam'),
(13, '10_Nguyễn', 'Lợi', '2024-04-11', '0766778694', 'thanhloi867@gmail.com', 'aaa', '$2y$10$hjr/uG1FI2PkeY8o7i1rqurzmdRcBCJCIVuaTOLBOsgWG5IoLWlQW', 3, '2024-04-02 06:10:12', '2024-04-02 06:10:12', 'Nam'),
(14, 'Hòa Nhân', 'Nam Phuong', '2024-04-06', '0123456789', 'thanhloi867@gmail.com', 'aaa123bc', '$2y$10$dykAm8jDHra20Sfo6QlYlOsodjb6mIuMdQULVb4TiswmXW83.cgzi', 3, '2024-04-02 06:17:04', '2024-04-02 06:17:04', 'Nam'),
(15, 'Anh', 'Trần ', '2024-04-11', '0123456789', 'kjfdkjs@jdsjkd.com', 'abc', '$2y$10$XlNubSWIr2YvtWN8Ylx77O9XvdAv2XI5w2HqvVxPPxQByvl10WfZu', 3, '2024-04-02 13:43:08', '2024-04-02 13:43:08', NULL),
(16, '', '', '', '', '', '', '$2y$10$aSs3qfHO6pXzobKqxm6xouZQk7mEmt63yNWWazftEzKLUEr3fmlze', 3, '2024-04-02 15:23:53', '2024-04-02 15:23:53', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `airline_id` (`airline_id`);

--
-- Chỉ mục cho bảng `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `titket_classes_id` (`titket_classes_id`),
  ADD KEY `airport_id` (`airport_id`);

--
-- Chỉ mục cho bảng `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aircrafts_id` (`aircrafts_id`);

--
-- Chỉ mục cho bảng `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `titketclasses`
--
ALTER TABLE `titketclasses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD CONSTRAINT `aircrafts_ibfk_1` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`),
  ADD CONSTRAINT `aircrafts_ibfk_2` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`);

--
-- Các ràng buộc cho bảng `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`titket_classes_id`) REFERENCES `titketclasses` (`id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`airport_id`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `booking_ibfk_7` FOREIGN KEY (`titket_classes_id`) REFERENCES `titketclasses` (`id`),
  ADD CONSTRAINT `booking_ibfk_8` FOREIGN KEY (`airport_id`) REFERENCES `airports` (`id`);

--
-- Các ràng buộc cho bảng `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`aircrafts_id`) REFERENCES `aircrafts` (`id`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`aircrafts_id`) REFERENCES `aircrafts` (`id`);

--
-- Các ràng buộc cho bảng `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Các ràng buộc cho bảng `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
