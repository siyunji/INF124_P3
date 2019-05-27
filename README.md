# INF124_P3
This is the repository for INF124 project three, a shopping web for chocolate, using java servlets store and track each users' recently viewed items and purchased items.

In our group, there are three group members : Zhaomin Li, Sunjun Ahn, and Siyun Ji.

Running on ` `   
1. We created the `mostRecentViewed.java` to store what user viewed in a LinkedList and then print out by calling its item identification number. When the user views the item, it checks if there is duplicated item stored in the LinkedList. If there is, then it removes the existing one and then queue it to the end of its LinkedList. After it is stored in the LinkedList, the most recently viewed items will print out item's attributes(values) such as image, name, and price by its key(which is item identification number) upto 5 items. 

(1. the first servlet should handle the displaying of the list of products obtained from a backend database, and the second servlet should use session tracking to display the last 5 products that the user has visited (viewed the product details page). In case this number is less than 5, show whatever amount of information you have stored in the session. You are required to use servlet "include" feature to implement this requirement. 
2. Using servlets create a "product details" page. This page should take a product identifier as a parameter and show the product details after getting the relevant information from the database. This page should NOT have an order form, only a button to "Add to Cart". Use servlet "session" to store the products in a shopping cart. 

3. Using servlets create a "check out" page, which allows the user to place an order. The page should show all the products in the shopping cart and the total price. This page should have a form which will allow the user to do the following:

Enter shipping information: name, shipping address, phone number, credit card number, etc.
Submit the order for storage in the backend database
On successful submission, forward to the order details page. You are required to use servlet "forward" feature to implement this requirement. )


2.


3. For this requirement, we created `storeItems.java` to store the items which each user add into the shopping cart. Inside the Session, we used a hashmap to store the information and the key of the hashmap is the product number and value is the quatities of this item. In `checkOut.java` we connect and access the database and show all of the production information on the page. After getting the quanity and price,we calculated the total price and then store in the database which connect with the user information. Then in `storeItems.java`, we insert the user purchase information into the database though "post" method. Then we use "forward" to forward request and response to the confirmation page.   


 --Explanation for other file: 
`item.html`: we added the method "post" and set the action of form to redirect to the `confirm.php`.
`confirm.html`: we require `dbconnect.php` to get the connetion and inserted the information we got from users into the database.
`Info.css`: css file connected to `confirm.php`
`home.html`: show the home page with information we get from database.
`home.css`: css file connected to `home.php`
`shop.html`: show the shopping page with information we get from database.
`shop.css`: css file connected to `shop.php`
`item.js`: send request to `zip.php` and `tax.php`



