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



    <title>Cadastro da Animais </title>
</head>


<body>
<main class="main" id="main">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center card-title fs-3">Registro de Manejo</h2>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="row mb-4 d-flex justify-content-between">
                    <input type="hidden" id="id_manejo" name="id_manejo">
                    <div class="col-sm-3">
                        <label for="data_manutencao" class="form-label-lg">Data de Manutenção</label>
                        <input type="date" class="form-control border-dark" id="data_manutencao" name="data_manutencao">
                    </div>
                    <div class="col-sm-3">
                        <label for="tipo_manutencao" class="form-label-lg">Tipo de Manutenção</label>
                        <input type="text" class="form-control border-dark" id="tipo_manutencao" name="tipo_manutencao">
                    </div>
                    <div class="col-sm-3">
                        <label for="observacao" class="form-label-lg">Observação</label>
                        <input type="text" class="form-control border-dark" id="observacao" name="observacao">
                    </div>
                    <div class="col-sm-3">
                        <label for="brinco" class="form-label-lg">Brinco do Animal</label>
                        <input type="text" class="form-control border-dark" id="brinco" name="brinco">
                    </div>
                </div>
                <div class="container">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
            <table id="tabela-manejo" class="table table-responsive-lg table-striped p-2">
                <thead>
                    <tr>
                        <th>Data de Manutenção</th>
                        <th>Tipo de Manutenção</th>
                        <th>Observação</th>
                        <th>Brinco do Animal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01/01/2022</td>
                        <td>Vacinação</td>
                        <td>Nenhuma observação</td>
                        <td>12345</td>
                        <td>
                            <a href="#" class="btn btn-warning">Editar</a>
                            <a href="#" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                    <tr>
                        <td>02/02/2022</td>
                        <td>Verificação de peso</td>
                        <td>Animal abaixo do peso ideal</td>
                        <td>67890</td>
                        <td>
                            <a href="#" class="btn btn-warning">Editar</a>
                            <a href="#" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                    <!-- adicionar mais linhas para mais manejo -->
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
        $('#tabela-manejo').DataTable({
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