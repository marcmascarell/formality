# Formality (Laravel)

Form fields helper and guesser. Tries to detect the field type based on the name and the given config.

# Installation

Add the providers and alias from `laravelcollective/html` dependency (if you haven't already)

As described [here](https://laravelcollective.com/docs/5.2/html)
 
# Usage

```php

$fieldTypes = [
    // Field Type (Should be a Type that exists)
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
            // Youcan register hooks to modify the output
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
    'password' => []
];

$fieldNames = [
    'title', // will generate a title Field
    'body', // will generate a textarea Field
    'created_at', // will generate a datetime Field
    'password', // will generate a password Field
];

$parser = new Mascame\Formality\Parser\Parser($fieldTypes);
$factory = new Mascame\Formality\Factory\Factory($parser, ['should-be-a-text-field']);

$fields = $factory->makeFields();

// Output them where u want
foreach ($fields as $field) {
    $field->output();
}

```
