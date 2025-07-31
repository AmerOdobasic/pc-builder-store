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
When viewing your admin dashboard, you can look at all of the products in the database. You can either add, delete or even edit them
Everything is simple until you get to the add products part
To add a product, I currently only have it so that only one option can be added for one product
Fill in all of the required options for adding the product
I have added an image called 'product-test.jpg' which is already included in assets/images. 
IMPORTANT: You must upload new photos into assets/images and copy/paste the relative path into the form when adding a product

You can add new help pages in help-section/ and Orders are tracked in orders and order_items tables

Since I have time to update the website more, I will be possibly adding a way for the admin to track the orders made from customers and i will be adding a themes charger to the admin portion aswell along with better mobile support

My URL for the website 
If you have any problems trying to run my project, please let me know as soon as possible at my email odobasia@uwindsor.ca 