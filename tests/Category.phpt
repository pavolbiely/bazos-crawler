<?php

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$category = new Bazos\Category();

Assert::true($category->setName('Auto') instanceof Bazos\Category);
Assert::true($category->setLink('https://auto.bazos.sk/') instanceof Bazos\Category);
Assert::true($category->setGroup('Osobné autá') instanceof Bazos\Category);
Assert::same('Auto', $category->getName());
Assert::same('https://auto.bazos.sk', $category->getLink());
Assert::same('Osobné autá', $category->getGroup());
