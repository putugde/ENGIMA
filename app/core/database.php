<?php

class Database
{
    private $_host = DB_HOST;
    private $_uname = DB_UNAME;
    private $_psw = DB_PSW;
    private $_db_name = DB_NAME;

    private $_dbh;
    private $_stmt;

    public function __construct()
    {
        //data source name
        $dsn = 'mysql:host=' . $this->_host . ';dbname=' . $this->_db_name;
        $option = [ PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
        $this->dbh = null;
        $limit = 10;
        $counter = 0;

        while(true){
            try {
                $this->dbh = new PDO($dsn, $this->_uname, $this->_psw, $option);
                $this->dbh->exec( "SET CHARACTER SET utf8" );
                $this->dbh->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC ); 
                $this->dbh->setAttribute( PDO::ATTR_PERSISTENT, true );
                break;
            } catch (PDOException $e) {
                $this->dbh = null;
                $counter++;
                if ($counter == $limit)
                    throw $e;
            }
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function convert($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        } elseif (is_array($dat)) {
            $ret = [];
            foreach ($dat as $i => $d) {
                $ret[ $i ] = self::convert($d);
            }
            return $ret;
        } elseif (is_object($dat)) {
            foreach ($dat as $i => $d) {
                $dat->$i = self::convert($d);
            }
            return $dat;
        } else {
            return $dat;
        }
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
