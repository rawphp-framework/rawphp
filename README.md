# RawPHP Framework

[![Build Status](https://travis-ci.org/slimphp/Slim.svg?branch=3.x)](https://travis-ci.org/slimphp/Slim)
[![Coverage Status](https://coveralls.io/repos/github/slimphp/Slim/badge.svg?branch=3.x)](https://coveralls.io/github/slimphp/Slim?branch=3.x)
[![Total Downloads](https://poser.pugx.org/slim/slim/downloads)](https://packagist.org/packages/partner/rawphp)
[![License](https://poser.pugx.org/slim/slim/license)](https://packagist.org/packages/partner/rawphp)

RawPHP is powerful and robust PHP framework that helps people from different PHP backgrounds work on the same project seamlessly. You can write Laravel, CakePHP, Slim, Symphone and Procedural PHP code inside it and it all works perfectly. Its the PHP Framework for everyone. RawPHP was built for teams with ever changing team members.

RawPHP comes with complete user authentication system built-in and ready to use out of the box. 

## Installation
There are two ways to install RawPHP:
* It's recommended that you use [Composer](https://getcomposer.org/) to install RawPHP.

```bash
$ composer require partner/rawphp
```

* The second way is that you can just clone this repository into your local machine, then CD into it and run `composer install` in your command line. 

Both methods install RawPHP and all required dependencies. RawPHP requires PHP 5.5.0 or newer.

## Usage

There are two ways to run RawPHP
### PHP's inbuilt server
After RawPHP has installed, you can run it by using the built-in PHP server. Navigate to the root folder and run the below command:
```bash
$ php -S localhost:8000 -t public
```
Going to http://localhost:8000/ will now display your default Homepage.

### Wamp, LAMP or XAMP server
Otherwise, you can just put it in your wamp/www or xxamp htdocs folder and access it by visiting the url on your browser `localhost/your-rawphp-folder/public


For more information on how to configure your web server, see the [Documentation](https://www.slimframework.com/docs/start/web-servers.html).

## Tests

To execute the test suite, you'll need phpunit.

```bash
$ phpunit
```

Now you have a copy of RawPHP and it's working fine, you'll need to setup your RawPHP database to complete this installation. The full [installation instructions are here](https://github.com/rawphp-framework/rawphp-docs/blob/master/docs/start/installation.md) . Enjoy.
## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Learn More
Since RawPHP was built using the best parts of CakePHP, Laravel and Slim, you can always consult the documentation of any of them to learn more about RawPHP
You can also create an issue on this repo to get better clarifications if you have any questions.
Learn more at these links:

- [Website](https://www.slimframework.com)
- [Documentation](https://www.slimframework.com/docs/start/installation.html)
- [Support Forum](http://discourse.slimframework.com)
- [Twitter](https://twitter.com/slimphp)
- [Resources](https://github.com/xssc/awesome-slim)

## Security

If you discover security related issues, please use the issue tracker (for now).


## License

The RawPHP Framework is licensed under the MIT license. See [License File](LICENSE.md) for more information.
