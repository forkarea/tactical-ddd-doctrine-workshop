CREATE TABLE `Event` (
    `aggregate_id` varchar(60) NOT NULL,
    `type` varchar(255) NOT NULL,
    `data` text NOT NULL,
    `occurred_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8
