# File for database design ideas

## Pokemon table
Field names are "id","name","types","height","weight","abilities","egg_groups","stats","genus","description"

types, abilities, egg_groups, and stats contain multiple values inside.

Stats contains the 6 stat values always.
The others can have 1 or more values for a single pokemon

Thus types, abilities, and egg_groups can be single tables that add the pokemon id each time they need another type. Will waste space but not require making another table to link with.
Stats can just be one large table with 6 columns that each pokemon links to with their stats.

## Trainer table
Trainers need to supply an email and password. Should have 3 fields, id, email, pass
