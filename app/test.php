<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 13/09/2018
 * Time: 17:06
 */

namespace App;


class test
{
    private $driver;
    private $table;
    private $connection;

    public function __construct(array $database)
    {
        $this->driver = $database['driver'];
        $this->table = $database['table'];
        $this->connection = $database['connection'];
    }

    public function getDriver () {
        return $this->driver;
    }

}