-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 20 2018 г., 20:22
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `calculator`
--

-- --------------------------------------------------------

--
-- Структура таблицы `calculator`
--

CREATE TABLE `calculator` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_edited` datetime NOT NULL,
  `data` text NOT NULL,
  `submitted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `calculator`
--

INSERT INTO `calculator` (`id`, `user_id`, `date_added`, `date_edited`, `data`, `submitted`) VALUES
(1, 4, '2018-10-19 19:36:27', '2018-10-19 19:52:58', '{\"c2\":\"\",\"e2\":\"\",\"c3\":\"\",\"e3\":\"\",\"c4\":\"\",\"e4\":\"\",\"c9\":\"\",\"d9\":\"\",\"e9\":\"\",\"c10\":\"\",\"d10\":\"\",\"e10\":\"\",\"c11\":\"\",\"d11\":\"\",\"e11\":\"\",\"c12\":\"\",\"d12\":\"\",\"e12\":\"\",\"c17\":\"\",\"c18\":\"\",\"c19\":\"\",\"d17\":\"\",\"d18\":\"\",\"d19\":\"\",\"e17\":\"\",\"e18\":\"\",\"e19\":\"\",\"c21\":\"\",\"c22\":\"\",\"c23\":\"\",\"d22\":\"\",\"d23\":\"\",\"d24\":\"\",\"e22\":\"\",\"e23\":\"\",\"e24\":\"\",\"c25\":\"\",\"c26\":\"\",\"c27\":\"\",\"d27\":\"\",\"d28\":\"\",\"d29\":\"\",\"e27\":\"\",\"e28\":\"\",\"e29\":\"\",\"c34\":\"\",\"d34\":\"\",\"e34\":\"\",\"c35\":\"\",\"d35\":\"\",\"e35\":\"\",\"c36\":\"\",\"d36\":\"\",\"e36\":\"\",\"c37\":\"\",\"d37\":\"\",\"e37\":\"\",\"c41\":\"\",\"d41\":\"\",\"e41\":\"\",\"c42\":\"\",\"d42\":\"\",\"e42\":\"\",\"c43\":\"\",\"d43\":\"\",\"e43\":\"\",\"c45\":\"\",\"c46\":\"\",\"c47\":\"\",\"c48\":\"\",\"d45\":\"\",\"d46\":\"\",\"d47\":\"\",\"d48\":\"\",\"e45\":\"\",\"e46\":\"\",\"e47\":\"\",\"e48\":\"\",\"c49\":\"\",\"d49\":\"\",\"e49\":\"\",\"c50\":\"\",\"d50\":\"\",\"e50\":\"\",\"d54\":\"\",\"e54\":\"\",\"d55\":\"\",\"e55\":\"\",\"d56\":\"\",\"e56\":\"\",\"d57\":\"\",\"e57\":\"\",\"d58\":\"\",\"e58\":\"\",\"d59\":\"\",\"e59\":\"\",\"d60\":\"\",\"e60\":\"\",\"d64\":\"\",\"e64\":\"\",\"d65\":\"\",\"e65\":\"\",\"d66\":\"\",\"e66\":\"\",\"d67\":\"\",\"e67\":\"\",\"d68\":\"\",\"e68\":\"\",\"submit\":\"Submit\",\"f9\":0,\"f10\":0,\"f11\":0,\"f12\":0,\"d14\":0,\"e14\":0,\"f14\":0,\"f17\":0,\"f18\":0,\"f19\":0,\"d20\":0,\"e20\":0,\"f20\":0,\"f22\":0,\"f23\":0,\"f24\":0,\"d25\":0,\"e25\":0,\"f25\":0,\"f27\":0,\"f28\":0,\"f29\":0,\"d30\":0,\"e30\":0,\"f30\":0,\"d32\":0,\"e32\":0,\"f32\":0,\"f34\":0,\"f35\":0,\"f36\":0,\"f37\":0,\"d39\":0,\"e39\":0,\"f39\":0,\"f41\":0,\"f42\":0,\"f43\":0,\"f45\":0,\"f46\":0,\"f47\":0,\"f48\":0,\"f49\":0,\"f50\":0,\"d52\":0,\"e52\":0,\"f52\":0,\"f54\":0,\"f55\":0,\"f56\":0,\"f57\":0,\"f58\":0,\"f59\":0,\"f60\":0,\"d62\":0,\"e62\":0,\"f62\":0,\"f64\":0,\"f65\":0,\"f66\":0,\"f67\":0,\"f68\":0,\"d70\":0,\"e70\":0,\"f70\":0,\"d72\":0,\"e72\":0,\"f72\":0}', 1),
(2, 4, '2018-10-20 18:13:22', '2018-10-20 18:13:22', '{\"c2\":\"\",\"e2\":\"\",\"c3\":\"\",\"e3\":\"\",\"c4\":\"\",\"e4\":\"\",\"c9\":\"\",\"d9\":\"12\",\"e9\":\"2\",\"c10\":\"\",\"d10\":\"\",\"e10\":\"\",\"c11\":\"\",\"d11\":\"\",\"e11\":\"\",\"c12\":\"\",\"d12\":\"\",\"e12\":\"\",\"c17\":\"\",\"c18\":\"\",\"c19\":\"\",\"d17\":\"\",\"d18\":\"\",\"d19\":\"\",\"e17\":\"\",\"e18\":\"\",\"e19\":\"\",\"c21\":\"\",\"c22\":\"\",\"c23\":\"\",\"d22\":\"\",\"d23\":\"\",\"d24\":\"\",\"e22\":\"\",\"e23\":\"\",\"e24\":\"\",\"c25\":\"\",\"c26\":\"\",\"c27\":\"\",\"d27\":\"\",\"d28\":\"\",\"d29\":\"\",\"e27\":\"\",\"e28\":\"\",\"e29\":\"\",\"c34\":\"\",\"d34\":\"\",\"e34\":\"\",\"c35\":\"\",\"d35\":\"\",\"e35\":\"\",\"c36\":\"\",\"d36\":\"\",\"e36\":\"\",\"c37\":\"\",\"d37\":\"\",\"e37\":\"\",\"c41\":\"\",\"d41\":\"\",\"e41\":\"\",\"c42\":\"\",\"d42\":\"\",\"e42\":\"\",\"c43\":\"\",\"d43\":\"\",\"e43\":\"\",\"c45\":\"\",\"c46\":\"\",\"c47\":\"\",\"c48\":\"\",\"d45\":\"\",\"d46\":\"\",\"d47\":\"\",\"d48\":\"\",\"e45\":\"\",\"e46\":\"\",\"e47\":\"\",\"e48\":\"\",\"c49\":\"\",\"d49\":\"\",\"e49\":\"\",\"c50\":\"\",\"d50\":\"\",\"e50\":\"\",\"d54\":\"\",\"e54\":\"\",\"d55\":\"\",\"e55\":\"\",\"d56\":\"\",\"e56\":\"\",\"d57\":\"\",\"e57\":\"\",\"d58\":\"\",\"e58\":\"\",\"d59\":\"\",\"e59\":\"\",\"d60\":\"\",\"e60\":\"\",\"d64\":\"\",\"e64\":\"\",\"d65\":\"\",\"e65\":\"\",\"d66\":\"\",\"e66\":\"\",\"d67\":\"\",\"e67\":\"\",\"d68\":\"\",\"e68\":\"\",\"saveToDb\":\"Save to data base\",\"f9\":14,\"f10\":0,\"f11\":0,\"f12\":0,\"d14\":12,\"e14\":2,\"f14\":14,\"f17\":0,\"f18\":0,\"f19\":0,\"d20\":0,\"e20\":0,\"f20\":0,\"f22\":0,\"f23\":0,\"f24\":0,\"d25\":0,\"e25\":0,\"f25\":0,\"f27\":0,\"f28\":0,\"f29\":0,\"d30\":0,\"e30\":0,\"f30\":0,\"d32\":0,\"e32\":0,\"f32\":0,\"f34\":0,\"f35\":0,\"f36\":0,\"f37\":0,\"d39\":0,\"e39\":0,\"f39\":0,\"f41\":0,\"f42\":0,\"f43\":0,\"f45\":0,\"f46\":0,\"f47\":0,\"f48\":0,\"f49\":0,\"f50\":0,\"d52\":0,\"e52\":0,\"f52\":0,\"f54\":0,\"f55\":0,\"f56\":0,\"f57\":0,\"f58\":0,\"f59\":0,\"f60\":0,\"d62\":0,\"e62\":0,\"f62\":0,\"f64\":0,\"f65\":0,\"f66\":0,\"f67\":0,\"f68\":0,\"d70\":0,\"e70\":0,\"f70\":0,\"d72\":12,\"e72\":2,\"f72\":14}', 0),
(3, 13, '2018-10-20 18:55:54', '2018-10-20 18:55:54', '{\"c2\":\"\",\"e2\":\"\",\"c3\":\"\",\"e3\":\"\",\"c4\":\"\",\"e4\":\"\",\"c9\":\"\",\"d9\":\"1\",\"e9\":\"2\",\"c10\":\"\",\"d10\":\"\",\"e10\":\"\",\"c11\":\"\",\"d11\":\"\",\"e11\":\"\",\"c12\":\"\",\"d12\":\"\",\"e12\":\"\",\"c17\":\"\",\"c18\":\"\",\"c19\":\"\",\"d17\":\"\",\"d18\":\"\",\"d19\":\"\",\"e17\":\"\",\"e18\":\"\",\"e19\":\"\",\"c21\":\"\",\"c22\":\"\",\"c23\":\"\",\"d22\":\"\",\"d23\":\"\",\"d24\":\"\",\"e22\":\"\",\"e23\":\"\",\"e24\":\"\",\"c25\":\"\",\"c26\":\"\",\"c27\":\"\",\"d27\":\"\",\"d28\":\"\",\"d29\":\"\",\"e27\":\"\",\"e28\":\"\",\"e29\":\"\",\"c34\":\"\",\"d34\":\"\",\"e34\":\"\",\"c35\":\"\",\"d35\":\"\",\"e35\":\"\",\"c36\":\"\",\"d36\":\"\",\"e36\":\"\",\"c37\":\"\",\"d37\":\"\",\"e37\":\"\",\"c41\":\"\",\"d41\":\"\",\"e41\":\"\",\"c42\":\"\",\"d42\":\"\",\"e42\":\"\",\"c43\":\"\",\"d43\":\"\",\"e43\":\"\",\"c45\":\"\",\"c46\":\"\",\"c47\":\"\",\"c48\":\"\",\"d45\":\"\",\"d46\":\"\",\"d47\":\"\",\"d48\":\"\",\"e45\":\"\",\"e46\":\"\",\"e47\":\"\",\"e48\":\"\",\"c49\":\"\",\"d49\":\"\",\"e49\":\"\",\"c50\":\"\",\"d50\":\"\",\"e50\":\"\",\"d54\":\"\",\"e54\":\"\",\"d55\":\"\",\"e55\":\"\",\"d56\":\"\",\"e56\":\"\",\"d57\":\"\",\"e57\":\"\",\"d58\":\"\",\"e58\":\"\",\"d59\":\"\",\"e59\":\"\",\"d60\":\"\",\"e60\":\"\",\"d64\":\"\",\"e64\":\"\",\"d65\":\"\",\"e65\":\"\",\"d66\":\"\",\"e66\":\"\",\"d67\":\"\",\"e67\":\"\",\"d68\":\"\",\"e68\":\"\",\"saveToDb\":\"Save to data base\",\"f9\":3,\"f10\":0,\"f11\":0,\"f12\":0,\"d14\":1,\"e14\":2,\"f14\":3,\"f17\":0,\"f18\":0,\"f19\":0,\"d20\":0,\"e20\":0,\"f20\":0,\"f22\":0,\"f23\":0,\"f24\":0,\"d25\":0,\"e25\":0,\"f25\":0,\"f27\":0,\"f28\":0,\"f29\":0,\"d30\":0,\"e30\":0,\"f30\":0,\"d32\":0,\"e32\":0,\"f32\":0,\"f34\":0,\"f35\":0,\"f36\":0,\"f37\":0,\"d39\":0,\"e39\":0,\"f39\":0,\"f41\":0,\"f42\":0,\"f43\":0,\"f45\":0,\"f46\":0,\"f47\":0,\"f48\":0,\"f49\":0,\"f50\":0,\"d52\":0,\"e52\":0,\"f52\":0,\"f54\":0,\"f55\":0,\"f56\":0,\"f57\":0,\"f58\":0,\"f59\":0,\"f60\":0,\"d62\":0,\"e62\":0,\"f62\":0,\"f64\":0,\"f65\":0,\"f66\":0,\"f67\":0,\"f68\":0,\"d70\":0,\"e70\":0,\"f70\":0,\"d72\":1,\"e72\":2,\"f72\":3}', 0),
(4, 1, '2018-10-20 19:16:53', '2018-10-20 19:16:53', '{\"c2\":\"\",\"e2\":\"\",\"c3\":\"\",\"e3\":\"\",\"c4\":\"\",\"e4\":\"\",\"c9\":\"\",\"d9\":\"1\",\"e9\":\"2\",\"c10\":\"\",\"d10\":\"\",\"e10\":\"\",\"c11\":\"\",\"d11\":\"\",\"e11\":\"\",\"c12\":\"\",\"d12\":\"\",\"e12\":\"\",\"c17\":\"\",\"c18\":\"\",\"c19\":\"\",\"d17\":\"\",\"d18\":\"\",\"d19\":\"\",\"e17\":\"\",\"e18\":\"\",\"e19\":\"\",\"c21\":\"\",\"c22\":\"\",\"c23\":\"\",\"d22\":\"\",\"d23\":\"\",\"d24\":\"\",\"e22\":\"\",\"e23\":\"\",\"e24\":\"\",\"c25\":\"\",\"c26\":\"\",\"c27\":\"\",\"d27\":\"\",\"d28\":\"\",\"d29\":\"\",\"e27\":\"\",\"e28\":\"\",\"e29\":\"\",\"c34\":\"\",\"d34\":\"\",\"e34\":\"\",\"c35\":\"\",\"d35\":\"\",\"e35\":\"\",\"c36\":\"\",\"d36\":\"\",\"e36\":\"\",\"c37\":\"\",\"d37\":\"\",\"e37\":\"\",\"c41\":\"\",\"d41\":\"\",\"e41\":\"\",\"c42\":\"\",\"d42\":\"\",\"e42\":\"\",\"c43\":\"\",\"d43\":\"\",\"e43\":\"\",\"c45\":\"\",\"c46\":\"\",\"c47\":\"\",\"c48\":\"\",\"d45\":\"\",\"d46\":\"\",\"d47\":\"\",\"d48\":\"\",\"e45\":\"\",\"e46\":\"\",\"e47\":\"\",\"e48\":\"\",\"c49\":\"\",\"d49\":\"\",\"e49\":\"\",\"c50\":\"\",\"d50\":\"\",\"e50\":\"\",\"d54\":\"\",\"e54\":\"\",\"d55\":\"\",\"e55\":\"\",\"d56\":\"\",\"e56\":\"\",\"d57\":\"\",\"e57\":\"\",\"d58\":\"\",\"e58\":\"\",\"d59\":\"\",\"e59\":\"\",\"d60\":\"\",\"e60\":\"\",\"d64\":\"\",\"e64\":\"\",\"d65\":\"\",\"e65\":\"\",\"d66\":\"\",\"e66\":\"\",\"d67\":\"\",\"e67\":\"\",\"d68\":\"\",\"e68\":\"\",\"saveToDb\":\"Save to data base\",\"f9\":3,\"f10\":0,\"f11\":0,\"f12\":0,\"d14\":1,\"e14\":2,\"f14\":3,\"f17\":0,\"f18\":0,\"f19\":0,\"d20\":0,\"e20\":0,\"f20\":0,\"f22\":0,\"f23\":0,\"f24\":0,\"d25\":0,\"e25\":0,\"f25\":0,\"f27\":0,\"f28\":0,\"f29\":0,\"d30\":0,\"e30\":0,\"f30\":0,\"d32\":0,\"e32\":0,\"f32\":0,\"f34\":0,\"f35\":0,\"f36\":0,\"f37\":0,\"d39\":0,\"e39\":0,\"f39\":0,\"f41\":0,\"f42\":0,\"f43\":0,\"f45\":0,\"f46\":0,\"f47\":0,\"f48\":0,\"f49\":0,\"f50\":0,\"d52\":0,\"e52\":0,\"f52\":0,\"f54\":0,\"f55\":0,\"f56\":0,\"f57\":0,\"f58\":0,\"f59\":0,\"f60\":0,\"d62\":0,\"e62\":0,\"f62\":0,\"f64\":0,\"f65\":0,\"f66\":0,\"f67\":0,\"f68\":0,\"d70\":0,\"e70\":0,\"f70\":0,\"d72\":1,\"e72\":2,\"f72\":3}', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `department`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$G2rYrRaKmN8.3eF6R7s8Fe6WfOAB3CB5EsJdygdxfTk3Zsb3adns6', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `calculator`
--
ALTER TABLE `calculator`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `calculator`
--
ALTER TABLE `calculator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
