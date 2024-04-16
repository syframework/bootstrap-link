SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_link
-- ----------------------------
CREATE TABLE IF NOT EXISTS `t_link` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `icon` enum('website','facebook','twitter','youtube','vine','instagram','twitch','tumblr','android','tripadvisor','yelp','pinterest','amazon','etsy','foursquare','linkedin','snapchat','viadeo','vimeo','discord','github','whatsapp','telegram','tiktok','apple','airbnb','blogger','') NOT NULL,
  `url` varchar(255) NOT NULL,
  `tag` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `icon` (`icon`,`tag`) USING BTREE,
  KEY `tag` (`tag`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

SET FOREIGN_KEY_CHECKS=1;