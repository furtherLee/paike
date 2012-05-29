
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `password` varchar(80) NOT NULL,
  `birthday` date NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` varchar(80) NOT NULL,
  `iter` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `users` (`id`, `email`, `name`, `sex`, `password`, `create_time`, `salt`, `iter`, `birthday`) VALUES
(1, 'test@paike.com', 'test', '男', 'c23fd1ab5aa572349eb30e15d0437ee3', '2012-05-29 10:39:41', '4a37a7266e9a19cbe63e7ce5bca07ebc', 9, '2012-05-29');

