
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
  `photo` varchar(200),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `desp` text NOT NULL,
  `leader` int(11) NOT NULL,
  `photo` varchar(200), 
  KEY `leader` (`leader`),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`leader`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `members` (
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`gid`, `uid`),
  KEY `gid` (`gid`),
  KEY `uid` (`uid`),
  FOREIGN KEY (`gid`) REFERENCES `groups` (`id`),
  FOREIGN KEY (`uid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desp` text NOT NULL,
  `gid` int(11) NOT NULL,
  KEY `gid` (`gid`),
  PRIMARY KEY (`id`),
  FOREIGN KEY(`gid`) REFERENCES `groups` (`id`)   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `workers` (
  `uid` int(11) NOT NULL,
  `wid` int(11) NOT NULL,
  PRIMARY KEY(`uid`, `wid`),
  KEY `uid` (`uid`),
  KEY `wid` (`wid`),
  FOREIGN KEY(`uid`) REFERENCES `users` (`id`),
  FOREIGN KEY(`wid`) REFERENCES `works` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`),
  FOREIGN KEY(`gid`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `assigns` (
  `sid` int(11) NOT NULL,
  `wid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`sid`, `wid`, `uid`),
  KEY `uid` (`uid`),
  KEY `wid` (`wid`),
  KEY `sid` (`sid`),
  FOREIGN KEY(`uid`) REFERENCES `users` (`id`),
  FOREIGN KEY(`wid`) REFERENCES `works` (`id`),
  FOREIGN KEY(`sid`) REFERENCES `schedules` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
