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
    private $firstWhere;

    function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->state = 0;
        $this->firstWhere = false;
    }

    /**
     * Standard increment of state
     */
    function transition() {
        $this->state++;
    }

    function clean($input) {
        if (is_array($input)) {
            $output = $input;
            foreach ($input as $key => $val) {
                $key = mysqli_real_escape_string($this->db, $key);
                $val = mysqli_real_escape_string($this->db, $val);
                $output[$key] = $val;
            }
        } else {
            $output = htmlspecialchars(mysqli_real_escape_string($this->db, $input));
        }
        return $output;
    }

    function update($table) {
        $table = $this->clean($table);
        if ($this->state == 0) {
            $this->query .= "UPDATE `" . $table . "` ";
        }
        $this->transition();
        return $this;
    }

    function set($column, $toVal) {
        $column = $this->clean($column);
        $toVal = $this->clean($toVal);
        if ($this->state > 0) {
            if (!is_array($column) && !is_array($toVal)) {
                $this->query .= "SET `" . $column . "` = '" . $toVal . "' ";
            } else {
                $columnC = count($column);
                $varC = count($toVal);
                if ($columnC == $varC) {
                    $this->query .= "SET ";
                    for ($i = 0; $i < $varC; $i++) {
                        if ($i > 0)
                            $this->query .= ", ";
                        $this->query .= "`" . $column[$i] . "` = '" . $toVal[$i] . "' ";
                    }
                }
            }
        }
        $this->transition();
        return $this;
    }

    /**
     * Draws out beginning of SELECT statement, depending on WHAT target to select and from WHREE
     * @param String/Array $what fields to select from table
     * @param String $where tablename
     * @return String $this->query 
     */
    function select($column) {
        $column = $this->clean($column);
        if ($this->state == 0 && $column != "*") {
            if (!is_array($column))
                $this->query .= "SELECT `" . $column . "` ";
            else {
                $this->query .= "SELECT ";
                $numtargets = count($column);
                for ($i = 0; $i < $numtargets; $i++) {
                    if ($i < ($numtargets - 1))
                        $this->query .= "`" . $column[$i] . "`, ";
                    else
                        $this->query .= "`" . $column[$i] . "` ";
                }
            }
        } else {
            $this->query .= "SELECT " . $column . " ";
        }
        $this->transition();
        return $this;
    }
    
    function insert_into($table, $values) {
        $table = $this->clean($table);
        $values = $this->clean($values);
        if($this->state == 0) {
            $this->query .= "INSERT INTO `".$table."` ";
            $n = count($values);
            $iteration = 0;
            $this->query .= "( ";
            $newVals = array();
            foreach($values as $key => $val) {
                $newVals[] = $val;
                if($iteration == ($n-1))
                    $this->query .= "`".$key."`";
                else
                    $this->query .= "`".$key."`, ";
                $iteration++;
            }
            $this->query .= ") VALUES ( ";
            $iteration = 0;
            for($i = 0; $i < $n; $i++) {
                if($iteration == ($n-1))
                    $this->query .= "`".$newVals[$i]."`";
                else
                    $this->query .= "`".$newVals[$i]."`, ";
                $iteration++;
            }
            $this->query .= ");";
        }
    }

    function delete_from($table) {
        $table = $this->clean($table);
        if ($this->state == 0) {
            $this->query .= "DELETE FROM `" . $table . "` ";
        }
        $this->transition();
        return $this;
    }

    /**
     * FROM
     */
    function from($table) {
        $table = $this->clean($table);
        if ($this->state == 1) {
            $this->query .= "FROM `" . $table . "` ";
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
        if ($this->state > 0) {
            if (!$this->firstWhere) {
                $this->query .= "WHERE `" . $field . "` " . $comparison . " '" . $target . "' ";
            } else {
                $this->query .= "AND `" . $field . "` " . $comparison . " '" . $target . "' ";
            }
        }
        $this->transition();
        $this->firstWhere = true;
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

    function exec() {
        $query = $this->db->query($this->query);
        return $query;
    }

    /**
     * Trims the whitespace buffering from the query
     * @return String $this->query
     */
    function retrieve() {
        return trim($this->query);
    }

}
