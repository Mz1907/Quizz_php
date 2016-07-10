<?php

class Question {

    ////////////////////////////////////////////////////////////////////////////
    public $_id;
    public $_quizzName;
    public $_title;
    public $_isChoiceCode;
    public $_choices;
    public $_answer;
    public $_created;
    public $_modified;

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
        return 'quizz_questions';
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getQuizzName() {
        return $this->_quizzName;
    }

    public function setQuizzName($quizzName) {
        $this->_quizzName = $quizzName;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function setTitle($title) {
        $this->_title = $title;
    }
    
    public function getIsChoiceCode(){
        return $this->_isChoiceCode;
    }
    
    public function setIsChoiceCode($isChoiceCode){
        $this->_isChoiceCode = $isChoiceCode;
    } 

    public function getChoices() {
        return $this->_choices;
    }

    public function setChoices($choices) {
        if (is_array($choices))
            $this->_choices = serialize($choices);
        else
            $this->_choices = unserialize($choices);
    }

    public function getAnswer() {
        return $this->_answer;
    }

    public function setAnswer($answer) {
        $this->_answer = $answer;
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
