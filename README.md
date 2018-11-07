[![Build Status](https://travis-ci.org/peter279k/laravel-simple-validation.svg?branch=master)](https://travis-ci.org/peter279k/laravel-simple-validation)
[![Coverage Status](https://coveralls.io/repos/github/peter279k/laravel-simple-validation/badge.svg?branch=master)](https://coveralls.io/github/peter279k/laravel-simple-validation?branch=master)

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
