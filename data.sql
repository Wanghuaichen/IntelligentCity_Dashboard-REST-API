DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
	`id` int NOT NULL,
	`name` varchar(32) NOT NULL,
	`description` text(16) NOT NULL,
	`sensor_value` decimal(5) NULL,
	`category_id` int NOT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NULL,
	PRIMARY KEY (`id`)
);

-- Insert 3 entries into products
INSERT INTO `products` VALUES (2,'Ev Baca 1','Ev Baca Sensörü 1',1,1,'2017-10-10 05:38:00',NULL);
INSERT INTO `products` VALUES (3,'Ev Baca 2','Ev Baca Sensörü 2',1,1,'2017-10-10 05:38:00',NULL);
INSERT INTO `products` VALUES (4,'Ev Baca 3','Ev Baca Sensörü 3',1,1,'2017-10-10 05:38:00',NULL);

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
	`id` int NOT NULL,
	`name` varchar(256) NOT NULL,
	`description` text(16) NOT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,
	PRIMARY KEY (`id`)
);

-- Insert 2 entries into categories
INSERT INTO `categories` VALUES (1,'Baca Sensörleri','Baca Sensörü; CO Degerleri.','2014-06-01 00:35:07','2014-05-30 14:34:33');
INSERT INTO `categories` VALUES (2,'Havuz Sensörleri','Havuz Sensörleri; Klor, Bulaniklik ve Iletkenlik verileri.','2014-06-01 00:35:07','2014-05-30 14:34:33');

DROP TABLE IF EXISTS `sensor_values`;

CREATE TABLE `sensor_values` (
	`measurement_id` int NOT NULL,
	`sensor_value` decimal(9) NOT NULL,
	`measurement_date` datetime NOT NULL,
	`product_id` int NOT NULL,
	PRIMARY KEY (`measurement_id`)
);

-- Insert 63 entries into sensor_values
INSERT INTO `sensor_values` VALUES (36,10,'2017-10-08 07:12:00',2);
INSERT INTO `sensor_values` VALUES (37,2,'2017-10-08 07:12:00',4);
INSERT INTO `sensor_values` VALUES (38,136,'2017-10-08 07:12:00',3);
INSERT INTO `sensor_values` VALUES (39,6,'2017-10-09 07:12:00',2);
INSERT INTO `sensor_values` VALUES (40,105,'2017-10-09 07:12:00',4);
INSERT INTO `sensor_values` VALUES (41,1,'2017-10-07 07:13:00',2);
INSERT INTO `sensor_values` VALUES (50,30,'2017-10-07 07:17:00',3);
INSERT INTO `sensor_values` VALUES (51,28,'2017-10-07 07:17:00',4);
INSERT INTO `sensor_values` VALUES (52,76,'2017-10-06 07:18:00',3);
INSERT INTO `sensor_values` VALUES (53,176,'2017-10-06 07:18:00',4);
INSERT INTO `sensor_values` VALUES (54,2,'2017-10-06 07:18:00',2);
INSERT INTO `sensor_values` VALUES (55,81,'2017-10-05 07:19:00',3);
INSERT INTO `sensor_values` VALUES (56,109,'2017-10-05 07:19:00',4);
INSERT INTO `sensor_values` VALUES (77,5,'2017-10-05 07:35:00',3);
INSERT INTO `sensor_values` VALUES (78,6,'2017-10-10 07:35:00',2);
INSERT INTO `sensor_values` VALUES (124,73,'2017-10-10 18:04:00',4);
INSERT INTO `sensor_values` VALUES (125,5,'2017-10-10 18:05:00',3);
INSERT INTO `sensor_values` VALUES (126,107,'2017-10-10 18:05:00',4);
INSERT INTO `sensor_values` VALUES (127,21,'2017-10-10 18:06:00',3);
INSERT INTO `sensor_values` VALUES (128,110,'2017-10-10 18:06:00',4);
INSERT INTO `sensor_values` VALUES (129,172,'2017-10-10 18:06:00',4);
INSERT INTO `sensor_values` VALUES (130,5,'2017-10-10 18:07:00',3);
INSERT INTO `sensor_values` VALUES (131,126,'2017-10-10 18:07:00',4);
INSERT INTO `sensor_values` VALUES (132,20,'2017-10-10 18:08:00',3);
INSERT INTO `sensor_values` VALUES (133,2,'2017-10-10 18:08:00',3);
INSERT INTO `sensor_values` VALUES (134,4,'2017-10-10 18:09:00',3);
INSERT INTO `sensor_values` VALUES (135,124,'2017-10-10 18:09:00',4);
INSERT INTO `sensor_values` VALUES (136,19,'2017-10-13 18:10:00',3);
INSERT INTO `sensor_values` VALUES (142,2,'2017-10-13 18:18:00',4);
INSERT INTO `sensor_values` VALUES (143,13,'2017-10-12 18:19:00',4);
INSERT INTO `sensor_values` VALUES (144,36,'2017-10-11 18:19:00',4);
INSERT INTO `sensor_values` VALUES (145,69,'2017-10-10 18:19:00',4);
INSERT INTO `sensor_values` VALUES (146,101,'2017-10-10 18:19:00',4);
INSERT INTO `sensor_values` VALUES (147,123,'2017-10-10 18:19:00',4);
INSERT INTO `sensor_values` VALUES (148,126,'2017-10-10 18:19:00',4);
INSERT INTO `sensor_values` VALUES (149,115,'2017-10-10 18:20:00',4);
INSERT INTO `sensor_values` VALUES (150,83,'2017-10-10 18:20:00',4);
INSERT INTO `sensor_values` VALUES (151,53,'2017-10-10 18:20:00',4);
INSERT INTO `sensor_values` VALUES (152,48,'2017-10-10 18:20:00',4);
INSERT INTO `sensor_values` VALUES (153,42,'2017-10-10 18:20:00',4);
INSERT INTO `sensor_values` VALUES (154,44,'2017-10-10 18:21:00',4);
INSERT INTO `sensor_values` VALUES (155,67,'2017-10-10 18:21:00',4);
INSERT INTO `sensor_values` VALUES (156,92,'2017-10-10 18:21:00',4);
INSERT INTO `sensor_values` VALUES (157,96,'2017-10-10 18:21:00',4);
INSERT INTO `sensor_values` VALUES (158,91,'2017-10-10 18:21:00',4);
INSERT INTO `sensor_values` VALUES (159,116,'2017-10-10 18:21:00',4);
INSERT INTO `sensor_values` VALUES (160,135,'2017-10-10 18:21:00',4);
INSERT INTO `sensor_values` VALUES (161,132,'2017-10-10 18:22:00',4);
INSERT INTO `sensor_values` VALUES (181,16,'2017-10-10 18:27:00',4);
INSERT INTO `sensor_values` VALUES (182,1,'2017-10-10 18:27:00',2);
INSERT INTO `sensor_values` VALUES (183,37,'2017-10-10 18:27:00',4);
INSERT INTO `sensor_values` VALUES (184,1,'2017-10-10 18:28:00',2);
INSERT INTO `sensor_values` VALUES (185,69,'2017-10-10 18:28:00',4);
INSERT INTO `sensor_values` VALUES (186,1,'2017-10-10 18:28:00',2);
INSERT INTO `sensor_values` VALUES (187,82,'2017-10-10 18:28:00',4);
INSERT INTO `sensor_values` VALUES (188,119,'2017-10-10 18:28:00',4);
INSERT INTO `sensor_values` VALUES (189,4,'2017-10-10 18:28:00',2);
INSERT INTO `sensor_values` VALUES (190,133,'2017-10-10 18:28:00',4);
INSERT INTO `sensor_values` VALUES (191,11,'2017-10-10 18:28:00',2);
INSERT INTO `sensor_values` VALUES (192,150,'2017-10-10 18:28:00',4);
INSERT INTO `sensor_values` VALUES (193,21,'2017-10-10 18:28:00',2);
INSERT INTO `sensor_values` VALUES (194,33,'2017-10-10 18:28:00',2);
INSERT INTO `sensor_values` VALUES (195,1,'2017-10-10 18:28:00',3);