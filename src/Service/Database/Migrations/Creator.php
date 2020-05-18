<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations;

use Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template\AddColumn;
use Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template\AddForeignKey;
use Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template\AlterTable;
use Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template\CreateTable;
use Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template\DropTable;
use Mbroersen\LaravelDatabaseMigrate\Service\Database\Migrations\Template\Migration;
use Illuminate\Support\Str;
use Mbroersen\LaravelDatabaseMigrate\Service\Database\Reader;

class Creator
{
    public function start()
    {
        $tables = (new Reader())->getTables();

        $this->createTableMigrations($tables);

        sleep(1);

        $this->createForeignKeyMigrations($tables);
    }

    /**
     * @param $table
     * @return string
     */
    protected function getClassName($table)
    {
        $className = ucfirst(Str::camel($table));
        $className = "createTable{$className}";
        return $className;
    }

    /**
     * @param $table
     * @return string
     */
    protected function getFileName($table)
    {
        $filename = now()->format('Y_m_d_His_') . Str::snake($this->getClassName($table)) . '.php';
        return $filename;
    }

    /**
     * @param string $filename
     */
    protected function getFilePath(string $filename)
    {
        return database_path('migrations/test/' . $filename);
    }

    /**
     * @param $tables
     */
    protected function createForeignKeyMigrations($tables)
    {
        foreach ($tables as $table) {
            $table = current($table);
            $keys = (new Reader())->getForeignKeys($table);

            $foreignRelations = [];
            $dropForeignRelations = [];

            foreach ($keys as $key) {
                if (!empty($key->REFERENCED_TABLE_NAME)) {
                    $foreignRelations[] = (new AddForeignKey())->setKey($key)->get();
                    $dropForeignRelations[] = (new AddForeignKey())->setKey($key)->get();
                }
            }

            $className = ucfirst(Str::camel($table));
            $className = "addIndexesToTable{$className}";
            $filename = now()->format('Y_m_d_His_') . Str::snake($className) . '.php';

            $this->getFilePath($filename);
            $up = (new AlterTable())->setTable($table)->setFields($foreignRelations)->get();
            $down = (new AlterTable())->setTable($table)->setFields($dropForeignRelations)->get();

            Writer::write(
                $this->getFilePath($filename),
                (new Migration())
                    ->setClassName($this->getClassName($table))
                    ->setUp($up)
                    ->setDown($down)
                    ->get()
            );

        }
    }

    /**
     * @param $tables
     */
    protected function createTableMigrations($tables)
    {
        foreach ($tables as $table) {
            $table = current($table);
            $fields = [];
            $columns = (new Reader())->getColumns($table);

            foreach ($columns as $column) {
                $fields[] = (new AddColumn())
                    ->setColumn($column)
                    ->get();
            }

            $up = (new CreateTable())
                ->setTable($table)
                ->setFields($fields)
                ->get();

            $down = (new DropTable())
                ->setTable($table)
                ->get();

            Writer::write(
                $this->getFilePath($this->getFileName($table)),
                (new Migration())
                    ->setClassName($this->getClassName($table))
                    ->setUp($up)
                    ->setDown($down)
                    ->get()
            );

        }
    }
}
