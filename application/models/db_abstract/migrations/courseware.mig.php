<?php
/**
 * <h1>Akaddit v2 CourseWare Class</h1>
 * @author Akinsola Ademola, A [07062671144]
 * @version 2.0, 2014/2015
 * @link http://geekerbyte.blogspot.com => TripleKinsola@gmail.com
 * @copyright date('Y');
 * 
 */
class CourseWare{
    // Migration properties...
    //1 id	int(11)	AUTO_INCREMENT
    //2 title	varchar(100)
    //3 file_name	varchar(100)
    //4 file_encrypt_name	varchar(30)
    //5 author	varchar(100)
    //6 course_code	varchar(100)
    //7 course_id	int(11)
    //8 sch_id	int(11)
    //9 thumbnail_image	varchar(20)
    //10    uploader_user_id	int(11)
    //11	date_added	timestamp 	CURRENT_TIMESTAMP
    //12	courseware_type	varchar(30)
    //13	interest_id	int(11)
    //14	scope	int(11)
    //15	file_size	int(11)

    private static $table = "course_wares"; //Db Table
    protected static $db_fields=array('id', 'title', 'file_name', 'file_encrypt_name', 'author', 'course_code', 'course_id', 'sch_id', 'thumbnail_image', 'uploader_user_id', 'date_added', 'courseware_type', 'interest_id', 'scope', 'file_size');

    // Class properties
    public $id;
    public $title;
    public $file_name;
    public $file_encrypt_name;
    public $author;
    public $course_code;
    public $course_id;
    public $sch_id;
    public $thumbnail_image;
    public $date_added = 'NOW()';//In the DBase, it authomatically set....
    public $uploader_user_id;
    public $courseware_type;
    public $interest_id;
    public $scope;
    public $file_size;


    // Common Database Methods
    public static function find_all() {
        return self::find_by_sql("SELECT * FROM ".self::$table);
    }

    public static function find_by_id($id=0) {
        $result_array = self::find_by_sql("SELECT * FROM ".self::$table." WHERE id=".$id." LIMIT 1");

        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_sql($sql="") {
        global $data;
        $result_set = $data->query($sql);
        $object_array = array();
        while ($row = $data->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    public static function count_all() {
        global $data;
        $sql = "SELECT COUNT(*) FROM ".self::$table;
        $result_set = $data->query($sql);
        $row = $data->fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record) {
        // Could check that $record exists and is an array
        $object = new self;

        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
        // return an array of attribute names and their values
        $attributes = array();
        foreach(self::$db_fields as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $data;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach($this->attributes() as $key => $value){
            $clean_attributes[$key] = $data->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save() {
        // A new record won't have an id yet.
        return isset($this->id) ? $this->update() : $this->create();
    }

    private function create() {
        global $data;
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO ".self::$table." (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if($data->query($sql)) {
            $this->id = $data->insert_id();
            return true;
        } else {
            return false;
        }
    }

    private function update() {
        global $data;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".self::$table." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $data->escape_value($this->id);
        $data->query($sql);
        return ($data->affected_rows() == 1) ? true : false;
    }

    public function delete() {
        global $data;
        $sql = "DELETE FROM ".self::$table;
        $sql .= " WHERE id=". $data->escape_value($this->id);
        $sql .= " LIMIT 1";
        $data->query($sql);
        return ($data->affected_rows() == 1) ? true : false;
    }
}
?>