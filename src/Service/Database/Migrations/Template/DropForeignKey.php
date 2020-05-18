<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class DropForeignKey
{
    private $key;

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    public function get() {
        return  "\t\t\$table->dropForeign('{$this->key->CONSTRAINT_NAME}');";
    }
}
