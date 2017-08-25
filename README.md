# DateTimeRange

The Postgres database supports [ranges](https://www.postgresql.org/docs/current/static/rangetypes.html). This package 
provides capabilities to parse or build tstzranges for Postgres databases. This package attempts to fully support all 
the features of the tstzrange type. We made an exception for null values, which are interpreted as "infinity". 

## Installation

You can install the package via composer:

`composer require inthere/datetime-range`

## Usage

```php
$parser = new Parser(
    '["2015-08-14 16:07:28.956968+02","2018-08-14 16:07:28.956968+02"]',
     new DateTimeZone('UTC')
);
$dateTimeRange = $parser->parse();
```

This returns a `DateTimeRange` object, which can provide the lower and upper range:

```php
$lowerRange = $dateTimeRange->getLowerRange();
$upperRange = $dateTimeRange->getUpperRange();
```

A `Range` object will be returned which contains the date, the boundary and which knows if the range is "infinity":

```php
$lowerRange->isInfinity(); 
// returns a boolean

$lowerRange->getDateTime(); 
// returns a datetime object or null if infinity

$lowerRange->getBoundary(); 
// returns a boundary object
```

The `Boundary` object determines if the range is inclusive [] or exclusive () and if the range is lower or upper:

```php
$boundary = $lowerRange->getBoundary();

$boundary->isLower(); 
// returns a boolean (true = lower, false = upper)

$boundary->isInclusive(); 
// returns a boolean (true = inclusive, false = exclusive)
```

## Tests

`$ vendor/bin/phpunit`

## Contributors

Contributions are welcome. We accept contributions via pull requests on Github.

## License

The MIT License (MIT). Please see the [License File](LICENSE) for more information.

## About InThere

InThere - "The training Through Gaming Company" - speeds up training your team and change processes by providing a 
micro-training concept based on serious games.  