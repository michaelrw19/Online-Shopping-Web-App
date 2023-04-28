Team 37
- Jenny Su, 500962385
- Tiffany Tran, 500886609
- Kevin Tran, 500967982
- Michael Widianto, 501033366


Before running this application:
- open a terminal and run the 'npm install' command inside the react-app folder
- inside the react-app folder, create a file named '.env.local' and copy and paste 
  the following line inside the .env.local file: REACT_APP_GOOGLE_MAPS_API_KEY=AIzaSyCLherBXiXAewyPuGAs-5Hs47p0-_D7VcQ
- in react-app/php/dbConnection.php, change the connection settings to your own 
  settings (e.g. your hostname, password, etc)

Steps for running this application:
- open XAMPP and start Apache and MySQL
- navigate to the react-app folder and run the following two commands in separate terminals:
    - in react-app/php folder: php -S localhost:8000
        then create the database tables and populate records by running the createTables.php and
        populateRecords.php files:
        localhost:8000/Table/createTables.php
        localhost:8000/Table/populateRecords.php (only run once or dupe records will be created)
    - in react-app folder: npm start
- the application should then open on localhost:3000


Note: If your terminal doesn't recognize 'php' as a command, go to your environment variable settings -> system variables -> select Path -> edit Path and add the location of the php folder that came with XAMPP (e.g. something like C:\xampp\php). If running in an IDE, restart the IDE
