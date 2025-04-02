<?php  
class mailsettings{
	private $table = "mailsettings";
	private $conn;

	//All properties
	public $id;
	public $email;
	public $mail_server;
	public $mail_username;
	public $mail_password;
	public $mail_port;
	public $created_at;
	public $updated_at;

	//Connect DB
	public function __construct($db){
		$this->conn = $db;
	}

	//Read all records
	public function readAll(){
		$sql = "SELECT * FROM $this->table";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	//Read record
	public function read(){
		$sql = "SELECT * FROM $this->table
				WHERE id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->id);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row = $stmt->fetch();
			$this->email = $row['email'];
			$this->mail_server = $row['mail_server'];
			$this->mail_username = $row['mail_username'];
			$this->mail_password = $row['mail_password'];
			$this->mail_port = $row['mail_port'];
			$this->created_at = $row['created_at'];
			$this->updated_at = $row['updated_at'];
		}
	}

	//Create mailsettings page
	public function create(){
		$sql = "INSERT INTO $this->table
				SET email = :get_email,
					mail_server = :get_mail_server,
					mail_username = :get_mail_username,
					mail_password = :get_mail_password,
					mail_port = :get_mail_port,
					created_at = :get_created_date,
					updated_at = :get_updated_date";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_email",$this->email);
		$stmt->bindParam(":get_mail_server",$this->mail_server);
		$stmt->bindParam(":get_mail_username",$this->mail_username);
		$stmt->bindParam(":get_mail_password",$this->mail_password);
		$stmt->bindParam(":get_mail_port",$this->mail_port);
		$stmt->bindParam(":get_created_date",$this->created_at);
		$stmt->bindParam(":get_updated_date",$this->updated_at);
		
		if($stmt->execute()){
			return true;
		}
	}

	//Update mailsettings page
	public function update(){
		$sql = "UPDATE $this->table
				SET email = :get_email,
					mail_server = :get_mail_server,
					mail_username = :get_mail_username,
					mail_password = :get_mail_password,
					mail_port = :get_mail_port,
					updated_at = :get_updated_date
				WHERE id = :get_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(":get_id",$this->id);
		$stmt->bindParam(":get_email",$this->email);
		$stmt->bindParam(":get_mail_server",$this->mail_server);
		$stmt->bindParam(":get_mail_username",$this->mail_username);
		$stmt->bindParam(":get_mail_password",$this->mail_password);
		$stmt->bindParam(":get_mail_port",$this->mail_port);
		$stmt->bindParam(":get_updated_date",$this->updated_at);
		
		
		if($stmt->execute()){
			return true;
		}

	}

}

?>