<?php

/*
**** User table ****
* id int primary key
* user group id int
* name varchar(40)
* email varchar(96)
* image
* gender varchar(5)
* password varchar(40)
* created int 
* status
*
*
*
**** group user ****
* id int primary key
* namr varchar(40)
*
*
*
**** permession ****
* id int primary key
* users group id int
* rules text
*
*
*
**** categories ***
* id int primary key
* parent_id int
* name varchar(96)
* 
*
*
**** projects ****
* id int primary key
* user id int
* project name varchar(255)
* (category) project player int
* number of slides int
* static int
* basic int
* animation int
* app int
* start date int
* end date int
* created int
* status

* resurces and hours and slides int
* project manager int
* Backgrounds text
* Thumbs text
*
*
*
**** comments (waves) ***
* id int primary key
* user id int
* project id int
* comment text
* created int
* status
*
*
*
**** settings ***
* id int primary key
* key varchar(40)
* value text
*/

?>