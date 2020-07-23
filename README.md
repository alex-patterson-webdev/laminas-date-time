[![Build Status](https://travis-ci.com/alex-patterson-webdev/laminas-date-time.svg?branch=master)](https://travis-ci.com/alex-patterson-webdev/laminas-date-time)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alex-patterson-webdev/laminas-date-time/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alex-patterson-webdev/laminas-date-time/?branch=master)


# Arp\LaminasDateTime

## About

A Date and Time component module for the Laminas Framework.

## Installation

Installation via [composer](https://getcomposer.org).

    require alex-patterson-webdev/laminas-date-time ^0.1
    
In order integrate with Laminas MVC, please add the module namespace to the `modules.config.php` of your laminas application.
        
    // moudle.config.php
    return [    
        // .... other module namespaces
        'Arp\\LaminasDateTime',
    ];

## Components
  
- A `CurrentDateTimeProvider` service abstracts the creation of `\DateTimeInterface` instances.
- A `DateTimeHelper` view helper allowing date time objects to be rendered consistently in view scripts.

## Unit Tests

PHP Unit test using PHPUnit.

    php vendor/bin/phpunit
