PART 1: SETTING UP REPO

(Note that this is my first submission and things will be changing in this read me file)

Github repo link: https://github.com/AmerOdobasic/pc-builder-store/tree/master
My own myweb link for the webpage = https://odobasia.myweb.cs.uwindsor.ca/pc-builder-store/index.php

What is the project about? It is a simple project focusing on how PHP + MySQL can be used for an e-commerce site for purchasing PC parts. 
So far, this includes dynamic product options, admin product management, shopping cart & checkout system, user authentication, and a help center with FAQs. 

1. To set up the project, you can either clone this repo or download the ZIP from my submission on D2L and extract it.
2. a) Import the Database
   b) Open phpMyAdmin
   c) Select your database (e.g., yourusername_db)
   d) Import the pcbuilder.sql file from the 'other/pcbuilder.sql' file path

NOTE: Do NOT include CREATE DATABASE statements in your SQL when importing to myweb. I had this error when trying to import my database into myweb

3. Configure db.php in 'other/db.php';
    $host = 'localhost';
    $db = 'your_db_name';
    $user = 'your_myweb_username';
    $pass = 'your_db_password';

    If you are using this locally, like with XAMPP, do this;
    $host = 'localhost';
    $db = 'pcbuilder';
    $user = 'root';
    $pass = '';
    (Check permissions in phpMyAdmin if you are having trouble with this)

4. Upload to myweb
    Upload the project via FTP or File Manager to:
    /home/yourusername/public_html/

5. Your live site will be at:
    https://myweb.cs.uwindsor.ca/~yourusername/index.php

ADMIN ACCESS
I have created two accounts that are visible in the 'users' table on my database, those are a user and admin
- For the admin account, simply sign in using the navbar and click the 'log in' button
The Email for the admin = admin@gmail.com and the password = 'password' (most strongest password of all time i know...)
- For the user account, the email = user@gmail.com and password = 'abcd123'

ADDING PRODUCTS 
When viewing your admin dashboard, you can look at all of the products in the database, and you can either add, delete, edit, or view orders.
Everything is simple for you until you get to the 'add products' part
Fill in all of the required options for adding the product
I have added 2 test images called 'product-test.jpg' and 'product-test2.jpg' which is already included in assets/images to use 
IMPORTANT: You must upload new photos into assets/images and copy/paste the relative path into the form when adding a product

Also in the admin dashboard, you can also view all of the orders that have been placed. You can view the order details and the order status and change the status of the order. 
If you look at the header, you also can view the responses sent from people who need help/contacted support. The response will be sent to the server along with the time of the response.

If you have any problems trying to run my project, please let me know as soon as possible at my email odobasia@uwindsor.ca 
