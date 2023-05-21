<?php
include('links.php');
include('header.php');
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Cadastro de Lote Animal </title>
</head>


<body>
    <main class="main" id="main">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center card-title fs-3">Registro de Lote Animal</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row mb-4 d-flex justify-content-between">
                        <input type="hidden" id="id_lote_animal" name="id_lote_animal">
                        <div class="col-sm-3">
                            <label for="observacao" class="form-label-lg">Lote</label>
                            <input type="text" class="form-control border-dark" id="observacao" name="observacao">
                        </div>
                   
                        <div class="col-sm-3">
                            <label for="data_entrada" class="form-label-lg">Data de Entrada</label>
                            <input type="date" class="form-control border-dark" id="data_entrada" name="data_entrada">
                        </div>
                    
                        <div class="col-sm-3">
                            <label for="observacao" class="form-label-lg">Observação</label>
                            <input type="text" class="form-control border-dark" id="observacao" name="observacao">
                        </div>
                        <div class="col-sm-3">
                            <label for="fazenda" class="form-label-lg">Fazenda</label>
                            <select class="form-select" id="fazenda" name="fazenda">
                                <option value="">Selecione uma fazenda</option>
                                <option value="fazenda1">Fazenda 1</option>
                                <option value="fazenda2">Fazenda 2</option>
                                <option value="fazenda3">Fazenda 3</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="lote" class="form-label-lg">Potreiro</label>
                            <select class="form-select" id="lote" name="lote">
                                <option value="">Selecione um potreiro</option>
                                <option value="lote1">potreiro 1</option>
                                <option value="lote2"> potreiro 2</option>
                                <option value="lote3">potreiro 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>

                <table id="tabela-lote" class="table table-responsive-lg table-striped p-2">
                    <thead>
                        <tr>
                          
                            <th>Lote</th>
                            <th>Data de Entrada</th>
                            <th>potreiro</th>
                            <th>Observação</th>
                            <th>Fazenda</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                         
                            <td>lote1</td>
                            <td>01/01/2022</td>
                            <td>potreiro1</td>
                            <td>Nenhuma observação</td>
                            <td>Fazenda 1</td>
                            <td>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                        <tr>
                            
                            <td>lote2</td>
                            <td>02/01/2022</td>
                            <td>potreiro2</td>
                            <td>apenas femeas</td>
                            <td>Fazenda 2</td>
                            <td>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                        <tr>
                         
                            <td>lote3</td>
                            <td>03/01/2022</td>
                            <td>potreiro3</td>
                            <td>nehuma obserevação </td>
                            <td>Fazenda 3</td>
                            <td>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </main>





</body>




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="/assets/js/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script>
</script>
<script>
    $(document).ready(function() {
        $('#cep').inputmask("99999-999");
    });
</script>

<script>
    $(document).ready(function() {
        $('#telefone').inputmask('(99) 9999-9999');
    });
</script>


<script>
    $(document).ready(function() {
        $('#tabela-lote').DataTable({
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'

            }
        });
    });
</script>




<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<footer class="footer">
    <?php
    include('footer.php')

    ?>

</footer>





</html>