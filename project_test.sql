-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-12-19 07:30
-- 서버 버전: 10.4.8-MariaDB
-- PHP 버전: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `project_test`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `match_info`
--

CREATE TABLE `match_info` (
  `match_num` int(11) NOT NULL,
  `match_team_home` varchar(50) DEFAULT NULL,
  `match_team_away` varchar(50) DEFAULT NULL,
  `match_lineup_home` varchar(255) NOT NULL,
  `match_lineup_away` varchar(255) NOT NULL,
  `match_date` datetime NOT NULL DEFAULT current_timestamp() COMMENT '경기날짜',
  `match_sta_num` int(11) NOT NULL COMMENT '경기장번호',
  `team_logo_home` varchar(255) DEFAULT NULL,
  `team_logo_away` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `match_info`
--

INSERT INTO `match_info` (`match_num`, `match_team_home`, `match_team_away`, `match_lineup_home`, `match_lineup_away`, `match_date`, `match_sta_num`, `team_logo_home`, `team_logo_away`) VALUES
(1, '경남', '수원', 'img\\lineup\\GYEONGNAM_LINEUP2.png', 'img\\lineup\\SUWON_LINEUP.png', '2018-08-23 19:30:00', 1, 'img\\logo_team\\normal\\KLEAGUE1\\GYEONGNAM.PNG', 'img\\logo_team\\normal\\KLEAGUE1\\SUWON.PNG'),
(2, '울산', '상주', 'img\\lineup\\ULSAN_LINEUP.jpg', 'img\\lineup\\SANGJU_LINEUP.png', '2018-08-24 19:00:00', 2, 'img\\logo_team\\normal\\KLEAGUE1\\ULSAN.PNG', 'img\\logo_team\\normal\\KLEAGUE1\\SANGJOO.PNG'),
(3, '전북', '성남', 'img\\lineup\\JEONBUK_LINEUP.jpg', 'img\\lineup\\SEONGNAM_LINEUP.png', '2018-08-24 19:00:00', 3, 'img\\logo_team\\normal\\KLEAGUE1\\JEONBUK.PNG', 'img\\logo_team\\normal\\KLEAGUE1\\SEONGNAM.PNG'),
(4, '대구', '강원', 'img\\lineup\\DAEGU_LINEUP.jpg', 'img\\lineup\\GANGWON_LINEUP.jpg', '2018-08-24 19:30:00', 4, 'img\\logo_team\\normal\\KLEAGUE1\\DAEGU.PNG', 'img\\logo_team\\normal\\KLEAGUE1\\GANGWON.PNG'),
(5, '포항', '인천', 'img\\lineup\\POHANG_LINEUP.jpg', 'img\\lineup\\INCHEON_LINEUP.jpg', '2018-08-25 19:00:00', 5, 'img\\logo_team\\normal\\KLEAGUE1\\POHANG.PNG', 'img\\logo_team\\normal\\KLEAGUE1\\INCHEON.PNG'),
(6, '제주', '서울', 'img\\lineup\\JEJU_LINEUP.png', 'img\\lineup\\SEOUL_LINEUP.jpg', '2018-08-25 19:00:00', 6, 'img\\logo_team\\normal\\KLEAGUE1\\JEJU.PNG', 'img\\logo_team\\normal\\KLEAGUE1\\SEOUL.PNG');

-- --------------------------------------------------------

--
-- 테이블 구조 `reserve_info`
--

CREATE TABLE `reserve_info` (
  `reserve_num` int(11) NOT NULL,
  `tot_ticket_num_or_vip_seat_place` char(10) DEFAULT NULL,
  `seat_info` enum('vip','normal') DEFAULT NULL,
  `reserved_user` varchar(20) NOT NULL DEFAULT '',
  `tot_ticket_price` int(11) NOT NULL,
  `reserved_sta_num` int(11) DEFAULT NULL,
  `reserved_match_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `stadium`
--

CREATE TABLE `stadium` (
  `sta_num` int(11) NOT NULL,
  `sta_name` varchar(20) NOT NULL DEFAULT '',
  `sta_place` varchar(50) NOT NULL DEFAULT '',
  `total_seat_normal` int(11) NOT NULL,
  `total_seat_vip` int(11) NOT NULL,
  `reserved_seat_normal` int(11) NOT NULL,
  `reserved_seat_vip` varchar(255) NOT NULL DEFAULT '',
  `price_ticket_normal` int(11) DEFAULT 0,
  `price_ticket_vip` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `stadium`
--

INSERT INTO `stadium` (`sta_num`, `sta_name`, `sta_place`, `total_seat_normal`, `total_seat_vip`, `reserved_seat_normal`, `reserved_seat_vip`, `price_ticket_normal`, `price_ticket_vip`) VALUES
(1, '창원축구센터', '경남 창원시 성산구 비음로 97 창원축구센터', 200, 20, 0, '0', 15000, 35000),
(2, '울산종합운동장', '울산 중구 염포로 55 울산종합운동장', 200, 20, 0, '0', 15000, 35000),
(3, '전주월드컵경기장', '전북 전주시 덕진구 기린대로 1055', 200, 20, 0, '0', 15000, 35000),
(4, 'DGB 대구은행파크', '대구 북구 고성로 191', 200, 20, 0, '0', 15000, 35000),
(5, '포항 스틸야드', '경북 포항시 남구 동해안로6213번길 20 포항스틸야드', 200, 20, 0, '0', 15000, 35000),
(6, '제주월드컵경기장', '제주 서귀포시 월드컵로 31', 200, 20, 0, '0', 15000, 35000);

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL DEFAULT '',
  `user_pw` varchar(255) NOT NULL DEFAULT '',
  `user_name` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_gender` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`user_id`, `user_pw`, `user_name`, `user_email`, `user_gender`) VALUES
('soy567', '5678', '홍석현', 'soy567@email.com', '남성');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `match_info`
--
ALTER TABLE `match_info`
  ADD PRIMARY KEY (`match_num`),
  ADD KEY `match_sta_num` (`match_sta_num`);

--
-- 테이블의 인덱스 `reserve_info`
--
ALTER TABLE `reserve_info`
  ADD PRIMARY KEY (`reserve_num`),
  ADD KEY `reserved_sta_num` (`reserved_sta_num`),
  ADD KEY `reserved_user` (`reserved_user`),
  ADD KEY `reserved_match_num` (`reserved_match_num`);

--
-- 테이블의 인덱스 `stadium`
--
ALTER TABLE `stadium`
  ADD PRIMARY KEY (`sta_num`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `match_info`
--
ALTER TABLE `match_info`
  MODIFY `match_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `reserve_info`
--
ALTER TABLE `reserve_info`
  MODIFY `reserve_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 테이블의 AUTO_INCREMENT `stadium`
--
ALTER TABLE `stadium`
  MODIFY `sta_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `match_info`
--
ALTER TABLE `match_info`
  ADD CONSTRAINT `match_info_ibfk_1` FOREIGN KEY (`match_sta_num`) REFERENCES `stadium` (`sta_num`);

--
-- 테이블의 제약사항 `reserve_info`
--
ALTER TABLE `reserve_info`
  ADD CONSTRAINT `reserve_info_ibfk_1` FOREIGN KEY (`reserved_sta_num`) REFERENCES `stadium` (`sta_num`),
  ADD CONSTRAINT `reserve_info_ibfk_2` FOREIGN KEY (`reserved_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reserve_info_ibfk_3` FOREIGN KEY (`reserved_match_num`) REFERENCES `match_info` (`match_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
