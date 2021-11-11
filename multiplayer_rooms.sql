CREATE TABLE `multiplayer_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `channel_id` int unsigned DEFAULT NULL,
  `starts_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ends_at` timestamp NULL DEFAULT NULL,
  `max_attempts` tinyint unsigned DEFAULT NULL,
  `participant_count` int unsigned NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `type` enum('playlists','head_to_head','team_versus') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category` enum('normal','spotlight') NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`id`),
  KEY `multiplayer_rooms_user_id_index` (`user_id`),
  KEY `multiplayer_rooms_category_ends_at_index` (`category`,`ends_at`),
  KEY `multiplayer_rooms_category_user_id_index` (`category`,`user_id`),
  KEY `multiplayer_rooms_ends_at_index` (`ends_at`),
  KEY `multiplayer_rooms_type_category_ends_at_index` (`type`,`category`,`ends_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

ALTER TABLE `multiplayer_rooms`
  ADD COLUMN `queue_mode` enum('host_only', 'free_for_all', 'fair_rotate') NOT NULL DEFAULT 'host_only'
  AFTER `category`;

ALTER TABLE `multiplayer_playlist_items`
  ADD COLUMN `user_id` int unsigned NOT NULL DEFAULT '0'
  AFTER `id`;

