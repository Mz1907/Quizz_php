<?php

class User {

    protected $_pseudo;
    protected $_password;
    protected $_created;
    protected $_modified;

    ////////////////////////////////////////////////////////////////////////////
    public function __construct(array $option) {
        if (is_array($option)) {
            $methods = get_class_methods($this);
            foreach ($option as $key => $value) {
                $key = substr($key, 1);
                $method = 'set' . ucfirst($key);
                if (in_array($method, $methods)) {
                    $this->$method($value);
                }
            }
            return $this;
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    public function getClassVarsAndValues() {
        $vars = get_class_vars(get_class($this));
        if (is_array($vars)) {
            $result = [];
            $methods = get_class_methods($this);
            foreach ($vars as $key => $value) {
                $key = substr($key, 1);
                $method = 'get' . ucfirst($key);
                if (in_array($method, $methods)) {
                    $tmpResult = $this->$method();
                    $result[$key] = $tmpResult === false ? 0 : $this->$method();
                }
            }
            return $result;
        }
    }

    public function getTableName() {
        return 'users';
    }

    public function getPseudo() {
        return $this->_pseudo;
    }

    public function setPseudo($pseudo) {
        $this->_pseudo = $pseudo;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function getCreated() {
        return $this->_created;
    }

    public function setCreated($created) {
        $this->_created = $created;
    }

    public function getModified() {
        return $this->_modified;
    }

    public function setModified($modified) {
        $this->_modified = $modified;
    }

}
