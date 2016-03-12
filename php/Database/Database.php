<?php
namespace Fbreuer\Cms\Database;

/*
 * This file belongs to the package "TYPO3 Fluid".
 * See LICENSE.txt that was shipped with this package.
 */

class Database
{
    protected $db;

    public function __construct() {
        $host_name  = 'db617247485.db.1and1.com';
        $database   = 'db617247485';
        $user_name  = 'dbo617247485';
        $password   = 'eduardflorian2016';

        $this->db = mysqli_connect($host_name, $user_name, $password, $database);
    }

    public function query($query)
    {
        return mysqli_query($this->db, $query);
    }

    public function next_result()
    {
        return mysqli_next_result($this->db);
    }

    public function get_array($mysqli_result)
    {
        return mysqli_fetch_array($mysqli_result);
    }

}

