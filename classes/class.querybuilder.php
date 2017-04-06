<?php

require_once __DIR__ . '/class.utility.php';
require_once __DIR__ . '/../includes/global.php';

/**
 * BASIC QUERY BUILDER, SIMPLE FOR MYGUITAR
 * @Author Mitchell Murphy
 * @Author_Email mitchell.murphy96@gmail.com
 * 
 * Standard for this file
 * 
 * After every modification to query string, buffer spacing left at end of string for next update.
 */
class QueryBuilder {

    private $query;
    private $state;
    private $db;

    /**
     * STATES: 0 = INITIAL
     * 1 - SELECT DEFINED
     * 2 - FROM DEFINED
     * 3 - WHERE DEFINED (CONDITIONAL
     */
    function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->state = 0;
    }

    /**
     * Standard increment of state
     */
    function transition() {
        $this->state++;
    }

    function clean($input) {
        $output = $input;
        if (is_array($input)) {
            //dothis (array)
        } else {
            //do this (non array)
        }
        return $output;
    }

    /**
     * Draws out beginning of SELECT statement, depending on WHAT target to select and from WHREE
     * @param String/Array $what fields to select from table
     * @param String $where tablename
     * @return String $this->query 
     */
    function select($what) {
        $what = $this->clean($what);
        if ($this->state == 0 && $what != "*") {
            if (!is_array($what))
                $this->query .= "SELECT `" . $what . "` ";
            else {
                $this->query .= "SELECT ";
                $numtargets = count($what);
                for ($i = 0; $i < $numtargets; $i++) {
                    if ($i < ($numtargets - 1))
                        $this->query .= "`" . $what[$i] . "`, ";
                    else
                        $this->query .= "`" . $what[$i] . "` ";
                }
            }
        } else {
            $this->query .= "SELECT " . $what . " ";
        }
        $this->transition();
        return $this;
    }

    /**
     * FROM
     */
    function from($where) {
        $where = $this->clean($where);
        if ($this->state == 1) {
            $this->query .= "FROM `" . $where . "` ";
        }
        $this->transition();
        return $this;
    }

    /**
     * Appends the WHERE clause to SELECT statement
     * @param String $field to check against
     * @param String $comparison operator
     * @param String $target value
     * @return string $this->query
     */
    function where($field, $comparison, $target) {
        $allowedComparisons = array('LIKE', '=', '>', '<', '<=', '>=');
        if (!in_array($comparison, $allowedComparisons)) {
            return "Failed to provide correct comparison";
        }
        if ($comparison == "LIKE") {
            $target = "%" . $target . "%";
        }
        if ($this->state > 1) {
            if ($this->state > 1 && $this->state < 3) {
                $this->query .= "WHERE `" . $field . "` " . $comparison . " '" . $target . "' ";
            } else {
                $this->query .= "AND `" . $field . "` " . $comparison . " '" . $target . "' ";
            }
        }
        $this->transition();
        return $this;
    }

    function get() {
        $ret = array();
        $query_result = $this->db->query($this->query);
        while ($row = $query_result->fetch_assoc()) {
            $ret[] = $row;
        }
        $query_result->free();
        return $ret;
    }

    /**
     * Trims the whitespace buffering from the query
     * @return String $this->query
     */
    function retrieve() {
        return trim($this->query);
    }

}
