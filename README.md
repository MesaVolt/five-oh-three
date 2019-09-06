# FiveOhThree (503)

[![Latest Stable Version](https://poser.pugx.org/mesavolt/five-oh-three/v/stable)](https://packagist.org/packages/mesavolt/five-oh-three)
[![License](https://poser.pugx.org/mesavolt/five-oh-three/license)](https://packagist.org/packages/mesavolt/five-oh-three)

Easy to setup maintenance page.

## Installation

```bash
composer require mesavolt/five-oh-three
```

## Usage

In your app's entry point (something like `public/app.php` or `web/app.php`),
add these lines before the code that should only run if the lock file is not present :

```php
<?php
// replace the `use` line with this if you don't use Composer's autoloader
// require __DIR__.'/../vendor/mesavolt/five-oh-three/src/LockGuard.php';
use Mesavolt\FiveOhThree\LockGuard;

LockGuard::checkAndRender();
```

Before deploying your application, create a deploying.lock file in your project's root
directory. Remove it once your app can go live:

```bash
# deploy-my-project.sh

# Create the lock file
touch deploying.lock

# Here goes your usual deployment steps
export SYMFONY_ENV=prod
composer -n --ansi --no-dev install --optimize-autoloader
bin/console --ansi -n --env=prod cache:clear --no-warmup
# ...

# Remove the lock file
rm deploying.lock
```

## Customization

```php
<?php
use Mesavolt\FiveOhThree\LockGuard;

LockGuard::checkAndRender([
    'lock_path' => __DIR__.'/../estoy-deployin.lock',   // path to lock file
    'template' => __DIR__.'/res/deploying.html',        // path to custom template (can either be a PHP or HTML file)

    // when using the default template:
    'auto_refresh' => false,            // you can disable the auto-refresh...
    'auto_refresh_interval' => 30,      // ... or customize its interval
    'icon' => 'http://bestanimations.com/Site/Construction/under-construction-animated-gif-8.gif',
]);
```

## Testing

```bash
# run this once when you clone the project
composer install

# run this before every test to make sure vendor/autoload.php exists and is up-to-date,
# especially if you changed some namespaces
composer dump-autoload 

# launch the test suite
./vendor/bin/phpunit
```
