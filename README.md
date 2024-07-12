
# The Hair Hub

Created by: Joel K. Kusi.


## Installation

Install the_hair_hub with composer & npm

```bash
  cd the_hair_hub
  composer install
  npm install
  copy env.example
  paste and rename it to .env
  php artisan key:generate
  php artisan migrate // It should create a database.
  php artisan migrate:fresh --seed
```
    
## Features

- CRUD for users(admin, employee & customer)
- CRUD for appointments
- Overview user information
- Overview worked hours of an employee


## FAQ

#### How do I login?

- Email: admin@example.com
- Password: password

#### Login doesn't work

- You probably forgot to seed the database
- Run the next command

```bash
  php artisan migrate:fresh --seed
```

#### I created/updated a user or appointment but noting happened

- For some reason the errors are not displaying but that's why
- If you get redirected to another page that's when you know something has been submited succesfully
## Just so you know

- When displaying the appointments in the Employee and Customer column you'll only see numbers those are the id's
- A customer can only edit a appointment if the status is "Approved"
- If a customer edits a appointment the status goes to "Pending"
- Unfortunately you cannot assign product(s) to an appointment