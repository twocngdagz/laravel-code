## About this project [test update]

A simple SPA using Laravel, Bootstrap and Vue

- Crawl the data from [2019 PSHS NCE Passers](http://www.pshs.edu.ph/nce2019/)
- List the passers alphabetically and paginated by 50 records.
- Search by name, school and division using full-text search.
- Can add a passer.
- Has a summary page of school with the number of passers.

## Install

Install the composer dependencies

```bash
composer install
```

Migrating passers table

```bash
php artisan migrate
```

Grabbing data from [2018 PSHS NCE Passers](http://www.pshs.edu.ph/nce2019/)
```bash
php artisan crawl:nce
```

### Assets

Installing front end dependencies requires `npm`.

```
npm install
```

To build assets run:

```bash
npm run dev
```
