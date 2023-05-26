![github workflow](https://github.com/alex-patterson-webdev/laminas-date-time/actions/workflows/workflow.yml/badge.svg)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alex-patterson-webdev/laminas-date-time/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alex-patterson-webdev/laminas-date-time/?branch=master)
[![codecov](https://codecov.io/gh/alex-patterson-webdev/laminas-date-time/branch/master/graph/badge.svg)](https://codecov.io/gh/alex-patterson-webdev/laminas-date-time)

# Arp\LaminasDateTime

## About

A Laminas Framework integration module for [Arp\DateTime](https://github.com/alex-patterson-webdev/date-time) components.

## Installation

Installation via [composer](https://getcomposer.org).

    require alex-patterson-webdev/laminas-date-time ^0.5
    
In order integrate with Laminas MVC, please add the module namespace to the `modules.config.php` of your laminas application.
        
    // moudle.config.php
    return [    
        // .... other module namespaces
        'Arp\\LaminasDateTime',
    ];

## Unit Tests

PHP Unit test using PHPUnit.

    php vendor/bin/phpunit
