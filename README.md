# TodoList

# Getting started

## Installation

Clone the repository

    git clone https://github.com/ramo772/TodoList.git

Switch to the repo folder

    cd companies-employees

Install all the dependencies 

    composer install

    
Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env




Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000/companies  &&  http://localhost:8000/employees
