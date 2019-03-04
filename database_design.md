# File for database design ideas

## CSV file
type, abilities, egg groups, and stats are in JSON format. Use PHP JSON commands to grab the goods.

## Pokemon table
Field names are "id","name","types","height","weight","abilities","egg_groups","stats","genus","description"

types, abilities, egg_groups, and stats contain multiple values inside.

Stats contains the 6 stat values always.
The others can have 1 or more values for a single pokemon

Thus types, abilities, and egg_groups can be single tables that add the pokemon id each time they need another type. Will waste space but not require making another table to link with.
Stats can just be one large table with 6 columns that each pokemon links to with their stats.

Note: these are not neccesarily the names I'll use just getting the tables mapped out
* pokemon table(id, name, height, weight, genus, description)
* types table(pokemon id, type)
* abilities table(pokemon id, ability)
* egg_groups table(pokemon id, egg group)
* stats table(hp, speed, attack, defense, special attack, special defense) this table's id matches the pokemon id aka 1 to 1 relationship

Each table needs a model

## Trainer table
Trainers need to supply an email and password. Should have 3 fields, id, email, pass

* trainer table(email, password, time created, time updated, api token) add on to auth generated User
* caught table(id of trainer and id of pokemon that has been caught) is there a better way? Each trainer * 500+ caught pokemon is a lot of entries with many users
