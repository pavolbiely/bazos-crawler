<?php

declare(strict_types=1);

namespace Bazos;

class Advertisment
{
	/** @var int */
	protected $id;

	/** @var string */
	protected $title;

	/** @var \DateTime */
	protected $date;

	/** @var string */
	protected $link;

	/** @var string */
	protected $img;

	/** @var string */
	protected $text;

	/** @var float */
	protected $price;

	/** @var string */
	protected $city;

	/** @var string */
	protected $postcode;

	/** @var int */
	protected $views;

	/** @var int */
	protected $email;

	/** @var string */
	protected $phone;

	/** @var string */
	protected $author;

	public function __construct(int $id)
	{
		$this->id = $id;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setTitle(string $title): Advertisment
	{
		$this->title = $title;
		return $this;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setDate(\DateTime $date): Advertisment
	{
		$this->date = $date;
		return $this;
	}

	public function getDate(): \DateTime
	{
		return $this->date;
	}

	public function setLink(string $link): Advertisment
	{
		$this->link = $link;
		return $this;
	}

	public function getLink(): string
	{
		return $this->link;
	}

	public function setImg(string $img): Advertisment
	{
		$this->img = $img;
		return $this;
	}

	public function getImg(): string
	{
		return $this->img;
	}

	public function setText(string $text): Advertisment
	{
		$this->text = $text;
		return $this;
	}

	public function getText(): string
	{
		return $this->text;
	}

	public function setPrice(float $price): Advertisment
	{
		$this->price = $price;
		return $this;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function setCity(string $city): Advertisment
	{
		$this->city = $city;
		return $this;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function setPostcode(string $postcode): Advertisment
	{
		$this->postcode = $postcode;
		return $this;
	}

	public function getPostcode(): string
	{
		return $this->postcode;
	}

	public function setViews(int $views): Advertisment
	{
		$this->views = $views;
		return $this;
	}

	public function getViews(): int
	{
		return $this->views;
	}

	public function setEmail(int $email): Advertisment
	{
		$this->email = $email;
		return $this;
	}

	public function getEmail(): int
	{
		return $this->email;
	}

	public function setPhone(string $phone): Advertisment
	{
		$this->phone = $phone;
		return $this;
	}

	public function getPhone(): string
	{
		return $this->phone;
	}

	public function setAuthor(string $author): Advertisment
	{
		$this->author = $author;
		return $this;
	}

	public function getAuthor(): string
	{
		return $this->author;
	}
}
