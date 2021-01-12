<div class="row justify-content-center mt-5">
    <div class="col-md-12 col-lg-12">
        <a href="/customer/newCustomer" class="btn btn-sm float-end btn-success">Novo Cliente</a>
        <div class="table-responsive-lg mt-5">
            <table class="table table-striped table-inverse">
                <thead class="thead-info">
                    <tr class="text-center">
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data Nascimento</th>
                        <th>Gênero</th>
                        <th>CEP</th>
                        <th>Endereço</th>
                        <th>Número</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($customers) && count($customers)): ?>
                            <?php foreach($customers as $customer): ?>
                                <tr class="text-center">
                                    <td>
                                        <?= $customer['name'];?>
                                    </td>
                                    <td class="col-md-2">
                                        <?= Customer\Resources\Common::cpfFormatter($customer['cpf']);?>
                                    </td>
                                    <td>
                                        <?= Customer\Resources\Common::convertDateToView($customer['birthdate']);?>
                                    </td>
                                    <td>
                                        <?= $customer['gender'];?>
                                    </td>
                                    <td>
                                        <?= $customer['cep'];?>
                                    </td>
                                    <td>
                                        <?= $customer['address'];?>
                                    </td>
                                    <td>
                                        <?= $customer['number'];?>
                                    </td>
                                    <td>
                                        <?= $customer['complement'];?>
                                    </td>
                                    <td>
                                        <?= $customer['neighborhood'];?>
                                    </td>
                                    <td>
                                        <?= $customer['state'];?>
                                    </td>
                                    <td>
                                        <?= $customer['city'];?>
                                    </td>
                                    <td class="col-md-2">
                                        <a href="/customer/editCustomer/<?= $customer['id'];?>" class="btn btn-success">Editar</a>
                                        <a class="btn btn-danger delete-customer pointer" data-code="<?= $customer['id']; ?>">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="text-center">
                                <td colspan="12">
                                    <span>Nenhum Cliente Encontrado!</span>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>