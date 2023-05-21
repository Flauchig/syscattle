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



    <title>Cadastro da Fazenda </title>
</head>


<body>
    <main class="main" id="main">
        <div class="card">
            <input type="hidden" name="id_potreiro">
            <div class="card-header">
                <h2 class="text-center card-title fs-3"> Cadastro de Potreiros </h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label for="inputText" class="form-label-lg">Nome da Potreiro</label>
                            <input type="text" class="form-control border-dark">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputText" class="form-label-lg">Tamanho em Hectares</label>
                            <input type="text" class="form-control border-dark" maxlength="4">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label for="inputText" class="form-label-lg">Capacidade de Animais</label>
                            <input type="text" class="form-control border-dark">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputText" class="form-label-lg">Tipo de Pasto</label>
                            <input type="text" class="form-control border-dark">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <label for="selectFazenda" class="form-label-lg">Selecione a Fazenda</label>
                            <select id="selectFazenda" class="form-select border-dark">
                                <option selected>Selecione uma fazenda</option>
                                <option value="1">Fazenda A</option>
                                <option value="2">Fazenda B</option>
                                <option value="3">Fazenda C</option>
                            </select>
                            
                            
                        </div>
                    </div>

                    <div class="container">
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
                
                <table id="tabela-potreiro" class="table table-responsive-lg table-striped p-2">
                    <thead>
                        <tr>
                            <th scope="col">Nome da Potreiro</th>
                            <th scope="col">Tamanho em Hectares</th>
                            <th scope="col">Capacidade de Animais</th>
                            <th scope="col">Tipo de Pasto</th>
                            <th scope="col">Fazenda</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Potreiro 1</td>
                            <td>50</td>
                            <td>100</td>
                            <td>Pasto 1</td>
                            <td>Fazenda A</td>
                            <td>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Potreiro 2</td>
                            <td>30</td>
                            <td>50</td>
                            <td>Pasto 2</td>
                            <td>Fazenda B</td>
                            <td>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                        <!-- adicione outras linhas aqui -->
                    </tbody>
                </table>





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
        $('#tabela-potreiro').DataTable({
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