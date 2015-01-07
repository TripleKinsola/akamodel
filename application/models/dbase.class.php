<?php

/**
*@ author: "#$%^&^&^*^*#$"
* Main database parent class which could be extended by other classes that need data collections or inputs
* Class Instance variable = "$data" or as a reference to be "$database". But I like sticking with $data, because it's all about the data!
*/

// require_once("/config/config.inc.php");//Basic configurations kept away from "#$%^$*()@$#" access. Please edit a full path directory to this requirement, for it is all meal needed for the MySQLbase.class.
class MySQLbase{
    
    private $connection;
    public $last_query;
    private $magic_quotes_active;
    private $real_escape_string_exists;

	function __construct() {
		$this->open_connection();
	    $this->magic_quotes_active = get_magic_quotes_gpc();
	    $this->real_escape_string_exists = function_exists( "mysql_real_escape_string" );
	}

    public function open_connection() {
        $this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->connection) {
            die("Database connection failed: " . mysql_error());
        } else {
            $db_select = mysql_select_db(DB_NAME, $this->connection);
            if (!$db_select) {
                die("Database selection failed: " . mysql_error());
            }
        }
    }

    public function close_connection() {
        if(isset($this->connection)) {
            mysql_close($this->connection);
            unset($this->connection);
        }
    }

    public function query($sql) {
        $this->last_query = $sql;
        $result = mysql_query($sql, $this->connection);
        $this->confirm_query($result);//@ production, please no confirmation is needed.
        return $result;
    }
    
    public function escape_value( $value ) {
        if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
            $value = mysql_real_escape_string( $value );
        } else { // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
            // if magic quotes are active, then the slashes already exist
        }
        return $value;
    }
    

    // "database-neutral" methods
    public function fetch_array($result_set) {
        return mysql_fetch_array($result_set);
    }

    public function num_rows($result_set) {
        return mysql_num_rows($result_set);
    }

    public function insert_id() {
        // get the last id inserted over the current db connection
        return mysql_insert_id($this->connection);
    }

    public function affected_rows() {
        return mysql_affected_rows($this->connection);
    }

    private function confirm_query($result) {
        if (!$result) {
        $output = "Database query failed: " . mysql_error() . "<br /><br />";

       //Note: The next line of code is to be commented on production. I only use it in development to output last executed incorrect SQL
        $output .= "Last SQL query: " . $this->last_query; //Here to be commented @ production.
        die( $output );
        }
    }
    
}
$data = new MySQLbase;
?>