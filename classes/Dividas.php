<?php

require_once 'Crud.php';

class Dividas extends Crud{
	
	protected $table = 'divida';
	private $id_cliente;
	private $valor;

	public function setIdCliente($id_cliente){
		$this->id_cliente = $id_cliente;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function insert(){

		$sql  = "INSERT INTO $this->table (id_cliente, valor) VALUES (:id_cliente, :valor)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_cliente', $this->id_cliente);
		$stmt->bindParam(':valor', $this->valor);
		return $stmt->execute(); 

	}

	public function update($id_divida){

		$sql  = "UPDATE $this->table SET id_cliente = :id_cliente, valor = :valor WHERE id_divida = :id_divida";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_cliente', $this->id_cliente);
		$stmt->bindParam(':valor', $this->valor);
		$stmt->bindParam(':id_divida', $id_divida);
		return $stmt->execute();

	}

	public function delete_divida($id_divida){
		$sql  = "DELETE FROM $this->table WHERE id_divida = :id_divida";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_divida', $id_divida, PDO::PARAM_INT);
		return $stmt->execute(); 
	}

	public function baixa_divida($id_divida){
		$sql  = "UPDATE $this->table SET baixada = 1 WHERE id_divida = :id_divida";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_divida', $id_divida, PDO::PARAM_INT);
		return $stmt->execute(); 
	}

	public function find_dividas($id_divida){
		$sql  = "SELECT * FROM $this->table INNER JOIN clientes ON $this->table.id_cliente = clientes.id_cliente WHERE id_divida = :id_divida ";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id_divida', $id_divida, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

}