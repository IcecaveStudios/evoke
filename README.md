# Evoke

[![Build Status]](https://travis-ci.org/IcecaveStudios/evoke)
[![Test Coverage]](https://coveralls.io/r/IcecaveStudios/evoke?branch=develop)
[![SemVer]](http://semver.org)

**Evoke** is a small PHP library for invoking callables using positional and named parameters, a little like Python's `*args, **kwargs` syntax.

* Install via [Composer](http://getcomposer.org) package [icecave/evoke](https://packagist.org/packages/icecave/evoke)
* Read the [API documentation](http://icecavestudios.github.io/evoke/artifacts/documentation/api/)

## Example

```php
use Icecave\Evoke\Invoker;

$invoker = new Invoker;

$func = function ($a, $b, $c = 30, $d) {
    return array($a, $b, $c, $d);
};

$positionalArguments = array(10, 20);
$keywordArguments = array('d' => '40');

$result = $invoker->invoke($func, $positionalArguments, $keywordArguments);

assert($result === array(10, 20, 30, 40));
```

<!-- references -->
[Build Status]: http://b.adge.me/travis/IcecaveStudios/evoke/develop.svg
[Test Coverage]: http://b.adge.me/coveralls/IcecaveStudios/evoke/develop.svg
[SemVer]: http://b.adge.me/:semver-0.1.0-yellow.svg
