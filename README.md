# StageMatch


## Installation

1. Create an empty database.

 2. Create a copy of the ".env.example" file, call it ".env" and fill your config details in. **Including the database details**.
 
 3. Run the following command in a terminal in the **project root**:
 `composer install 
 && npm i 
 && php artisan key:generate
 && php artisan jwt:secret
 && php artisan storage:link
 && php artisan migrate:fresh --seed`
 
2. After everything ran successfully without errors, start a second terminal in the **project root** again.

3. Run `npm run watch` in 1 terminal and `php artisan serve` in the other one


## Trello board
https://trello.com/b/N7G2g1ka/stage-match-project-genderneutraal