CREATE TABLE `votes_2`(
    `id_region` BIGINT NOT NULL,
    `votes_2_count` BIGINT NOT NULL
);
ALTER TABLE
    `votes_2` ADD INDEX `votes_2_id_region_index`(`id_region`);
CREATE TABLE `pic_hike`(
    `id_hike_pictures` INT NOT NULL AUTO_INCREMENT INDEX,
    `picture_tour` VARCHAR(255) NOT NULL
);
CREATE TABLE `clients`(
    `id_client` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(70) NOT NULL,
    `fio` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(15) NOT NULL,
    `male` TINYINT(1) NOT NULL,
    `adress` VARCHAR(255) NOT NULL,
    `votes` BIGINT NOT NULL
);
CREATE TABLE `regions`(
    `id_region` INT NOT NULL,
    `name` INT NOT NULL,
    `id_hike` INT NOT NULL,
    PRIMARY KEY(`id_region`)
);
CREATE TABLE `hike`(
    `id_hike` INT NOT NULL AUTO_INCREMENT INDEX,
    `id_pictures` INT NOT NULL AUTO_INCREMENT,
    `name_hike` VARCHAR(255) NOT NULL,
    `description_hike` TEXT NOT NULL,
    `start_position` VARCHAR(255) NOT NULL,
    `stop_position` VARCHAR(255) NOT NULL,
    `kod_map` TEXT NOT NULL,
    `d_start` DATETIME NOT NULL,
    `d_stop` DATETIME NOT NULL,
    `price_hike` DECIMAL(7, 2) NOT NULL,
    `id_leader` INT NOT NULL AUTO_INCREMENT
);
CREATE TABLE `order_hike`(
    `id_order` INT NOT NULL AUTO_INCREMENT,
    `id_client` INT NOT NULL AUTO_INCREMENT INDEX,
    `adress` VARCHAR(255) NOT NULL,
    `payment_method` VARCHAR(255) NOT NULL,
    `status` VARCHAR(255) NOT NULL,
    `comment` VARCHAR(255) NOT NULL
);
CREATE TABLE `votes`(
    `id_region` INT UNSIGNED NOT NULL AUTO_INCREMENT INDEX,
    `id_okruga` INT NOT NULL,
    `votes_count` INT NOT NULL
);
ALTER TABLE
    `votes` ADD INDEX `votes_id_okruga_index`(`id_okruga`);
CREATE TABLE `otchtet`(
    `id_client` INT NOT NULL,
    `id_hike` INT NOT NULL,
    `picture_doc` CHAR(255) NOT NULL
);
ALTER TABLE
    `otchtet` ADD INDEX `otchtet_id_client_index`(`id_client`);
CREATE TABLE `clients_hike`(
    `id_hike` INT NOT NULL AUTO_INCREMENT INDEX,
    `id_client` INT NOT NULL AUTO_INCREMENT INDEX
);
CREATE TABLE `okruga`(
    `id_okruga` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `okruga` ADD INDEX `okruga_id_okruga_index`(`id_okruga`);
ALTER TABLE
    `votes` ADD CONSTRAINT `votes_id_region_foreign` FOREIGN KEY(`id_region`) REFERENCES `votes_2`(`id_region`);
ALTER TABLE
    `order_hike` ADD CONSTRAINT `order_hike_id_client_foreign` FOREIGN KEY(`id_client`) REFERENCES `clients`(`id_client`);
ALTER TABLE
    `otchtet` ADD CONSTRAINT `otchtet_id_client_foreign` FOREIGN KEY(`id_client`) REFERENCES `clients`(`id_client`);
ALTER TABLE
    `hike` ADD CONSTRAINT `hike_id_pictures_foreign` FOREIGN KEY(`id_pictures`) REFERENCES `pic_hike`(`id_hike_pictures`);
ALTER TABLE
    `clients_hike` ADD CONSTRAINT `clients_hike_id_hike_foreign` FOREIGN KEY(`id_hike`) REFERENCES `hike`(`id_hike`);
ALTER TABLE
    `clients_hike` ADD CONSTRAINT `clients_hike_id_client_foreign` FOREIGN KEY(`id_client`) REFERENCES `clients`(`id_client`);
ALTER TABLE
    `votes` ADD CONSTRAINT `votes_id_region_foreign` FOREIGN KEY(`id_region`) REFERENCES `regions`(`id_region`);
ALTER TABLE
    `votes` ADD CONSTRAINT `votes_id_okruga_foreign` FOREIGN KEY(`id_okruga`) REFERENCES `okruga`(`id_okruga`);
ALTER TABLE
    `regions` ADD CONSTRAINT `regions_id_hike_foreign` FOREIGN KEY(`id_hike`) REFERENCES `hike`(`id_hike`);
ALTER TABLE
    `otchtet` ADD CONSTRAINT `otchtet_id_hike_foreign` FOREIGN KEY(`id_hike`) REFERENCES `clients_hike`(`id_hike`);