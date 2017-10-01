# Formality (Laravel)

[![Packagist](https://img.shields.io/packagist/v/mascame/formality.svg?maxAge=2592000?style=plastic)](https://packagist.org/packages/mascame/formality)
[![Travis](https://img.shields.io/travis/marcmascarell/formality.svg?maxAge=2592000?style=plastic)](https://travis-ci.org/marcmascarell/formality)
[![license](https://img.shields.io/github/license/marcmascarell/formality.svg?maxAge=2592000?style=plastic)](https://github.com/marcmascarell/formality)

Form fields type guesser. Tries to detect the field type based on the name and the given config.

# Installation

`composer require mascame/formality`

# Usage

fields_config.php
```php
return [
    'password' => [], // will match the keyword `password`
    'text' => [
        'autodetect' => [
            'title',  
        ]
    ],
    'textarea' => [
        'autodetect' => [
            'body',  
        ],
    ],
    'datetime' => [
        'regex' => [
            '/_at$/'
        ],
    ],
];
```

Wherever.php
```php

$fieldTypes = require "fields_config.php";

$fieldNames = [
    'title',
    'body',
    'created_at',
    'password',
];

$parser = new Mascame\Formality\Parser\Parser($fieldTypes);



```

# Run Tests

`vendor/bin/codecept run unit`