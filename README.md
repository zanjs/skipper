Laravel Admin & BREAD System (Browse, Read, Edit, Add, & Delete), made for Laravel 5.3.


After creating your new Laravel application you can include the Skipper package with the following command: 

```bash
composer require anla/skipper dev-master
```

Next make sure to create a new database and add your database credentials to your .env file:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Add the Skipper service provider to the `config/app.php` file in the `providers` array:

```php
'providers' => [
    // Laravel Framework Service Providers...
    //...
    
    // Package Service Providers
    Anla\Skipper\SkipperServiceProvider::class,
    // ...
    
    // Application Service Providers
    // ...
],
```

Lastly, we can install skipper by running

```bash
php artisan skipper:install
```

Note: If you don't have composer installed and use composer.phar instead, run the following 2 commands:

```bash
composer.phar dump-autoload
php artisan db:seed
```

And we're all good to go! 

Start up a local development server with `php artisan serve` And, visit http://localhost:8000/admin and you can login with the following login credentials:

```
**email:** z@z.com
**password:** password
```
