<?php

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$ad = new Bazos\Advertisment(999);

Assert::true($ad->setTitle('Lorem ipsum') instanceof Bazos\Advertisment);
Assert::true($ad->setDate(new \DateTime()) instanceof Bazos\Advertisment);
Assert::true($ad->setLink('https://auto.bazos.sk/inzerat/123456789/testing.php') instanceof Bazos\Advertisment);
Assert::true($ad->setImg('https://www.bazos.sk/img/1t/999/123456789.jpg?t=1495192503') instanceof Bazos\Advertisment);
Assert::true($ad->setText('Lorem ipsum dolor') instanceof Bazos\Advertisment);
Assert::true($ad->setPrice(100.95) instanceof Bazos\Advertisment);
Assert::true($ad->setCity('Bratislava') instanceof Bazos\Advertisment);
Assert::true($ad->setPostcode('831 04') instanceof Bazos\Advertisment);
Assert::true($ad->setViews(50) instanceof Bazos\Advertisment);
Assert::true($ad->setEmail(123) instanceof Bazos\Advertisment);
Assert::true($ad->setPhone('0949949949') instanceof Bazos\Advertisment);
Assert::true($ad->setAuthor('John Doe') instanceof Bazos\Advertisment);
Assert::same(999, $ad->getId());
Assert::same('Lorem ipsum', $ad->getTitle());
Assert::true($ad->getDate() instanceof \DateTime);
Assert::same('https://auto.bazos.sk/inzerat/123456789/testing.php', $ad->getLink());
Assert::same('https://www.bazos.sk/img/1t/999/123456789.jpg?t=1495192503', $ad->getImg());
Assert::same('Lorem ipsum dolor', $ad->getText());
Assert::same(100.95, $ad->getPrice());
Assert::same('Bratislava', $ad->getCity());
Assert::same('831 04', $ad->getPostcode());
Assert::same(50, $ad->getViews());
Assert::same(123, $ad->getEmail());
Assert::same('0949949949', $ad->getPhone());
Assert::same('John Doe', $ad->getAuthor());
