-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `id` bigint(20) NOT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `country_code` varchar(3) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `analytics`
--

INSERT INTO `analytics` (`id`, `user_ip`, `country_code`, `country`, `operating_system`, `browser`, `date`) VALUES
(1, '192.168.1.125', '', '', '', '', 1676831400),
(2, '192.168.1.125', '', '', '', '', 1677004200),
(3, '192.168.1.114', '', '', '', '', 1677090600),
(4, '82.157.123.54', 'CN', 'China', '', '', 1677263400),
(5, '103.240.208.227', 'IN', 'India', '', '', 1677263400),
(6, '49.34.80.173', 'IN', 'India', '', '', 1677349800),
(7, '150.129.104.93', 'IN', 'India', '', '', 1677522600),
(8, '103.240.208.216', 'IN', 'India', '', '', 1677695400),
(9, '82.157.123.54', 'CN', 'China', '', '', 1677695400),
(10, '103.240.208.240', 'IN', 'India', '', '', 1677781800),
(11, '103.240.208.117', 'IN', 'India', '', '', 1678041000),
(12, '103.240.208.26', 'IN', 'India', '', '', 1678127400),
(13, '150.129.104.9', 'IN', 'India', '', '', 1678300200),
(14, '49.34.171.91', 'IN', 'India', '', '', 1678300200),
(15, '49.34.166.52', 'IN', 'India', '', '', 1678300200),
(16, '192.168.1.117', '', '', '', '', 1678386600),
(17, '192.168.1.125', '', '', '', '', 1678991400),
(18, '192.168.1.105', '', '', '', '', 1679596200),
(19, '192.168.1.125', '', '', '', '', 1680028200),
(20, '192.168.1.102', '', '', '', '', 1680028200),
(21, '192.168.1.111', '', '', '', '', 1680633000),
(22, '192.168.1.111', '', '', '', '', 1680719400),
(23, '192.168.1.106', '', '', '', '', 1680805800),
(24, '192.168.1.106', '', '', '', '', 1681065000),
(25, '192.168.1.116', '', '', '', '', 1681065000),
(26, '192.168.1.115', '', '', '', '', 1681151400),
(27, '192.168.1.115', '', '', '', '', 1681237800),
(28, '192.168.1.110', '', '', '', '', 1681324200),
(29, '150.129.104.149', 'IN', 'India', '', '', 1681669800),
(30, '150.129.104.11', 'IN', 'India', '', '', 1682015400),
(31, '103.240.208.52', 'IN', 'India', '', '', 1682101800),
(32, '150.129.104.79', 'IN', 'India', '', '', 1682274600),
(33, '49.34.244.162', 'IN', 'India', '', '', 1682274600),
(34, '103.240.208.168', 'IN', 'India', '', '', 1682361000),
(35, '150.129.104.39', 'IN', 'India', '', '', 1682361000),
(36, '150.129.104.189', 'IN', 'India', '', '', 1682447400),
(37, '150.129.104.118', 'IN', 'India', '', '', 1682879400),
(38, '103.240.208.53', 'IN', 'India', '', '', 1682965800),
(39, '103.240.208.50', 'IN', 'India', '', '', 1683052200),
(40, '43.250.156.192', 'IN', 'India', '', '', 1683138600),
(41, '150.129.104.197', 'IN', 'India', '', '', 1683484200),
(42, '150.129.104.37', 'IN', 'India', '', '', 1683570600),
(43, '150.129.104.175', 'IN', 'India', '', '', 1684693800),
(44, '43.250.156.174', 'IN', 'India', '', '', 1684780200),
(45, '43.250.156.145', 'IN', 'India', '', '', 1684866600),
(46, '157.32.251.238', 'IN', 'India', '', '', 1684866600),
(47, '103.240.208.150', 'IN', 'India', '', '', 1684953000),
(48, '157.32.228.166', 'IN', 'India', '', '', 1684953000),
(49, '157.32.227.169', 'IN', 'India', '', '', 1684953000),
(50, '157.32.242.106', 'IN', 'India', '', '', 1684953000),
(51, '157.32.244.122', 'IN', 'India', '', '', 1684953000),
(52, '103.240.208.163', 'IN', 'India', '', '', 1685385000),
(53, '157.32.228.194', 'IN', 'India', '', '', 1685385000),
(54, '152.58.35.57', 'IN', 'India', '', '', 1685385000),
(55, '157.32.244.240', 'IN', 'India', '', '', 1685385000),
(56, '157.32.233.221', 'IN', 'India', '', '', 1685471400),
(57, '157.32.246.79', 'IN', 'India', '', '', 1685471400),
(58, '157.32.244.232', 'IN', 'India', '', '', 1685471400),
(59, '150.129.104.66', 'IN', 'India', '', '', 1685471400),
(60, '150.129.104.45', 'IN', 'India', '', '', 1685557800),
(61, '157.32.245.168', 'IN', 'India', '', '', 1685557800),
(62, '103.240.208.129', 'IN', 'India', '', '', 1685644200),
(63, '157.32.224.52', 'IN', 'India', '', '', 1685644200),
(64, '157.32.234.35', 'IN', 'India', '', '', 1685644200),
(65, '150.129.104.49', 'IN', 'India', '', '', 1685644200),
(66, '157.32.233.2', 'IN', 'India', '', '', 1685644200),
(67, '103.240.208.68', 'IN', 'India', '', '', 1685644200),
(68, '157.32.248.5', 'IN', 'India', '', '', 1685644200),
(69, '49.34.207.58', 'IN', 'India', '', '', 1685903400),
(70, '43.250.156.200', 'IN', 'India', '', '', 1685903400),
(71, '152.58.39.252', 'IN', 'India', '', '', 1685903400),
(72, '103.240.208.3', 'IN', 'India', '', '', 1685989800),
(73, '103.240.208.174', 'IN', 'India', '', '', 1686076200),
(74, '43.250.156.187', 'IN', 'India', '', '', 1686249000),
(75, '150.129.104.128', 'IN', 'India', '', '', 1686249000),
(76, '49.34.195.143', 'IN', 'India', '', '', 1686335400),
(77, '150.129.104.112', 'IN', 'India', '', '', 1686335400),
(78, '150.129.104.14', 'IN', 'India', '', '', 1686508200),
(79, '27.61.255.27', 'IN', 'India', '', '', 1686508200),
(80, '150.129.104.101', 'IN', 'India', '', '', 1686508200),
(81, '43.250.156.216', 'IN', 'India', '', '', 1686594600),
(82, '150.129.104.101', 'IN', 'India', '', '', 1686594600),
(83, '114.31.188.45', 'IN', 'India', '', '', 1686594600),
(84, '150.129.104.58', 'IN', 'India', '', '', 1686681000),
(85, '103.240.208.25', 'IN', 'India', '', '', 1686681000);

-- --------------------------------------------------------

--
-- Table structure for table `applied_users`
--

CREATE TABLE `applied_users` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applied_users`
--

INSERT INTO `applied_users` (`id`, `post_id`, `user_id`, `date`, `status`) VALUES
(32, 3, 27, 1686592773, 0),
(33, 2, 27, 1686592784, 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_ads`
--

CREATE TABLE `app_ads` (
  `id` int(11) NOT NULL,
  `ads_name` varchar(255) DEFAULT NULL,
  `ads_info` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_ads`
--

INSERT INTO `app_ads` (`id`, `ads_name`, `ads_info`, `status`) VALUES
(1, 'Admob', '{\"publisher_id\":\"pub-3940256099942544\",\"banner_on_off\":\"1\",\"banner_id\":\"ca-app-pub-3940256099942544\\/6300978111\",\"interstitial_on_off\":\"0\",\"interstitial_id\":\"ca-app-pub-3940256099942544\\/1033173712\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"0\",\"native_id\":\"ca-app-pub-3940256099942544\\/2247696110\",\"native_position\":\"7\"}', 0),
(2, 'StartApp', '{\"publisher_id\":\"203601319\",\"banner_on_off\":\"1\",\"banner_id\":\"\",\"interstitial_on_off\":\"1\",\"interstitial_id\":\"\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"0\",\"native_id\":\"\",\"native_position\":\"7\"}', 0),
(3, 'Facebook', '{\"publisher_id\":\"\",\"banner_on_off\":\"1\",\"banner_id\":\"IMG_16_9_APP_INSTALL#288347782353524_288349185686717\",\"interstitial_on_off\":\"1\",\"interstitial_id\":\"IMG_16_9_APP_INSTALL#288347782353524_288396272348675\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"1\",\"native_id\":\"IMG_16_9_APP_INSTALL#288347782353524_288348195686816\",\"native_position\":\"7\"}', 0),
(4, 'AppLovins MAX', '{\"publisher_id\":\"\",\"banner_on_off\":\"1\",\"banner_id\":\"3221a2640039c8a8\",\"interstitial_on_off\":\"1\",\"interstitial_id\":\"06b9bf27824eb7f6\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"1\",\"native_id\":\"0d3c3740628feba8\",\"native_position\":\"7\"}', 0),
(5, 'Wortise', '{\"publisher_id\":\"a4e76baa-c4ce-4672-ba85-f2f7190bd19b\",\"banner_on_off\":\"1\",\"banner_id\":\"a2562302-14ce-476b-94d4-0c6431f1f927\",\"interstitial_on_off\":\"1\",\"interstitial_id\":\"ed6fc25c-9855-485e-9513-fed0d3acc528\",\"interstitial_clicks\":\"5\",\"native_on_off\":\"1\",\"native_id\":\"cf65ed35-4765-4955-96fc-a33cf43d5340\",\"native_position\":\"7\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`, `status`) VALUES
(1, 'Accounting', 'upload/images/category/Category/Accounting/16567_accounting.jpg', 1),
(2, 'Banking', 'upload/images/category/Category/Banking/662_banking.jpg', 1),
(3, 'Engineering', 'upload/images/category/Category/Engineering/21737_engineering.jpg', 1),
(4, 'Management', 'upload/images/category/Category/Management/41537_management.jpg', 1),
(5, 'Teacher', 'upload/images/category/Category/Teacher/14331_teacher.jpg', 1),
(6, 'Railway', 'upload/images/category/Category/Railway/33773_railway.jpg', 1),
(7, 'Other', 'upload/images/category/Category/Other/73272_other.jpg', 1),
(8, 'Medical', 'upload/images/category/Category/Medical/62258_medical.jpg', 1),
(9, 'Marketing', 'upload/images/category/Category/Marketing/73446_marketing.jpg', 1),
(10, 'Manufacturing', 'upload/images/category/Category/Manufacturing/98980_manufacturing.jpg', 1),
(11, 'Health Care', 'upload/images/category/Category/Health Care/94918_health_care.jpg', 1),
(12, 'Finance', 'upload/images/category/Category/Finance/33294_finance.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `user_id`, `post_id`, `post_type`) VALUES
(7, 3, 1, 'Jobs'),
(103, 27, 2, 'Jobs'),
(104, 27, 3, 'Jobs');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `job_type` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `job_work_days` varchar(255) DEFAULT NULL,
  `job_work_time` varchar(255) DEFAULT NULL,
  `vacancy` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `cat_id`, `location_id`, `title`, `description`, `job_type`, `designation`, `salary`, `company_name`, `phone`, `email`, `website`, `job_work_days`, `job_work_time`, `vacancy`, `address`, `experience`, `qualification`, `skills`, `image`, `date`, `status`) VALUES
(1, 1, 1, 2, 'Account Job', '<p>test info</p>', 'Full Time', 'Sr.Accountant', 30000.00, 'ABC PVT', '9236541233', 'info@abc.com', '', '', '', '', 'Phase 1', '', 'Masters', 'Tally,Zoho Books', 'upload/images/category/Category/Accounting/16567_accounting.jpg', 1678991400, 1),
(2, 15, 2, 2, 'Senior banker', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\\\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\\\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>', 'Full Time', 'Loan processor', 29000.00, 'HDFC Bank', '9236541233', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Fri', '10AM-5PM', '2', 'embarrassing hidden in the middle, Kolkata', '5 Years', 'Certification', 'Organisation,time management,Problem solving,Leadership', 'upload/15-4afd3065ac4549bf23423c2277a40d40.jpg', 1680546600, 1),
(3, 15, 1, 1, 'Bookkeeper', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Contract', 'Service professional', 25000.00, 'Accounting Firm', '9236541233', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon - Fri', '9AM - 5PM', '2', 'printing and typesetting, Mumbai', '1 Years', 'Bachelors', 'Organisation,Financial accounting,Communication', 'upload/15-78ef489df42ac4257f872dbe2ebc4541.jpg', 1680546600, 1),
(5, 1, 4, 4, 'Angular Js Developer', '<p>expedita distinctio. At vero eos et accusamus et iusto Lorem ipsum dolor sit amet, consectetur adipiscing...odio dignissimos ducimusexpedita distinctio. At vero eos et accusamus et iusto odio dignissimos ducimus</p>', 'Part Time', 'MEAN Stack Developer', 14000.00, 'Php Programers', '+91 9587654321', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Fri', '9Am-6Pm', '5', 'Lorem ipsum dolor Morbi.', '5 Years', 'Bachelors', 'Jquery', 'upload/images/category/Category/Management/87354_16527.jpg', 1686594600, 1),
(6, 1, 3, 11, 'Angular Js Developer', '<p>Lorem ipsam</p>', 'Full Time', 'MEAN Stack Developer', 15000.00, 'RK Infotech', '+91 9587654321', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Monday - Friday', '9 AM to 6 PM', '2', 'Lorem ipsum dolor  Rajkot.', '1 Years', 'Masters', 'Angular Js,JavaScript,Jquery', 'upload/images/category/Category/Management/87354_16527.jpg', 1686594600, 1),
(7, 1, 8, 5, 'Medicine Supervisor', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Full Time', 'Experienced Professional', 10000.00, 'Pharma Tech Inc', '7410321568', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Fri', '9Am-4Pm', '3', 'El Dorado, Arkansas,  Mudra', '3 Years', 'MPhil/MS', 'Marketing', 'upload/images/category/Category/Medical/52621.jpg', 1686594600, 1),
(8, 1, 6, 15, 'Dot Developer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Contract', 'Experienced Professional', 10000.00, 'Surf wave', '7410321568', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Fri', '9Am-4Pm', '3', 'El Dorado, Arkansas, Delhi', '3 Years', 'MPhil/MS', 'Marketing', 'upload/images/category/Category/Railway/31424.jpg', 1686594600, 1),
(9, 1, 8, 13, 'Medicine Supervisor', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Part Time', 'Experienced Professional', 10500.00, 'Pharma Tech Inc', '+91 9587654321', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Fri', '9Am-4Pm', '3', 'El Dorado, Arkansas, Bangalore', '3 Years', 'MPhil/MS', 'Marketing', 'upload/images/category/Category/Medical/56386.jpg', 1686594600, 1),
(10, 1, 3, 9, 'Electrical Engineer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tellus libero, rutrum eleifend enim vitae, aliquam fermentum tortor. Morbi facilisis malesuada placerat. Aliquam ipsum metus, scelerisque sit amet libero ac, volutpat molestie lacus. Nam varius leo enim, sit amet aliquet odio varius sed. Vestibulum sodales egestas velit a convallis. Sed aliquam, diam et sagittis tincidunt, nisi nulla fermentum turpis, faucibus interdum lacus turpis ut ligula. Nulla sit amet laoreet enim. Sed lobortis suscipit ipsum eget convallis.</p>', 'Full Time', 'Engineer', 14000.00, 'Power Wave', '9780321456', 'info@viaviweb.com', 'http://viaviweb.com/', 'Monday - Friday', '9AM-5PM', '2', 'Lorem Ipsum Dolor Amreli..', '4 Years', 'Bachelors', 'Sales,Marketing', 'upload/images/category/Category/Engineering/68445.jpg', 1686594600, 1),
(11, 1, 10, 17, 'Laravel Developer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tellus libero, rutrum eleifend enim vitae, aliquam fermentum tortor. Morbi facilisis malesuada placerat. Aliquam ipsum metus, scelerisque sit amet libero ac, volutpat molestie lacus. Nam varius leo enim, sit amet aliquet odio varius sed. Vestibulum sodales egestas velit a convallis. Sed aliquam, diam et sagittis tincidunt, nisi nulla fermentum turpis, faucibus interdum lacus turpis ut ligula. Nulla sit amet laoreet enim. Sed lobortis suscipit ipsum eget convallis.</p>', 'Full Time', 'Web Devloper', 40000.00, 'Travel Advisor', '8780321456', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Fri', '9 AM to 6 PM', '4', 'Canon City, Colorado, Surat', '2 Years', 'Certification', 'PHP,MYSQL,HTML,CSS', 'upload/images/category/Category/Manufacturing/44026.jpg', 1686594600, 1),
(12, 1, 4, 14, 'Ios Developer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tellus libero, rutrum eleifend enim vitae, aliquam fermentum tortor. Morbi facilisis malesuada placerat. Aliquam ipsum metus, scelerisque sit amet libero ac, volutpat molestie lacus. Nam varius leo enim, sit amet aliquet odio varius sed. Vestibulum sodales egestas velit a convallis. Sed aliquam, diam et sagittis tincidunt, nisi nulla fermentum turpis, faucibus interdum lacus turpis ut ligula. Nulla sit amet laoreet enim. Sed lobortis suscipit ipsum eget convallis.</p>', 'Full Time', 'Web Devloper', 30000.00, 'Travel Advisor', '9856852136', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Monday - Friday', '9AM-5PM', '4', 'Canon City, Colorado, Vadodara', '2 Years', 'Bachelors', 'PHP,MYSQL,HTML,CSS', 'upload/images/category/Category/Management/29755.jpg', 1686594600, 1),
(13, 1, 5, 17, 'Project Manager', '<p>or sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.Lorem ipsum dol</p>', 'Internship', 'Designer', 13000.00, 'Multimedia Design', '8740321456', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Sat', '9Am-6Pm', '3', 'Kaneohe Station, Hawaii, Surat', '1 Years', 'Bachelors', 'Communicastion Skill', 'upload/images/category/Category/Teacher/28436.jpg', 1686594600, 1),
(14, 1, 4, 8, 'Full Stack Designer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Full Time', 'Php Devloper', 25000.00, 'Connect People', '8703214567', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Fri', '9AM-5PM', '5', 'Barrington, New Hampshire, Gandhinagar', '2 Years', 'Certification', 'Laravel,Adobe Photoshop', 'upload/images/category/Category/Management/29755.jpg', 1686594600, 1),
(15, 1, 5, 6, 'Web Designer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Contract', 'Designer', 15000.00, 'New Design Studio', '9874012360', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Fri', '9Am-10Pm', '10', 'Milton, Delaware, kutch', '4 Years', 'Short Course', 'HTML,CSS,Adobe', 'upload/images/category/Category/Teacher/99233.jpg', 1686594600, 1),
(16, 1, 6, 17, 'Medicine Supervisor', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Full Time', 'MS', 25000.00, 'Pharma Tech Inc', '8745632108', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Sat', '9Am-6Pm', '12', 'Dorado, Arkansas,Surat', '3 Years', 'MPhil/MS', 'Marketing,Communication Skill', 'upload/images/category/Category/Management/87354_16527.jpg', 1686594600, 1),
(17, 1, 7, 7, 'Php Developer Required', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tellus libero, rutrum eleifend enim vitae, aliquam fermentum tortor. Morbi facilisis malesuada placerat. Aliquam ipsum metus, scelerisque sit amet libero ac, volutpat molestie lacus. Nam varius leo enim, sit amet aliquet odio varius sed. Vestibulum sodales egestas velit a convallis. Sed aliquam, diam et sagittis tincidunt, nisi nulla fermentum turpis, faucibus interdum lacus turpis ut ligula. Nulla sit amet laoreet enim. Sed lobortis suscipit ipsum eget convallis. Quisque sit amet nisi vel urna mattis lobortis. Suspendisse non pulvinar magna. Etiam tellus quam, sodales vel semper quis, laoreet eu elit. Maecenas aliquet convallis massa, ac pharetra tellus consequat a. In dictum est non ornare faucibus. Duis malesuada ipsum sed tincidunt aliquam. Cras ullamcorper velit nec tellus bibendum, id varius nunc commodo.</p>', 'Part Time', 'Devlopers', 35000.00, 'It company', '9874563215', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Sat', '9AM-5PM', '3', 'labaster, Alabama, jaipur', '5 Years', 'Masters', 'PHP,MYSQL,Strong Communication Skill', 'upload/images/category/Category/Teacher/28436.jpg', 1686594600, 1),
(18, 1, 9, 15, 'Wordpress Developer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Contract', 'Experienced Professional', 15000.00, 'Connect People', '9874563210', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Fri', '9AM-5PM', '4', 'Barrington, New Hampshire, Delhi', '5 Years', 'Certification', 'WordPress,HTML,CSS,JavaScript', 'upload/images/category/Category/Medical/56386.jpg', 1686594600, 1),
(19, 1, 1, 9, 'Graphic Designer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Part Time', 'Designer', 20000.00, 'Media Wave', '9874563210', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Fri', '9Am-6Pm', '12', 'Lorem Ipsum Dolor Amreli..', '3 Years', 'Bachelors', 'Adobe Photoshop,HTML,CSS', 'upload/images/category/Category/Accounting/75844_img1.jpg', 1686594600, 1),
(20, 1, 1, 16, 'SEO Expert', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Internship', 'Day', 20000.00, 'Mayan Design Studios', '9874563210', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Fri', '9Am-6Pm', '25', 'Lorem Ipsum Dolor Ahmedabad..', '3 Years', 'Bachelors', 'HTML,CSS,Communication', 'upload/images/category/Category/Teacher/28436.jpg', 1686594600, 1),
(21, 1, 2, 2, 'Credit Analyst', '<p>aliquam fermentum tortor. Morbi facilisis malesuada placerat. Aliquam ipsum metus, scelerisque sit amet libero ac, volutpat molestie lacus. Nam varius leo enim, sit amet aliquet odio varius sed. Vestibulum sodales egestas velit a convallis. Sed aliquam, diam et sagittis tincidunt, nisi nulla fermentum turpis, faucibus interdum lacus turpis ut ligula. Nulla sit amet laoreet enim. Sed lobortis suscipit ipsum eget convallis.</p>', 'Contract', 'Experienced Professional', 18000.00, 'Globex Corporation', '9523665430', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Fri', '9AM-5PM', '8', 'Nulla sit amet laoreet ,Kolkata', '1 Years', 'Bachelors', 'Problem solving.,Communication Skills', 'upload/images/category/Category/Banking/Untitled-1.jpg', 1686594600, 1),
(22, 1, 8, 1, 'Medical assistant', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Full Time', 'Experienced Professional', 12000.00, 'Massive Dynamic', '8562245932', 'viaviwebtech@gmail.com', 'http://viaviweb.com', 'Mon-Sat', '9Am-10Pm', '4', 'Donec a arcu at leo interdum,Mumbai', '2 Years', 'MPhil/MS', 'Communation,Empathy,TeamWork', 'upload/images/category/Category/Medical/123.jpg', 1686594600, 1),
(23, 1, 12, 5, 'Purchasing Clerk', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Contract', 'Experienced Professional', 22000.00, 'Vehement Capital Partners', '7285469815', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Sat', '9AM-8PM', '6', 'Curabitur ac pulvinar elit, Mudra', '1 Years', 'Bachelors', 'Corporate finance,Problem solving,Communication', 'upload/images/category/Category/Finance/Untitled-2 copy.jpg', 1686594600, 1),
(24, 1, 1, 13, 'Controller', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Full Time', 'public accountant', 30000.00, 'Acme Corporation', '7878953216', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Sat', '9Am-7Pm', '2', 'viverra vulputate vitae odio, Bangalore', '3 Years', 'PHD/Doctorate', 'Time management,Critical thinking', 'upload/images/category/Category/Accounting/Untitled-2 copy.jpg', 1686594600, 1),
(25, 1, 3, 15, 'Civil engineer', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Contract', 'Entry Level', 12000.00, 'Soylent Corp', '9223564516', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Sat', '9Am-6Pm', '15', 'Aenean tristique porta massa, Delhi', '1 Years', 'Bachelors', 'Project management,Creativity,Teamwork', 'upload/images/category/Category/Engineering/Untitled-2 copy.jpg', 0, 1),
(26, 1, 11, 8, 'Health Services Manager', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pretium nunc non justo placerat pulvinar. Vestibulum ac ullamcorper sapien, nec scelerisque ipsum. Aliquam in tempus nulla. Curabitur ac pulvinar elit. Donec sed iaculis lorem. Duis at fermentum odio, ut mattis risus. Mauris molestie mi a dignissim eleifend. Nam sit amet facilisis odio, ac ornare quam. Donec a arcu at leo interdum viverra vulputate vitae odio. Aliquam erat volutpat. Vivamus aliquam interdum ex a condimentum. Sed mollis maximus cursus. Aenean vitae malesuada tellus. Aenean tristique porta massa. Fusce at nisl vitae dui consectetur pharetra. Praesent non ipsum dui.</p>', 'Full Time', 'Certification Addiction', 15000.00, 'Globex Check-Up', '9564851269', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Sun', '9Am-10Pm', '10', 'Donec sed iaculis lorem, Gandhinagar', '1 Years', 'MPhil/MS', 'Patience,Decision-making,Time managemen', 'upload/images/category/Category/Health Care/536465.jpg', 1686594600, 1),
(27, 15, 3, 16, 'Chemical engineer', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>', 'Internship', 'Engineer', 12000.00, 'Syska Hennessy Group', '8546225622', 'viaviwebtech@gmail.com', 'http://viaviweb.com/', 'Mon-Sat', '9Am-6Pm', '12', 'Latin literature from 45 BC, Ahmedabad', '1 Years', 'Bachelors', 'Communication,Creativity', 'upload/15-afea85ee5aaf9acef5f5f8cb46ee6eac.jpg', 1686594600, 1),
(28, 15, 11, 9, 'Medical technologist', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \\\"de Finibus Bonorum et Malorum\\\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'Full Time', 'Nurse practitioners', 15000.00, 'Living Proof Health', '9452365412', 'info@viaviweb.com', 'http://viaviweb.com/', 'Mon-Sun', '9Am-7Pm', '3', 'accompanied by English, Amreli', '1 Years', 'MPhil/MS', 'Communication,Positive attitude,Time management', 'upload/15-0dbc44def11af82b6d7d1d23ef527005.jpg', 1686594600, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `status`) VALUES
(1, 'Mumbai', 1),
(2, 'Kolkata', 1),
(3, 'London', 1),
(4, 'Morbi', 1),
(5, 'Mudra', 1),
(6, 'kutch', 1),
(7, 'jaipur', 1),
(8, 'Gandhinagar', 1),
(9, 'Amreli', 1),
(10, 'Morbi', 1),
(11, 'Rajkot', 1),
(12, 'Other', 1),
(13, 'Bangalore', 1),
(14, 'Vadodara', 1),
(15, 'Delhi', 1),
(16, 'Ahmedabad', 1),
(17, 'Surat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_title` varchar(500) NOT NULL,
  `page_slug` varchar(500) NOT NULL,
  `page_content` text NOT NULL,
  `page_order` int(3) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_title`, `page_slug`, `page_content`, `page_order`, `status`) VALUES
(1, 'About Us', 'about-us', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\\"Lorem ipsum dolor sit amet..\\\", comes from a line in section 1.10.32.</p>', 1, 1),
(2, 'Terms Of Use', 'terms-of-use', '<p><strong>Use of this site is provided by Demos subject to the following Terms and Conditions:</strong><br />1. Your use constitutes acceptance of these Terms and Conditions as at the date of your first use of the site.<br />2. Demos reserves the rights to change these Terms and Conditions at any time by posting changes online. Your continued use of this site after changes are posted constitutes your acceptance of this agreement as modified.<br />3. You agree to use this site only for lawful purposes, and in a manner which does not infringe the rights, or restrict, or inhibit the use and enjoyment of the site by any third party.<br />4. This site and the information, names, images, pictures, logos regarding or relating to Demos are provided &ldquo;as is&rdquo; without any representation or endorsement made and without warranty of any kind whether express or implied. In no event will Demos be liable for any damages including, without limitation, indirect or consequential damages, or any damages whatsoever arising from the use or in connection with such use or loss of use of the site, whether in contract or in negligence.<br />5. Demos does not warrant that the functions contained in the material contained in this site will be uninterrupted or error free, that defects will be corrected, or that this site or the server that makes it available are free of viruses or bugs or represents the full functionality, accuracy and reliability of the materials.<br />6. Copyright restrictions: please refer to our Creative Commons license terms governing the use of material on this site.<br />7. Demos takes no responsibility for the content of external Internet Sites.<br />8. Any communication or material that you transmit to, or post on, any public area of the site including any data, questions, comments, suggestions, or the like, is, and will be treated as, non-confidential and non-proprietary information.<br />9. If there is any conflict between these Terms and Conditions and rules and/or specific terms of use appearing on this site relating to specific material then the latter shall prevail.<br />10. These terms and conditions shall be governed and construed in accordance with the laws of England and Wales. Any disputes shall be subject to the exclusive jurisdiction of the Courts of England and Wales.<br />11. If these Terms and Conditions are not accepted in full, the use of this site must be terminated immediately.</p>', 2, 1),
(3, 'Privacy Policy', 'privacy-policy', '<h4><strong>Privacy Policy of&nbsp;<span class=\\\"highlight preview_company_name\\\">Company Name</span></strong></h4>\r\n<p><span class=\\\"highlight preview_company_name\\\">Company Name</span>&nbsp;operates the&nbsp;<span class=\\\"highlight preview_website_name\\\">Website Name</span>&nbsp;website, which provides the SERVICE.</p>\r\n<p>This page is used to inform website visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service, the&nbsp;<span class=\\\"highlight preview_website_name\\\">Website Name</span>&nbsp;website.</p>\r\n<p>If you choose to use our Service, then you agree to the collection and use of information in relation with this policy. The Personal Information that we collect are used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p>\r\n<p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at&nbsp;<span class=\\\"highlight preview_website_url\\\">Website URL</span>, unless otherwise defined in this Privacy Policy.</p>\r\n<h4><strong>Information Collection and Use</strong></h4>\r\n<p>For a better experience while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to your name, phone number, and postal address. The information that we collect will be used to contact or identify you.</p>\r\n<h4><strong>Log Data</strong></h4>\r\n<p>We want to inform you that whenever you visit our Service, we collect information that your browser sends to us that is called Log Data. This Log Data may include information such as your computer\\\'s Internet Protocol (&ldquo;IP&rdquo;) address, browser version, pages of our Service that you visit, the time and date of your visit, the time spent on those pages, and other statistics.</p>\r\n<h4><strong>Cookies</strong></h4>\r\n<p>Cookies are files with small amount of data that is commonly used an anonymous unique identifier. These are sent to your browser from the website that you visit and are stored on your computer\\\'s hard drive.</p>\r\n<p>Our website uses these &ldquo;cookies&rdquo; to collection information and to improve our Service. You have the option to either accept or refuse these cookies, and know when a cookie is being sent to your computer. If you choose to refuse our cookies, you may not be able to use some portions of our Service.</p>\r\n<h4><strong>Service Providers</strong></h4>\r\n<p>We may employ third-party companies and individuals due to the following reasons:</p>\r\n<ul>\r\n<li>To facilitate our Service</li>\r\n<li>To provide the Service on our behalf</li>\r\n<li>To perform Service-related services or</li>\r\n<li>To assist us in analyzing how our Service is used.</li>\r\n</ul>\r\n<p>We want to inform our Service users that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>\r\n<h4><strong>Security</strong></h4>\r\n<p>We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>\r\n<h4><strong>Links to Other Sites</strong></h4>\r\n<p>Our Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>\r\n<p>Children\\\'s Privacy</p>\r\n<p>Our Services do not address anyone under the age of 13. We do not knowingly collect personal identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.</p>\r\n<h4><strong>Changes to This Privacy Policy</strong></h4>\r\n<p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.</p>\r\n<h4><strong>Contact Us</strong></h4>\r\n<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>', 3, 1),
(4, 'Delete Account Instruction', 'delete-account-instruction', '<p>Delete Account</p>\r\n<p>Mail me on= info@gmail.com</p>', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(6, 'kuldip.viaviweb@gmail.com', '$2y$10$NQjCzfikdyJDnCbZV/62C.vozwqfqFZgoxsFQG1wFkbSIuR0lBOzW', '2022-11-22 06:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway`
--

CREATE TABLE `payment_gateway` (
  `id` int(11) NOT NULL,
  `gateway_name` varchar(255) NOT NULL,
  `gateway_info` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_gateway`
--

INSERT INTO `payment_gateway` (`id`, `gateway_name`, `gateway_info`, `status`) VALUES
(1, 'Paypal', '{\"mode\":\"sandbox\",\"braintree_merchant_id\":\"6kymhgsxb5f8tgry\",\"braintree_public_key\":\"dptng2rn836c5thw\",\"braintree_private_key\":\"f5f9deb391a23f4a0c8ebe9de2047c05\",\"braintree_merchant_account_id\":\"ViaviWebTechGBP2\"}', 1),
(2, 'Stripe', '{\"stripe_secret_key\":\"sk_test_IYZ3m5d9AWPCI8ohIUeItQQv\",\"stripe_publishable_key\":\"pk_test_H168acspefs1XLs4nFyBNWBc\"}', 1),
(3, 'Razorpay', '{\"razorpay_key\":\"rzp_test_3Xn9o5IRWFjKR4\",\"razorpay_secret\":\"9GExgEs8mWk2j5b8KswuNzIx\"}', 1),
(4, 'Paystack', '{\"paystack_secret_key\":\"sk_test_b3a005e485d55c4dc47696c29f27705918f98a15\",\"paystack_public_key\":\"pk_test_03ee87c23e8815638f5c4ef582aca392e8b3c39b\"}', 1),
(6, 'PayUMoney', '{\"mode\":\"sandbox\",\"payu_merchant_id\":\"1\",\"payu_key\":\"oZ7oo9\",\"payu_salt\":\"UkojH5TS\"}', 1),
(8, 'Flutterwave', '{\"flutterwave_public_key\":null,\"flutterwave_secret_key\":null,\"flutterwave_encryption_key\":null}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_ratings`
--

CREATE TABLE `post_ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `rate` int(1) NOT NULL,
  `review_text` text DEFAULT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_ratings`
--

INSERT INTO `post_ratings` (`id`, `user_id`, `post_id`, `post_type`, `rate`, `review_text`, `date`) VALUES
(5, 3, 1, 'Book', 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1677236539),
(7, 3, 2, 'Book', 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 1677749392);

-- --------------------------------------------------------

--
-- Table structure for table `post_views`
--

CREATE TABLE `post_views` (
  `id` bigint(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `post_views` int(11) NOT NULL DEFAULT 0,
  `post_download` int(11) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_views`
--

INSERT INTO `post_views` (`id`, `post_id`, `post_type`, `post_views`, `post_download`, `date`) VALUES
(2, 1, 'Jobs', 2, 0, 1679250600);

-- --------------------------------------------------------

--
-- Table structure for table `recent_view`
--

CREATE TABLE `recent_view` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recent_view`
--

INSERT INTO `recent_view` (`id`, `user_id`, `post_id`) VALUES
(1, 18, 1),
(2, 18, 2),
(3, 18, 3),
(4, 18, 4),
(5, 27, 2),
(6, 27, 3),
(7, 27, 1),
(8, 28, 1),
(9, 28, 3),
(10, 29, 1),
(11, 30, 5),
(12, 30, 3),
(13, 30, 6),
(14, 30, 8),
(15, 30, 13),
(16, 30, 2),
(17, 30, 1),
(18, 30, 21),
(19, 30, 10),
(20, 30, 22),
(21, 18, 13),
(22, 27, 7);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `time_zone` varchar(255) NOT NULL DEFAULT 'UTC',
  `default_language` varchar(255) NOT NULL DEFAULT 'en',
  `currency_code` varchar(255) NOT NULL DEFAULT 'USD',
  `admin_logo` varchar(255) DEFAULT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_company` varchar(255) DEFAULT NULL,
  `app_website` varchar(255) DEFAULT NULL,
  `app_contact` varchar(255) DEFAULT NULL,
  `app_version` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `smtp_email` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `smtp_encryption` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `google_play_link` varchar(255) DEFAULT NULL,
  `apple_store_link` varchar(255) DEFAULT NULL,
  `onesignal_app_id` varchar(255) DEFAULT NULL,
  `onesignal_rest_key` varchar(255) DEFAULT NULL,
  `app_update_hide_show` varchar(255) NOT NULL DEFAULT 'true',
  `app_update_version_code` varchar(255) DEFAULT NULL,
  `app_update_desc` varchar(255) DEFAULT NULL,
  `app_update_link` varchar(255) DEFAULT NULL,
  `app_update_cancel_option` varchar(255) NOT NULL DEFAULT 'true',
  `pagination_limit` int(3) NOT NULL DEFAULT 10,
  `envato_buyer_name` varchar(255) DEFAULT NULL,
  `envato_purchase_code` varchar(255) DEFAULT NULL,
  `app_package_name` varchar(255) DEFAULT NULL,
  `netsocks_on_off` varchar(255) NOT NULL DEFAULT 'on',
  `netsocks_publisher_key` varchar(255) DEFAULT NULL,
  `netsocks_consent` varchar(255) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `time_zone`, `default_language`, `currency_code`, `admin_logo`, `app_name`, `app_email`, `app_logo`, `app_company`, `app_website`, `app_contact`, `app_version`, `smtp_host`, `smtp_port`, `smtp_email`, `smtp_password`, `smtp_encryption`, `facebook_link`, `twitter_link`, `instagram_link`, `youtube_link`, `google_play_link`, `apple_store_link`, `onesignal_app_id`, `onesignal_rest_key`, `app_update_hide_show`, `app_update_version_code`, `app_update_desc`, `app_update_link`, `app_update_cancel_option`, `pagination_limit`, `envato_buyer_name`, `envato_purchase_code`, `app_package_name`, `netsocks_on_off`, `netsocks_publisher_key`, `netsocks_consent`) VALUES
(1, 'Asia/Kolkata', 'en', 'USD', 'upload/jobs_app_logo.png', 'Android Jobs App', 'info@viavilab.com', 'upload/Jobs_Icon_Square.png', 'VIAVIWEB', 'www.viaviweb.com', '+91 9227777522', '1.0.0', 'smtp.gmail.com', '465', '', '', 'SSL', 'https://facebook.com/viaviweb', 'https://twitter.com/viaviwebtech', 'https://instagram.com/viaviwebtech', 'https://youtube.com/viaviwebtech', '#gp', '#ap', '1a5c4fd0-2d25-4c23-a794-2dd117d3dc87', 'ZWFiNzY4ZDItMWVmYi00YjMyLWFlM2UtYWFiZTEyM2RhNDU0', 'false', '1', 'Please update new app', 'https://google.com', 'true', 10, '', '', 'com.example.jobs', 'on', NULL, 'off');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan`
--

CREATE TABLE `subscription_plan` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `plan_days` int(11) NOT NULL,
  `plan_duration` varchar(255) NOT NULL,
  `plan_duration_type` varchar(255) NOT NULL,
  `plan_price` decimal(11,2) NOT NULL,
  `plan_type` varchar(255) NOT NULL,
  `plan_job_limit` int(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subscription_plan`
--

INSERT INTO `subscription_plan` (`id`, `plan_name`, `plan_days`, `plan_duration`, `plan_duration_type`, `plan_price`, `plan_type`, `plan_job_limit`, `status`) VALUES
(1, 'Free Plan', 1, '1', '1', 0.00, 'Seeker', 2, 1),
(2, 'Basic Plan', 7, '7', '1', 10.00, 'Provider', 2, 1),
(3, 'Premium Plan', 30, '1', '30', 29.00, 'Seeker', 10, 1),
(4, 'Platinum Plan', 365, '1', '365', 99.00, 'Provider', 50, 1),
(7, 'Free', 1, '1', '1', 0.00, 'Provider', 1, 1),
(8, 'Platinum Plan', 365, '1', '365', 99.00, 'Seeker', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `gateway` varchar(255) NOT NULL,
  `payment_amount` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `email`, `plan_id`, `gateway`, `payment_amount`, `payment_id`, `date`) VALUES
(1, 4, 'testsocial@gmail.com', 1, 'Paypal', '10.00', 'xyz', 1677315758),
(2, 3, 'kuldip.viaviweb@gmail.com', 1, 'Paypal', '0.00', 'xyz', 1683176314),
(3, 18, 'kelvin.viaviweb@gmail.com', 1, 'N/A', '0.00', '-', 1683179328),
(4, 18, 'kelvin.viaviweb@gmail.com', 2, 'Razorpay', '10.00', 'pay_LlU1LdoKeU56sf', 1683180941),
(5, 18, 'kelvin.viaviweb@gmail.com', 2, 'Stripe', '10.00', 'pi_1N3vSVG6oS1iXMRb5GDXdej7', 1683181022),
(6, 18, 'kelvin.viaviweb@gmail.com', 2, 'PayUMoney', '10.00', '1683181033747', 1683181106),
(7, 18, 'kelvin.viaviweb@gmail.com', 2, 'Paypal', '10.00', 'PAYID-MRJU5AI7PD11197P1726921A', 1683181222),
(8, 26, 'sample@provider.com', 7, 'N/A', '0.00', '-', 1686289011),
(9, 27, 'viaviwebtech@gmail.com', 3, 'Razorpay', '29.00', 'pay_M16pHUdHYJ9M8S', 1686592700),
(10, 28, 'test@gmail.com', 1, 'N/A', '0.00', '-', 1686630175),
(11, 29, 'kelvin.dadava@gmail.com', 1, 'N/A', '0.00', '-', 1686634684);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usertype` varchar(255) DEFAULT 'User',
  `social_login_type` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `date_of_birth` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `current_company` varchar(255) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `company_working_day` varchar(255) DEFAULT NULL,
  `company_working_time` varchar(255) DEFAULT NULL,
  `company_info` text DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `plan_id` int(2) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `exp_date` int(11) DEFAULT NULL,
  `plan_amount` float(11,2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `confirmation_code` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `session_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `social_login_type`, `google_id`, `facebook_id`, `name`, `email`, `password`, `phone`, `city`, `address`, `date_of_birth`, `gender`, `current_company`, `skills`, `experience`, `resume`, `company_website`, `company_working_day`, `company_working_time`, `company_info`, `user_image`, `plan_id`, `start_date`, `exp_date`, `plan_amount`, `status`, `confirmation_code`, `remember_token`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, 'Viavi Webtech', 'admin@admin.com', '$2y$10$iurhWQOmnZjaYjtFEKLLueNW1Vmb6Q7vZ4Dfoqsr.C1Qp.ZLr1J7y', '9227777522', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'viavi-webtech-1f2416ecff3faba4159de6b399477081-b.jpg', NULL, NULL, NULL, NULL, 1, NULL, 'YyvjnZc71kYwvCqtIRXART3JLP4ZptFQ8eJJkffWwgRlRMlf4iQHBH4LOtf3', 'iXL5Efee1FhfiXQzxPTe2PzEfFqU3seM3b6TzvU7', '2020-03-10 19:16:45', '2023-06-13 12:00:05'),
(3, 'User', NULL, NULL, NULL, 'Kuldip Viaviweb', 'kuldip.viaviweb@gmail.com', '$2y$10$wIkbCWx3rWE/woXnCR5LYO9404wjeOAfyS6l0U58Mqbh5lQCQ1aw.', '987456111', 'Rajkot', 'RJ', 674418600, 'Male', 'Viaviweb', 'Laravel', '2 Years', 'upload/resume/1682156284_LiveStream.png', NULL, NULL, NULL, NULL, NULL, 1, 1683138600, 1683225000, 0.00, 1, NULL, NULL, NULL, '2023-02-21 11:37:28', '2023-05-03 18:00:40'),
(15, 'Company', NULL, NULL, NULL, 'Viaviwebtech', 'info@viaviweb.com', '$2y$10$BUcmNA57/w2cWaLasld32uGx0LZJcKSWEdDL/k2zEXSMnxue6WTaG', '9236541233', 'Rajkot', '3rd Floor, Shyam Complex, Parivar Park, Near Mayani Chowk, Rajkot-360005', NULL, NULL, NULL, NULL, NULL, NULL, 'http://www.viaviweb.com', 'Mon-Sat', '9 AM - 6 PM', '<p>Viavi Webtech have extensive experience in web design and development, graphic design, mobile application development and online marketing.<br /><br />We contribute to one another&rsquo;s thoughts, ideas and pull together our passion and dedication to give our clients the very best quality of our work to maintain our reputation.</p>', 'viaviwebtech-75baa296b4b26430de4d85188736ebae-b.jpg', 4, NULL, 1693420200, NULL, 1, NULL, NULL, NULL, '2023-04-02 06:48:20', '2023-06-13 01:02:06'),
(22, 'Company', NULL, NULL, NULL, 'Google', 'mail@gmail.com', '$2y$10$ffXsb9QXYBRA9gQRC78qkOYmeKDvbnzHec07qCswqMuITxB0vqxua', '9876543210', 'Bangalore', 'Phase 1', NULL, NULL, NULL, NULL, NULL, NULL, 'https://google.com', 'Mon-Fri', '9AM-5PM', '', 'google-24812c9410f6e41689b3cc9b7a09bc0f-b.jpg', 1, NULL, 1685039400, NULL, 1, NULL, NULL, NULL, '2023-05-24 23:53:37', '2023-05-25 00:31:02'),
(23, 'Company', NULL, NULL, NULL, 'Facebook', 'mail@facebook.com', '$2y$10$jRGrYUR/R.JobqRXgXc99u5SjOINDZAFOPXxZYHEYQgKUBU3cIKXW', '9876541230', 'Pune', 'Phase 2', NULL, NULL, NULL, NULL, NULL, NULL, 'https://facebook.com', 'Mon-Fri', '9AM-5PM', '', 'facebook-e7ee3d1f916dd303c7f8d2f88c8ca7d8-b.jpg', 1, NULL, 1685039400, NULL, 1, NULL, NULL, NULL, '2023-05-24 23:54:19', '2023-05-25 00:30:54'),
(27, 'User', 'google', '102004158600731021225', NULL, 'VIAVI WEB', 'viaviwebtech@gmail.com', '$2y$10$eLxL4ZK6xgwxVQ3h/IlNIOaI7Yd2yyUM53bBggIIEPsjZbMGULp4O', '9876543210', 'RJ', 'Parivar Park', -19800, 'male', 'ViaviWebTech ', 'Your Current Skills', '3 Yr', NULL, NULL, NULL, NULL, NULL, 'viavi-web-5f08bd2a168306d486f544fe504e1a98-b.jpg', 3, 1686508200, 1689100200, 29.00, 1, NULL, NULL, NULL, '2023-06-12 02:03:51', '2023-06-13 19:21:26'),
(30, 'User', NULL, NULL, NULL, 'Test', 'test@gmail.com', '$2y$10$HFGMqk5A0DIZ06drNLpZCeMbv1RfNhFQnFFJsehKrFg48RDyEAOTC', '9876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2023-06-12 19:03:11', '2023-06-12 19:03:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_users`
--
ALTER TABLE `applied_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_ads`
--
ALTER TABLE `app_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_ratings`
--
ALTER TABLE `post_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recent_view`
--
ALTER TABLE `recent_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `applied_users`
--
ALTER TABLE `applied_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `app_ads`
--
ALTER TABLE `app_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_ratings`
--
ALTER TABLE `post_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post_views`
--
ALTER TABLE `post_views`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recent_view`
--
ALTER TABLE `recent_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_plan`
--
ALTER TABLE `subscription_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
