<?php

class db{
	
	private $sql;
	private $returne;
	var $arr = array();

	//Search the table name and has a specific search
	public function with2($table,$user_id){

		$this -> sql = "select * from $table where user_id = $user_id";
		$this -> returne = mysql_query($this -> sql);

	}

	//Search the table name, with the specificied table to search and the input to where you're gonna search
	public function search($table,$table_search,$user_id){

		$this -> sql = "select * from $table where $table_search = '$user_id' ";
		$this -> returne = mysql_query($this -> sql);

	}

	public function search_full($full_list){

        $this -> sql = $full_list;
        $this -> returne = mysql_query($this -> sql);

    }

	function getSelection($insert){
		while($row = mysql_fetch_array($this -> returne)){
		    return $row[$insert];
		}
	}

    public function getSelection2(){
        $returnd2 = $this -> returne;
        while($row2 = mysql_fetch_array($returnd2)){
            return var_dump($row2['date']);
        }

        $selection = "";
    }

    public function getReturne(){
        $returnd = $this -> returne;
        $this -> row = mysql_fetch_array($this -> returne);
        return $this -> row['date'];
        //return $this -> returne;
    }

    public function getNumRow(){
        return mysql_num_rows($this -> returne);
    }

    public function getError(){
        return mysql_error();
    }

}

?>