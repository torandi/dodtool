ALTER TABLE `entities`
	DROP COLUMN `armor_type`,
	ADD COLUMN `natural_armor` int(10) unsigned default 0;
