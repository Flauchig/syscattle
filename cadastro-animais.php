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
                <h2 class="text-center card-title fs-3">Cadastro de Animais</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row mb-4 d-flex justify-content-between">
                        <input type="hidden" id="id_animal" name="id_animal">
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Data de Nascimento</label>
                            <input type="date" class="form-control border-dark" id="data_nascimento" name="data_nascimento">
                        </div>
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Brinco</label>
                            <input type="text" class="form-control border-dark" id="brinco" name="brinco">
                        </div>
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Peso</label>
                            <input type="text" class="form-control border-dark" id="peso" name="peso">
                        </div>
                    </div>
                    <div class="row mb-4 d-flex justify-content-between">
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Raça</label>
                            <input type="text" class="form-control border-dark" id="raca" name="raca">
                        </div>
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Lote</label>
                            <select class="form-select border-dark" id="lote" name="lote">
                                <option value="" selected>Selecione um lote</option>
                                <option value="lote1">Lote 1</option>
                                <option value="lote2">Lote 2</option>
                                <option value="lote3">Lote 3</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Potreiro</label>
                            <select class="form-select border-dark" id="potreiro" name="potreiro">
                                <option value="" selected>Selecione um potreiro</option>
                                <option value="potreiro1">Potreiro 1</option>
                                <option value="potreiro2">Potreiro 2</option>
                                <option value="potreiro3">Potreiro 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="container">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
                <table id="tabela-animal" class="table table-responsive-lg table-striped p-2">
    <thead>
        <tr>
            <th>Data de Nascimento</th>
            <th>Brinco</th>
            <th>Peso</th>
            <th>Raça</th>
            <th>Lote</th>
            <th>Potreiro</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>01/01/2020</td>
            <td>123</td>
            <td>500</td>
            <td>Nelore</td>
            <td>Lote 1</td>
            <td>Potreiro 1</td>
            <td>
                <a href="#" class="btn btn-warning">Editar</a>
                <a href="#" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
        <tr>
            <td>02/02/2020</td>
            <td>456</td>
            <td>600</td>
            <td>Aberdeen Angus</td>
            <td>Lote 2</td>
            <td>Potreiro 2</td>
            <td>
                <a href="#" class="btn btn-warning">Editar</a>
                <a href="#" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
        <!-- adicionar mais linhas para mais animais -->
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
        $('#tabela-animal').DataTable({
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