-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 07:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `cover` varchar(500) NOT NULL,
  `isbn` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Publication` varchar(30) NOT NULL,
  `Genre` varchar(10) NOT NULL,
  `Volumes` int(3) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `source` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `stu_id` varchar(20) NOT NULL,
  `picture` varchar(5000) NOT NULL,
  `name` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `source` varchar(1000) NOT NULL,
  `notes` longtext NOT NULL,
  `Time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `T_Id` bigint(10) NOT NULL,
  `book_name` varchar(50) NOT NULL DEFAULT '',
  `book_id` varchar(50) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `issued_date` varchar(50) NOT NULL,
  `returned_date` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `Name` varchar(25) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Id` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`Name`, `Department`, `Id`, `email`, `password`) VALUES
('Partha Sarathi', 'mathematics', '128975', 'parthasarathi@gmail.com', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stu_img` varchar(500) NOT NULL,
  `stu_name` varchar(100) NOT NULL,
  `Dob` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `course` varchar(50) NOT NULL,
  `Stu_id` varchar(15) NOT NULL,
  `college` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stu_img`, `stu_name`, `Dob`, `Gender`, `course`, `Stu_id`, `college`, `Email`, `password`, `total`) VALUES
('student_images/ady.jpg', 'Anand Reddy', '2000-07-11', 'Male', 'M.Sc Computer Science', '100721504030', 'University Colllege Of Science', 'm.anandreddy2000@gmail.com', 'anand11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`T_Id`),
  ADD KEY `sno` (`T_Id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Stu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
