# Formality

[![Packagist](https://img.shields.io/packagist/v/mascame/formality.svg?maxAge=2592000?style=plastic)](https://packagist.org/packages/mascame/formality)
[![Travis](https://img.shields.io/travis/marcmascarell/formality.svg?maxAge=2592000?style=plastic)](https://travis-ci.org/marcmascarell/formality)
[![license](https://img.shields.io/github/license/marcmascarell/formality.svg?maxAge=2592000?style=plastic)](https://github.com/marcmascarell/formality)

Form fields type guesser. Tries to detect the field type based on the name and the given config.

# Installation

`composer require mascame/formality`

# Usage

```php

$types = [
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

$parser = new Mascame\Formality\Parser\Parser($types);

print $parser->parse('title');  // text
print $parser->parse('body');  // textarea
print $parser->parse('created_at');  // datetime
print $parser->parse('password');  // password

```

# Run Tests

`vendor/bin/codecept run unit`