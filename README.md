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
add these two lines as very first instructions:

```php
<?php

require __DIR__.'/../../MesaVolt/five-oh-three/src/FiveOhThree.php';
FiveOhThree::checkAndRender();
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

```bash
FiveOhThree::checkAndRender([
    'lock_path' => __DIR__.'/../estoy-deployin.lock',   // path to lock file
    'template' => __DIR__.'/res/deploying.html',        // path to custom template (can either be a PHP or HTML file)

    // when using the default template:
    'auto_refresh' => false,            // you can disable the auto-refresh...
    'auto_refresh_interval' => 30,      // ... or customize its interval
    'icon' => 'http://bestanimations.com/Site/Construction/under-construction-animated-gif-8.gif',
]);
```
