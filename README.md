# CS174 Ticon
This is a group project for CS 174. We're working on a online shopping website for clothes... but it's only a simulation. ONLY. A SIMULATION.

Group members:
* Allen Bui ([allenbui94](https://github.com/allenbui94)) - just kinda organized stuff...
* Sridivya Kondapalli ([jardinargent](https://github.com/jardinargent)) - did most of the front end
* Daniel Li ([akina1051](https://github.com/akina1051)) - made some funny banners
* Edwin Tsang ([etsan](https://github.com/etsan)) - did most of the work

# Setup

1. Open up your DB2 admin command window and then run the batch script named `db2_setup.bat`. Let's hope everything works as intended. This will make sure the database is set up and preloaded with some data.
2. Make sure you have XAMPP installed on your computer. Make sure it can navigate to the project directory and access `index.php`.
3. Enjoy. Feel free to inspect our pitiful project and test out its functionality, but I assure you it works... at least on our machines.
4. If ever the database messes up, try running `db2 -tvmf sql\clean-reinit.sql` and then `db2 -tvmf sql\insert_statements.sql` to fix the database.

## Templates
We shamelessly grabbed lots of stuff online. Thanks to:
* Start Bootstrap
