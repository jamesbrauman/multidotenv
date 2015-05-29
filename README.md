# multidotenv
> Simple per-environment .env files for Laravel 5.

multidotenv is a package for Laravel 5 that provides functionality to load an additional environment-specific .env file.

## How it works
Laravel 5 uses the [dotenv](https://github.com/bkeepers/dotenv) package to load the `.env` file in the root directory. multidotenv extends Laravel 5 so that an additional `.env` file is loaded depending on the environment name.

For example, given a `.env` file containing:
```
DB_HOST=localhost
DB_DATABASE=my_project
DB_USERNAME=root
DB_PASSWORD=root
```
and a `.env.testing` file containing:
```
DB_DATABASE=my_project_testing
```
when running the command `php artisan migrate --env=testing` the loaded enviroment variables would be:
```
DB_HOST=localhost
DB_DATABASE=my_project_testing
DB_USERNAME=root
DB_PASSWORD=root
```

## Installation

Add `thesnackalicious/multidotenv` to your `composer.json` file:

```
"require": {
  "thesnackalicious/multidotenv": "dev-master"
}
```

Use `composer` to install this package.

```
$ composer update
```

### Update Web Kernel and Console Kernal
Add a `bootrappers()` function to the `app/Http/Kernel.php` file and the `app/Console/Kernel.php` file:
```
/**
 * Get the bootstrap classes for the application.
 *
 * @return array
 */
protected function bootstrappers()
{
    $search = 'Illuminate\Foundation\Bootstrap\DetectEnvironment';
    $replacement = 'TheSnackalicious\MultiDotEnv\DetectEnvironment';

    return array_map(function($v) use ($search, $replacement) {
        return $v == $search ? $replacement : $v;
    }, $this->bootstrappers);
}
```
