# yajra-datatable-demo

## Prerequisite
* laravel 59
* composer (installed in global path)
* Apache
* MySQL

## Steps to run project locally
1. Clone this project to your server root directory using following command.<br/>
    <b> git clone https://github.com/ashishradadiya/yajra-datatable-demo.git </b>
2. Go to project root directory (yajra-datatable-demo) and open cmd/terminal on that path.
3. Perform this command: <b> composer install </b>
4. Do necessary changes in .env file(i.e. database connection properties).
5. Perform this command to create the table: <b> php artisan migrate:refresh </b>
  6. Perform this command to load data in table: <b> php artisan tinker </b> and then <b> factory(App\User::class, 50000)->create(); </b>
7. Open this URL in browser. http://localhost/yajra-datatable-demo/
