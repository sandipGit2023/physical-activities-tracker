## Initial setup

1. Create .env with .env.example content

2. Generate keys:
   `php artisan key:generate`

3. Replace with your local db credentials

4. Install dependencies
   `composer install`

5. Run migration:
   `php artisan migrate`

6. Seed db (Adds some data to the db for testing purposes)
   `php artisan db:seed`

7. Run the server
   `php artisan serve`
