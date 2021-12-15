<?php

namespace app\models;

require_once 'app/Database.php';
require_once 'app/models/Type.php';
require_once 'app/models/Base.php';
use app\models\Type;
use app\models\Base;
use app\Database;
use PDO;

class Vehicle extends Base {
    private $id;
    private $make;
    private $model;
    private $engine;
    private $type;

    public function __construct($dataArr = null) {
        if ($dataArr != null) {            
            $this->id = $dataArr['id'];
            $this->make = $dataArr['make'];
            $this->model = $dataArr['model'];
            $this->engine = $dataArr['engine'];
            $this->type = Type::getById($dataArr['type_id']);
        }
    }

    public function getId() { return $this->id; }
    public function getMake() { return $this->make; }
    public function getModel() { return $this->model; }
    public function getEngine() { return $this->engine; }
    public function getType() : Type { return $this->type; }

    public function setMake($newMake) { $this->make = $newMake; }
    public function setModel($newModel) { $this->model = $newModel; }
    public function setEngine($newEngine) { $this->engine = $newEngine; }
    public function setType(Type $newType) { $this->type = $newType; }

    public static function getAll() : array {
        $req = Database::get()->query('SELECT * FROM vehicles');
        return self::makeCollection(Vehicle::class, $req->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function getCars() : array {
        $req = Database::get()->query('SELECT vehicles.* FROM vehicles LEFT JOIN types ON vehicles.type_id=types.id WHERE types.type_name="car"');
        return self::makeCollection(Vehicle::class, $req->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function getTrucks() : array {
        $req = Database::get()->query('SELECT vehicles.* FROM vehicles LEFT JOIN types ON vehicles.type_id=types.id WHERE types.type_name="truck"');
        return self::makeCollection(Vehicle::class, $req->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function getById(int $id) : Vehicle {
        $req = Database::get()->prepare('SELECT * FROM vehicles WHERE id=?');
        $req->execute([$id]);
        return new Vehicle($req->fetch(PDO::FETCH_ASSOC));
    }

    public static function create($dataArr) : bool {
        $req = Database::get()->prepare('INSERT INTO vehicles (make, model, engine, type_id) VALUES (?, ?, ?, ?)');
        return $req->execute([$dataArr['make'], $dataArr['model'], $dataArr['engine'], $dataArr['type']]);
    }

    public static function update($dataArr) : bool {
        $req = Database::get()->prepare('UPDATE vehicles SET make=?, model=?, engine=?, type_id=? WHERE id=?');
        return $req->execute([$dataArr['make'], $dataArr['model'], $dataArr['engine'], $dataArr['type'], $dataArr['id']]);
    }

    public static function delete(int $id) : bool {
        $req = Database::get()->prepare('DELETE FROM vehicles WHERE id=?');
        return $req->execute([$id]);
    }
}
