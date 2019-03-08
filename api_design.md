# api design file

## API calls
- All calls are designed to work with HTTP GET. A few need the URL line querys such as page or email. You can type in the fields just like shown below in a browser to test the API
- Making a program or app to do this for you is even better but more time consuming
- Tested in Laravel Homestead version 8.02

## URL
all api have a prefix of /api/ which I will not keep re-typing. An example: /api/pokemon?page=1 would get the pagination result. I will only show the pokemon?page=1 part the api is assumed to have been added

### Required
1. pokemon?page=pagenumber&per_page=perpage //views all pokemon available. per_page is not required. The default if not there is 15. page starts at 1 and goes until the last pokemon is shown. In our case it's number 553. Extra data from laravel is sent back such as previous and next page number
2. pokemon/number //replace number with an actua number. pokemon/7 shows squirtle, who has an id of 7
3. register?name=name&email=email&password=password&password_confirmation=password //all these GET fields are required. Replace the part after = with the actual name/email and so on
4. trainer?api_token=token //View the given user who has the sent API token's caught pokemon
5. trainer/mark?api_token=token&pokemon_id=id //Marks the pokemon with said id as caught for the trainer who matches the api token given. pokemon_id=7 would set squirtle as caught since it has an id of 7. These are all aquired from viewing them individually or by pagination

### Trainer/User related
* A trainers user name is their email they give
* After registering and after all logins, a new API token is generated. This is required to access the caught pokemon list and to add more pokemon to the list
1. login?email=email&password=password //login with user. All fields required. Creates new api token. Previous one is invalid
2. logout?email=email&password=password //logout with user. All fields required. Clears the users api token so it is invalid

### Admin
1. admin/setup //fills in the pokemon related tables. Tables must be manually cleared between runs of this command. Only needs to be done once. If you wipe the DB for any reason just run it again

### Debug/dev
1. test(simple test route)

### Example of how to use
1. View single pokemon or view the pagination form to get an idea of what pokemon are out there. Note pokemon id numbers for later use
2. Create a trainer with register. Keep the api_token that is passed back to you. Username is your email. Don't forget your password.
3. Login and logout as needed to make new api tokens or clear old ones. You can stay logged in as long as you want. The system will not auto log you out.
4. Use this to start marking pokemon you have caught with trainer?apitoken&pokemon_id GET fields. If you caught a blastoise send it with pokemon_id=9 for example.
5. View pokemon you have caught. Some basic information about the trainer is sent back and a JSON array with the id and name of all pokemon you listed as caught.
6. Enjoy!

### Sample routes for homestead
* Single pokemon get
   * http://192.168.10.10:8000/api/pokemon/1  gets pokemon with id of 1. in this case Bulbasaur
   * http://192.168.10.10:8000/api/pokemon/7  gets squirtle
* Paginate
   * http://192.168.10.10:8000/api/pokemon?page=1&per_page=9 page 1 and per page of 9 pokemon
   * http://192.168.10.10:8000/api/pokemon?page=10 page 10 and default per page of 15
* Trainer(register, login, logout, view caught pokemon, and mark a single pokemon as caught)
   * http://192.168.10.10:8000/api/register?name=scott&email=test@test.net&password=password&password_confirmation=password //register the user with name scott, email of test@test.net, and password of password(needs to be at least 6 characters)
   * http://192.168.10.10:8000/api/login?email=bob@test.net&password=password //login with user that has email bob@test.net and password of password
   * http://192.168.10.10:8000/api/logout?email=bob@test.net&password=password //logout with user that has email bob@test.net and password of password
   * http://192.168.10.10:8000/api/user?api_token=NnYCIUJimBXRTCGkK2x2eZUGMdsDk4budlS7S0JS694QLSllHnDZlhA1FnFb //returns information about user who has this api_token. Good way to check the login worked
   * http://192.168.10.10:8000/api/trainer?api_token=NnYCIUJimBXRTCGkK2x2eZUGMdsDk4budlS7S0JS694QLSllHnDZlhA1FnFb //views pokemon caught by trainer with this api_token
   * http://192.168.10.10:8000/api/trainer/mark?api_token=GIAfkmeXrqPeXyAT06waPhW5nEx6csld14zlOlUg8USYJ8cJCS9CVQFwRVyA&pokemon_id=1 //mark pokemon with an id of 1 as caught for this trainer
* Admin
   * http://192.168.10.10:8000/api/admin/setup  runs the setup method that will fill in the pokemon table from the CSV file. Trying to re-run it will cause an exception and a debug page to show. Before running it again, use migrate:fresh to rebuild the table
