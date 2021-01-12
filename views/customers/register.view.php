<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-8 mb-4 text-center align-items-center">
        <a href="/customer" class="btn btn-sm btn-warning float-start">Voltar</a>
        <h2><?= $titleAndButton; ?> Cliente</h2>
    </div>
    <div class="col-md-6 col-md-8">
        <form id ="form<?= !empty($customer['id']) ? 'Update' : 'Register';?>Customer" action="/customer/<?= !empty($customer['id']) ? 'update' : 'register';?>Customer" method="POST" class="needs-validation">
            <input type="hidden" name="code" value="<?= $customer['id'] ?? null;?>">
            <input type="hidden" id="savedCity" value="<?= $customer['city'] ?? null;?>">
            <div class="row mb-3">
                <label for="code" class="col-sm-2 col-form-label">Código: </label>
                <div class="col-sm-2">
                    <input id="code" type="text" class="form-control" disabled value="<?= $customer['id'] ?? null;?>" />
                </div>
                <label for="customerName" class="col-sm-2 col-form-label">Nome: </label>
                <div class="col-sm-6">
                    <input id="customerName" name="customerName" type="text" class="form-control required" value="<?= $customer['name'] ?? null;?>" required maxlength="150"/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="customerCPF" class="col-sm-2 col-form-label">CPF: </label>
                <div class="col-sm-4">
                    <input id="customerCPF" name="customerCPF" type="text" class="form-control maskCPF" maxlength="14" value="<?= $customer['cpf'] ?? null;?>" />
                </div>
                <label for="customerBirthDate" class="col-sm-2 col-form-label">Data de Nascimento: </label>
                <div class="col-sm-4">
                    <input id="customerBirthDate" name="customerBirthDate" type="text" class="form-control required" autocomplete="off" value="<?=!empty($customer['birthdate']) ? Customer\Resources\Common::convertDateToView($customer['birthdate'], 'm/d/Y') : null;?>" required/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="customerGender" class="col-sm-2 col-form-label">Gênero: </label>
                <div class="col-sm-4">
                    <select id="customerGender" name="customerGender" class="form-control required" required>
                        <option value="">Selecione...</option>
                        <option value="F" <?= !empty($customer['gender']) && $customer['gender'] === 'F' ? 'selected' : '';?>>Feminino</option>
                        <option value="M" <?= !empty($customer['gender']) && $customer['gender'] === 'M' ? 'selected' : '';?>>Masculino</option>
                    </select>
                </div>
                <label for="customerCep" class="col-sm-2 col-form-label">CEP: </label>
                <div class="col-sm-4">
                    <input id="customerCep" name="customerCep" type="text" class="form-control maskCEP" value="<?= $customer['cep'] ?? null;?>" maxlength="9"/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="customerAddress" class="col-sm-2 col-form-label">Endereço: </label>
                <div class="col-sm-4">
                    <input id="customerAddress" name="customerAddress" type="text" class="form-control" value="<?= $customer['address'] ?? null;?>" maxlength="150"/>
                </div>
                <label for="customerCep" class="col-sm-2 col-form-label">Bairro: </label>
                <div class="col-sm-4">
                    <input id="customerNbh" name="customerNbh" type="text" class="form-control" value="<?= $customer['neighborhood'] ?? null;?>" maxlength="100"/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="customerNumber" class="col-sm-2 col-form-label">Número: </label>
                <div class="col-sm-2">
                    <input id="customerNumber" name="customerNumber" class="form-control" type="text" value="<?= $customer['number'] ?? null;?>" maxlength="6"/>
                </div>
                <label for="customerComplement" class="col-sm-2 col-form-label">Complemento: </label>
                <div class="col-sm-6">
                    <input id="customerComplement" name="customerComplement" type="text" class="form-control" value="<?= $customer['complement'] ?? null;?>" maxlength="100"/>
                </div>
            </div>
            <div class="row mb-3">
                <label for="customerState" class="col-sm-2 col-form-label">Estado: </label>
                <div class="col-sm-2">
                    <select id="customerState" name="customerState" class="form-control">
                        <option value="">Selecione...</option>
                        <?php if (is_array($states) && count($states)): ?>
                            <?php foreach($states as $state) :?>
                                <option value="<?=$state['sigla'];?>" <?= !empty($customer['state']) &&  $state['sigla'] === $customer['state'] ? 'selected' : '';?>><?=$state['sigla'];?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <label for="customerCity" class="col-sm-2 col-form-label">Cidade: </label>
                <div class="col-sm-6">
                    <input id="customerCity" name="customerCity" type="text" class="form-control" value="<?= $customer['city'] ?? null;?>" maxlength="150"/>
                </div>
            </div>
            <button id="btn<?=!empty($customer['id']) ? 'Update' : 'Register';?>" type="button" class="btn btn-sm btn-success float-end"><?= $titleAndButton; ?></button>
        </form>
    </div>
</div>