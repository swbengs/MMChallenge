# api design file

## URL(names are not final)
all api have a prefix of /api/ which I will not keep re-typing. An example: /api/page would get the pagination result

### Required
1. page(get page JSON of pokemon page number and or setting for # per page) not sure 100% how to do pagination
2. single(single pokemon pokemon id to display info for)
3. register(new trainer requires email and password)
4. mark(trainer email and password and id of pokemon to mark caught)
5. marked(trainer mail and password. Returns all pokemon caught. Probably just pokemon id and name)

### Admin
1. setup(allows all tables to be wiped and started clean. Should probably have authentication and or password but first version will just be available to anyone who knows of it)

### Debug/dev

