<?php

use yii\db\Schema;
use yii\db\Migration;

class m151229_104501_init extends Migration {
    public function up() {
       $this->execute("
        DROP TABLE IF EXISTS `authors`;
        CREATE TABLE `authors` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`firstname` VARCHAR(255) NOT NULL,
	`lastname` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
        )
        COLLATE='utf8_general_ci'
        ENGINE=InnoDB;


        DROP TABLE IF EXISTS `books`;
        CREATE TABLE IF NOT EXISTS `books` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(255) NOT NULL,
          `preview` varchar(255) DEFAULT NULL,
          `author_id` int(11) DEFAULT NULL,
          `date` timestamp NULL DEFAULT NULL,
          `date_create` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `date_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
           PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
          ALTER TABLE `books` ADD KEY `author_id` (`author_id`);
       ");

       $this->execute("
         ALTER TABLE `books` ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE SET NULL;
       ");

       $this->execute("
        INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES
        (1,	'Имя 1',	'Фамилия 1'),
        (2,	'Имя 2',	'Фамилия 2'),
        (3,	'Имя 3',	'Фамилия 3'),
        (4,	'Имя 4',	'Фамилия 4'),
        (5,	'Имя 5',	'Фамилия 5');
       ");
         
       $this->execute("
         INSERT INTO `books` (`name`, `preview`, `author_id`, `date`, `date_create`) VALUES
                             ('Старик и море',	'',	1,	'2015-12-29 13:02:07', '2015-12-01 00:00:00'),
                             ('Книга 1',	NULL,	1,	'2015-12-29 13:02:08', '2015-12-01 00:00:00'),
                             ('Книга 2',	NULL,	2,	'2015-12-29 13:02:20', '2015-12-01 00:00:00'),
                             ('Книга 3',	NULL,	3,	'2015-12-29 13:02:33', '2015-12-01 00:00:00'),
                             ('Книга 4',	NULL,	4,	'2015-12-29 13:02:50', '2015-12-01 00:00:00'),
                             ('Книга 5',	NULL,	5,	'2015-12-29 13:03:05', '2015-12-01 00:00:00');
         ");

    }

    public function down() {
        echo "m151229_104501_init cannot be reverted.\n";
        $this->execute("
          DROP TABLE IF EXISTS `books`;
          DROP TABLE IF EXISTS `authors`;
       ");
       return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
