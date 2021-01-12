<?php

declare(strict_types = 1);

namespace Customer\Model;

use Customer\DB\Connection;

class Model
{
    protected string $table;
    protected $connection = null;

    public function __construct()
	{
		$this->connection = Connection::getInstance();
	}

    private function bind($sql, $data)
	{
		$bind = $this->connection->prepare($sql);
		foreach ($data as $k => $v) {
			gettype($v) == 'int' ? $bind->bindValue(':' . $k, $v, \PDO::PARAM_INT)
				: $bind->bindValue(':' . $k, $v, \PDO::PARAM_STR);
		}
		return $bind;
    }
    
    public function update(array $data): array
	{
		try{
			if (!array_key_exists('id', $data)) {
				throw new \Exception('warning', 'ID não encontrado!', 286, true);
			}

			$datasSql = '';

			foreach($data as $key => $value)
			{
				if($key !== 'id') {
					$datasSql .= $key . ' = ' . ':' . $key . ', ';
				}
			}

			$datasSql = substr($datasSql, 0, -2);

			$sql = "UPDATE " . $this->table . " SET " . $datasSql . " WHERE id = :id";
			$stmt = $this->bind($sql, $data);
			if ($stmt->execute()) {
				return ['message' => 'Registro atualizado com sucesso!'];
			}
			throw new \Exception('erro', 'Falha ao atualizar registro!', 2, true);
		} catch (\PDOException $e) {
			return ['erro' => true, 'code' => $e->getCode(), 'message' => $e->getMessage()];
		}
    }
    
    public function delete(int $id): array
	{
		try{
			$sql = "DELETE FROM {$this->table} WHERE id = :id";
			$delete = $this->bind($sql, ['id' => $id]);
			$delete->execute();
			if ($delete->rowCount() > 0) {
				return ['message' => 'Registro excluído com sucesso!'];
			}
			return ['erro' => true, 'message' => 'Registro não encontrado!'];
		} catch (\PDOException $e) {
			return ['erro' => true, 'code' => $e->getCode(), 'message' => $e->getMessage()];
		}
    }
    
    public function insert(array $data = []): array
	{
		try{
			$sql = "INSERT INTO {$this->table} (" . implode(',', array_keys($data)). ") VALUES (:" . implode(', :', array_keys($data)) . ")";
			$stmt = $this->bind($sql, $data);
			$stmt->execute();
			return ['message' => 'Registro salvo com sucesso!'];
		} catch (\PDOException $e) {
			return ['erro' => true, 'code' => $e->getCode(), 'message' => $e->getMessage()];
		}
	}
}