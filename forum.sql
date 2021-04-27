-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 07:14 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addNewComment` (IN `description_` VARCHAR(100), IN `userId_` INT, IN `threadId_` INT)  BEGIN
INSERT INTO comments ( description,userId, threadId,votes) VALUES (description_,userId_ ,threadId_,0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addNewThread` (IN `topic_` VARCHAR(100), IN `summary_` VARCHAR(100), IN `tag_` VARCHAR(100), IN `user_Id` INT(11))  BEGIN
INSERT INTO threads ( topic,summary, tag, userId,votes,views,noAnswers) VALUES (topic_,summary_ ,tag_,user_Id, 0,0,0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteComment` (IN `commentId_` INT(11))  BEGIN
DELETE from comments where commentId = commentId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteThread` (IN `threadId_` INT(11))  BEGIN
DELETE from threads where threadId = threadId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserDetails` (IN `user_Id` INT(11))  BEGIN
SELECT * FROM userview where id = user_Id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `preUpdateViewComment` (IN `user_Id` INT, IN `commentId_` INT)  BEGIN
SELECT * FROM comments where userId = user_Id and commentId = commentId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `preUpdateViewThread` (IN `user_Id` INT(11), IN `threadId_` INT(11))  BEGIN
SELECT * FROM threads where userId = user_Id and threadId = threadId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registerUser` (IN `user_name` VARCHAR(100), IN `name_` VARCHAR(100), IN `email_` VARCHAR(100), IN `password_` VARCHAR(100), IN `avatar_` VARCHAR(100))  BEGIN
DECLARE userId INT;
INSERT INTO users (username) VALUES (user_name);
SELECT extractUserId(user_name) into userId;
INSERT INTO usersprofile (id,name,email, password, avatar) VALUES (userId,name_ ,email_,password_, avatar_);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `retriveMyThreadsAcctoDate` (IN `user_Id` INT(11), IN `duration` VARCHAR(100))  BEGIN
IF duration = 'all' THEN
		SELECT * from threads where userId = user_Id;
ELSEIF duration = 'Last Week' THEN
	SELECT * from threads where userId = user_Id and DATEDIFF(CURRENT_TIMESTAMP , tDateTime) <= 7;
ELSEIF duration = 'Last Month' THEN
	SELECT * from threads where userId = user_Id and DATEDIFF(CURRENT_TIMESTAMP , tDateTime) <= 30;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sortAcc` (IN `type` VARCHAR(100), IN `way` VARCHAR(100))  BEGIN
IF type = 'rating' THEN
	IF way = 'ascend' THEN
		SELECT * from threads ORDER by votes ASC;
    ELSE
    	SELECT * from threads ORDER by votes DESC;
    END IF;
ELSEIF type = 'views' THEN
	IF way = 'ascend' THEN
		SELECT * from threads ORDER by views ASC;
    ELSE
    	SELECT * from threads ORDER by views DESC;
    END IF;
ELSEIF type = 'time' THEN
	IF way = 'ascend' THEN
		SELECT * from threads ORDER by tDateTime ASC;
    ELSE
    	SELECT * from threads ORDER by tDateTime DESC;
    END IF;
ELSEIF type = 'noOfComments' THEN
	IF way = 'ascend' THEN
		SELECT * from threads ORDER by noAnswers ASC;
    ELSE
    	SELECT * from threads ORDER by noAnswers DESC;
    END IF;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateComment` (IN `commentId_` INT(11), IN `description_` VARCHAR(100))  BEGIN
UPDATE comments SET description = description_  where commentId = commentId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateNoAnswers` (IN `threadId_` INT(11))  BEGIN
DECLARE ans INT; 
SELECT COUNT(*) INTO ans from comments WHERE threadId = threadId_;
UPDATE threads SET noAnswers = ans where threadId = threadId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateThread` (IN `threadId_` INT(11), IN `topic_` VARCHAR(100), IN `summary_` VARCHAR(100), IN `tag_` VARCHAR(100))  BEGIN
UPDATE threads SET topic = topic_ , summary = summary_ , tag = tag_  where threadId = threadId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateViews` (IN `threadId_` INT(11))  BEGIN
UPDATE threads SET views = views + 1  where threadId = threadId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewAllThreads` ()  BEGIN
	SELECT * from threads;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewCommentedThreads` (IN `user_Id` INT(11))  BEGIN
SELECT * FROM threads WHERE threadId in (Select threadId from comments where userid = user_Id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewComments` (IN `threadId_` INT)  BEGIN
SELECT * from comments where threadId = threadId_;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewMyThreads` (IN `user_Id` INT)  BEGIN
SELECT * from threads WHERE userId = user_Id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewThread` (IN `threadId_` INT(11))  BEGIN
SELECT * from threads where threadId = threadId_;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `checkCommentAutho` (`user_Id` INT(11), `commentId_` INT(11)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT COUNT(*) INTO ans from comments where userId = user_Id and commentId = commentId_;
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `checkThreadAutho` (`user_Id` INT(11), `threadId_` INT(11)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT COUNT(*) INTO ans from threads where userId = user_Id and threadId = threadId_;
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `checkUser` (`user_name` VARCHAR(100), `email_` VARCHAR(100)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT Count(*) INTO ans from userView where username = user_name or email = email_;
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `countCommentedThreads` (`user_Id` INT(11)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT COUNT(*) INTO ans from threads WHERE threadId in (Select threadId from comments where userid = user_Id);
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `countCommentsByUser` (`user_Id` INT(11)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT COUNT(*) INTO ans from comments where userId = user_Id;
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `countCommentsPerThreads` (`threadId_` INT(11)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT COUNT(*) INTO ans from comments WHERE threadId = threadId_;
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `countThreadsByUser` (`user_Id` INT(11)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT Count(*) INTO ans from threads where userId = user_Id;
RETURN ans;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `extractUserId` (`user_name` VARCHAR(100)) RETURNS INT(11) BEGIN
DECLARE userId INT;
SELECT id INTO userId from users where username = user_name;
RETURN userId;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `extractUsername` (`user_Id` INT(11)) RETURNS VARCHAR(100) CHARSET latin1 BEGIN
DECLARE user_name VARCHAR(100);
SELECT username INTO user_name from users where id = user_Id;
RETURN user_name;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `loginUser` (`user_name` VARCHAR(100), `email_` VARCHAR(100), `password_` VARCHAR(100)) RETURNS INT(11) BEGIN
DECLARE ans INT;
SELECT Count(*) INTO ans from userview where username = user_name and email = email_ and password = password_;
RETURN ans;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `cDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL,
  `threadId` int(11) NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `cDateTime`, `description`, `userId`, `threadId`, `votes`) VALUES
(7, '2021-04-10 19:28:36', ' sir may  give us Seminar', 1, 4, -2),
(12, '2021-04-15 13:47:00', 'WE IMPLEMENTED , PL/SQL', 1, 4, 5),
(27, '2021-04-17 07:50:06', 'UI OK!', 1, 22, 0),
(28, '2021-04-17 10:32:45', 'Checking all sections in admin', 19, 4, 4),
(29, '2021-04-22 14:24:04', 'Checking vomment', 1, 4, -1),
(32, '2021-04-26 08:44:47', 'Yes, You can use php functions for the same', 1, 46, 2),
(33, '2021-04-26 08:45:18', 'You can refer the documentation of Firebase', 1, 44, 0),
(34, '2021-04-26 08:49:01', '@GoodOldGaze, yeah but the question is can you help us or not?', 30, 46, 3),
(35, '2021-04-26 08:49:50', 'Update firebase messaging component', 30, 45, 0),
(36, '2021-04-26 08:50:25', 'The ctrl v + c isn\'t working ?', 30, 42, 0),
(37, '2021-04-26 08:54:33', 'Please search it ', 31, 38, 1),
(38, '2021-04-26 08:56:16', 'But, that is a fundamental before using it ', 32, 46, 2),
(39, '2021-04-26 08:59:41', 'Integrate the maven facilities', 33, 34, 0),
(40, '2021-04-26 09:03:01', 'We must submit our DBMS Project first and then focus on MIT Practicals', 34, 4, 0),
(41, '2021-04-26 09:04:57', 'Yes it is stored in the register', 34, 41, 0),
(42, '2021-04-26 09:05:17', 'But you can redirect it in to your memory', 34, 41, 0),
(43, '2021-04-26 09:06:14', 'you need to add path variable in your system', 35, 26, 0),
(44, '2021-04-26 09:06:59', 'The second method we give you the wrong answer because it does not check whole ararys', 35, 29, 0),
(45, '2021-04-26 09:10:50', 'You can divide your project files into small group of classes and functions', 39, 30, 0),
(47, '2021-04-26 09:12:02', 'Use math.org to create maths function or you may just add images', 39, 39, 0);

--
-- Triggers `comments`
--
DELIMITER $$
CREATE TRIGGER `decreasNoAnswer` AFTER DELETE ON `comments` FOR EACH ROW CALL updateNoAnswers(OLD.threadId)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteComments` BEFORE DELETE ON `comments` FOR EACH ROW DELETE from votecomment where votecomment.commentId = OLD.commentId
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `increaseNoAnswer` AFTER INSERT ON `comments` FOR EACH ROW CALL updateNoAnswers(NEW.threadId)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `commentuserview`
-- (See below for the actual view)
--
CREATE TABLE `commentuserview` (
`Comment` varchar(1000)
,`CommentedBy` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `commentvotesview`
-- (See below for the actual view)
--
CREATE TABLE `commentvotesview` (
`Comment` varchar(1000)
,`VotedBy` varchar(100)
,`Value` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `threadcommentsview`
-- (See below for the actual view)
--
CREATE TABLE `threadcommentsview` (
`Thread` varchar(1000)
,`Tag` varchar(20)
,`Comment` varchar(1000)
);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `threadId` int(11) NOT NULL,
  `tDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `topic` varchar(1000) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `tag` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `noAnswers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`threadId`, `tDateTime`, `topic`, `summary`, `tag`, `userId`, `votes`, `views`, `noAnswers`) VALUES
(4, '2021-04-09 18:48:11', 'Automata And Formal Languages', 'Mukesh Sir wants us to read more and more research papers', 'Research', 1, 4, 274, 5),
(10, '2021-04-15 10:40:29', 'Local host setup', 'How to setup phpMyadmin?', 'phymyadmin', 1, 3, 15, 0),
(22, '2021-04-16 18:21:52', 'Checking UI', 'Checking the relative position of UI', 'UI', 1, 1, 7, 1),
(23, '2021-04-17 10:07:48', 'Check', 'At this point,we have a pretty dam satisfactory comment thread.This design by itself can work for', 'check', 1, 0, 0, 0),
(24, '2021-04-17 10:32:10', 'Thread by a admin', 'Admin', 'adminThreads', 19, 2, 6, 0),
(26, '2021-04-26 08:10:19', 'not able to use console.log inside function', '\" I wrote the below code in there it executes hisorry.pushState but not executing the console.log(\"\"', 'javascript', 30, 2, 2, 1),
(27, '2021-04-26 08:11:35', 'Cannot load my own font in quasar framework', '\"Im building an application only for tablet and I want to use my own font in ttf format. How can I l', 'css', 30, 1, 0, 0),
(28, '2021-04-26 08:14:54', 'Record / Upload a fixed length video with progress bar using HTML5 and Javascript', '\"I am making a small project in HTML & Java-script, where a user can record a video and upload it to', 'html', 30, 1, 0, 0),
(29, '2021-04-26 08:15:52', 'Java - Finding unique elements in two different arrays', '\"But here I\'m getting [1,2,3,4] as output. But the expected output is [1,2,3,4,7,8]. I\'m not sure wh', 'java', 31, 1, 3, 1),
(30, '2021-04-26 08:16:24', 'What are the solutions (with pros and cons) for React nested multi providers', 'Recently I had a hard challenge, to refactor a big chunk of a project, that was left as a mess, afte', 'react', 31, 1, 3, 1),
(31, '2021-04-26 08:17:24', 'How to make locally pushed array global javascript', '\"I have array initially declared in global scope as an empty array then inside a function callback. ', 'javascript', 31, 1, 1, 0),
(32, '2021-04-26 08:18:51', 'Dropdown content displayed to the right column in masonry layout', 'I\'m using masonry layout to get two columns with different height elements in each of them. In the f', 'css', 32, 1, 0, 0),
(33, '2021-04-26 08:19:35', 'Is â€œ--â€ a valid CSS3 identifier?', '\"According the CSS Level 3 specification, for parsing the start of an identifier, you:  Check if thr', 'css', 32, 1, 0, 0),
(34, '2021-04-26 08:20:02', 'How to create a non-executable JAR file that includes all Maven dependencies', '\"I have a Java project that doesn\'t have a main file but it has a lot of Maven dependencies.  How I ', 'java', 32, 2, 4, 1),
(35, '2021-04-26 08:22:13', 'react Material-table unable to change each icon set color?', '\"I am using the material-table library and trying to change each icon color. Would you please help m', 'react', 33, 0, 0, 0),
(36, '2021-04-26 08:22:29', 'Printing return max from list', 'I need method which will return person with the highest salary. I can\'t use void method.', 'java', 33, 0, 0, 0),
(37, '2021-04-26 08:22:49', 'Wordpress : what is the best solution to convert to static files?', 'I have several Wordpress websites on my shared hosting. The result is that my ressources are often i', 'html', 33, 1, 0, 0),
(38, '2021-04-26 08:24:30', 'How to obtain Google Docs document identifier in Alternative Runtime Docs Add-on', '\"About a week ago the Alternative Runtime was released to the public (general documentation)  I am c', 'node', 36, 1, 5, 1),
(39, '2021-04-26 08:24:59', 'Trying to do math in .format', '\"It does the subtraction, but not the floor decision and adding  import discord from discord.ext imp', 'python', 36, 2, 2, 1),
(40, '2021-04-26 08:25:20', 'Parse arbitrary precision numbers with Boost spirit', 'I would like to write a Boost Spirit Qi parser that can parse arbitrary C integer literals (e.g. 123', 'c++', 36, 1, 0, 0),
(41, '2021-04-26 08:27:05', 'Reusing output from last command in Bash', '\"Is the output of a Bash command stored in any register? E.g. something similar to $? capturing the ', 'terminal', 37, 2, 5, 2),
(42, '2021-04-26 08:27:21', 'How can I copy the output of a command directly into my clipboard?', 'How can I pipe the output of a command into my clipboard and paste it back when using a terminal? ', 'shell', 37, 3, 5, 1),
(44, '2021-04-26 08:29:46', 'How to delete Image saved on Firestorage inside a login area in Flutter?', '\"I have a registration area in which the user can choose a profile picture, among other things. If t', 'flutter', 39, 3, 4, 1),
(45, '2021-04-26 08:30:54', 'firebase messaging component is not present in android studio', '\"Getting error firebase messaging component is not present in android studio. I am using updated fir', 'androidStudio', 38, 4, 4, 1),
(46, '2021-04-26 08:31:13', 'Is there a way to create a â€œLibraries We Useâ€ page from composer?', '\"I am developing a proprietary php project, which is using several open source packages.  Is there a', 'php', 38, 7, 28, 3);

--
-- Triggers `threads`
--
DELIMITER $$
CREATE TRIGGER `deleteRelatedComments` BEFORE DELETE ON `threads` FOR EACH ROW DELETE from comments where comments.threadId = OLD.threadId
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `deleteThreads` BEFORE DELETE ON `threads` FOR EACH ROW DELETE from votethread where votethread.threadId = OLD.threadId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `threaduserview`
-- (See below for the actual view)
--
CREATE TABLE `threaduserview` (
`Thread` varchar(1000)
,`Tag` varchar(20)
,`PostedBy` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `threadvotesview`
-- (See below for the actual view)
--
CREATE TABLE `threadvotesview` (
`Thread` varchar(1000)
,`Tag` varchar(20)
,`VotedBy` varchar(100)
,`Value` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`) VALUES
(1, 'GoodOldGaze'),
(19, 'admin'),
(30, 'harryPotter'),
(31, 'hermioneGringer'),
(32, 'ronWeasley'),
(33, 'ginneWeasley'),
(34, 'alubusDumbeldore'),
(35, 'ruberousSnape'),
(36, 'dracoMalfoy'),
(37, 'neivelleLongbottom'),
(38, 'georgeWeasley'),
(39, 'percyWeasley'),
(40, 'modern1234');

-- --------------------------------------------------------

--
-- Table structure for table `usersprofile`
--

CREATE TABLE `usersprofile` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersprofile`
--

INSERT INTO `usersprofile` (`id`, `email`, `name`, `password`, `avatar`) VALUES
(1, 'parvapatel2571@gmail.com', 'Parva Patel', '25f9e794323b453885f5181f1b624d0b', 'images/DSCN0846.JPG'),
(19, 'admin@dforum.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'images/admin.png'),
(30, 'harrypotter@hogwarts.com', 'Harry', '1513b62b10ad9fba11efe128e58ddca4', 'images/1.png'),
(31, 'hermionegringer@gmail.com', 'Hermione', '64f6323f97f700f02187584a524a85e1', 'images/2.png'),
(32, 'ronweasley@yahoo.co.in', 'Ronald', '9211d11eb81866ad6cd8ed1461ca9454', 'images/3.png'),
(33, 'ginneWeasley@hotmail.com', 'Ginne', '486bf108ab6ace385ffdcbd79ddadb44', 'images/3.png'),
(34, 'alubusdumbeldore@protonmail.com', 'Alubus', 'd603d3591fe3a1166451336a0c5e7ceb', 'images/5.png'),
(35, 'ruberoussnape@hogwarts.com', 'Ruberous', '10410ab91cee914da022b2c8779995b7', 'images/6.png'),
(36, 'dracomalfoy@gmail.com', 'Draco', '2159ef38342a6452757ec5f85a14071a', 'images/7.png'),
(37, 'neivellelongbottom@yahoo.com', 'Neivelle', '210ca12aa34ebdd3837b261f76a3e300', 'images/8.png'),
(38, 'georgeweasley@hotmail.com', 'George', '2cec788ccb0f1d1aa72a7d26bbe2b981', 'images/9.png'),
(39, 'percyweasley@protonmail.com', 'Percy', '1044c7f43411617bb5a7298d6dfeac8f', 'images/10.png'),
(40, 'modern@gmail.com', 'Modern', '202cb962ac59075b964b07152d234b70', 'images/7.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `userview`
-- (See below for the actual view)
--
CREATE TABLE `userview` (
`id` int(11)
,`username` varchar(100)
,`email` varchar(100)
,`name` varchar(100)
,`password` varchar(100)
,`avatar` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `votecomment`
--

CREATE TABLE `votecomment` (
  `voteCommentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `commentId` int(11) NOT NULL,
  `voteValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votecomment`
--

INSERT INTO `votecomment` (`voteCommentId`, `userId`, `commentId`, `voteValue`) VALUES
(2, 1, 7, -1),
(6, 1, 12, 1),
(11, 19, 7, -1),
(12, 19, 12, 1),
(17, 1, 28, 1),
(19, 30, 32, -1),
(20, 31, 7, 1),
(21, 31, 12, 1),
(22, 31, 28, 1),
(23, 31, 29, -1),
(25, 31, 37, 1),
(26, 32, 32, 1),
(27, 32, 34, 1),
(29, 32, 7, 1),
(30, 32, 28, 1),
(31, 32, 12, 1),
(32, 32, 29, 1),
(33, 33, 32, 1),
(34, 33, 34, 1),
(35, 33, 38, 1),
(36, 34, 32, 1),
(37, 34, 34, 1),
(38, 34, 38, 1),
(39, 34, 7, -1),
(40, 34, 12, 1),
(41, 34, 28, 1),
(42, 34, 29, -1);

-- --------------------------------------------------------

--
-- Table structure for table `votethread`
--

CREATE TABLE `votethread` (
  `voteThreadId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `threadId` int(11) NOT NULL,
  `voteValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votethread`
--

INSERT INTO `votethread` (`voteThreadId`, `userId`, `threadId`, `voteValue`) VALUES
(5, 1, 4, 1),
(13, 1, 22, 1),
(14, 19, 4, 1),
(19, 19, 24, 1),
(21, 1, 24, 1),
(23, 1, 46, 1),
(24, 1, 45, 1),
(25, 1, 44, 1),
(27, 1, 42, 1),
(28, 1, 41, 1),
(29, 1, 40, 1),
(30, 1, 39, 1),
(31, 1, 37, 1),
(32, 1, 34, 1),
(33, 1, 32, 1),
(34, 1, 26, 1),
(35, 1, 27, 1),
(36, 1, 28, 1),
(37, 30, 46, 1),
(38, 30, 45, 1),
(39, 30, 42, 1),
(40, 31, 46, 1),
(42, 31, 45, 1),
(43, 31, 44, 1),
(44, 31, 41, 1),
(45, 31, 39, 1),
(48, 31, 29, 1),
(49, 31, 30, 1),
(50, 31, 31, 1),
(51, 31, 38, 1),
(52, 32, 46, 1),
(53, 33, 46, 1),
(54, 33, 45, 1),
(55, 33, 44, 1),
(56, 33, 4, 1),
(59, 33, 33, 1),
(60, 33, 26, 1),
(61, 33, 34, 1),
(62, 34, 4, 1),
(63, 35, 46, 1),
(66, 39, 42, 1),
(67, 40, 46, 1);

-- --------------------------------------------------------

--
-- Structure for view `commentuserview`
--
DROP TABLE IF EXISTS `commentuserview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `commentuserview`  AS SELECT `a`.`description` AS `Comment`, `b`.`username` AS `CommentedBy` FROM (`comments` `a` join `users` `b` on(`a`.`userId` = `b`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `commentvotesview`
--
DROP TABLE IF EXISTS `commentvotesview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `commentvotesview`  AS SELECT `a`.`description` AS `Comment`, `c`.`username` AS `VotedBy`, `b`.`voteValue` AS `Value` FROM ((`comments` `a` join `votecomment` `b`) join `users` `c` on(`b`.`userId` = `c`.`id` and `a`.`commentId` = `b`.`commentId`)) ;

-- --------------------------------------------------------

--
-- Structure for view `threadcommentsview`
--
DROP TABLE IF EXISTS `threadcommentsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `threadcommentsview`  AS SELECT `a`.`topic` AS `Thread`, `a`.`tag` AS `Tag`, `b`.`description` AS `Comment` FROM (`threads` `a` join `comments` `b` on(`a`.`threadId` = `b`.`threadId`)) ORDER BY `a`.`topic` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `threaduserview`
--
DROP TABLE IF EXISTS `threaduserview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `threaduserview`  AS SELECT `a`.`topic` AS `Thread`, `a`.`tag` AS `Tag`, `b`.`username` AS `PostedBy` FROM (`threads` `a` join `users` `b` on(`a`.`userId` = `b`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `threadvotesview`
--
DROP TABLE IF EXISTS `threadvotesview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `threadvotesview`  AS SELECT `a`.`topic` AS `Thread`, `a`.`tag` AS `Tag`, `c`.`username` AS `VotedBy`, `b`.`voteValue` AS `Value` FROM ((`threads` `a` join `votethread` `b`) join `users` `c` on(`b`.`userId` = `c`.`id` and `a`.`threadId` = `b`.`threadId`)) ;

-- --------------------------------------------------------

--
-- Structure for view `userview`
--
DROP TABLE IF EXISTS `userview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userview`  AS SELECT `a`.`id` AS `id`, `a`.`username` AS `username`, `b`.`email` AS `email`, `b`.`name` AS `name`, `b`.`password` AS `password`, `b`.`avatar` AS `avatar` FROM (`users` `a` join `usersprofile` `b` on(`a`.`id` = `b`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `threadId` (`threadId`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`threadId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersprofile`
--
ALTER TABLE `usersprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votecomment`
--
ALTER TABLE `votecomment`
  ADD PRIMARY KEY (`voteCommentId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `commentId` (`commentId`);

--
-- Indexes for table `votethread`
--
ALTER TABLE `votethread`
  ADD PRIMARY KEY (`voteThreadId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `threadId` (`threadId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `threadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `votecomment`
--
ALTER TABLE `votecomment`
  MODIFY `voteCommentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `votethread`
--
ALTER TABLE `votethread`
  MODIFY `voteThreadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`threadId`) REFERENCES `threads` (`threadId`);

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `usersprofile`
--
ALTER TABLE `usersprofile`
  ADD CONSTRAINT `usersprofile_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `usersprofile_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `votecomment`
--
ALTER TABLE `votecomment`
  ADD CONSTRAINT `votecomment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `votecomment_ibfk_2` FOREIGN KEY (`commentId`) REFERENCES `comments` (`commentId`);

--
-- Constraints for table `votethread`
--
ALTER TABLE `votethread`
  ADD CONSTRAINT `votethread_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `votethread_ibfk_2` FOREIGN KEY (`threadId`) REFERENCES `threads` (`threadId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
