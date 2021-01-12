<?php

declare(strict_types = 1);

namespace Customer\Controller;

use Customer\Controller\Controller;
use Customer\Model\ModelCustomer;
use Customer\Resources\Common;

class Customer extends Controller
{
    public function main(): void 
    {
        $data['customers'] = (new ModelCustomer())->getCustomers();
        parent::prepareView('customers/list', $data, true);
    }

    private function validateRequiredFields(): string
    {
        $requiredFields = [
            'customerName' => 'Nome',
            'customerBirthDate' => 'Data de Nascimento',
            'customerGender' => 'Gênero'
        ];
        $data = filter_input_array(INPUT_POST);
        foreach($requiredFields as $required => $name) {
            if (empty($data[$required])) {
                return $name;
            }
        }
        return '';
    }

    public function newCustomer()
    {
        $data['titleAndButton'] = !empty($data['customer'][0]['id']) ? 'Atualizar' : 'Cadastrar';
        $data['states'] = Common::listStates();
        parent::prepareView('customers/register', $data, true);
    }
    
    public function registerCustomer()
    {
        $formData = filter_input_array(INPUT_POST);
        $campo = $this->validateRequiredFields();
        if (!empty($campo)) {
            $result = ['erro' => true, 'message' => "O campo {$campo} é Obrigatório!"];
        } else {
            $result = (new ModelCustomer())->registerCustomer($formData);
        }
        echo json_encode($result);
    }
    
    public function deleteCustomer()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        echo json_encode((new ModelCustomer())->deleteCustomer($id));
    }
    
    public function editCustomer(int $id){
        $data['customer'] = (new ModelCustomer())->getCustomerById($id);
        $data['states'] = Common::listStates();
        $data['titleAndButton'] = empty($data['customer'][0]['id']) ? 'Atualizar' : 'Cadastrar';
        parent::prepareView('customers/register', $data, true);
    }

    public function updateCustomer()
    {
        $formData = filter_input_array(INPUT_POST);
        $campo = $this->validateRequiredFields();
        if (!empty($campo)) {
            $result = ['erro' => true, 'message' => "O campo \"{$campo}\" é Obrigatório!"];
        } else {
            $result = (new ModelCustomer())->updateCustomer($formData);
        }
        echo json_encode($result);
    }

    public function getCities(): void
    {
        echo json_encode(Common::listCities());
    }
}