# api design file

## URL(names are not final)
all api have a prefix of /api/ which I will not keep re-typing. An example: /api/pokemon?page=1 would get the pagination result

### Required
1. page(get page JSON of pokemon page number and or setting for # per page)
2. pokemon(single pokemon pokemon id to display info for)
3. register(new trainer requires email and password) return api token used for trainer api calls like mark, marked
4. caught(api token id of pokemon to mark caught)
5. all_caught(api token. Returns all pokemon caught. Probably just pokemon id and name)

### Admin
1. setup(allows all tables to be wiped and started clean. Should probably have authentication and or password but first version will just be available to anyone who knows of it)

### Debug/dev
1. test(simple test route)

### Sample routes for homestead
* Single pokemon get
   * http://192.168.10.10:8000/api/pokemon/1  gets pokemon with id of 1. in this case Bulbasaur
   * http://192.168.10.10:8000/api/pokemon/7  gets squirtle
* Paginate
   * http://192.168.10.10:8000/api/pokemon?page=1&per_page=9 page 1 and per page of 9 pokemon
   * http://192.168.10.10:8000/api/pokemon?page=10 page 10 and default per page of 15
* Trainer(register, login, logout, view caught pokemon, and mark a single pokemon as caught)
   * http://192.168.10.10:8000/api/register?name=scott&email=test@test.net&password=pass&password_confirmation=pass //register the user with name scott, email of test@test.net, and password of pass
   * http://192.168.10.10:8000/api/login?email=bob@test.net&password=password //login with user that has email bob@test.net and password of password
   * http://192.168.10.10:8000/api/logout?email=bob@test.net&password=password //logout with user that has email bob@test.net and password of password
   * http://192.168.10.10:8000/api/user?api_token=NnYCIUJimBXRTCGkK2x2eZUGMdsDk4budlS7S0JS694QLSllHnDZlhA1FnFb //returns information about user who has this api_token. Good way to check the login worked
   * http://192.168.10.10:8000/api/trainer?api_token=NnYCIUJimBXRTCGkK2x2eZUGMdsDk4budlS7S0JS694QLSllHnDZlhA1FnFb //views pokemon caught by trainer with this api_token
* Admin
   * http://192.168.10.10:8000/api/admin/setup  runs the setup method that will fill in the pokemon table from the CSV file. Trying to re-run it will cause an exception and a debug page to show. Before running it again, use migrate:fresh to rebuild the table
