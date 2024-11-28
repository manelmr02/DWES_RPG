<?php
class Character
{
	protected $id;
	protected $name;
	protected $description;
	protected $health;
	protected $strength;
	protected $defense;
	protected $image;
	protected $db;

	public function __construct($db){
		$this->setDb($db);
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($value)
	{
		$this->name = $value;
		return $this;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($value)
	{
		$this->description = $value;
		return $this;
	}

	public function getHealth()
	{
		return $this->health;
	}

	public function setHealth($value)
	{
		$this->health = $value;
		return $this;
	}

	public function getStrength()
	{
		return $this->strength;
	}

	public function setStrength($value)
	{
		$this->strength = $value;
		return $this;
	}

	public function getDefense()
	{
		return $this->defense;
	}

	public function setDefense($value)
	{
		$this->defense = $value;
		return $this;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function setImage($value)
	{
		$this->image = $value;
		return $this;
	}

	public function getDb() {
		return $this->db;
	}

	public function setDb($value) {
		$this->db = $value;
	}

	public function save()
	{
		$stmt = $this->db->prepare("INSERT INTO characters (name,description,health,strength,defense) VALUES (:name,:description,:health,:strength,:defense)");
		$stmt->bindValue(':name', $this->getName());
		$stmt->bindValue(':description', $this->getDescription());
		$stmt->bindValue(':health', $this->getHealth());
		$stmt->bindValue(':strength', $this->getStrength());
		$stmt->bindValue(':defense', $this->getDefense());

		return $stmt->execute();
	}

	public function update() {
        try {
            $stmt = $this->db->prepare("UPDATE characters 
                                        SET name = :name, 
                                            description = :description, 
                                            health = :health, 
                                            strength = :strength, 
                                            defense = :defense 
                                        WHERE id = :id");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':health', $this->health);
            $stmt->bindParam(':strength', $this->strength);
            $stmt->bindParam(':defense', $this->defense);
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar el personaje: " . $e->getMessage();
            return false;
        }
    }
}

	
