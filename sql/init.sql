create table product
(
	productID int,
	name varchar(64),
	price double,
	description varchar(255),
	category varchar(32),
	tagSpecific varchar(32),
	itemSize int
);
​
create table customer
(
	id int,
	firstName varchar(32),
	lastName varchar(32),
	street varchar(64),
	city varchar(32),
	sta varchar(2),
	zip varchar(5),
	country varchar(32),
	email varchar(64),
	password varchar(64),
	phoneNumber varchar(10)
);
​
create table payment
(
	customerID int,
	cardNumber varchar(32),
	securityCode varchar(32),
	expirationDate varchar(32),
	firstName varchar(32),
	lastName varchar(32)
);
​
create table orderInfo
(
	orderID int,
	customerID int,
	itemCost double,
	orderAmt int,
	shippingType int,
	shippingPrice double,
	tax double,
	orderTime varchar(32)
);
​
create table orderedItems
(
	orderID int,
	productID int
);
​
create table warehouse
(
	productID int,
	quantity int,
	longitude long,
	latitude long
);