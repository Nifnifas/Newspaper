

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- Sukurta duomenų struktūra lentelei `users`

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `articles` (
`article_id` INT(3) NOT NULL AUTO_INCREMENT ,
`category` INT(2) NOT NULL ,
`title` VARCHAR(50) NOT NULL ,
`text` TEXT NOT NULL ,
`fk_user_id` varchar(32),
PRIMARY KEY (`article_id`),
FOREIGN KEY (`fk_user_id`) REFERENCES users(`userid`)
) ENGINE = MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `categories` (
`category_id` INT(2) NOT NULL AUTO_INCREMENT,
`title` VARCHAR(15) NOT NULL,
PRIMARY KEY (category_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `sender_id` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_article_id` INT(3),
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`fk_article_id`) REFERENCES articles(`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('Valdytojas', '16c354b68848cdbd8f54a226a0a55b21', '7ed2b87b255a0348b61226bd7c2ed5b4', 5, 'demo@ktu.lt', 1330553708),
('Administratorius', '16c354b68848cdbd8f54a226a0a55b21', 'a2fe399900de341c39c632244eaf8483', 9, 'demo@ktu.lt', 1330553956),
('Vartotojas', '16c354b68848cdbd8f54a226a0a55b21', '9a47f4552955b91bcd8850d73b00e703', 1, 'demo@ktu.lt', 1330553730);
