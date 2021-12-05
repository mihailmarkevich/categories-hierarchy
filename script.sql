CREATE TABLE categories (
  `id` INT PRIMARY KEY AUTO_INCREMENT
  `name` VARCHAR(255) NOT NULL
);

CREATE TABLE categories_to_categories (
  `category_id` INT NOT NULL,
  `parent_category_id` INT NOT NULL,
  `level` INT NOT NULL,
);