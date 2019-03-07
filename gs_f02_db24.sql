-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 3 月 07 日 08:57
-- サーバのバージョン： 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_f02_db24`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bookImgURL` text COLLATE utf8_unicode_ci,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `yourCmt` text COLLATE utf8_unicode_ci NOT NULL,
  `score` int(1) NOT NULL,
  `review` text COLLATE utf8_unicode_ci,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `title`, `bookImgURL`, `author`, `url`, `comment`, `yourCmt`, `score`, `review`, `image`, `indate`) VALUES
(70, 'ごはんごはん', 'http://books.google.com/books/content?id=eG0ItAEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '視覚デザイン研究所', 'http://books.google.co.jp/books?id=eG0ItAEACAAJ&dq=intitle:%E3%81%94%E3%81%AF%E3%82%93&hl=&source=gbs_api', '主役はお米。子供の健康な感情を育てる視覚デザインのえほん。ひとりでよむ、4さい~。いっしょによむ、1さい~。', '白米', 4, NULL, NULL, '2019-03-07 16:22:06'),
(71, 'たまごにいちゃんとたまごねえちゃん', 'http://books.google.com/books/content?id=4DpYMQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 'あきやまただし', 'http://books.google.co.jp/books?id=4DpYMQAACAAJ&dq=intitle:%E3%81%9F%E3%81%BE%E3%81%94&hl=&source=gbs_api', '', 'たまごたべよう', 4, 'とても食べたくなりました。', NULL, '2019-03-07 16:28:03'),
(72, '「お金の流れ」はこう変わった! 松本大のお金の新法則', 'http://books.google.com/books/content?id=ylQfDxxOETsC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '松本大', 'https://play.google.com/store/books/details?id=ylQfDxxOETsC&source=gbs_api', 'ソロモンブラザースとゴールドマンサックスで大成功した超一流トレーダーでもある松本大氏が初めて執筆するお金の流れそのものの話。キイワードは「人口ベース経済への回帰」。産業革命後、情報と技術の偏在によって起きた世界のGDP分布の偏りが、人口の大きさに比例する方向、つまり産業革命以前の形へ回帰し始めたのだ。', '￥￥￥￥￥￥￥￥￥￥￥￥￥￥￥', 4, '＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃', NULL, '2019-03-07 17:32:08'),
(73, 'ダ・ヴィンチ・コードの謎を解く', 'http://books.google.com/books/content?id=umGwlttA4W8C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'サイモンコックス', 'https://play.google.com/store/books/details?id=umGwlttA4W8C&source=gbs_api', '『ダ・ヴィンチ・コード』の謎を真実と小説に分けて解明したガイドブック。聖杯伝説、キリストの結婚の有無、最後の晩餐の秘密に迫る!', 'よみたい', 1, '上書きしちゃうよ', NULL, '2019-03-07 17:36:07'),
(74, '衣服改良運動と服装改善運動', 'http://books.google.com/books/content?id=txBOAQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '夫馬佳代子', 'http://books.google.co.jp/books?id=txBOAQAAIAAJ&dq=intitle:%E9%81%8B%E5%8B%95&hl=&source=gbs_api', '', '運動', 0, '００００', NULL, '2019-03-07 17:41:52'),
(75, 'マックミラン高校女子硬式野球部（２）', 'http://books.google.com/books/content?id=Hl3HBQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '須賀達郎', 'https://play.google.com/store/books/details?id=Hl3HBQAAQBAJ&source=gbs_api', '女子硬式野球部のマネージャーは、超家庭派男子・正清大地（まさきよ・だいち）。母のような広い心で、部員たちをマネージメントする、ゆるゆるほんわかな女子野球4コマ……なのですが、舞台は全国大会に突入！ 正清の加入で成長著しいマックミラン高校の、全国制覇を懸けた真剣勝負が始まる！！ 新感覚“野球愛”ショート＆4コマ！！', 'よまん', 4, 'みらん', NULL, '2019-03-07 17:50:01'),
(76, 'アルカトラズ島/サンフランシスコ', 'http://books.google.com/books/content?id=AN3WFRRscq8C&printsec=frontcover&img=1&zoom=1&source=gbs_api', '芦刈いづみ', 'http://books.google.co.jp/books?id=AN3WFRRscq8C&dq=intitle:%E3%82%B5%E3%83%B3%E3%83%95%E3%83%A9%E3%83%B3%E3%82%B7%E3%82%B9%E3%82%B3&hl=&source=gbs_api', 'アルカトラズ島は、サンフランシスコ沖に浮かぶ島です。かつては刑務所として使われていて、今はそのまま観光地化されています。島へのアクセスは船のみ。刑務所は、セルフガイドのオーディオツアーで自由に回ることができます。(総合情報サイト「All About」に2011年05月19日に掲載された情報を書籍化しました)', 'いこう', 5, 'さいこうやね', NULL, '2019-03-07 17:52:25');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`, `indate`) VALUES
(22, 'oeeo', 'opopopo', '@@@@@@', 0, 1, '2019-02-14 01:38:22'),
(35, 'まにあうか', '1', '1', 0, 1, '2019-02-14 13:12:16'),
(66, '課題やる', 'kadai', 'kadai', 0, 0, '2019-02-24 20:50:46'),
(68, 'おなかへった', 'hetta', 'hetta', 0, 0, '2019-02-27 16:52:41'),
(70, '管理者', 'kanri', 'kanri', 1, 0, '2019-02-28 00:56:34'),
(78, 'あなざわさん', 'ana', 'ana', 0, 0, '2019-03-04 16:28:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
