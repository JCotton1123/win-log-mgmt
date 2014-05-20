CREATE DATABASE `syslog`;

CREATE TABLE `win_logs` (
  `timestamp` datetime DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `event_id` varchar(8) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `task_category` varchar(255) DEFAULT NULL,
  `event_descr` text,
  KEY `win_logs_timestamp_idx` (`timestamp`),
  KEY `win_logs_host_idx` (`host`),
  KEY `win_logs_event_id_idx` (`event_id`),
  KEY `win_logs_source_idx` (`source`),
  KEY `win_logs_user_idx` (`user`),
  KEY `win_logs_keyword_idx` (`keyword`),
  KEY `win_logs_task_category_idx` (`task_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
