<?php

require_once 'DB.php';

abstract class Crud extends DB{

	protected $table;

	abstract public function insert();
	abstract public function update($id_cliente);

	public function find_clientes($id_cliente){
		$sql  = "SELECT * FROM $this->table WHERE id_cliente = :id_cliente";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function findAll_clientes(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function findAll_dividas(){
		$sql  = "SELECT * FROM $this->table INNER JOIN clientes ON $this->table.id_cliente = clientes.id_cliente";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function findRepeat($nome, $email){
		$sql  = "SELECT * FROM $this->table WHERE nome = :nome OR email = :email";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function delete_cliente($id_cliente){
		$sql  = "DELETE FROM $this->table WHERE id_cliente = :id_cliente";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
		return $stmt->execute(); 
	}

}