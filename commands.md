# Useful commands

## vagrant
* vagrant up //start laravel homestead
* vagrant halt //stop homestead
* vagrant ssh //start ssh session

## homestead
* php artisan make:thing thingname -m //make:thing will make that type of class. If a model the -m will make a migration as well
* php artisan serve --host 0.0.0.0 //start the php server. Needs to be run anytime the a route file changes. Page code will load the new stuff without restart
* php artisan migrate:fresh //will completely wipe the database and rebuild it

## mysql
* show databases; //shows the databases on the server
* use homestead; //this is the database that contains project databases
* show tables; //shows all tables in the used database
* describe table //shows what the structure of the table is
* select * from table //get everything from a table

