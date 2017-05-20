# Bazos - PHP Crawler
[![Build Status](https://travis-ci.org/pavolbiely/bazos-crawler.svg?branch=master)](https://travis-ci.org/pavolbiely/bazos-crawler)
[![Coverage Status](https://coveralls.io/repos/github/pavolbiely/bazos-crawler/badge.svg?branch=master)](https://coveralls.io/github/pavolbiely/bazos-crawler?branch=master)

PHP Crawler for downloading ads and categories from bazos.sk, bazos.cz or bazos.at.

## Usage

Use composer to install this package.

### Download ads from single category
```php
$crawler = new Bazos\Crawler();

$items = $crawler->crawlAds('https://auto.bazos.sk/', 5); // 5 means number of pages to parse, default is 1

foreach ($items as $item) {
    echo $item->getTitle() . "\n";
}
```

### Download ads from all categories
```php
$crawler = new Bazos\Crawler();

$categories = $crawler->crawlCategories($crawler::URL_SK);

foreach ($categories as $category) {
	$items = $crawler->crawlAds($category->getLink(), 5); // 5 means number of pages to parse, default is 1

	foreach ($items as $item) {
	    echo $item->getTitle() . "\n";
	}
}
```

## How to run tests?
Tests are build with [Nette Tester](https://tester.nette.org/). You can run it like this:
```bash
tester.bat -c php.ini-win --coverage coverage.html --coverage-src ../src
```

## Minimum requirements
- PHP 7.1+
- ext-curl
- ext-tidy

## Disclaimer
Please do not abuse the Bazos portal. I've developed this crawler just for tracking bike ads where I was looking for the one someone stole from me.

## License
MIT License (c) Pavol Biely

Read the provided LICENSE file for details.
