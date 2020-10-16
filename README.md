# mantenenceWebApp

composer install
composer require fzaninotto/faker

# configure .env

database.default.hostname = localhost
database.default.database = ci4-2
database.default.username = laravel
database.default.password = password
database.default.DBDriver = MySQLi

# configure app/Config/Database.php
public $default = [
		'DSN'      => '',
		'hostname' => 'localhost',
		'username' => 'laravel',
		'password' => 'password',
		'database' => 'c4-2',
# run migration
$ php spark migrate

# run seeder
$ php spark db:seed UserSeeder
$ php spark db:seed MaintenanceSeeder

# video 13:10