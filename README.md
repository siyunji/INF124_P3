# INF124_P3
This is the repository for INF124 project three, a shopping web for chocolate, using java servlets store and track each users' recently viewed items and purchased items.

In our group, there are three group members : Zhaomin Li, Sunjun Ahn, and Siyun Ji.

Running on ` `   
1. We created the `mostRecentViewed.java` to store what user viewed in a LinkedList and then print out by calling its item identification number. When the user views the item, it checks if there is duplicated item stored in the LinkedList. If there is, then it removes the existing one and then queue it to the end of its LinkedList. After it is queued in the LinkedList, the most recently viewed items will print out item's attributes(values) such as image, name, and price by its key(which is item identification number) upto 5 items. 


2. We created the `item.java` to create the product detailed page. As user select the product in advance, this page takes items identification number as a key and print out its attributes such as item's main image with its two other sub-images, name, price, and then detailed information. And This page has another session to stored item's indentification number as a key with user provided quantity as its value in a LinkedList in order to store in the cart.

3. For this requirement, we created `storeItems.java` to store the items which each user add into the shopping cart. Inside the session we created, we used a hashmap to store the information and the key of the hashmap is the product number and value is the quatities of this item. In `checkOut.java` we connect and access the database and show all of the production information on the page. After getting the quanity and price,we calculated the total price and then store in the database which connect with the user information. Then in `storeItems.java`, we insert the user purchase information into the database though "post" method. Then we use "forward" to forward request and response to the confirmation page. In`confirm.java`, we got the information sent by "forward" and use html code in to reveal the comfirmation page.    


 --Explanation for other file: 
`Info.css`: css file connected to `confirm.html`
`home.html`: show the home page with information we get from database.
`home.css`: css file connected to `home.html`
`shop.html`: show the shopping page with information we get from database.
`shop.css`: css file connected to `shop.html`



