# Jobs Serach Application Using Github Search API

## Introduction

This is a basic application using the Zend Framework MVC layer and module
systems. This application is meant to be used as a Job Search using various 
APIs like Github, Linkedin and etc.

## Installation 

Clone the the repository

```bash
$ cd /path/to/install
$ composer install
```

Once installed, you can test it out immediately using PHP's built-in web server:

```bash
$ cd path/to/install
$ php -S 0.0.0.0:8080 -t public/ public/index.php
# OR use the composer alias:
$ composer run --timeout 0 serve
```

This will start the cli-server on port 8080, and bind it to all network
interfaces. You can then visit the site at http://localhost:8080/
- which will bring up Zend Framework welcome page.

**Note:** The built-in CLI server is *for development only*.
