At the begining run comand - (composer update). 
Then copy file (.env.example) to (.env) then run - (php artisan key generate).



##1. To add data to the database, you can use url ( /add_new_objects ) which will add information about asteroids for the last 3 days
##2. Or import data from ( public/Near Earth Objects.sql )
##3. Main url:
##- ( / ) show greetings
##- ( /add_new_objects ) add new information to db
##- ( /neo/hazardous )  shows potential hazardous objects
##- ( /neo/fastest/{hazardous?} ) shows all information from db sort by speed
