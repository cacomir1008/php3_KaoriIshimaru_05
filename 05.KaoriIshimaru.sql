-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 4 月 08 日 18:47
-- サーバのバージョン： 5.7.32
-- PHP のバージョン: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_friends_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_family_table`
--

CREATE TABLE `gs_family_table` (
  `family_id` int(12) NOT NULL,
  `friend_id` int(12) NOT NULL,
  `partner_name` varchar(64) NOT NULL,
  `child1_name` varchar(64) NOT NULL,
  `child1_bd` date NOT NULL,
  `child2_name` varchar(64) NOT NULL,
  `child2_bd` date NOT NULL,
  `family_comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_family_table`
--

INSERT INTO `gs_family_table` (`family_id`, `friend_id`, `partner_name`, `child1_name`, `child1_bd`, `child2_name`, `child2_bd`, `family_comment`) VALUES
(6, 2, '雪菜', '翠', '2018-03-03', '泰平', '2019-04-06', 'お家でお会いした'),
(7, 3, '太郎', '恵奈', '2018-03-01', '仁奈', '2019-04-05', '誕生日会でお会いした'),
(8, 4, 'William', '---', '2021-04-07', '---', '2021-04-07', '妊娠中'),
(9, 5, 'スネ子', 'すね美', '1997-03-04', 'すね太郎', '2000-04-08', '子供服はバーバリーのみ'),
(10, 6, 'じゃい美', '---', '2021-04-07', '---', '2021-04-07', '2020年結婚'),
(11, 7, '恵理菜', '有希', '2018-03-02', '武彦', '2019-04-06', '有希ちゃんの誕生祝いにスタイをプレゼント済み'),
(12, 8, 'ジャイ夫', 'ジャイ美', '2021-03-03', '---', '2000-04-07', 'ジャイ美ちゃんにまだ会えてない'),
(13, 9, '禰豆子', '禰子', '2021-04-04', '豆太', '2021-04-04', '双子誕生！');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_friend_table`
--

CREATE TABLE `gs_friend_table` (
  `friend_id` int(12) NOT NULL,
  `id` int(12) NOT NULL,
  `friend_fname` varchar(64) NOT NULL,
  `friend_lname` varchar(64) NOT NULL,
  `friend_bd` date NOT NULL,
  `friend_status` varchar(20) NOT NULL,
  `friend_location` varchar(20) NOT NULL,
  `friend_comment` varchar(300) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_friend_table`
--

INSERT INTO `gs_friend_table` (`friend_id`, `id`, `friend_fname`, `friend_lname`, `friend_bd`, `friend_status`, `friend_location`, `friend_comment`, `life_flg`) VALUES
(2, 1, 'Simon', 'Berger', '1986-04-27', 'married', '神奈川', '2020年に結婚', 0),
(3, 1, '恵理菜', '石川', '1987-07-30', 'married', '山形', '大学クラスメート', 0),
(4, 1, '康子', '三木', '1987-07-30', 'Choose Status', 'NewYork', '', 1),
(5, 2, '骨皮', 'すね夫', '1985-02-28', 'married', 'Tokyo', '実業家として活躍中', 0),
(6, 2, '武', '剛田', '1985-06-15', 'Choose Status', 'Chiba', 'お見合いを頑張っている', 0),
(7, 1, '光彦', '武田', '1984-03-03', 'married', '香港', '2021年、東京に戻ってくるらしい', 0),
(8, 2, 'ジャイ子', '剛田', '1990-09-03', 'married', 'Tokyo', '2020年にしずかとお家に遊びに行った/2021年、ついに結婚！', 0),
(9, 5, '善逸', '我妻', '1990-09-05', 'married', '丙', '戦友！', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_id` varchar(128) NOT NULL,
  `user_pw` varchar(64) NOT NULL,
  `life_flg` int(1) NOT NULL DEFAULT '0',
  `kanri_flg` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `user_name`, `user_id`, `user_pw`, `life_flg`, `kanri_flg`) VALUES
(1, 'Caori', 'caori_test', 'test', 0, 1),
(2, '野比のび太', 'nobita_test', 'test', 0, 0),
(3, 'アリス', 'alice_test', 'test', 1, 0),
(4, 'Elizabeth', 'Elizabeth_test', 'test', 1, 1),
(5, '竈門 炭治郎', 'kamado_test', 'test', 0, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_family_table`
--
ALTER TABLE `gs_family_table`
  ADD PRIMARY KEY (`family_id`);

--
-- テーブルのインデックス `gs_friend_table`
--
ALTER TABLE `gs_friend_table`
  ADD PRIMARY KEY (`friend_id`);

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_family_table`
--
ALTER TABLE `gs_family_table`
  MODIFY `family_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `gs_friend_table`
--
ALTER TABLE `gs_friend_table`
  MODIFY `friend_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
