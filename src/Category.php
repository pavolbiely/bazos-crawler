<?php

declare(strict_types=1);

namespace Bazos;

class Category
{
	protected $name = "";

	protected $link = "";

	protected $group = "";

	public function setName(string $name): Category
	{
		$this->name = trim(str_replace("\n", " ", $name));
		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setLink($link): Category
	{
		$this->link = rtrim($link, '/');
		return $this;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function setGroup(string $group): Category
	{
		$this->group = $group;
		return $this;
	}

	public function getGroup(): string
	{
		return $this->group;
	}
}
