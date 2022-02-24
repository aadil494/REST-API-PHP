CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Technology'),
(2, 'Gaming'),
(3, 'Auto'),
(4, 'Entertainment'),
(5, 'Books');

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `posts` (`id`, `category_id`, `title`, `body`, `author`, `created_at`) VALUES
(1, 1, 'Post From Retrofit', 'This is a test post from retrofit', 'Aadil Matloob Jan', '2022-02-24 14:46:50'),
(2, 1, 'Singleton pattern with combination of lazy loading ', 'Your second code snippet is, in my opinion, the best way of thread-safe lazily initializing a singleton. It actually has a pattern name.', 'The Code Bear', '2022-02-24 22:25:21'),
(3, 3, ' Authenticating users with PHP ', 'Your second code snippet is, in my opinion, the best way of thread-safe lazily initializing a singleton. It actually has a pattern name.', 'The Code Bear', '2022-02-24 22:26:44'),
(4, 3, 'Android Retrofit post request not working', '\n\ni have posted my retrofit code below where there is an interface and a mainactivity method where the method on a response body just receves an\ntag unlike any data and also the data into database is not inserted .. trying using xammp\n\nHere in interface i have defined keys', 'The Code Bear', '2022-02-24 22:27:54');
