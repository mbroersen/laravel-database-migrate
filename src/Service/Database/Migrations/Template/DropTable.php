<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class DropTable {

    private $table;

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }


    public function get(): string
    {
        return "Schema::dropIfExists('{$this->table}');";
    }
}
