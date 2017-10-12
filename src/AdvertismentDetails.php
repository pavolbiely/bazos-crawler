<?php

declare(strict_types=1);

namespace Bazos;

class AdvertismentDetails
{
	/** @var string */
	protected $description;

	/** @var array */
	protected $images;

	public function expose()
	{
		return get_object_vars($this);
	}
	
	public function setDescription(string $description): AdvertismentDetails
	{
		$this->description = $description;
		return $this;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setImages(array $images): AdvertismentDetails
	{
		$this->images = $images;
		return $this;
	}

	public function getImages(): array
	{
		return $this->images;
	}
}
