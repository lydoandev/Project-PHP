DROP DATABASE IF EXISTS sell_leather;
CREATE DATABASE sell_leather;
ALTER DATABASE `sell_leather` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
set global innodb_large_prefix=on;
SET @@global.innodb_large_prefix = 1;
USE sell_leather;
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`(
	`username` VARCHAR(50) NOT NULL PRIMARY KEY,
	`password` VARCHAR(255) NOT NULL,
	`avatar_url` VARCHAR(255),
	`first_name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50) NOT NULL,
	`birthday` DATE,
	`gender` VARCHAR(10),
	`email` VARCHAR(100),
	`address` VARCHAR(100),
	`phone` VARCHAR(11),
	`creation_date` DATETIME,
	`u_role` VARCHAR(50) NOT NULL,
	`last_access` DATE,
	`is_active` BOOLEAN NOT NULL
);

CREATE TABLE employees(
	emp_id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(255),
    identify_card_num INT(11),
    address VARCHAR(255),
    email VARCHAR(255),
    salary INT(11)
);

CREATE TABLE shippers(
	ship_id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(255),
    company VARCHAR(255),
    phone VARCHAR(11)
);

CREATE TABLE orders(
	order_id VARCHAR(10) PRIMARY KEY,
    username VARCHAR(50),
    emp_id VARCHAR(10),
    ship_id VARCHAR(10),
    request_date DATE,
    order_date DATE,
    order_address VARCHAR(255),
    status VARCHAR(45),
    total_price INT(11),
    FOREIGN KEY (username) REFERENCES users (username),
    FOREIGN KEY (emp_id) REFERENCES employees (emp_id),
    FOREIGN KEY (ship_id) REFERENCES shippers (ship_id)
);

CREATE TABLE categories(
	cate_id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE products(
	prod_id VARCHAR(10) PRIMARY KEY,
    name VARCHAR(255),
    material VARCHAR(255),
    image VARCHAR(255),
    price_in INT(11),
    price_out INT(11),
    date_add DATE,
    quantity INT(11),
    description text,
    cate_id VARCHAR(10),
    views int(11),
    status BOOLEAN,
    FOREIGN KEY (cate_id) REFERENCES categories (cate_id)
);

/*CREATE TABLE products_detail(
	prod_id VARCHAR(10),
    type VARCHAR(20),
    color VARCHAR(20),
    quantity INT(11),
    FOREIGN KEY (prod_id) REFERENCES products (prod_id),
    PRIMARY KEY(prod_id, type, color)
);
*/

CREATE TABLE promotion(
	prod_id VARCHAR(10),
    new_price INT(11),
    date_start DATE,
    date_end DATE,
    FOREIGN KEY (prod_id) REFERENCES products (prod_id),
    PRIMARY KEY(prod_id,date_start)
);

CREATE TABLE ords_prods(
    order_id VARCHAR(10),
    prod_id VARCHAR(10),
    quantity int(11),
    FOREIGN KEY (order_id) REFERENCES orders (order_id),
    FOREIGN KEY (prod_id) REFERENCES products (prod_id),
    PRIMARY KEY(order_id, prod_id)
);

INSERT INTO `users`
 VALUES ('administrator', '$2y$10$8Re1K6.OTJ5aPrbMLLFq/e31YVwFaQg8P1s6rfsb96mpqR5v0/Z.W','Image/acount.png',
 'Ly', 'Đoàn Thị', '1999-11-22', 'female', 'lydoan.dev@gmail.com','101B Lê Hữu Trác','0348543343',NOW(), 'admin', NOW(), 1),
 ('stocker', '$2y$10$79ywhulHRpeIB5oPhq0/L.W./lnVt58ahiRzbEGdf0Mwcs2A4mu8C','Image/acount.png',
 'Ly', 'Đoàn Thị', '1999-11-22', 'female', 'lydoan.dev@gmail.com','101B Lê Hữu Trác','0348543343',NOW(), 'stocker', NOW(), 1);
 MK/*$2y$10$E25hWDbXsIsMxffSQEA6L.o3bCdkQh.1j0OX4UKIz7WE2s3/C240a*/