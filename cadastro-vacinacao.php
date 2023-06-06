<?php
include('links.php');
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $data_vacinacao = $_POST['data_vacinacao'];
    $tipo_vacinacao = $_POST['tipo_vacinacao'];
    $dose = $_POST['dose'];
    $lote_vacina = $_POST['lote_vacina'];
    $fabricante = $_POST['fabricante'];
    $observacao = $_POST['observacao'];
    $fk_animal = isset($_POST['fk_animal']) ? $_POST['fk_animal'] : '';
    $fk_lote = isset($_POST['fk_lote']) ? $_POST['fk_lote'] : '';

    if ($fk_animal == '' && $fk_lote == '') {
        echo '<div class="alert alert-danger text-center" style="font-weight: bold; font-size: 16px ; margin-top: 30px;">Por favor, Não deixe espaços em branco .</div>';
    } else {

        //verificação dos registros no banco de dados
        $sql_query = $conexao->prepare("SELECT * FROM 
                                            vacinacao
                                        WHERE 
                                            data_vacinacao = :data_vacinacao
                                        AND
                                            tipo_vacinacao = :tipo_vacinacao
                                        AND 
                                            dose = :dose 
                                        AND
                                            lote_vacina = :lote_vacina 
                                        AND 
                                            fabricante = :fabricante
                                        AND 
                                            observacao = :observacao
                                        AND
                                            fk_animal = :fk_animal
                                        AND
                                            fk_lote = :fk_lote           ");

        $sql_query->bindValue(':data_vacinacao', $data_vacinacao);
        $sql_query->bindValue(':tipo_vacinacao', $tipo_vacinacao);
        $sql_query->bindValue(':dose', $dose);
        $sql_query->bindValue(':lote_vacina', $lote_vacina);
        $sql_query->bindValue(':fabricante', $fabricante);
        $sql_query->bindValue(':observacao', $observacao);
        $sql_query->bindValue(':fk_animal', $fk_animal);
        $sql_query->bindValue(':fk_lote', $fk_lote);
        $sql_query->execute();

        if ($sql_query->rowCount() == 0) {
            // se não ouver registro no banco  fazer o insert

            $sql_insert = $conexao->prepare(" INSERT INTO vacinacao(data_vacinacao, tipo_vacinacao, dose, lote_vacina, fabricante, observacao, fk_animal, fk_lote) VALUES (:data_vacinacao, :tipo_vacinacao, :dose, :lote_vacina, :fabricante, :observacao, :fk_animal, :fk_lote)");

            $sql_insert->bindValue(':data_vacinacao', $data_vacinacao);
            $sql_insert->bindValue(':tipo_vacinacao', $tipo_vacinacao);
            $sql_insert->bindValue(':dose', $dose);
            $sql_insert->bindValue(':lote_vacina', $lote_vacina);
            $sql_insert->bindValue(':fabricante', $fabricante);
            $sql_insert->bindValue(':observacao', $observacao);
            $sql_insert->bindValue(':fk_animal', $fk_animal);
            $sql_insert->bindValue(':fk_lote', $fk_lote);
            $sql_insert->execute();
        }
    }
}


$sql_query = $conexao->prepare(' SELECT 
                                        v.id_vacinacao,
                            DATE_FORMAT(v.data_vacinacao, "%d/%m/%Y") as data_vacinacao,
                                        v.data_vacinacao as data_vac,
                                        v.tipo_vacinacao,
                                        v.dose,
                                        v.lote_vacina,
                                        v.fabricante,
                                        v.observacao, 
                                        v.fk_animal,
                                        v.fk_lote,
                                        a.brinco,
                                        l.lote
                                    FROM
                                        vacinacao AS v
                                    LEFT JOIN
                                        animal AS A
                                    ON
                                        a.id_animal = v.fk_animal

                                    LEFT JOIN 
                                        lote_animal AS l
                                    
                                    ON
                                        l.id_lote_animal = v.fk_lote');

$sql_query->execute();
$vacinacoes = $sql_query->fetchAll(PDO::FETCH_ASSOC);







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
                                <input type="date" class="form-control border-dark" id="data_vacinacao" name="data_vacinacao" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="tipo_vacinacao" class="form-label-lg">Tipo de Vacinação</label>
                                <input type="text" class="form-control border-dark" id="tipo_vacinacao" name="tipo_vacinacao" re>
                            </div>
                            <div class="col-sm-3">
                                <label for="dose" class="form-label-lg">Dose</label>
                                <input type="text" class="form-control border-dark" id="dose" name="dose" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="lote_vacina" class="form-label-lg">Lote Vacina</label>
                                <input type="text" class="form-control border-dark" id="lote_vacina" name="lote_vacina" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="fabricante" class="form-label-lg">Fabricante</label>
                                <input type="text" class="form-control border-dark" id="fabricante" name="fabricante" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="observacao" class="form-label-lg">Observação</label>
                                <input type="text" class="form-control border-dark" id="observacao" name="observacao">
                            </div>
                            <div class="col-sm-3">
                                <label for="fk_animal" class="form-label-lg">Brinco Animal</label>
                                <select class="form-select border-dark" id="fk_animal" name="fk_animal">
                                    <option value="">Selecione um Brinco </option>
                                    <?php
                                    $animais_query = $conexao->query('SELECT * FROM animal');
                                    $animais = $animais_query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($animais as $animal) {
                                        echo '<option value="' . $animal['id_animal'] . '">' . $animal['brinco'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="inputText" class="form-label-lg">Lote Animal</label>
                                <select class="form-select border-dark" id="fk_lote" name="fk_lote">
                                    <option value="" selected>Selecione um lote</option>
                                    <?php
                                    $lotes_query = $conexao->query('SELECT * FROM lote_animal');
                                    $lotes = $lotes_query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($lotes as $lote) {
                                        echo '<option value="' . $lote['id_lote_animal'] . '">' . $lote['lote'] . '</option>';
                                    }
                                    ?>>
                                </select>

                            </div>



                            <div>

                                <br />
                                <button type="submit" name="submit" class="btn btn-primary">Adicionar</button>
                            </div>



                    </form>

                    <div class="container">
                        <br />
                        <br />

                        <table id="tabela-vacina" class="table table-responsive-lg table-striped p-2 w-100">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Data de Vacinação</th>
                                    <th>Tipo de Vacinação</th>
                                    <th>Dose</th>
                                    <th>Lote Vacina</th>
                                    <th>Fabricante</th>
                                    <th>Observação</th>
                                    <th>Brinco do Animal</th>
                                    <th>Lote Animal</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vacinacoes as $vacinacao) : ?>
                                    <tr>
                                        <td class="d-none"><?php echo $vacinacao['id_vacinacao'] ?></td>
                                        <td><?php echo $vacinacao['data_vacinacao'] ?></td>
                                        <td><?php echo $vacinacao['tipo_vacinacao'] ?></td>
                                        <td><?php echo $vacinacao['dose'] ?> ml</td>
                                        <td><?php echo $vacinacao['lote_vacina'] ?></td>
                                        <td><?php echo $vacinacao['fabricante'] ?></td>
                                        <td><?php echo $vacinacao['observacao'] ?></td>
                                        <td><?php echo $vacinacao['brinco'] ?></td>
                                        <td><?php echo $vacinacao['lote'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning  " data-toggle="modal" data-target="#modalEditar<?php echo $vacinacao['id_vacinacao']; ?>">Editar</button>
                                   
                                            <a href="excluir-vacinacao.php?id=<?php echo $vacinacao['id_vacinacao']; ?>" class="btn btn-danger mt-1 " onclick="return confirm('Tem certeza que deseja excluir esta vacinacao ?')">Excluir</a>
                                        </td>
                                    </tr>

                                    <!-- inicio do modal  -->
                                    <div class="modal fade" id="modalEditar<?php echo $vacinacao['id_vacinacao']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalEditarLabel">Editar Vacinação</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="editar-vacinacao.php" method="post">
                                                        <input type="hidden" name="id_vacinacao" value="<?php echo $vacinacao['id_vacinacao']; ?>">

                                                        <div class="form-group">
                                                            <label for="data_vacinacao">Data Vacinação</label>
                                                            <input type="date" class="form-control" id="data_vacinacao" name="data_vacinacao" value="<?php echo $vacinacao['data_vac']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tipo_vacinacao">Tipo Vacinação</label>
                                                            <input type="text" class="form-control" id="tipo_vacinacao" name="tipo_vacinacao" value="<?php echo $vacinacao['tipo_vacinacao']; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="dose">Dose</label>
                                                            <input type="text" class="form-control" id="dose" name="dose" value="<?php echo $vacinacao['dose']; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lote_vacina'">Lote Vacina</label>
                                                            <input type="text" class="form-control" id="lote_vacina" name="lote_vacina" value="<?php echo $vacinacao['lote_vacina']; ?>">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="fabricante">Fabricante</label>
                                                            <input type="text" class="form-control" id="fabricante" name="fabricante" value="<?php echo $vacinacao['fabricante']; ?>">
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="observacao">Observação</label>
                                                            <input type="text" class="form-control" id="observacao" name="observacao" value="<?php echo $vacinacao['observacao']; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fk_animal">Brinco Animal</label>
                                                            <select name="fk_animal" id="fk_animal" class="form-control border-dark" required>
                                                                <option value="">Selecione um Brinco</option>
                                                                <?php foreach ($animais as $animal) : ?>
                                                                    <option value="<?php echo $animal['id_animal']; ?>" <?php if ($animal['id_animal'] == $vacinacao['fk_animal']) echo 'selected'; ?>><?php echo $animal['brinco']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fk_lote">Nome do Lote</label>
                                                            <select name="fk_lote" id="fk_lote" class="form-control border-dark" required>
                                                                <option value="">Selecione um lote</option>
                                                                <?php foreach ($lotes as $lote) : ?>
                                                                    <option value="<?php echo $lote['id_lote_animal']; ?>" <?php if ($lote['id_lote_animal'] == $vacinacao['fk_lote']) echo 'selected'; ?>><?php echo $lote['lote']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>

                                                        <br />



                                                        <button type="submit" name="submit-vacinacao" class="btn btn-primary">Salvar</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- fim  do modal  -->






                                <?php endforeach;  ?>
                            </tbody>
                        </table>

                    </div>
            </div>
    </main>





</body>




<footer class="footer">
    <?php
    include('footer.php')

    ?>

</footer>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.3/i18n/Portuguese-Brasil.json"></script>
<script>
    $(document).ready(function() {
        $('#tabela-vacina').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/Portuguese-Brasil.json"
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



<!-- Inclua o jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="/assets/js/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


<!-- Inclua o jQuery Inputmask após o jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#editar-cep').inputmask("99999-999");
        $('#editar-telefone').inputmask("(99) 9999-9999");
    });
</script>
<script>
    $(document).ready(function() {
        $('#editar-cep').inputmask("99999-999");
        $('#editar-telefone').inputmask('(99) 9999-9999');
    });
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




</html>