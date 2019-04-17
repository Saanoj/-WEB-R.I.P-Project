<?php

require_once __DIR__.'/../utils/FieldValidator.php';

class Attraction implements JsonSerializable{

  private $id;
  private $name;
  private $duration;
  private $capacity;
  private $minHeight;

  public function __construct( ?int $id, string $name, float $duration, int $capacity, float $minHeight){
    $this->id=$id;
    $this->name=$name;
    $this->duration=$duration;
    $this->capacity=$capacity;
    $this->minHeight=$minHeight;
  }
  public function getId(): ?int { return $this->id; }
  public function getName(): string { return $this->name; }
  public function getDuration(): float { return $this->duration; }
  public function getCapacity(): int { return $this->capacity; }
  public function getMinHeight(): float {return $this->minHeight; }

  public function setId(int $id){ $this->id = $id; }

  public function __toString(): string{
    $out = "";
    foreach (get_object_vars($this) as $key => $value) {
      $out .= "$key: $value | ";
    }
    return $out;
  }

  public static function AttractionFromArray(array $data): ?Attraction{
    if (FieldValidator::validate($data, ['name', 'duration', 'capacity', 'min_height'])) {
        $attraction = new Attraction(NULL,$data['name'],$data['duration'],$data['capacity'],$data['min_height']);
        if (isset($data['id'])) {
          $attraction->setId($data['id']);
        }
        return $attraction;
    }
    return NULL;
  }

  public function jsonSerialize(){
    return get_object_vars($this);
  }
}

 ?>
