[![PHP Tests](https://github.com/5upermario/slim-skeleton/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/5upermario/slim-skeleton/actions/workflows/php.yml)

# Create project

```bash
composer create-project 5upermario/slim-skeleton project-name

# Docker:
docker run --rm --interactive --tty --volume $PWD:/app --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp composer create-project 5upermario/slim-skeleton project-name
```

# Utilities

Serve application
```bash
composer serve
```

It runs a dev server on port 8000

Run tests
```bash
composer test
# Or
npm run test

# Docker:
docker run --rm --interactive --tty --volume $PWD:/app --volume ${COMPOSER_HOME:-$HOME/.composer}:/tmp composer test
# Or
npm run test:docker
```

Watch tests

```bash
npm run watch:test

# Docker:
npm run watch:test:docker
```

# Additional features

## Event dispatcher

You can setup events and listeners in config/events.php like

```php
return [
    \App\Example\Domain\Event\SomeEvent::class => [
        \App\Example\Domain\Event\SomeListener1::class,
        \App\Example\Domain\Event\SomeListener2::class,
    ],
];
```

Then you can evaluate these events with the EventDispatcher class

```php
class ExampleClass {
    private EventDispatcher $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher) {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function someFunction() {
        $this->eventDispatcher->dispatch(new SomeEvent());
    }
}
```
