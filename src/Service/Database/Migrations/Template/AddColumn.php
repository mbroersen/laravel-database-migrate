<?php

namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template;

class AddColumn
{

    private $column;

    public function setColumn($column)
    {
        $this->column = $column;
        return $this;
    }

    public function getDictType()
    {
        $methods = [
            'rememberToken',
            'softDeletes',
            'softDeletesTz',
            'bigIncrements',
            'bigInteger',
            'dropColumn',
            'ipAddress',
            'macAddress',
            'mediumInteger',
            'mediumIncrements',
            'renameColumn',
            'smallIncrements',
            'timestampTz',
            'timestamp',
            'smallInteger',
            'tinyIncrements',
            'tinyInteger',
            'unsignedInteger',
            'increments',
            'dateTimeTz',
            'dateTime',
            'longText',
            'integer',
            'boolean',
            'decimal',
            'date',
            'enum',
            'geometry',
            'jsonb',
            'json',
            'point',
            'polygon',
            'string',
            'text',
            'time',
            'unsigned',
            'uuid',
            'year',
        ];

        $typeDict = [
            'varchar'   => 'string',
            'char'      => 'string',
            'int'       => 'integer',
            'bigint'    => 'bigInteger',
            'tinyint'   => 'tinyInteger',
            'smallint'  => 'smallInteger',
            'mediumint' => 'mediumInteger',
            'timestamp' => 'timestamp',
            'time'      => 'time',
            'date'      => 'date',
            'datetime'  => 'dateTime',
            'text'      => 'text',
            'json'      => 'json',
            'longtext'  => 'longtext',
        ];


        return $typeDict[$this->column->DATA_TYPE];
    }

    //todo add default
    //todo add primary key
    public function get()
    {
        return "\t\t\$table->{$this->getDictType()}('{$this->column->COLUMN_NAME}'" .
        ($this->getDictType() === 'string' ? ", {$this->column->CHARACTER_MAXIMUM_LENGTH})" : ')') .
        ($this->column->IS_NULLABLE === "YES" ? '->nullable()' : '') .
        ($this->column->EXTRA === "auto_increment" ? '->ai()' : '') .
        "->default({$this->column->COLUMN_DEFAULT})" .
        (strpos($this->column->COLUMN_TYPE, ' unsigned') !== false ? '->unsigned()' : '');
    }


}