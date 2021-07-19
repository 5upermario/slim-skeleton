[![PHP Composer](https://github.com/5upermario/slim-skeleton/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/5upermario/slim-skeleton/actions/workflows/php.yml)

# Create project

```
composer create-project 5upermario/slim-skeleton project-name
```

# Create project using docker
```
docker run --rm --interactive --tty --volume $PWD:/app --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp composer create-project 5upermario/slim-skeleton project-name
```

# Utilities

## Serve application

```
composer serve
```

It runs a dev server on port 8000

## Run tests

```
composer test
```

## Watch tests

```
npm run watch:test
```
