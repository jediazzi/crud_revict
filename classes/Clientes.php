<?php

require_once 'Crud.php';

class Clientes extends Crud{
	
	protected $table = 'clientes';
	private $nome;
	private $email;

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function insert(){

		if($this->findRepeat($this->nome, $this->email)) {

		} else {
			$sql  = "INSERT INTO $this->table (nome, email) VALUES (:nome, :email)";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			return $stmt->execute(); 
		}

	}

	public function update($id_cliente){
		if($this->findRepeat($this->nome, $this->email)) {

		} else {
			$sql  = "UPDATE $this->table SET nome = :nome, email = :email WHERE id_cliente = :id_cliente";
			$stmt = DB::prepare($sql);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':id_cliente', $id_cliente);
			return $stmt->execute();
		}	

	}

}