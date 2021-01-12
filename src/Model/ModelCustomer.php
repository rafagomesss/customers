<?php

declare(strict_types = 1);

namespace Customer\Model;

use Customer\DB\Connection;
use Customer\Resources\Common;

class ModelCustomer extends Model
{
    protected string $table = 'customer';

    private function compareColumns(): array
    {
        return [
            'code' => 'id',
            'customerName' => 'name',
            'customerCPF' => 'cpf',
            'customerBirthDate' => 'birthdate',
            'customerGender' => 'gender',
            'customerCep' => 'cep',
            'customerAddress' => 'address',
            'customerNbh' => 'neighborhood',
            'customerNumber' => 'number',
            'customerComplement' => 'complement',
            'customerState' => 'state',
            'customerCity' => 'city',
        ];
    }

    private function getTableColumns(): array
    {
        $this->connection = Connection::getInstance();
        $sql = "SELECT COLUMN_NAME
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = 'customers' AND TABLE_NAME = '{$this->table}';";
        $stmt = $this->connection->prepare($sql);
        if ($stmt->execute()) {
            $columns = $stmt->fetchAll(\PDO::FETCH_COLUMN);
            return empty($columns) ? [] : $columns;
        }

    }

    private function prepareCustomerData(array $customer): array
    {
        $newArray = [];
        foreach ($this->compareColumns() as $key => $columns) {
            $newArray[$columns] = $customer[$key] ?? '';
        }
        return $newArray;
    }
    
    public function getCustomers(): array
    {
        $this->connection = Connection::getInstance();
        $stmt = $this->connection->query("SELECT * FROM {$this->table}");
        $customers = $stmt->fetchAll() ?? [];

        return $customers;
    }

    public function getCustomerById(int $id): array
    {
        $this->connection = Connection::getInstance();
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        if ($stmt->execute()) {
            $customer = $stmt->fetch();
            return empty($customer) ? [] : $customer;
        }
    }

    public function updateCustomer(array $customer): array
    {
        $data = $this->prepareCustomerData($customer);
        $data['cpf'] = !empty($data['cpf']) ? Common::returnOnlyNumbers($data['cpf']) : null;
        $data['birthdate'] = Common::convertDateToDataBase($data['birthdate']);
        return $this->update($data);
    }

    public function registerCustomer(array $customer): array
    {
        $data = $this->prepareCustomerData($customer);
        $data['cpf'] = !empty($data['cpf']) ? Common::returnOnlyNumbers($data['cpf']) : null;
        $data['birthdate'] = Common::convertDateToDataBase($data['birthdate']);
        return $this->insert($data);
    }

    public function deleteCustomer(int $id): array
    {
        return $this->delete($id);
    }

    public function verifyCPFExists(string $cpf): ?array
	{
		try{
			$sql = "SELECT 1 FROM {$this->table} WHERE cpf = :cpf";
			$stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':cpf', $cpf, \PDO::PARAM_STR);
            if ($stmt->execute()) {
                $result = $stmt->fetch();
                return !empty($result) ? [
                                            'erro' => true,
                                            'message' => "Esse CPF já foi cadastrado!"
                                        ] : null;
            }
            return ['erro' => true, 'message' => 'Erro ao verificar CPF na base!'];
		} catch (\PDOException $e) {
			return ['erro' => true, 'code' => $e->getCode(), 'message' => $e->getMessage()];
		}
	}
}