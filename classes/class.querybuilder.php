<?php

require_once __DIR__ . '/class.utility.php';
require_once __DIR__ . '/../includes/global.php';
class QueryBuilder {
    private $query;
    private $state;
    /**
     * STATES: 0 = INITIAL
     */
    
    function __construct() {
        $this->state = 0;
    }
    
    function SELECT($what,$where) {
        if($this->state == 0) {
            $this->query .= "SELECT " . $what . " FROM " . $where;   
        }
        return $this->query;
    }
}