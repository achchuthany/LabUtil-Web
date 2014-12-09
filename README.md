
Requirements
===========
PHP 5.3.7+
1. MySQL 5 database (please use a modern version of MySQL (5.5, 5.6, 5.7) as 
   very old versions have a exotic bug that makes PDO injections possible.

Server Installation (quick setup)
===========

1. create database " labutil " and table users via the SQL statements in the " _database " folder.
2. in administer/advanced/config/config.php, change mySQL user and password (DB_USER and DB_PASS).
3. in administer/advanced/config/config.php, change COOKIE_DOMAIN to your domain name 
	(and don't forget to put the dot in front of the domain!)
4. in administer/advanced/config/config.php, change COOKIE_SECRET_KEY to a random string. 
	this will make your cookies more secure
5. change the URL part of EMAIL_PASSWORDRESET_URL and EMAIL_VERIFICATION_URL in administer/advanced/config/config.php
	to your URL! You need to provide the URL of your project here to link to your project from within 
	verification/password reset mails.
	

Help
==========
Blog
====
http://jfn-csc-rad-g7.blogspot.com

Client Software 
====
https://sourceforge.net/projects/labutilization

Client Software Installation
=====
http://jfn-csc-rad-g7.blogspot.com/2013/12/labutil-client-installation.html
