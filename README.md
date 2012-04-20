# basecamp.php

Lightweight multi-paradigm PHP (JSON) client for the new [Basecamp API](https://github.com/37signals/bcx-api).

Many thanks to Sandeep Shetty, whose [Shopify client](https://github.com/sandeepshetty/shopify.php) provided the inspiration and much of the code for this project.


## Requirements

* PHP 5.3 with [cURL support](http://php.net/manual/en/book.curl.php).


## Getting Started

### Download
Download the [latest version of basecamp.php](https://github.com/bdunlap/basecamp.php/archives/master):

```shell
$ curl -L http://github.com/bdunlap/basecamp.php/tarball/master | tar xvz
$ mv bdunlap-basecamp.php-* basecamp.php
```

### Require

```php
<?php
require 'path/to/basecamp.php/basecamp.php';
?>
```

### Usage
Currently supports private apps only.

Making API calls:

```php
<?php
$appName = 'MyApp';
$appContact = 'yourname@example.com';

$basecampAccountId = '999999999';
$basecampUsername = 'yourusername';
$basecampPassword = 'yourpassword';

$basecamp = basecamp_api_client($appName, $appContact,
    $basecampAccountId, $basecampUsername, $basecampPassword);

try {
    /**
     * Get a list of all projects:
     */
    $projects = $basecamp('GET', '/projects.json');

    /**
     * Create a new project:
     */
    $project = array(
        'name' => 'My new project!',
    );

    $basecamp('POST', '/projects.json', $project);
} catch ($e) {
    die($e->getMessage());
}
?>
```
See the [Basecamp API docs](https://github.com/37signals/bcx-api#api-ready-for-use) for more interactions.
