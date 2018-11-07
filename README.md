# Simple validation rule

## What?
A simple validation to your Laravel 5.5+ Validation Rules. Including IP, e-mail validations and so on.
## Install
Install with composer:

```bash
composer require lee/laravel-simple-validation
```
## Usage
In your controllers, add the validation with your other rules:

```php

use Lee\LaraSimpleValidation;

$request->validate([
    'email' => 'required|string|email'
    'ip' => ['required', new LaraSimpleValidation],
]);
```
