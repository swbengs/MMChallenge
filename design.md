# File to cover general design for this project

## Phases
I plan for there to be 3 phases

1. Get basic project stuff in place and get the database up and running. Refresh my memory of PHP and databases. Get the CSV file loaded and able to fill the database up
2. All requirements met, even if not perfectly. Preferably find the password/secret database type but if it doesn't work at first it'll have to do.
3. Improvements for everything there is time for. Better database design, using more of Laravel framework, and so on.

## Things to do
1. Find easy to use IDE/editer for PHP. Visual studio code? others? Please no more notepad coding ;)
2. Design work
3. Keep studying Laravel and proper usage


## notes/ramblings
This section may sometimes belong in another file but it's where I'll write about things I know and or am still figuring out.

Route -> just like irl router. directs what should go to what view/controller etc
Models -> take control of a single table and data entry, deletion, updating etc
Controller -> many uses but a route points to this if done properly
View -> simple a webpage of some sort. Can be html, php, javascript, and so on.
Service -> similar to a controller but is used to stop controllers from knowing about eloquent and can share lots of generic code with controllers. Requires more files and proper directory management

No idea of what to call Pokemon.php. The purpose of this file/class is to abstract how a pokemon is stored in the database from other stuff. 
Lets us change the database representation and no one needs to know above it. Controller doesn't seem to fit. Maybe Service? Model does not fit because it doesn't control the tables itself.
The models themselves will control the tables but this will guide the models to save the pieces of a pokemon. Have a method to return JSON ready array/dictionary/table of a pokemon for controllers to use and so on.

