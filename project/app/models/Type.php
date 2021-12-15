<?php

namespace app\models;

require_once 'app/Database.php';
require_once 'app/models/Base.php';
use app\models\Base;
use app\Database;
use PDO;

class Type extends Base {
    private $id;
    private $name;

    public function __construct($dataArr = null) {
        if ($dataArr != null) {
            $this->id = $dataArr['id'];
            $this->name = $dataArr['type_name'];
        }
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }

    public function setName($newName) { $this->name = $newName; }

    public static function getAll() {
        $req = Database::get()->query('SELECT * FROM types');
        return self::makeCollection(Type::class, $req->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function getById(int $id) : Type {
        $req = Database::get()->prepare('SELECT * FROM types WHERE id=?');
        $req->execute([$id]);
        return new Type($req->fetch(PDO::FETCH_ASSOC));
    }
}
