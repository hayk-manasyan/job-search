# Jobs Serach Application Using Github, StackOverflow Search APIs

# Upcoming releases will have User Management and Linkedin Job API

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
Create the database named *jobs*, import the dump from data/db/jobs.sql

Update the DB credentials in *config/autoload/global.php*

Once installed, you fetch the data and insert it into DB runing:

```bash
$ cd /path/to/install
$ php public/index.php update jobs
```
