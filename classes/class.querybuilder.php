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

    function stateUp() {
        $this->state++;
    }

    function SELECT($what, $where) {
        if ($this->state == 0) {
            if (!is_array($what))
                $this->query .= "SELECT `" . $what . "` FROM `" . $where . "` ";
            else {
                $this->query .= "SELECT ";
                $numtargets = count($what);
                for ($i = 0; $i < $numtargets; $i++) {
                    if ($i < ($numtargets - 1))
                        $this->query .= "`" . $what[$i] . "`, ";
                    else
                        $this->query .= "`" . $what[$i] . "` ";
                }
                $this->query .= "FROM `" . $where . "` ";
            }
        }
        $this->stateUp();
        return $this->query;
    }

    function WHERE($field, $comparison, $target) {
        $allowedComparisons = array('LIKE', '=', '>', '<', '<=', '>=');
        if(!in_array($comparison, $allowedComparisons))
                return "Failed to provide correct comparison";
        
        if ($this->state > 0) {
            if($comparison == "LIKE")
                $target = "%" . $target . "%";
            $this->query .= "WHERE `" . $field . "` " . $comparison . " `" . $target . "`";
        }
        $this->stateUp();
        return $this->query;    
    }

}
