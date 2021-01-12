<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <a href="/" class="btn btn-sm btn-warning float-start">INÍCIO</a>
        <h1 class="text-danger text-center">ERRO!</h1>
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <table class="table table-bordered border-dark">
            <thead class="table-info border border-dark">
                <tr>
                    <th>Código</th>
                    <th>Arquivo</th>
                    <th>Linha</th>
                    <th>Mensagem</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"><?= $exception->getCode(); ?></td>
                    <td><?= $exception->getFile(); ?></td>
                    <td><?= $exception->getLine(); ?></td>
                    <td><?= $exception->getMessage(); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>