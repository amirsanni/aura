<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Genmod
 *
 * @author Amir <amirsanni@gmail.com>
 */
class Genmod extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }


    /**
     * Update any single column in any table using a single column in the where clause
     * @param string $tableName the name of the table to update
     * @param string $colName name of column to update
     * @param mixed $colVal value to insert into $colName
     * @param string $whereCol column to use in the where clause
     * @param mixed $whereColVal value of column $whereCol
     * @return boolean
     */
    public function updateTableCol($tableName, $colName, $colVal, $whereCol, $whereColVal){
        $q = "UPDATE $tableName SET $colName = ? WHERE $whereCol = ?";
        
        $this->db->query($q, [$colVal, $whereColVal]);
        
        if($this->db->affected_rows() > 0){
            return TRUE;
        }
        
        else{
            return FALSE;
        }
    }
    
    
    
    /**
     * get a single column from any table using a single column in the where clause
     * @param string $tableName
     * @param string $selColName
     * @param string $whereColName
     * @param mixed $colValue
     * @return boolean
     */
    public function getTableCol($tableName, $selColName, $whereColName, $colValue){
        $q = "SELECT $selColName FROM $tableName WHERE $whereColName = ?";
        
        $run_q = $this->db->query($q, [$colValue]);
        
        if($run_q->num_rows() > 0){
            foreach($run_q->result() as $get){
                return $get->$selColName;
            }
        }
        
        else{
            return FALSE;
        }
    }
}
