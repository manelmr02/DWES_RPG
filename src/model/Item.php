<?php
class Item
{
	protected $id;
	protected $name;
	protected $description;
    protected $type;
	protected $effect;
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

	public function getType()
	{
		return $this->type;
	}

	public function setType($value)
	{
		$this->type = $value;
		return $this;
	}

    public function getEffect()
	{
		return $this->effect;
	}

	public function setEffect($value)
	{
		$this->effect = $value;
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

        $validTypes = ['weapon', 'armor', 'potion', 'misc'];//tipos validos
        if (!in_array($this->getType(), $validTypes)) {//comprobacion de si el tipo es válido
            throw new Exception("Tipo de ítem inválido. Los valores permitidos son: 'weapon', 'armor', 'potion', 'misc'.");
        }
		$stmt = $this->db->prepare("INSERT INTO items (name,description,type,effect) VALUES (:name,:description,:type,:effect)");
		$stmt->bindValue(':name', $this->getName());
		$stmt->bindValue(':description', $this->getDescription());
        $stmt->bindValue(':type', $this->getType());
        $stmt->bindValue(':effect', $this->getEffect());
		
        
		return $stmt->execute();
	}
}

	
