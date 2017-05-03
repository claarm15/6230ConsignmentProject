<?php 
/**
 * 
 */
class DB {
	
	protected $result;
	protected $link;
	
	/**
	 * Construct and optionally connect to database
	 */
	public function __construct($config) {
		extract($config);
		if (isset($host) && isset($user) && isset($password) && isset($database)) {
			return $this->connect($config);
		}
	}
	
	/**
	 * Singleton Instance of class
	 */
	public static function get_instance($config) {
		extract($config);
		static $instances = array();
		$key = "$host:$user:$password:$database";
		if (!isset($instances[$key])) {
			$instances[$key] = new DB($config);
		}
		return $instances[$key];
	}
	
	private function connect($config) {
		extract($config);
		if ($this->link = mysqli_connect($host, $user, $password)) {
			return mysqli_select_db($this->link, $database);
		}
		return false;
	}
	
	public function get_array($query) {
		$result = $this->query($query);
		return $this->get_row_list();
	}
	
	
	protected function set_query($args) {
		call_user_func_array(array($this, 'query'), $args);
	}
	
	
	private function query($query) {
		$args = func_get_args();
		if (count($args) > 1) {
			array_shift($args);
			$args = array_map('mysqli_real_escape_string', $args);
			array_unshift($args, $query);
			$query = call_user_func_array('sprintf', $args);
		}
		//echo "SEND QUERY: $query\n";
		if (!$this->result = mysqli_query($this->link, $query)) {
			if ($this->result !== false) {
				echo "QUERY ERROR: $query\n";
				throw new Exception('Query failed: '.mysqli_error($this->result));
			}
		}
		return $this->result;
	}

	private function get_row_list($query = null) {
		if ($query) {
			$args = func_get_args();
			$this->setQuery($args);
		}
		if (!is_bool($this->result)) {
			$rows = array();
			while($row = mysqli_fetch_assoc($this->result)) {
				$rows[] = (object) $row;
			}
			return $rows;
		} else {
			return false;
		}
	}
	
	private function get_row($query = null) {
		if ($query) {
			$args = func_get_args();
			$this->setQuery($args);
		}
		if ($this->result) {
			if ($row = mysqli_fetch_assoc($this->result)) {
				return (object) $row;
			}
		}
		return false;
	}
	
		public function get_result($query = null) {
		if ($query) {
			$args = func_get_args();
			$this->setQuery($args);
		}
		if ($this->result) {
			if ($row = mysqli_fetch_row($this->result)) {
				return $row[0];
			}
		}
		return false;
	}
	
	public function get_insert_id() {
		return mysqli_insert_id($this->link);
	}
	public function escape($data) {
		return mysqli_real_escape_string($this->link, $data);
	}
}
