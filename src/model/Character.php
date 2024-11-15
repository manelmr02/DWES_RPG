<?php
class Character{
    protected $id;
    protected $name;
    protected $description;
    protected $health;
    protected $strength;
    protected $defense;
    protected $image;

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
        return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
        return $this;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($value) {
		$this->description = $value;
        return $this;
	}

	public function getHealth() {
		return $this->health;
	}

	public function setHealth($value) {
		$this->health = $value;
        return $this;
	}

	public function getStrength() {
		return $this->strength;
	}

	public function setStrength($value) {
		$this->strength = $value;
        return $this;
	}

	public function getDefense() {
		return $this->defense;
	}

	public function setDefense($value) {
		$this->defense = $value;
        return $this;
	}

	public function getImage() {
		return $this->image;
	}

	public function setImage($value) {
		$this->image = $value;
        return $this;
	}
}