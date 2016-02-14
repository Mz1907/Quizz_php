<?php

class Database {

    public $_host;
    public $_name;
    public $_userName;
    public $_password;

    ////////////////////////////////////////////////////////////////////////////
    public function __construct() {
        $this->setHost("localhost");
        $this->setName("quizz");
        $this->setUserName("root");
        $this->setPassword("");
    }

    /////////////////////////////////////////////////////////////////////////////
    public function connect() {
        //la connexion se fera lorque l'on appelle la fonction query()
        try {

            $con = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getName(), $this->getUserName(), $this->getPassword());
            $con->exec('SET NAMES utf8');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $con;
        } catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function close($pdoObject) {
        $pdoObject = null;
    }

    public function query($stmt, $query, $select, $debug = false, $show = false) {
        $con = $this->connect();
        if ($debug) {
            if ($show)
                echo '<pre>' . $query . '</pre>';
            if ($select) {
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            } elseif (!$select) {
                $result = $stmt->execute();
            }
            //$result = $stmt;
            $this->close($con);
            return $result;
        } else {
            if ($select) {
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            } elseif (!$select) {
                $result = $stmt->execute();
            }
            //$result = $stmt;
            $this->close($con);
            return $result;
        }
    }

    /*
     * the keys of the associative array $array MUST BE in the fields of the table (in the database)
     */

    public function insertInto(array $array, $tableName) {
        $con = $this->connect();
        $query = 'INSERT INTO ' . $tableName . ' (';
        foreach ($array as $key => $value) {
            if (!is_array($value))
                $query .= '_' . $key . ',';
        }
        $query = substr($query, 0, strlen($query) - 1);
        $query .= ') VALUES (';
        foreach ($array as $key => $value) {
            if ($key != 'created' && !is_array($value)) {
                $query .= ':' . $key . ', ';
            } elseif ($key == 'created') {
                $query .= 'NOW(),';
            }
        }
        $query = substr($query, 0, strlen($query) - 2);
        $query .= ')';
        $stmt = $con->prepare($query);
        foreach ($array as $key => &$value) {
            if ($key != "created" && !is_array($value)) {
                $stmt->bindParam(':' . $key, $value);
            }
        }

        $result = $this->query($stmt, $query, false);
        $this->close($con);
        return $result;
    }

    public function update(array $array, $tableName) {
        $con = $this->connect();
        $query = 'UPDATE ' . $tableName . ' SET ';
        foreach ($array as $key => $value) {
            if ($key != 'modified') {
                $query .= '_' . $key . ' =:' . $key . ',';
            } elseif ($key == 'modified') {
                $query .= '_modified=NOW(),';
            }
        }
        $query = substr($query, 0, strlen($query) - 1);
        $query .= " WHERE _id='" . $array['id'] . "'";
        $stmt = $con->prepare($query);
        foreach ($array as $key => &$value) {
            if ($key != 'modified') {
                $stmt->bindParam(':' . $key, $value);
            }
        }
        $result = $this->query($stmt, $query, false);
        $this->close($con);
        return $result;
    }

    /* Ne dispoant pas d'un champ id il faut utiliser un autre champ pour se situer lorsque l'on supprime un element */

    public function delete($fieldName, $fieldValue, $tableName) {
        $con = $this->connect();
        $query = 'DELETE FROM ' . $tableName . " WHERE " . $fieldName . " =:" . $fieldName;
        $stmt = $con->prepare($query);
        $stmt->bindParam(':' . $fieldName, $fieldValue);
        $this->close($con);
        return $this->query($stmt, $query, false);
    }

    ////////////////////////////////////////////////////////////////////////////
    public function getHost() {
        return $this->_host;
    }

    public function getName() {
        return $this->_name;
    }

    public function getUserName() {
        return $this->_userName;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setHost($host) {
        $this->_host = $host;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function setUserName($userName) {
        $this->_userName = $userName;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

}
