<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class AddIndex {

    private $key;

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    //TODO fetch indexes
    public function getDictType()
    {
        $dictType = [
            'primary' => 'primary',
            'unique' => 'unique',
            'index' => 'index',
        ];

        return $dictType[$this->key];
    }

    public function get()
    {
        return  "\t\t\$table->{$this->getDictType()}('{$this->key->COLUMN_NAME}');";
    }
}
