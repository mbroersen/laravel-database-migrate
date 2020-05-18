<?php
namespace Mbroersen\LaravelDatabaseMigrate\Service\Database;


class Reader {

    //todo get schema name from connection and use it;
    const QUERY_GET_COLUMNS = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?";
    const QUERY_FOREIGN_KEYS = "SELECT * FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?";
    const QUERY_INDEXES = "SELECT * FROM information_schema.STATISTICS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?";


    /**
     * @return mixed
     */
    public function getTables()
    {
        return \DB::select("SHOW TABLES");
    }

    /**
     * @param $table
     * @return mixed
     */
    public function getColumns($table)
    {
        return \DB::select(self::QUERY_GET_COLUMNS, [env('DB_DATABASE'), $table]);
    }

    /**
     * @param $table
     * @return mixed
     */
    public function getForeignKeys($table)
    {
        return \DB::select(self::QUERY_FOREIGN_KEYS, [env('DB_DATABASE'), $table]);
    }

    /**
     * @param $table
     * @return mixed
     */
    public function getIndexs($table)
    {
        return \DB::select(self::QUERY_INDEXES, [env('DB_DATABASE'), $table]);
    }

}