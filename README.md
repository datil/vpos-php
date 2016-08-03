# vpos-php
Use this code as a guide to implement a payment button for the Alignet VPOS Gateway using the Datil VPOS API.

## Requirements
* PHP 7.0.x
* [Composer](https://getcomposer.org/)
* Linux or OSX.

## Quickstart
`composer install`

`php -S localhost:8000`

Finally, visit _http://localhost:8000_ and click the _Pay_ button. You should be redirected to the VPOS payment page where you can enter your credit card information.

When you finalize the transaction at the VPOS screen, you will be redirected to the URL you registered in the VPOS Gateway.
