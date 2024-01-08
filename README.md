# Doct'HUH'lib

## Prerequisites
As we are using a router to index and redirect our pages you might need to allow this kind of redirection on your web server. 
Here is a list of services that are known to work with our project

__Apache 2:__ You will need to activate the module Rewrite Engine and add headers to your vhost conf file:
````bash
1. sudo a2enmod rewrite 
2. sudo service apache2 restart
````
Then add this to your vhost conf file:
```apacheconf
 	<Directory [path to the project]>
		Options Indexes FollowSymLinks
                AllowOverride All
                Require all granted
		RewriteEngine On

                RewriteCond %{REQUEST_FILENAME} -f [OR]
                RewriteCond %{REQUEST_FILENAME} -d
                RewriteRule ^(.+) - [PT,L]

                RewriteRule ^assets/(.*)$ public/assets/$1 [L]

                RewriteBase /
                RewriteRule ^ index.php
	</Directory>
```

__Nginx:__ You will need to activate a similar module:
```
#
# Redirect all to index.php
#
RewriteEngine On

# if a directory or a file exists, use it directly
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

location / {
    try_files $uri $uri/ /index.php;
}
```
# Folders
```
.
├── resources			# Contains the needed files to initialize the database
├── assets			# assets files (images)
│   └── img			# Images kept (users pfp and icon of website)
├── src				# src files (controllers, dao, html requisites)
│   ├── appli			# Controllers files and utils.php file
│   ├── css			# CSS files used by HTML
│   ├── dao			# DAO files (Database Access Object)
│   ├── js			# JS files used by HTML
│   ├── metier			# Object files for collecting Database data.
│   └── view			# Views ('HTML' files as PHP)
│   README.md			# This file, contains instructions
└── index.php			# Router file
```

# Server structure
## The router
> A router is used to redirect the client where needed depending of the context path (/...). The program will **always** go through this file.

The router can be found at `./index.php`, at the root of the project.

## The controllers
> The controllers contains all the necessary operations tofor a web page, such as inserting and selecting from the database and stocking it in variables, gathering $_POST values, ...

The controllers can be found at `./src/appli/`:
- `cntrlLogin.php` is used for all operations related to login. (connection, editing, disconnection, registering)
- `cntrlApp.php` is used for the rest of the application.

## The DAO (Database Access Object)
> A DAO is used to collect and insert into the database. It contains objects that haveare initialized with the database name, port, table name, user and password.

The DAO can be found at `./src/dao/`. Each file is named `DaoX.php`, where `X` represents the name of the table being accessed.

## The Objects
> Objects are used to represent a concept thanks to proprieties and functions.

The objects can be found at `./src/metier/`. Each file has the name of its corresponding object in it. It is used to represent a table in the database, such as `User.php`, `Speciality.php`, `Meeting.php`, ...

## The views
> A view is corresponding to what the user will see on their screen, and therefor should have nothing more than the HTML code as well as required echo and foreach loops (which stays as stuffdatas showed on the screen of the user!)

The views can be found at `./src/view/` and usually start with a `v` if they are showed to the user. *(i.e: header.php isn't showed to the user on its own: though it is used on every page and therefor represent a "view")*

## Usage
- In order to connect as a user (to take a rendez-vous or consult your history) or as a doctor (to create appointements and manage your rendez-vous) the __default password__ is for all base users: __Isen44N__

- The website view is different if you are connected as a lambda user or as a doctor. 
To differenciate them, you can either create one in the corresponding login/creation section or check the column id_speciality in the users table.
If the user has a speciality, then it's a doctor, otherwise if null it's a user.

- Don't forget to change the const in the file `/src/appli/utils.php` and adapt them to your backend configuration
- You will find the sql creation document and insert document inside `/ressources/` as `CTDoctisen.sql` and `ITDoctisen`.




