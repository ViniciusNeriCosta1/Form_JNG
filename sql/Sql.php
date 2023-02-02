<?php 

# namespace App\DB;

class Sql {

	const HOSTNAME = "localhost";
	const USERNAME = "suporteti";
	const PASSWORD = "q1Q!q1Q!";
	const DBNAME = "prd_p12";

	private $conn;
	private $errors;

	public function __construct() {
		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD
		);
		$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	private function setParams($statement, $parameters = array()) {
		foreach ($parameters as $key => $value)  $this->bindParam($statement, $key, $value);
	}

	private function bindParam($statement, $key, $value) {
		$statement->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array()) {
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);

		try {
			return $stmt->execute();
		} catch (\PDOException $e) {
			$this->setErrors($e->getMessage());
			return false;
		}
	}

	public function select($rawQuery, $params = array()) {
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);

		try {
			$stmt->execute();

			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			$this->setErrors($e->getMessage());
			return false;
		}
	}

	public function setErrors($errors) {
		$this->errors = $errors;
	}	
	public function getErrors() {
		return $this->errors;
	}

	public function insert($table, $data = array()) {
		$query = " INSERT INTO $table (";
		foreach($data as $field => $value) $query .= "{$field}, ";
		$query = substr($query, 0, -2); //remove última vírgula da string
		$query .= ") VALUES (";

		$args = array();
		foreach($data as $field => $value) {
			$data[$field] = ($value == '') ? null : $value;
			
			$query .= ":{$field}, ";
			$args[$field] = $value;
		}

		$query = substr($query, 0, -2); //remove última vírgula da string
		$query .= ')';

		return $this->query($query, $args);
	}

	public function update($table, $data = array(), $where = null, $id = null) {
		if ($id === null) $id = "id_{$table}";
		if ($where === null) $where = "{$id} = :{$id}";

		$query = " UPDATE $table SET ";
		$args = array();

		foreach($data as $field => $value) {
			$data[$field] = ($value == '') ? null : $value;
			
			$query .= "{$field} = :{$field}, ";
			$args[$field] = $value;
		}

		$query = substr($query, 0, -2); //remove última vírgula da string
		$query .= " WHERE $where";

		return $this->query($query, $args);
	}

	public function delete($table, $value, $where = null, $id = null) {
		if ($id === null) $id = "id_{$table}";
		if ($where === null) $where = "{$id} = :{$id}";

		$query = " DELETE FROM $table WHERE $where";
		$args = [":{$id}" => $value];
		
		return $this->query($query, $args);
	}
}