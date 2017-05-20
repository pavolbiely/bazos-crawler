<?php

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$crawler = new Bazos\Crawler();

Assert::exception(function () use ($crawler) {
	$crawler->crawlCategories('http://example.org');
}, 'Bazos\CrawlerException', 'Invalid URL');
Assert::exception(function () use ($crawler) {
	$crawler->crawlAds(':');
}, 'Bazos\CrawlerException', 'Invalid URL');
Assert::exception(function () use ($crawler) {
	$crawler->crawlAds('https://bazos.museum');
}, 'Bazos\CrawlerException', 'Invalid URL - only bazos domains are valid');

Assert::true(count($crawler->crawlCategories($crawler::URL_SK)) > 0);
Assert::true(count($crawler->crawlAds('https://auto.bazos.sk/')) > 0);
