ALTER TABLE `entities`
	DROP COLUMN `armor_type`,
	ADD COLUMN `natural_armor` int(10) unsigned not null default 0;
