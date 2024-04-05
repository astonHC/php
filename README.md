# php
``CS1_IAD Portfolio 3 Repo``

![image](https://github.com/astonHC/php/assets/139020900/639a6b46-7b3a-4d3e-a07f-ac8cc688b1e7)


# Motive

This repository pertains towards the adherance of a Project Brief for CS1_IAD. Whereby the goal was to create a login system using php to communicate with a Database.

Any and all corresponding functionality can be found within these respective files, this is how I have it laid out on my local machine so if you were to build it for yourself, the layout would be the same.

# Build Instructions:

To build and use this project to verify all of the functionality, it would be a case of running XAMPP through your own Database.

However, I used my Arch Linux side of my PC to make this project so assuming you want to follow my steps, this is what I did

```1.```
update your repositories using ``sudo pacman -Syu``

```2.``` install [httpd](https://wiki.archlinux.org/title/Apache_HTTP_Server), [php-apache](https://archlinux.org/packages/extra/x86_64/php-apache/), [apache](https://archlinux.org/packages/extra/x86_64/apache/), [php](https://archlinux.org/packages/extra/x86_64/php/), [phpMyAdmin](https://wiki.archlinux.org/title/phpMyAdmin) and [mariaDB](https://wiki.archlinux.org/title/MariaDB)

# Setup the correspondence:

```1.``` cd into ``/etc/httpd/conf`` then run ``sudo YOUR_TEXT_EDITOR .`` and navigate to the prepriatory ``httpd.conf`` file

![image](https://github.com/astonHC/php/assets/139020900/b8e22306-f220-427e-92e7-124577b58662)

```2.``` comment this line using # ```"#LoadModule mpm_event_module modules/mod_mpm_event.so"``` and uncomment this line ```"LoadModule mpm_prefork_module modules/mod_mpm_prefork.so"``` 

```3.``` to enable php, in the same file, add these indents to the end of the file 

![image](https://github.com/astonHC/php/assets/139020900/093605a5-e1be-4501-a459-5824b0286c25)

```4.``` to setup phpMA, cd into ``/etc/httpd/conf/exta/phpmyadmin.conf`` and add these lines as shown

![image](https://github.com/astonHC/php/assets/139020900/a9d93dba-d5a6-4995-89c1-dc3c1b476724)

```5.``` last but not least, MariaDB

In a similar vein to how you would setup MySQL, run the mariaDB service ``sudo systemctl start mariadb.service``

create a new user using ``sudo mysql -u root``

from there, run the following 
![image](https://github.com/astonHC/php/assets/139020900/d130b22e-e9bc-4e5c-980d-e61a99189857)

and select ``Y`` for them all

# NOTE:

If in doubt whereby you are experiencing issues running phpMA on localhost or through any SSL connection, make sure that you cd into ``/etc/php`` then ``sudo YOUR_TEXT_EDITOR`` php.ini``

and add these lines:

![image](https://github.com/astonHC/php/assets/139020900/425e8738-0e72-4720-a11b-a3fead89fd42)

this adds the necessary funcrtionality to the phpMA connection because it will assume by default that you dont have the necessary mysqli extensions

Should you need any and all help with installation, email me at ``230315257@aston.ac.uk``

