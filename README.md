# Coingecko API Data Fetcher

## Installation

1. Clone the repository
2. Run `composer install` to install dependencies
3. Copy the `.env.example` file and rename it to `.env`
4. Configure the database and Coingecko API settings in the `.env` file
5. Run `php artisan migrate` to create the required database tables
6. Run `php artisan key:generate` to generate an application key

## Usage

Run the following command to fetch data from the Coingecko API and store it in the database:

```
php artisan coingecko:fetch-data
```

Any errors encountered during the API call will be inserted into a new table named `api_logs`.

You can view the API logs in the `api_logs` table.

Thank you for using Coingecko API Data Fetcher!
