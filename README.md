https://www.xlmeapp.com/

- [Setup](#setup)
    - [Dev Env](#development)
        - Docker
        - Git Hooks
            - [Pre-commit](#pre-commit)
        - Git Actions
    - Prod Env
        - Server script

  
  
# Setup  

## Development

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