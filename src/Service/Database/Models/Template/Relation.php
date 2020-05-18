<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class Relation {

    private $relationName;

    public function setRelationName($relationName) {
        $this->relationName = $relationName;
        return $this;
    }


    public function getRelationType() {
        "\$this->{$this->relationType}({$this->relationName}::class, '$this->foreign', '$this->localKey')";
    }



    public function get() {
        return "public function {$this->relationName}()
{
    return {$this->getRelationType()}
}
";
    }
}