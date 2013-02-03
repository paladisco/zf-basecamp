# zf-basecamp

Lightweight Zend Framework compatible client for the new [Basecamp API](https://github.com/37signals/bcx-api).

The library is largely based on the work of Ben Dunlap who created the basic Library of which
most of the credit here goes to him and to Sandeep Shetty, whose [Shopify client](https://github
.com/sandeepshetty/shopify.php) provided the inspiration and much of the code for this project.

I just took the whole thing and wrapped it into a nice Zend Framework compatible Library Class and wrapped some
standard Basecamp API Calls into functions.


## Requirements

* PHP 5.3 with [cURL support](http://php.net/manual/en/book.curl.php).


## Getting Started

### Download
Download the [latest version of zf-basecamp](https://github.com/paladisco/zf-basecamp):

```shell
$ curl -L http://github.com/dpaladino/paladisco/zf-basecamp | tar xvz
```

Add the folder 'library/Zend/Basecamp' to your local Zend Framework project (make sure the library lies in the
include path of your project, which should be the case for standard ZF projects).

### Usage
Currently supports private apps only.

Making API calls:

```php
<?php
    $basecamp = new Local_Basecamp_Api();

    $projects = $basecamp->getProjects();

    print_r($projects);
?>
```
See the [Basecamp API docs](https://github.com/37signals/bcx-api#api-ready-for-use) for more interactions.
