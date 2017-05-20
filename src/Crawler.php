<?php

declare(strict_types=1);

namespace Bazos;

class Crawler
{
	const URL_SK = 'https://www.bazos.sk';
	const URL_CZ = 'https://www.bazos.cz';
	const URL_AT = 'https://www.bazos.at';

	/**
	 * @return Category[]
	 */
	public function crawlCategories(string $url): array
	{
		if (!in_array($url, [self::URL_SK, self::URL_CZ, self::URL_AT])) {
			throw new CrawlerException('Invalid URL');
		}

		$xml = $this->convertHtmlToXml($url);

		$categories = [];
		foreach ($xml->body->div->table[1]->tr->td->table->tr as $tr) {
			foreach ($tr->td as $td) {
				$categories[] = (new Category())
					->setName((string) $td->span->a)
					->setLink($link = rtrim((string) $td->span->a['href'], '/'));

				$xml2 = $this->convertHtmlToXml($link);

				$counter = 0;
				$group = "";
				foreach ($xml2->body->div->table[1]->tr->td[0]->div as $div) {
					if ($counter % 2 == 0) {
						$group = (string) $div[0];
						if (in_array($group, ['Kategórie', 'Kategorie'])) {
							$group = "";
						}

					} else {
						foreach ($div->a as $a) {
							$link2 = (string)$a['href'];
							if (!preg_match('~^http~', $link2)) {
								$link2 = $link . $link2;
							}

							$categories[] = (new Category())
								->setName((string)$a)
								->setLink($link2)
								->setGroup($group);
						}
					}
					$counter++;
				}
			}
		}

		return $categories;
	}

	/**
	 * @return Advertisment[]
	 */
	public function crawlAds(string $url, int $pages = 1): array
	{
		if (!$purl = @parse_url($url)) {
			throw new CrawlerException('Invalid URL');
		}

		if (!(isset($purl['host']) && preg_match('~bazos\.(sk|cz|at)~', $purl['host']))) {
			throw new CrawlerException('Invalid URL - only bazos domains are valid');
		}

		$items = [];

		for ($page = 0; $page < $pages; $page++) {
			$xml = $this->convertHtmlToXml($url . ($page > 0 ? '/' . ($page * 20) . '/' : NULL));

			$counter = 0;
			foreach ($xml->body->div->table[1]->tr->td[1]->table as $node) {
				if ($counter++ < 2) {
					continue;
				}

				preg_match('~inzerat\/(\d+)\/~i', (string)$node->tr[0]->td[0]->span[0]->a['href'], $matches1);
				preg_match('~hodnotenie\.php\?mail=([^&]*)&telefon=([^&]*)&jmeno=([^"]*)"~i', (string)$node->tr[1]->td->script, $matches2);
				preg_match('~\[(.+)\]~i', (string)$node->tr[0]->td[0]->span[1], $matches3);
				$locality = explode("\n", trim((string)$node->tr[0]->td[2]));

				$items[] = (new Advertisment((int) $matches1[1]))
					->setTitle(str_replace("\n", " ", trim((string)$node->tr[0]->td[0]->span[0]->a)))
					->setDate(new \DateTime($matches3[1]))
					->setLink('https://' . parse_url($url, PHP_URL_HOST) . trim((string)$node->tr[0]->td[0]->a['href']))
					->setImg(trim((string)$node->tr[0]->td[0]->a->img['src']))
					->setText(str_replace("\n", " ", trim((string)$node->tr[0]->td[0]->div)))
					->setPrice((float) str_replace([" ",","," €"], [NULL,".",NULL], (string)$node->tr[0]->td[1]->span))
					->setCity($locality[0])
					->setPostcode($locality[1] ?? "")
					->setViews((int) trim((string)(int)$node->tr[0]->td[3]))
					->setEmail((int) $matches2[1])
					->setPhone((string) $matches2[2])
					->setAuthor(str_replace("\n", " ", (string) $matches2[3]));
			}
		}

		return $items;
	}

	protected function downloadHtmlPage(string $url): string
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$content = curl_exec($ch);

		if ($content === false) {
			throw new CrawlerException(curl_error($ch), curl_errno($ch));
		}

		curl_close($ch);

		return $content;
	}

	protected function convertHtmlToXml(string $url): \SimpleXMLElement
	{
		$input = $this->downloadHtmlPage($url);

		$tidy = new \tidy();
		$tidy->parseString($input, [
			'clean' => TRUE,
			'preserve-entities' => FALSE,
			'numeric-entities' => TRUE,
			'output-xml' => TRUE,
			'doctype' => 'omit',
		]);
		$tidy->cleanRepair();

		$output = (string) $tidy;
		$output = preg_replace('~&(?!#?[a-z0-9]+;)~', '&amp;', $output);

		$xml = @simplexml_load_string($output);
		if (!$xml) {
			throw new CrawlerException('Could not convert HTML to XML');
		}

		return $xml;
	}
}

class CrawlerException extends \Exception
{
}
