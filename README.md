https://www.xlmeapp.com/

- [About](#about)
- [Setup](#setup)
    - [Dev Env](#development)
        - First steps
            - [env file](#env-file)
        - Artisan Commands
            - [Seeding Dummy Data](#seeding-dummy-data)
        - Database
        - Docker
        - Git Hooks
            - [Pre-commit](#pre-commit)
        - Github Actions
            - [CI](#ci)
        - Tests
            - [Feature](#feature)
    - Prod Env
        - Server script


# About

  
# Setup  

## Development

### First Steps

```
docker compose build
docker compose exec -it house_app bash
composer install
npm install
npm run dev
```

#### env file
Please make sure to copy the .env.example file. To seed dummy data and run tests make sure to provide the 3 test user values:
```
TEST_USER_EMAIL
TEST_USER_USERNAME
TEST_USER_PASSWORD - Please provide a complex password that otherwise passes validation
``` 

### Artisan Commands

#### Seeding Dummy Data
Command can be found at -> App/Console/Commsds/SeedDummyData.php

This command works to populate your database and can be ran via:
```
php artisan app:seed-dummy-data
```
This command will run the following 2 Artisan commands
```
php artisan migrate:fresh
php artisan db:seed --class=DummySeeder
```
Of note, the command will fail if your current environment is not set to 'local'

### Database

### Docker
```
docker compose build
docker exec -it houze_app bash
npm install ----------- Required one time to generate dependencies from package.json
npm run dev
```

### Git Hooks

#### Pre-commit
Please include the following at the top of your .git/hooks/pre-commit file
```
# Reformat with pint formatter
files=$(git diff --cached --name-only --diff-filter=ACM -- '*.php');
docker exec xlme_v1_app ./vendor/bin/pint $files -q
filesFormattedWithPint=(${files// / })
git add $files
echo "${#filesFormattedWithPint[@]} files reformatted with Laravel Pint and inital files added back into commit"
```

### Github Actions

#### CI
A .github/workflows/ci.yml file exists that runs the features tests on push.


### Tests

#### Feature
Feature tests are used for core abilities of the application. Testing makes use of the PHPUnit framework.

Before running the testing command please make sure to have migrated and seeded the database. Please follow the [Seeding Dummy Data](#seeding-dummy-data) section.
```
php artisan test --filter Feature
``` 