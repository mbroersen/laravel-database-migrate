<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class AlterTable
{
    private $table;
    private $fields;

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function setFields($fields)
    {
        $this->fields = PHP_EOL . implode(';' . PHP_EOL, $fields) . ';' . PHP_EOL;
        return $this;
    }

    public function get():string
    {
        return  "Schema::table('$this->table'', function (Blueprint \$table) {{$this->fields}\t});";
    }
}
