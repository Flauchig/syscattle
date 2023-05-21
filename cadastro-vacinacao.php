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



    <title>Cadastro da Movimentação </title>
</head>


<body>
    <main class="main" id="main">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center card-title fs-3">Registro de Vacinação</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <form method="post">
                        <div class="row mb-4 d-flex justify-content-between">
                            <input type="hidden" id="id_vacinacao" name="id_vacinacao">
                            <div class="col-sm-3">
                                <label for="data_vacinacao" class="form-label-lg">Data de Vacinação</label>
                                <input type="date" class="form-control border-dark" id="data_vacinacao" name="data_vacinacao">
                            </div>
                            <div class="col-sm-3">
                                <label for="tipo_vacinacao" class="form-label-lg">Tipo de Vacinação</label>
                                <input type="text" class="form-control border-dark" id="tipo_vacinacao" name="tipo_vacinacao">
                            </div>
                            <div class="col-sm-3">
                                <label for="dose" class="form-label-lg">Dose</label>
                                <input type="text" class="form-control border-dark" id="dose" name="dose">
                            </div>
                            <div class="col-sm-3">
                                <label for="lote" class="form-label-lg">Lote</label>
                                <input type="text" class="form-control border-dark" id="lote" name="lote">
                            </div>
                            <div class="col-sm-3">
                                <label for="fabricante" class="form-label-lg">Fabricante</label>
                                <input type="text" class="form-control border-dark" id="fabricante" name="fabricante">
                            </div>
                            <div class="col-sm-3">
                                <label for="observacao" class="form-label-lg">Observação</label>
                                <input type="text" class="form-control border-dark" id="observacao" name="observacao">
                            </div>
                            <div class="col-sm-3">
                            <label for="brinco-animal" class="form-label-lg">Brico Animal</label>
                            <select class="form-select" id="brinco-animal" name="brinco-animal">
                                <option value="">Selecione um  brinco </option>
                                <option value="brinco1">Brinco 1</option>
                                <option value="brinco2">Brinco 2</option>
                                <option value="brinco3">Brinco 3</option>
                            </select>
                        </div>
                            <div class="col-sm-3">
                            <label for="lote-animal" class="form-label-lg">Lote Animal</label>
                            <select class="form-select" id="lote-animal" name="lote-animal">
                                <option value="">Selecione um Lote</option>
                                <option value="lote1">lote1</option>
                                <option value="lote2">lote2</option>
                                <option value="lote3">lote3</option>
                            </select>
                        </div>
                        </div>
                        <div class="container">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>

                    <table id="tabela-vacina" class="table table-responsive-lg table-striped p-2">
                        <thead>
                            <tr>
                                <th scope="col">Data de Vacinação</th>
                                <th scope="col">Tipo de Vacinação</th>
                                <th scope="col">Dose</th>
                                <th scope="col">Lote</th>
                                <th scope="col">Fabricante</th>
                                <th scope="col">Observação</th>
                                <th scope="col">Brinco do Animal</th>
                                <th scope="col">Lote Animal</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10/04/2023</td>
                                <td>Anti-Rábica</td>
                                <td>1ª Dose</td>
                                <td>LOT123</td>
                                <td>Pfizer</td>
                                <td>N/A</td>
                                <td>ABC123</td>
                                <td>LOTA456</td>
                                <td>
                                    <a href="#" class="btn btn-warning mt-1">Editar</a>
                                    <a href="#" class="btn btn-danger mt-1">Excluir</a>
                                </td>
                            </tr>
                            <tr>
                                <td>05/02/2023</td>
                                <td>V10</td>
                                <td>2ª Dose</td>
                                <td>LOT456</td>
                                <td>Merial</td>
                                <td>N/A</td>
                                <td>XYZ789</td>
                                <td>LOTB123</td>
                                <td>
                                    <a href="#" class="btn btn-warning mt-1">Editar</a>

                                    <a href="#" class="btn btn-danger mt-1">Excluir</a>
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
        $('#tabela-vacina').DataTable({
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