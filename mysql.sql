DROP DATABASE IF EXISTS sell_leather;
CREATE DATABASE sell_leather;
ALTER DATABASE `sell_leather` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
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
    order_date DATE,
    ship_date DATE,
    order_address VARCHAR(255),
    status BOOLEAN,
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
    image nVARCHAR(500),
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
		 'Ly', 'Đoàn Thị', '1999-11-22', 'Female', 'lydoan.dev@gmail.com','101B Lê Hữu Trác','0348543343',NOW(), 'admin', NOW(), 1),
		 ('stocker', '$2y$10$79ywhulHRpeIB5oPhq0/L.W./lnVt58ahiRzbEGdf0Mwcs2A4mu8C','Image/acount.png',
		 'Ly', 'Đoàn Thị', '1999-11-22', 'Female', 'lydoan.dev@gmail.com','101B Lê Hữu Trác','0348543343',NOW(), 'stocker', NOW(), 1),
		 ('trangtran', '$2y$10$E25hWDbXsIsMxffSQEA6L.o3bCdkQh.1j0OX4UKIz7WE2s3/C240a','Image/cus1.png',
		 'Trang', 'Trần Thị', '1999-11-22', 'Female', 'trangtran.dev@gmail.com','101B Lê Hữu Trác','0348548546',NOW(), 'customer', NOW(), 1),
		 ('nguyenmy', '$2y$10$E25hWDbXsIsMxffSQEA6L.o3bCdkQh.1j0OX4UKIz7WE2s3/C240a','Image/cus2.png',
		 'My', 'Nguyễn Thị', '1999-11-22', 'Female', 'nguyenmy.dev@gmail.com','101B Lê Hữu Trác','0348541548',NOW(), 'customer', NOW(), 1),
		 ('phantrung', '$2y$10$E25hWDbXsIsMxffSQEA6L.o3bCdkQh.1j0OX4UKIz7WE2s3/C240a','Image/cus3.png',
		 'Trung', 'Phan Thị', '1999-11-22', 'Female', 'nguyenmy.dev@gmail.com','101B Lê Hữu Trác','0348541548',NOW(), 'customer', NOW(), 1);
 
 INSERT INTO `employees`
 VALUES ('EMP_01','Nguyễn Thị Thu','20190101','04-Nguyễn Công Trứ-Hà Nội','thunguyen@gmail.com',7000000),
		('EMP_02','Nguyễn Phương Tri','20190102','43-Ba Đình-Hà Nội','tringuyen@gmail.com',7000000),
        ('EMP_03','Hoàng Văn Huy','20190103','13-Nguyễn Văn Thoại-Hà Nội','huyhoang@gmail.com',7000000),
        ('EMP_04','David Jonsh','20190104','04-Hùng Vương-Hà Nội','jonshdavid@gmail.com',7000000),
		('EMP_05','Trần Phương Thảo','20190105','101B-Lê Hữu Trắc-Hà Nội','thaotran@gmail.com',7000000),
		('EMP_06','Elly Trần ','20190106','93-Phạm Văn Đằng-Hà Nội','tranelly@gmail.com',7000000),
		('EMP_07','CrishTorn','20190107','23-Sinh Sắc-Hà Nội','crishtorn@gmail.com',7000000),
		('EMP_08','Leeon','20190108','04-Trưng Trắc-Hà Nội','leeon@gmail.com',7000000),
		('EMP_09','Jimin','20190109','46-Nguyễn Huệ-Hà Nội','jimin@gmail.com',7000000),
		('EMP_10','Min','201910','97-Nguyễn Du-Hà Nội','min@gmail.com',7000000);


INSERT INTO `shippers`
 VALUES ('SP_01','Đặng Văn Toàn','Grap','0354251678'),
		('SP_02','Nguyễn Văn Lâm','Grap','0324157498'),
        ('SP_03','Trần Văn Huy','Grap','0345124514');
 
 
 INSERT INTO `orders`
 VALUES ('OD_01','nguyenmy','EMP_01','SP_01','2019-01-11','2019-01-14','56-Nguyễn Văn Thoại-Đà Nẵng','1'),
		 ('OD_02','trangtran','EMP_02','SP_02','2019-01-20','2019-01-24','43-Nguyễn Công Trứ-Hà Nội','1'),
		 ('OD_03','phantrung','EMP_02','SP_02','2019-01-14','2019-01-18','102-Hùng Vương-Hồ Chí Minh','1');
 
 
 INSERT INTO `categories`
 VALUES ('CATE_01','Túi & Clutch'),
		('CATE_02','Ví da'),
        ('CATE_03','Phụ kiện');
        
 INSERT INTO `products`
 VALUES ('PD_01','CLUTCH HỘP','Da bò','Image/Product/CLUTCHHOP1.jpg|Image/Product/CLUTCHHOP2.jpg|Image/Product/CLUTCHHOP3.jpg|Image/Product/CLUTCHHOP4.jpg|Image/Product/CLUTCHHOP5.jpg'
		,1010000,1020000,'2019-01-01',100,'Đây là phiển bản cải tiến của mẫu Clutch cũ, với phiên bản mới này bạn có thể đựng được rất nhiều vận dụng chỉ trong một chiếc túi da nhỏ gọn.
		Đặc biệt: bên trong có ngăn có thể tách rời ra, sử dụng khi bạn muốn cần nhiều không gian để đồ hơn thì có thể tháo ra','CATE_01',11,1),
		('PD_02','BAO DA ĐỰNG GIẤY ĐĂNG KIỂM XE','Da bò','Image/Product/Bao-da-dang-kiem-xe-1.png|Image/Product/Bao-da-dang-kiem-xe-2.png|Image/Product/Bao-da-dang-kiem-xe-3.png|Image/Product/Bao-da-dang-kiem-xe-4.png',
        450000,495000,'2019-01-01',100,'Sử dụng chất liệu da bò cao cấp, bề mặt mềm mại, được xử lý cẩn thận càng bóng mịn theo thời gian sử dụng. Sản phẩm được may thủ cộng tỉ mỉ và tinh xảo','CATE_02',11,1),
        ('PD_03','DÂY ĐỒNG HỒ DA CÁ SẤU','Da cá sấu','Image/Product/2Da-ca-sau-1.png|Image/Product/2Da-ca-sau-2.png|Image/Product/Da-ca-sau-3.png|Image/Product/Da-ca-sau-4.png|Image/Product/Da-ca-sau-5.png',
        1425000,1485000,'2019-01-01',100,'','CATE_03',11,1),
        ('PD_04','PASSPORT VINTAGE','Da bò','Image/Product/PASSPORT-VINTAGE-1.png|Image/Product/PASSPORT-VINTAGE-2.png|Image/Product/PASSPORT-VINTAGE-3.png',
        290000,299000,'2019-01-01',100,'Chi tiết sản phẩm: Chất liệu: Da bò cao cấp 100% Thiết kế: 2 Ngăn chính cực rộng và 4 ngăn thẻ ATM Được thiết kế và sản xuất hoàn toàn thủ công bởi Chúng tôi Màu: Nâu','CATE_02',11,1),
        ('PD_05','BAO DA PASSPORT CHUẨN','Da bò','Image/Product/BAO-DA-PASSPORT-1.png|Image/Product/BAO-DA-PASSPORT-2.png|Image/Product/BAO-DA-PASSPORT-3.png|Image/Product/BAO-DA-PASSPORT-4.png|Image/Product/BAO-DA-PASSPORT-5.png',
        290000,299000,'2019-01-01',100,'Khi du lịch nước ngoài, hộ chiếu (Passport) là vật quan trọng nhất. Vì thế hãy bảo vệ và nâng niu nó bằng 1 chiếc ví đựng Passport Handmade này nhé','CATE_02',11,1),
        ('PD_06','CARDHOLDER - VÍ CARDHOLDER','Da bò','Image/Product/CARDHOLDER-1.png|Image/Product/CARDHOLDER-2.png|Image/Product/CARDHOLDER-3.png|Image/Product/CARDHOLDER-4.png|Image/Product/CARDHOLDER-5.png|Image/Product/CARDHOLDER-6.png',
        320000,350000,'2019-01-01',100,'Thiết kế nhỏ gọn, chuyên để đựng namecard, thẻ. Phù hợp với người thường xuyên phải mang nhiều thẻ, danh thiếp bên người.','CATE_02',11,1),
        ('PD_07','VÍ SỌC ĐÔI','Da bò Pullup','Image/Product/VI-SOC-DOI-1.png|Image/Product/VI-SOC-DOI-2.png|Image/Product/VI-SOC-DOI-3.png|Image/Product/VI-SOC-DOI-4.png|Image/Product/VI-SOC-DOI-5.png',
        420000,450000,'2019-01-01',100,'Chất liệu da bò Pullup, thiết kế hiện đại, bỏ vừa cmnd, giấy tờ xe.','CATE_02',11,1),
        ('PD_08','VÍ GO-MINI','Da bò','Image/Product/GO-MINI-1.png|Image/Product/GO-MINI-2.png|Image/Product/GO-MINI-3.png|Image/Product/GO-MINI-4.png|Image/Product/GO-MINI-5.png',
        215000,225000,'2019-01-01',100,'Thiết kế đơn giản, nhỏ gọn cầm vừa lòng bàn tay có thể dễ dàng bỏ túi trước áo hoặc quần.','CATE_02',11,1),
        ('PD_09','BAO DA MACBOOK HANDMADE','Da bò','Image/Product/BAO-DA-MACBOOK-HANDMADE-1.png|Image/Product/BAO-DA-MACBOOK-HANDMADE-2.png|Image/Product/BAO-DA-MACBOOK-HANDMADE-3.png|Image/Product/BAO-DA-MACBOOK-HANDMADE-4.png|Image/Product/BAO-DA-MACBOOK-HANDMADE-5.png|Image/Product/BAO-DA-MACBOOK-HANDMADE-6.png'
		,705000,715000,'2019-01-01',100,' Chất liệu da bò thật 100% - Bên trong lót 1 lớp nhung mềm  - Nắp có gắn nam châm hít chắc chắn - Có đủ loại cho các dòng MACBOOK 11, 12, 13 & 15 inch. - 3 màu: Đen / Vàng bò / Xanh dương','CATE_01',11,1),
        ('PD_10','MESSENGER BAG 01 - TÚI DA ĐEO CHÉO 01','Da bò','Image/Product/MESSENGER-BAG-01-1.png|Image/Product/MESSENGER-BAG-01-2.png|Image/Product/MESSENGER-BAG-01-3.png|Image/Product/MESSENGER-BAG-01-4.png'
		,1850000,1950000,'2019-01-01',100,'Chất liệu: Da bò thật 100%','CATE_01',11,1),
        ('PD_11','ZIP AROUND CLUTCH','Da bò','Image/Product/ZIP-AROUND-CLUTCH-1.png|Image/Product/ZIP-AROUND-CLUTCH-2.png|Image/Product/ZIP-AROUND-CLUTCH3.png|Image/Product/ZIP-AROUND-CLUTCH4.png|Image/Product/ZIP-AROUND-CLUTCH5.png|Image/Product/ZIP-AROUND-CLUTCH6.png|Image/Product/ZIP-AROUND-CLUTCH7.png'
		,1150000,1250000,'2019-01-01',100,'Chất liệu: Da bò thật 100%','CATE_01',11,1),
        ('PD_12','CLUTCH BOSSED','Da bò','Image/Product/CLUTCH-BOSSED-1.png|Image/Product/CLUTCH-BOSSED-2.png|Image/Product/CLUTCH-BOSSED-3.png|Image/Product/CLUTCH-BOSSED-4.png|Image/Product/CLUTCH-BOSSED-5.png'
		,1010000,1020000,'2019-01-01',100,'Chất liệu: Da bò thật 100%','CATE_01',11,1),
        ('PD_13','CLUTCH','Da bò','Image/Product/CLUTCH-1.png|Image/Product/CLUTCH-2.png|Image/Product/CLUTCH-3.png|Image/Product/CLUTCH-4.png|Image/Product/CLUTCH-5.png|Image/Product/CLUTCH-6.png|Image/Product/CLUTCH-7.png'
		,840000,850000,'2019-01-01',100,'Chất liệu: Da bò thật 100%','CATE_01',11,1),
        ('PD_14','TÚI XÁCH DA ĐA NĂNG','Da bò','Image/Product/Tui-xach-da-da-nang-1.png|Image/Product/Tui-xach-da-da-nang-2.png|Image/Product/Tui-xach-da-da-nang-3.png|Image/Product/Tui-xach-da-da-nang-4.png|Image/Product/Tui-xach-da-da-nang-5.png'
		,3940000,3950000,'2019-01-01',100,'Chất liệu: Chất liệu da bò thật 100% Màu: Nâu Công dụng: đựng vừa các loại macbook 13 trở xuống, thẻ, bút, tiền mặt, hộ chiếu, điện thoại...','CATE_01',11,1),
        ('PD_15','THREEFOLD CLUTCH','Da bò','Image/Product/THREEFOLD-CLUTCH-1.png|Image/Product/THREEFOLD-CLUTCH-2.png|Image/Product/THREEFOLD-CLUTCH-3.png|Image/Product/THREEFOLD-CLUTCH-4.png|Image/Product/THREEFOLD-CLUTCH-5.png|Image/Product/THREEFOLD-CLUTCH-6.png'
		,1440000,1450000,'2019-01-01',100,'Chất liệu: Da bò thật 100%','CATE_01',11,1),
        ('PD_16','BAO DA IPHONE','Da bò','Image/Product/BAO-DA-IPHONE-1.png|Image/Product/BAO-DA-IPHONE-2.png|Image/Product/BAO-DA-IPHONE-3.png|Image/Product/BAO-DA-IPHONE-4.png|Image/Product/BAO-DA-IPHONE-5.png|Image/Product/BAO-DA-IPHONE-6.png',
        150000,300000,'2019-01-01',100,'','CATE_03',11,1),
        ('PD_17','BAO DA MACBOOK LEO','Da bò','Image/Product/BAO-DA-MACBOOK-LEO-1.png|Image/Product/BAO-DA-MACBOOK-LEO-2.png|Image/Product/BAO-DA-MACBOOK-LEO-3.png|Image/Product/BAO-DA-MACBOOK-LEO-4.png',
        640000,650000,'2019-01-01',100,'','CATE_03',11,1),
        ('PD_18','DÂY DA ĐỒNG HỒ VEG Ý','Da bò','Image/Product/VEG-Y-1.png|Image/ProductVEG-Y-2.png|Image/Product/VEG-Y-3.png',
        840500,841500,'2019-01-01',100,'Không cần phải nói gì nhiều, nhìn qua những bức ảnh quý khách cũng thấy được được vẻ đẹp hoàn hảo, tỉ mỉ qua từng đường kim mũi chỉ rồi.','CATE_03',11,1),
        ('PD_19','LEATHER CASE IPHONE - ỐP LƯNG DA HANDMADE CAO CẤP','Da bò','Image/Product/LEATHER-CASE-IPHONE-1.png|Image/LEATHER-CASE-IPHONE-2.png|Image/Product/LEATHER-CASE-IPHONE-3.png|Image/Product/LEATHER-CASE-IPHONE-4.png',
        170000,180000,'2019-01-01',100,'Chất liệu: Da bò thật 100%','CATE_03',11,1),
        ('PD_20','DÂY DA ĐỒNG HỒ FC','Da bò','Image/Product/FC-1.png|Image/FC-2.png|Image/Product/FC-3.png|Image/Product/FC-4.png|Image/Product/FC-5.png|Image/Product/FC-6.png',
        930500,940500,'2019-01-01',100,'Dòng dây da đồng hồ FC mới của chúng tôi lấy ý tưởng từ hãng sản xuất đồng hồ nổi tiếng của Frédérique Constant của Thuỵ Sĩ: Luôn chính xác trong từng chi tiết nhỏ và mang lại cảm giác đẳng cấp cho người đeo.','CATE_03',11,1),
        ('PD_21','HẮT LƯNG DA CÁ SẤU','Da cá sấu','Image/Product/VEG-Y-1.png|Image/ProductVEG-Y-2.png|Image/Product/VEG-Y-3.png',
        1920500,1930500,'2019-01-01',100,'Chất liệu: Da cá sấu','CATE_03',11,1),
        ('PD_22','THẮT LƯNG THO-01','Da bò','Image/Product/THO-01.png|Image/THO-02.png|Image/Product/THO-03.png|Image/Product/THO-04.png|Image/Product/THO-5.png',
        465200,475200,'2019-01-01',100,'Chất liệu: Da cá sấu , Da bò thật 100%','CATE_03',11,1),
		('PD_23','VÍ DA CÁ SẤU','Da cá sấu','Image/Product/Vi-ca-sau-1.png|Image/Product/Vi-ca-sau-2.png|Image/Product/Vi-ca-sau-3.png|Image/Product/Vi-ca-sau-4.png|Image/Product/Vi-ca-sau-5.png|Image/Product/Vi-ca-sau-6.png',
        1400000,1500000,'2019-01-01',100,'Ví da cá sấu dùng càng bóng, đẹp chứ không bị bong, tróc xi như những loại ví làm từ nguồn da cá sấu kém chất lượng khác. (Ví da cá sấu làm từ da kém chất lượng, loại da này thường bị lỗi nên khi lên sản phẩm họ thường phun một lớp xi màu để giấu lỗi.
        Do đó, sau một thời gian sử dụng sản phẩm sẽ bị bay màu, tróc xi nhìn rất xấu)','CATE_02',11,1),
        ('PD_24','ESTY LONG WALLET - VÍ DÀI ESTY','Da bò','Image/Product/ESTY-LONG-WALLET-1.png|Image/Product/ESTY-LONG-WALLET-2.png',
        560000,570000,'2019-01-01',100,'Esty Long Wallet - Ví Dài Esty','CATE_02',11,1);
        
        
INSERT INTO `promotion`
 VALUES ('PD_01',1010000,'2019-01-18','2019-01-21'),
		('PD_02',450000,'2019-01-18','2019-01-21'),
        ('PD_03',1425000,'2019-01-18','2019-01-21'),
        ('PD_04',290000,'2019-01-18','2019-01-21'),
        ('PD_05',290000,'2019-01-18','2019-01-21'),
		('PD_06',320000,'2019-01-18','2019-01-21'),
        ('PD_07',420000,'2019-01-18','2019-01-21'),
        ('PD_08',215000,'2019-01-18','2019-01-21'),
        ('PD_09',705000,'2019-01-18','2019-01-21'),
        ('PD_10',1850000,'2019-01-18','2019-01-21');

        
        
INSERT INTO `ords_prods`
 VALUES ('OD_01','PD_01',1),
		('OD_02','PD_02',1),
        ('OD_03','PD_03',1);
        
        