-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 10.123.0.36:3306
-- Generation Time: Dec 02, 2019 at 11:23 AM
-- Server version: 5.7.15
-- PHP Version: 7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fornet_H`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `title`, `keywords`) VALUES
(1574626762, 'Coca Cola', 'Energy Drink', ''),
(1574626813, 'မားမား', 'ခေါက်ဆွဲ', ''),
(1574626923, 'LINC', 'စာရေးကိရိယာ', ''),
(1574673759, 'Johnnie Walker', 'whisky', ''),
(1574674114, 'calvin klein', 'wallet', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `c_price` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `stock_id`, `user_id`, `number`, `c_price`, `order_id`) VALUES
(1574956969, 1574852541, 3, 1, 22000, 1574957010),
(1574956978, 1574852557, 3, 1, 12000, 1574957010),
(1574965430, 1574852442, 1, 5, 0, 0),
(1575012049, 1574852183, 1, 3, 0, 0),
(1575036924, 1574852367, 1, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cat_1`
--

CREATE TABLE `cat_1` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_1`
--

INSERT INTO `cat_1` (`id`, `name`, `description`, `keywords`) VALUES
(1574626184, 'စားသောက်စရာများ', 'စားစရာ သောက်စရာများ ကို အချိန်နှင့်တစ်ပြေးညီ ပို့ပြီ', 'food drinks eat breakfast dinner lunck snack ညစာ နေ့လည်စာ '),
(1574626253, 'ရုံးသုံးကျောင်းသုံးပစ္စည်း', 'ရုံးသုံးကျောင်းသုံးပစ္စည်း များ ကို အချိန်နှင့်တစ်ပြေးညီ ပို့ပြီ', 'pen pencil desk '),
(1574674987, 'အသုံးအဆောင်', 'အသုံးအဆောင်', 'အသုံးအဆောင်');

-- --------------------------------------------------------

--
-- Table structure for table `cat_2`
--

CREATE TABLE `cat_2` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `cat_1_id` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_2`
--

INSERT INTO `cat_2` (`id`, `name`, `cat_1_id`) VALUES
(1574626288, 'စားစရာများ', 'cat_1_1574626184END'),
(1574626322, 'သောက်စရာများ', 'cat_1_1574626184END'),
(1574626347, 'စာရေးကိရိယာ', 'cat_1_1574626253END'),
(1574626368, 'ပရိဘောဂ', 'cat_1_1574626253END'),
(1574675788, 'အိတ် အမျိုးမျိုး', 'cat_1_1574674987END'),
(1574676178, 'fashion', 'cat_1_1574674987END');

-- --------------------------------------------------------

--
-- Table structure for table `cat_3`
--

CREATE TABLE `cat_3` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `cat_2_id` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_3`
--

INSERT INTO `cat_3` (`id`, `name`, `cat_2_id`, `keywords`) VALUES
(1574626415, 'ရိုးရာမုန့်များ', 'cat_2_1574626288END', 'မွင်းခါး'),
(1574626460, 'အအေး', 'cat_2_1574626322END', 'အာခြောက်တယ်'),
(1574626488, 'ယမကာ', 'cat_2_1574626322END', 'ပါးစပ်ချဉ်တယ်'),
(1574626523, 'ခဲတံ ဘောပင်', 'cat_2_1574626347END', '.'),
(1574626537, 'စာအုပ်', 'cat_2_1574626347END', '.'),
(1574626559, 'ကျောပိုးအိတ်(ကျောင်း)', 'cat_2_1574626347END', '.'),
(1574626578, 'ကွန်ပျူတာခုံ', 'cat_2_1574626368END', '.'),
(1574626586, 'ပင်ကာ', 'cat_2_1574626368END', '.'),
(1574626596, 'အဲယားကွန်း', 'cat_2_1574626368END', '.'),
(1574676284, 'ခရီးဆောင်အိတ်အမျိုးမျိုး', 'cat_2_1574675788END', 'ခရီးဆောင်အိတ်အမျိုးမျိုး'),
(1574676315, 'လက်ကိုင်အိတ်', 'cat_2_1574675788END', 'အိတ် slim bad '),
(1574676339, 'ကျောပိုးအိတ်', 'cat_2_1574675788END', 'အိတ် backpack '),
(1574676367, 'ဖိနပ်', 'cat_2_1574676178END', 'shose');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `tag_cat_3` text COLLATE utf8_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT '11111111',
  `rating` int(11) NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `description`, `tag_cat_3`, `brand_id`, `rating`, `keywords`) VALUES
(1574627077, 'CocaCola အအေးစုံ', 'အရမ်းကောင်း .', 'cat_3_1574626460END', 1574626762, 2, 'coca ကိုကာ ကိုလာ ကိုကာကိုလာ'),
(1574674707, 'Red Label', 'Johnnie Walker Red Label is our Pioneer Blend, the one that has introduced our whisky to the world. Highly versatile and with universal appeal, it has a bold, characterful flavour that shines through even when mixed. Johnnie Walker Red Label is now the best-selling Scotch Whisky around the globe. Perfect for parties and get-togethers, at home or going out. Enjoy with friends.', 'cat_3_1574626488END', 1574673759, 1, 'red lebel'),
(1574674796, 'GOLD LABEL RESERVE', 'Johnnie Walker Gold Label Reserve is the perfect blend for an indulgent celebration. Luxurious, creamy and honeyed, it is a wonderful tribute to the harmonious partnership of Speyside and Highland Whiskies, with just a hint of smouldering embers from the West Coast. Johnnie Walker Gold Label Reserve is made for those unforgettable nights out with amazing friends.', 'cat_3_1574626488END', 1574673759, 0, 'go lebel'),
(1574674843, 'BLACK LABEL', 'Johnnie Walker Black Label is a true icon, recognised as the benchmark for all other deluxe blends. Created using only whiskies aged for a minimum of 12 years from the four corners of Scotland, Johnnie Walker Black Label has an unmistakably smooth, deep, complex character. An impressive whisky to share on any occasion, whether you&#039;re entertaining at home with friends or on a memorable night out.', 'cat_3_1574626488END', 1574673759, 0, 'black lebel'),
(1574676484, 'red backpack', 'A bag is a common tool in the form of a non-rigid container. The use of bags predates recorded history, with the earliest bags being no more than lengths of animal skin, cotton, or woven plant fibers, folded up at the edges and secured in that shape with strings of the same material.', 'cat_3_1574676339END', 1111111, 1, 'bag'),
(1574676500, 'school girl', 'A bag is a common tool in the form of a non-rigid container. The use of bags predates recorded history, with the earliest bags being no more than lengths of animal skin, cotton, or woven plant fibers, folded up at the edges and secured in that shape with strings of the same material.', 'cat_3_1574626559END', 1111111, 1, 'bag'),
(1574676521, 'light boy', 'A bag is a common tool in the form of a non-rigid container. The use of bags predates recorded history, with the earliest bags being no more than lengths of animal skin, cotton, or woven plant fibers, folded up at the edges and secured in that shape with strings of the same material.', 'cat_3_1574676339END', 1111111, 1, 'bag'),
(1574676596, 'CK Brown', 'A wallet is a small, flat case that can be used to carry such small personal items as cash, credit cards, and identification documents, photographs, transit pass, gift cards, business cards and other paper or laminated cards.', 'cat_3_1574676315END', 1574674114, 1, 'ပိုက်ဆံအိတ်'),
(1574677025, 'luggage', 'Baggage or luggage consists of bags, cases, and containers which hold a traveller&#039;s personal articles while the traveler is in transit. A modern traveller can be expected to have packages containing clothing, toiletries, small possessions, trip necessities. On the return trip, travellers may have souvenirs and gifts.', 'cat_3_1574676284END', 1111111, 0, 'baggage'),
(1574677032, 'luggage', 'Baggage or luggage consists of bags, cases, and containers which hold a traveller&#039;s personal articles while the traveler is in transit. A modern traveller can be expected to have packages containing clothing, toiletries, small possessions, trip necessities. On the return trip, travellers may have souvenirs and gifts.', 'cat_3_1574676284END', 1111111, 0, 'baggage'),
(1574677040, 'luggage', 'Baggage or luggage consists of bags, cases, and containers which hold a traveller&#039;s personal articles while the traveler is in transit. A modern traveller can be expected to have packages containing clothing, toiletries, small possessions, trip necessities. On the return trip, travellers may have souvenirs and gifts.', 'cat_3_1574676284END', 1111111, 0, 'baggage'),
(1574677052, 'luggage', 'Baggage or luggage consists of bags, cases, and containers which hold a traveller&#039;s personal articles while the traveler is in transit. A modern traveller can be expected to have packages containing clothing, toiletries, small possessions, trip necessities. On the return trip, travellers may have souvenirs and gifts.', 'cat_3_1574676284END', 1111111, 0, 'baggage'),
(1574677236, 'Shose', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion. The design of shoes has varied enormously through time and from culture to culture, with appearance originally being tied to function.', 'cat_3_1574676367END', 1111111, 1, 'shose'),
(1574677245, 'Shose', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion. The design of shoes has varied enormously through time and from culture to culture, with appearance originally being tied to function.', 'cat_3_1574676367END', 1111111, 0, 'shose'),
(1574677252, 'Shose', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion. The design of shoes has varied enormously through time and from culture to culture, with appearance originally being tied to function.', 'cat_3_1574676367END', 1111111, 0, 'shose'),
(1574677260, 'Shose', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion. The design of shoes has varied enormously through time and from culture to culture, with appearance originally being tied to function.', 'cat_3_1574676367END', 1111111, 0, 'shose'),
(1574677269, 'Shose', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion. The design of shoes has varied enormously through time and from culture to culture, with appearance originally being tied to function.', 'cat_3_1574676367END', 1111111, 0, 'shose');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `theDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `address_code` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `theDate`, `user_id`, `name`, `phone`, `address_code`, `address`, `status`) VALUES
(1574957010, '2019-11-28 16:03:30', 3, 'AungMinOo', '095107567', 0, 'သန္လ်င္', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`item_id`, `user_id`) VALUES
(1574674707, 1),
(1574627077, 1),
(1574677236, 1),
(1574676484, 1),
(1574676521, 1),
(1574627077, 5),
(1574676500, 5),
(1574676596, 5);

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE `site_info` (
  `id` int(11) NOT NULL,
  `target` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `target`, `data`) VALUES
(1, 'name', 'H'),
(2, 'title', 'online mart');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `size` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `original_price` int(11) NOT NULL,
  `old_price` int(11) NOT NULL,
  `new_price` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `size`, `original_price`, `old_price`, `new_price`, `item_id`) VALUES
(1574627146, '250 ml', 500, 700, 650, 1574627077),
(1574851887, 'Bar Nyar', 20000, 30000, 27000, 1574677269),
(1574851946, 'White 3Line', 20000, 25000, 20000, 1574677269),
(1574851993, 'Origynal', 30000, 32000, 33000, 1574677260),
(1574852035, 'Yellow', 20000, 25000, 14000, 1574677252),
(1574852066, 'dark blue', 30000, 32000, 32000, 1574677245),
(1574852099, 'brown', 30000, 40000, 38000, 1574677236),
(1574852144, 'အလတ်စား', 40000, 50000, 48000, 1574677052),
(1574852183, 'အသေး', 20000, 25000, 26000, 1574677040),
(1574852204, 'အလတ်', 30000, 35000, 36000, 1574677040),
(1574852227, 'အကြီး', 35000, 40000, 38000, 1574677040),
(1574852263, 'အကြီး', 40000, 48000, 45000, 1574677032),
(1574852306, 'အစုံ', 57000, 70000, 65000, 1574677025),
(1574852342, 'အညို', 10000, 16000, 15000, 1574676596),
(1574852367, 'blue', 20000, 25000, 24000, 1574676521),
(1574852399, 'red', 15000, 18000, 17000, 1574676500),
(1574852413, 'blue', 15000, 18000, 18000, 1574676500),
(1574852442, 'red', 10000, 16000, 14000, 1574676484),
(1574852475, '1000 ml', 20000, 25000, 24000, 1574674843),
(1574852509, '1000 ml', 20000, 28000, 26000, 1574674796),
(1574852541, '1000 ml', 20000, 24000, 22000, 1574674707),
(1574852557, '600 ml', 10000, 14000, 12000, 1574674707);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `verify` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `password`, `level`, `verify`) VALUES
(1, 'ဟိန်းစိုး', '09252152447', '123456789', 3, 'verify'),
(3, 'Aung Min Oo', '095107567', '11223344', 3, 'verify'),
(4, 'Kyaw Aye Maung', '09421727699', '123456', 1, 'verify'),
(5, 'Zin Mar Hlaing', '09424608915', '12345678', 1, 'verify');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_1`
--
ALTER TABLE `cat_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_2`
--
ALTER TABLE `cat_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_3`
--
ALTER TABLE `cat_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `target` (`target`(255));

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`(255));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
