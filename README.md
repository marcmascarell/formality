# Formality (Laravel)

[![Packagist](https://img.shields.io/packagist/v/mascame/formality.svg?maxAge=2592000?style=plastic)](https://packagist.org/packages/mascame/arrayer)
[![Travis](https://img.shields.io/travis/marcmascarell/formality.svg?maxAge=2592000?style=plastic)](https://travis-ci.org/marcmascarell/arrayer)
[![license](https://img.shields.io/github/license/marcmascarell/formality.svg?maxAge=2592000?style=plastic)](https://github.com/marcmascarell/arrayer)

Form fields helper and guesser. Tries to detect the field type based on the name and the given config.

# Installation

Add the providers and alias from `laravelcollective/html` dependency (if you haven't already) as described [here](https://laravelcollective.com/docs/5.2/html)

# Usage

fields_config.php
```php
return [
    // Field Type (Should be a Type that exists)
    'password' => [],
    'text' => [
        'autodetect' => [
            'title',  
        ]
    ],
    'textarea' => [
        'autodetect' => [
            'body',  
        ],
        'hooks' => [
            // You can register hooks to modify the output
            'onOutput' => function($output) {
                return '<div>' . $output . '</div>'
            }
        ]
    ],
    'datetime' => [
        'regex' => [
            '/_at$/'
        ],
        // Inline input with automatic replacements
        'input' => '<input type="date" name="(:name)" value="(:value)" placeholder="(:label)">'
    ],
];
```

Wherever.php
```php

$fieldTypes = require "fields_config.php";

$fieldNames = [
    'title', // will generate a text Field
    'body', // will generate a textarea Field
    'created_at', // will generate a datetime Field
    'password', // will generate a password Field
];

$parser = new Mascame\Formality\Parser\Parser($fieldTypes);
$factory = new Mascame\Formality\Factory\Factory($parser, $fieldTypes, $fieldNames);

$fields = $factory->makeFields();

// Output them where u want
foreach ($fields as $field) {
    $field->output();
}

```
