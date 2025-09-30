<?php
class DBController {
    private $host     = "localhost";
    private $user     = "root";
    private $password = "";
    private $database = "crud_example";

    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->conn) {
            die("DB Connection failed: " . mysqli_connect_error());
        }
        mysqli_set_charset($this->conn, "utf8mb4");
    }


    public function runBaseQuery($query) {
        $result = mysqli_query($this->conn, $query);
        if ($result === false) {
            return [];
        }
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysqli_free_result($result);
        return $rows;
    }

    public function runQuery($query, $param_type = null, $param_value_array = []) {
        if ($param_type === null) {
            return $this->runBaseQuery($query);
        }
        $stmt = mysqli_prepare($this->conn, $query);
        if ($stmt === false) {
            return [];
        }
        $this->bindParams($stmt, $param_type, $param_value_array);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $rows = [];
        if ($result !== false) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            mysqli_free_result($result);
        }
        mysqli_stmt_close($stmt);
        return $rows;
    }


    public function insert($query, $param_type, $param_value_array) {
        $stmt = mysqli_prepare($this->conn, $query);
        if ($stmt === false) {
            return 0;
        }
        $this->bindParams($stmt, $param_type, $param_value_array);
        mysqli_stmt_execute($stmt);
        $id = mysqli_insert_id($this->conn);
        mysqli_stmt_close($stmt);
        return $id;
    }

    public function update($query, $param_type, $param_value_array) {
        $stmt = mysqli_prepare($this->conn, $query);
        if ($stmt === false) {
            return 0;
        }
        $this->bindParams($stmt, $param_type, $param_value_array);
        mysqli_stmt_execute($stmt);
        $affected = mysqli_affected_rows($this->conn);
        mysqli_stmt_close($stmt);
        return $affected;
    }

    
    private function bindParams(&$stmt, $param_type, $param_value_array) {
        $bind_names = [];
        $bind_names[] = $param_type;
        for ($i = 0; $i < count($param_value_array); $i++) {
            $bind_name = 'bind' . $i;
            $$bind_name = $param_value_array[$i];
            $bind_names[] = &$$bind_name;
        }
        call_user_func_array(array($stmt, 'bind_param'), $bind_names);
    }
}
