/* Creates a pair of Butt Boxers (ID 7777777) and stores 500 of them into a warehouse. */
insert into product values(7777777, "Butt Boxers", 195.95, "Signature Butt Brand underpants", "Underwear", "Men's", 2);
insert into warehouse values(7777777, 500, 32.555555, -122.1231214214);

/* Creates a pair of Butt Boxers Mk2 (ID 7777778) and stores 55 of them into a warehouse. */
insert into product values(7777778, "Butt Boxers Mk2", 2999.99, "Signature Butt Brand underpants mk2", "Underwear", "Men's", 2);
insert into warehouse values(7777778, 55, 32.555555, -122.1231214214);

/* Creates a new customer account for Frank Butt, adds payment info */
insert into customer values(123456789, "Frank", "Butt", "1 Washington Square", "San Jose", "CA", "95192", "US", "frank.butt@sjsu.edu", "password", "9119119111");
insert into payment values(123456789, "891238948122", "111", "4/18", "Frank", "Butt");

/* Butt purchased 1 pair of Butt Boxers and 2 pairs of Butt Boxers mk2 */
insert into orderedItems values(88888888, 7777777);
insert into orderedItems values(88888888, 7777778);
insert into orderedItems values(88888888, 7777778);
insert into orderInfo values(88888888, 123456789, 195.95, 1, 5, 5.95, 1.50, "Tues Dec 1 2015 23:55");

/* Creates a new customer account for Hello World, adds payment info */
insert into customer values(111111111, "Hello", "World", "1 Washington Square", "San Jose", "CA", "95192", "US", "helloworld@sjsu.edu", "password", "9119119111");
insert into payment values(111111111, "989898989898", "111", "4/18", "Hello", "World");

/* Hello World purchased 2 pairs of Butt Boxers */
insert into orderInfo values(99999999, 111111111, 195.95, 1, 5, 5.95, 1.50, "Tues Dec 1 2015 23:55");
insert into orderedItems values(99999999, 7777777);
insert into orderedItems values(99999999, 7777777);


/* Gets the information of all orders */
select orderInfo.orderID, orderInfo.customerID, product.name, product.productID
from orderInfo
join orderedItems on orderedItems.orderID=orderInfo.orderID
join product on product.productID=orderedItems.productID;
/* output
OrderID|CustomerID|Product|ProductID
88888888|111111111|Butt Boxers|7777777                                                                                                                                                                                            
88888888|111111111|Butt Boxers Mk2|7777778                                                                                                                                                                                        
88888888|111111111|Butt Boxers Mk2|7777778                                                                                                                                                                                        
99999999|123456789|Butt Boxers|7777777                                                                                                                                                                                            
99999999|123456789|Butt Boxers|7777777 
*/

/* Get only order #88888888's information */
select orderInfo.orderID, orderInfo.customerID, product.name, product.productID
from orderInfo
join orderedItems on orderedItems.orderID=orderInfo.orderID and orderedItems.orderID=88888888
join product on product.productID=orderedItems.productID;
/* output
OrderID|CustomerID|Product|ProductID
88888888|111111111|Butt Boxers|7777777                                                                                                                                                                                            
88888888|111111111|Butt Boxers Mk2|7777778                                                                                                                                                                                        
88888888|111111111|Butt Boxers Mk2|7777778
*/
      
/* Get all of Hello World's orders */
select customer.firstName, customer.lastName, customer.ID, customer.email, product.name
from customer
join orderInfo on orderInfo.customerID=customer.id and customer.firstName = "Hello" and customer.lastName = "World"
join orderedItems on orderedItems.orderID=orderInfo.orderID
join product on product.productID=orderedItems.productID;
/* output
First|Last|CustomerID|email|Product
Hello|World|111111111|helloworld@sjsu.edu|Butt Boxers                                                                                                                                                                             
Hello|World|111111111|helloworld@sjsu.edu|Butt Boxers 
*/