DROP TABLE product;
CREATE TABLE product(
    productID varchar(32),
    name varchar(64),
    price varchar(32),
    description varchar(255),
    category varchar(32),
    tagSpecific varchar(32)
);
DROP TABLE customer;
CREATE TABLE customer(
    id varchar(32),
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
DROP TABLE payment;
CREATE TABLE payment(
    customerID varchar(32),
    cardNumber varchar(32),
    securityCode varchar(32),
    expirationDate varchar(32),
    firstName varchar(32),
    lastName varchar(32)
);
DROP TABLE orderInfo;
CREATE TABLE orderInfo(
    orderID varchar(32),
    customerID varchar(32),
    itemCost varchar(32),
    orderAmt varchar(32),
    shippingType varchar(32),
    shippingPrice varchar(32),
    tax varchar(32),
    orderTime varchar(32)
);
DROP TABLE orderedItems;
CREATE TABLE orderedItems(
    orderID varchar(32),
    productID varchar(32)
);
DROP TABLE warehouse;
CREATE TABLE warehouse(
    productID varchar(32),
    quantity varchar(32),
    longitude varchar(32),
    latitude varchar(32)
);
DROP TABLE cart;
CREATE TABLE cart
(
	customerID varchar(32),
	productID varchar(32)
);