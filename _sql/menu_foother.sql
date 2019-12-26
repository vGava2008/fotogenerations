--
-- Table structure for table `menu_foother`
--

DROP TABLE IF EXISTS `menu_foother`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_foother` (
  `id` int(11) NOT NULL AUTOINCREMENT,
  `column` tinyint NOT NULL default 1,
  `sort_order` tinyint,
  `name` char(50) NOT NULL,
  `url` char(50) NULL DEFAULT NULL,
  `language_id` tinyint,
  `status` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
