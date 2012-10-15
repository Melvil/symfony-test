
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- bookmark
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bookmark`;


CREATE TABLE `bookmark`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`title` VARCHAR(255)  NOT NULL,
	`info` TEXT,
	`url` VARCHAR(255),
	`rating` INTEGER default 0,
	`vote_good` INTEGER default 0,
	`vote_bad` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `bookmark_I_1`(`title`),
	KEY `bookmark_I_2`(`rating`),
	INDEX `bookmark_FI_1` (`user_id`),
	CONSTRAINT `bookmark_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- category_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category_i18n`;


CREATE TABLE `category_i18n`
(
	`id` INTEGER  NOT NULL,
	`culture` CHAR(2)  NOT NULL,
	`title` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `category_i18n_I_1`(`title`),
	CONSTRAINT `category_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `category` (`id`)
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- bookmark_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bookmark_category`;


CREATE TABLE `bookmark_category`
(
	`bookmark_id` INTEGER  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	PRIMARY KEY (`bookmark_id`,`category_id`),
	CONSTRAINT `bookmark_category_FK_1`
		FOREIGN KEY (`bookmark_id`)
		REFERENCES `bookmark` (`id`)
		ON DELETE CASCADE,
	INDEX `bookmark_category_FI_2` (`category_id`),
	CONSTRAINT `bookmark_category_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- vote
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `vote`;


CREATE TABLE `vote`
(
	`user_id` INTEGER  NOT NULL,
	`bookmark_id` INTEGER  NOT NULL,
	`vote` TINYINT  NOT NULL,
	PRIMARY KEY (`user_id`,`bookmark_id`),
	CONSTRAINT `vote_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	INDEX `vote_FI_2` (`bookmark_id`),
	CONSTRAINT `vote_FK_2`
		FOREIGN KEY (`bookmark_id`)
		REFERENCES `bookmark` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
