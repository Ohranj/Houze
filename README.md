https://www.xlmeapp.com/

- [Setup](#setup)
    - [Dev Env](#development)
        - Artisan Commands
            - [Seeding Dummy Data](#seeding-dummy-data)
        - Database
        - Docker
        - Git Hooks
            - [Pre-commit](#pre-commit)
        - Git Actions
    - Prod Env
        - Server script


  
  
# Setup  

## Development

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