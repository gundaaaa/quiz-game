-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-12 09:29:26
-- サーバのバージョン： 10.4.17-MariaDB
-- PHP のバージョン: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `quiz`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_12_15_125910_crate_quiz_choice_table', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `quiz_choice`
--

CREATE TABLE `quiz_choice` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `miss` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `quiz_choice`
--

INSERT INTO `quiz_choice` (`id`, `text`, `answer`, `miss`) VALUES
(1, '見出しを付ける（大見出し）', 'h1タグ', 'h2タグ'),
(2, '見出しをつける（小見出し）', 'h6タグ', 'h3タグ'),
(3, 'ひとつの段落であることを表す', 'pタグ', 'trタグ'),
(4, '一つのセクションであることを示す', 'sectionタグ', 'footerタグ'),
(5, 'ナビゲーションであることを示す', 'navタグ', 'sectionタグ'),
(6, 'テーマや話題の区切り', 'hrタグ', 'liタグ'),
(7, '順序のないリストを表示する', 'ulタグ', 'aタグ'),
(8, '順序のあるリストを表示する', 'olタグ', 'divタグ'),
(9, 'リストの項目を記述する', 'liタグ', 'brタグ'),
(10, 'ひとかたまりの範囲として定義する', 'divタグ', 'tableタグ'),
(11, '改行する', 'brタグ', 'h1タグ'),
(12, '画像を表示する', 'imgタグ', 'h6タグ'),
(13, 'テーブル（表）を作成する', 'tableタグ', 'trタグ'),
(14, 'テーブル（表）のヘッダ部分を定義する', 'theadタグ', 'tdタグ'),
(15, 'テーブル（表）のフッタ部分を定義する', 'footタグ', 'inputタグ'),
(16, 'テーブル（表）の横一行を定義する', 'trタグ', 'linkタグ'),
(17, 'テーブル（表）のデータセルを作成する', 'tdタグ', 'baseタグ'),
(18, 'テーブル（表）の見出しセルを作成する', 'thタグ', 'titelタグ'),
(19, '入力・送信フォームを作る', 'formタグ', 'headタグ'),
(20, 'フォーム部品と項目名（ラベル）を関連付ける', 'labelタグ', 'htmlタグ'),
(21, 'フォームを構成する様々な入力部品を作成する', 'inputタグ', 'textareaタグ'),
(22, 'ボタンを作成する', 'buttonタグ', 'selectタグ'),
(23, 'セレクトボックスを作成する', 'selectタグ', 'buttonタグ'),
(24, 'セレクトボックスや入力候補リストの選択肢を指定する', 'optionタグ', 'thタグ'),
(25, '複数行のテキスト入力欄を作成する', 'textareaタグ', 'inputタグ'),
(26, 'ドキュメントタイプを宣言する', 'DOCTYPE html　', 'theadタグ'),
(27, 'HTML文書であることを示す', 'htmlタグ', 'formタグ'),
(28, '文書のヘッダ情報を表す', 'headタグ', 'brタグ'),
(29, '文書にタイトルをつける', 'titelタグ', 'imgタグ'),
(30, '相対パスの基準URIを指定する', 'baseタグ', 'tableタグ'),
(31, 'リンクする外部リソースを指定する', 'linkタグ', 'theadタグ');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `quiz_choice`
--
ALTER TABLE `quiz_choice`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `quiz_choice`
--
ALTER TABLE `quiz_choice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
