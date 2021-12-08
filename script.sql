CREATE TABLE categories (
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `parent_id` INT UNSIGNED NULL,
  `level` INT NOT NULL
);

-- DATA
INSERT INTO categories (`name`, `parent_id`, `level`) VALUES ('Техника', 0, 0);
INSERT INTO categories (`name`, `parent_id`, `level`) VALUES ('Гаджеты', 1, 1);
INSERT INTO categories (`name`, `parent_id`, `level`) VALUES ('Смартфоны', 2, 2);
INSERT INTO categories (`name`, `parent_id`, `level`) VALUES ('Xiaomi', 3, 3),('Meizu', 3, 3),('Samsung', 3, 3);