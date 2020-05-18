<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class AddForeignKey {

    private $key;

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function get():string
    {
        return  "\t\t\$table->foreign('{$this->key->COLUMN_NAME}', '{$this->key->CONSTRAINT_NAME}')->references('{$this->key->REFERENCED_COLUMN_NAME}')->on('{$this->key->REFERENCED_TABLE_NAME}');";
    }
}
