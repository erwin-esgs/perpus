<?php
class Database{
	private $host;
	private $user;
	private $pass;
	private $db;
	public $mysqli;
	
	public function __construct() {
    	$this->openConnection();
    }
    
    public function openConnection(){
    	$this->host = 'localhost';
    	$this->user = 'root';
    	$this->pass = '';
    	$this->db = 'skripsi_andre';
    	$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
    	return $this->mysqli;
    }
    
    function query($query){
		$this->mysqli->query($query);
		if(mysqli_error($this->mysqli)){
			echo mysqli_error($this->mysqli);
			exit();
		}
	}
	
	function insertId(){
		$last = mysqli_insert_id($this->mysqli);
		return $last;
	}
    
    function numRows($query_num){
		$query = $query_num;
		$num = $this->mysqli->query($query);
    	if(mysqli_error($this->mysqli)){
			echo mysqli_error($this->mysqli);
			exit();
		}
		else{
			return $num->num_rows;
		}
	}
    
    public function sqlQuery($query, $select_all = NULL){
    	$data = array();
		$sql = $this->mysqli->query($query);
		if(mysqli_error($this->mysqli)){
			echo mysqli_error($this->mysqli);
			exit();
		}
		else{
			if($sql->num_rows > 0){
				if($select_all == NULL){
					while($row = $sql->fetch_object()) {
						$data[] = $row;
					}
					return $data;
				}
				else{
					$data = $sql->fetch_object();
					return $data;
				}
				
				return $data;
			}
			else{
				return FALSE;
			}
		}
	}
		
    public function insert($table = NULL, $fields = array()){
    	$insert = '';
    	$insert_coloumn = '';
    	$insert_values = '';
    	foreach($fields as $key => $value){
		 	$insert_coloumn .= $key.", ";
		}
		foreach($fields as $key => $value){
		 	$insert_values .= '\''.$value.'\', ';
		}
		$insert_1 = rtrim($insert_coloumn,', ');
		$insert_2 = rtrim($insert_values,', ');
		$query = 'INSERT INTO '.$table.'('.$insert_1.') VALUES('.$insert_2.')';
        $this->mysqli->query($query);
        if(mysqli_error($this->mysqli)){
			echo mysqli_error($this->mysqli);
			exit();
		}
		else{
			return TRUE;
		}
    }
    
    public function update($table = NULL, $fields = array(), $where = array()){
     	$update = '';
     	$where_coloumn = '';
     	if(count($where) > 0){
     		foreach($where as $key => $value){
			 	$where_coloumn .= $key."="."'".$value."' AND ";
			}
			$where_coloumn = rtrim($where_coloumn,' AND ');
			$where = ' WHERE '.$where_coloumn;
		}
		else{
			$where = '';
		}
     	foreach($fields as $key => $value){
		 	$update .= $key."="."'".$value."', ";
		}
		$update = rtrim($update,', ');
		$query = "UPDATE ".$table." SET ".$update.$where;
		$this->mysqli->query($query);
    	if(mysqli_error($this->mysqli)){
			echo mysqli_error($this->mysqli);
			exit();
		}
		else{
			return TRUE;
		}
    }
    
    public function delete($table = NULL, $where = NULL){
		$query = 'DELETE FROM '.$table.' WHERE '.$where;
		$this->mysqli->query($query);
    	if(mysqli_error($this->mysqli)){
			echo mysqli_error($this->mysqli);
			exit();
		}
		else{
			return TRUE;
		}
	}
	
	function closeConnection(){
		$this->mysqli->close();
	}
}
?>