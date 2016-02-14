<?php

class Quizz {

    ////////////////////////////////////////////////////////////////////////////
    public $_id;
    public $_author;
    public $_name;
    public $_category;
    public $_created; //creation date
    public $_modified;

    ////////////////////////////////////////////////////////////////////////////
    public function __construct(array $option = null) {
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
        return 'quizz';
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getAuthor() {
        return $this->_author;
    }

    public function setAuthor($author) {
        $this->_author = $author;
    }

    public function getName() {
        return $this->_name;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function getCategory() {
        return $this->_category;
    }

    public function setCategory($category) {
        $this->_category = $category;
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
