# Extended Array for PHP

[![Build Status](https://travis-ci.org/javaguirre/php-extended-array.svg)](https://travis-ci.org/javaguirre/php-extended-array)

Just a simple extension of the PHP array using [ArrayObject][array_object]

## Install

Edit your composer.json file to require `javaguirre/php-extended-array` and run `composer update`

```json
"require": {
    "javaguirre/php-extended-array": "dev-master"
}
```

## Usage

```php
<?php

use TA\ExtendedArray\Type\ExtendedArray;

$fruits = new ExtendedArray(
    array(
        'tropical' => 'pineapple',
        'farm'     => 'strawberry'
    )
);

$fruits->has('tropical');

// true

$fruits->hasOne(array('tropical', 'asian'));

// true

$fruits->hasAll(array('tropical', 'asian'));

// false

$fruits->get('canary', 'banana');

// 'banana'

$fruits->get('tropical, 'banana');

// 'pineapple'

$fruits->getSubArray(array('tropical'));

// array('tropical' => 'pineapple');

$fruits->toArray();

// array('tropical' => 'pineapple', 'farm' => 'strawberry');

```

## LICENSE

[MIT License][license]

[license]: https://github.com/javaguirre/php-extended-array/blob/master/Resources/meta/LICENSE
[array_object]: https://php.net/manual/en/class.arrayobject.php
