SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `avatar` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`,'username','email')
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `threads` (
  `threadId` int(11) NOT NULL AUTO_INCREMENT,
  `tDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic` varchar(1000) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `tag` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `noAnswers` int(11) NOT NULL,
  PRIMARY KEY (`threadId`),

  FOREIGN KEY (userId) REFERENCES users(id) 


) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `cDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL,
  `threadId` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`commentId`),
  FOREIGN KEY (userId) REFERENCES users(id) ,
  FOREIGN KEY (threadId) REFERENCES threads(threadId) 
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
