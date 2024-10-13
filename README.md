# FutureTech: Empowering the Future with Technology

Our website is built in such a way that each components like the navigation bar, the forms (Login form, Add Product form, etc..) is on it own folder. Our idea was to make each components modular so at it is easy to when we will add a new page to the website.

Additional, you will only have access to the admin part of the website if you log in with an admin credentials.

Admin credentials: 
Email: kisto@futuretech.com
Passwd: 123456789


# Folder Explanation

- ### DB_CONNECT
    
    This folder has the PDO connect for the user's part and admin part.

- ### DB_SQL_EXPORT
    
    Has the database export

- ### Essential_tags

    Has some common tags that needs to be put in every page.

- ### Forms
  
    Has individual forms like product add, login form, signup form. This method allows up to just include the form in multiple pages like lego bricks. This method allows us to ensure that when the referenced form is modify, everything follow through.

- ### Images
  
    Just has our nav bar logo.

- ### JS
  
    Has all of our JavaScript files.

- ### Menu
  
    Store the the navigation bar's menu and the menu itself.

- ### Product-search
    has the php files which is going to output the cards on the different tabs to show the product. One file in particular `live-search.php` is the file that the JQuery reference for the live search feature.

- ### Uploads

    Has our images that the admin will he will add the products

- ### ValidationRoutes

    Has the verification and validation of users, admins, 
