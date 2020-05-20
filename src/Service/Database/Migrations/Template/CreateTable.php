<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;
class CreateTable
{
    private $table;
    private $fields;

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function setFields(array $fields)
    {
        $this->fields = PHP_EOL . implode(';' . PHP_EOL, $fields) . ';' . PHP_EOL;
        return $this;
    }

    public function get()
    {
        return "Schema::create('{$this->table}', function (Blueprint \$table) {{$this->fields}\t});";
    }
}
