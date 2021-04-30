# Covid19StatWebApp

Short description of the App

## Installation

# Detail steps for how to setup Web App locally:

## - XAMPP

- Ensure XAMPP Apache Server is running and the project folder is in the htdoc folder.
- Ensure XAMPP Sql server is running.

## - Database Setup

- Open Datagrip or your prefered DBMS application and create a connection to the XAMPP MySql server.
- Open the query file database->DatabaseSetup.sql.
- Run the entire script to create the Schema and related tables.
- NOTE: You might need to alter the 'dbconfig.php' file to point to your correct ip:port of you db.

## - Access Application

- Open the application.
- Navigate to the 'Signup' page and create an account.
- Click the login link at the bottom of the navigation bar and login with your new credentails.
- Once logged in, you can access the 'settings' page in the NavBar.
- Click the 'Update All Country Data' button to download all of the required data from the API.
- You will need to wait an extended time until the process is complete.
- A notification will tell you when the update is complete.

> ### Once the above steps are followed. You will now be able to use the application to read the Covid19 Data.
