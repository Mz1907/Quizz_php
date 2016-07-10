<?php

abstract class ObjectManager {

    ////////////////////////////////////////////////////////////////////////////
    protected $_db;
    //protected $_fullAcces;
    protected $_type;
    protected $_tableName;

    ////////////////////////////////////////////////////////////////////////////
    /* $_type is the type of the object we want to manage */
    public function __construct($database, $type, $tableName, $overrideFullAccess = false) {
        $this->_db = $database;
        //$this->_fullAcces = UserManager::isAdmin() || (boolean) $overrideFullAccess ? true : false;
        $this->_type = $type;
        $this->_tableName = $tableName;
    }

    ///////////////////////////////////////////////////////////////////////////
    /* Get all objects */
    public function getObjects($orderBy) {
        $con = $this->_db->connect();
        $query = "SELECT * FROM " . $this->_tableName;
        $query .= " ORDER BY " . $orderBy . ' DESC';
        $stmt = $con->prepare($query);
        $result = $this->_db->query($stmt, $query, true);
        $this->_db->close($con);
        return $result;
    }

    public function getObjectsByPrimaryKey($fieldName, $fieldValue, $orderBy) {
        $con = $this->_db->connect();
        $query = "SELECT * FROM " . $this->_tableName . " WHERE " . $fieldName . " =:" . $fieldName;
        $query .= " ORDER BY " . $orderBy;
        $stmt = $con->prepare($query);
        $stmt->bindParam(':' . $fieldName, $fieldValue);
        $result = $this->_db->query($stmt, $query, true);
        $this->_db->close($con);
        return $result;
    }

    public function addObjectInDatabase($object) {
        $array = $object->getClassVarsAndValues();
        $sqlResult = $this->_db->insertInto($array, $object->getTableName());
        return $sqlResult;
    }

    /* Modifies an object in the database if the current user is allowed to get it. */

    public function updateObjectInDatabase($object) {
        $array = $object->getClassVarsAndValues();
        $sqlResult = $this->_db->update($array, $object->getTableName());
        return $sqlResult;
    }

    /* Deletes an object in the database BUT use it only is there is NO SIDE EFFECT. */

    public function deleteObjectFromDatabase($object) {
        $sqlResult = $this->_db->delete('_id', $object->getId(), $object->getTableName());
        echo ' ... ' . $object->getId() . ' ... ' . $object->getTableName() . ' ... ';
        return $sqlResult;
    }

}
