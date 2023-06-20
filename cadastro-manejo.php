<?php
include('links.php');
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $data_manutencao = $_POST['data_manutencao'];
    $tipo_manutencao = $_POST['tipo_manutencao'];
    $observacao = $_POST['observacao'];
    $fk_animal = isset($_POST['fk_animal']) ? $_POST['fk_animal'] : '';

    if ($fk_animal == '') {
        echo '<div class="alert alert-danger text-center" style="font-weight: bold; font-size: 16px; margin-top: 30px;">Por favor, não deixe espaços em branco.</div>';
    } else {

        // Verificar se já existe o cadastro
        $sql_query = $conexao->prepare('SELECT * FROM manejo 
            WHERE 
                data_manutencao = :data_manutencao
            AND 
                tipo_manutencao = :tipo_manutencao
            AND 
                observacao = :observacao
            AND 
                fk_animal = :fk_animal');

        $sql_query->bindValue(':data_manutencao', $data_manutencao);
        $sql_query->bindValue(':tipo_manutencao', $tipo_manutencao);
        $sql_query->bindValue(':observacao', $observacao);
        $sql_query->bindValue(':fk_animal', $fk_animal);
        $sql_query->execute();

        if ($sql_query->rowCount() == 0) {
            // Inserir dados se não houver cadastro
            $sql_insert = $conexao->prepare('INSERT INTO manejo(data_manutencao, tipo_manutencao, observacao, fk_animal) VALUES (:data_manutencao, :tipo_manutencao, :observacao, :fk_animal)');

            $sql_insert->bindValue(':data_manutencao', $data_manutencao);
            $sql_insert->bindValue(':tipo_manutencao', $tipo_manutencao);
            $sql_insert->bindValue(':observacao', $observacao);
            $sql_insert->bindValue(':fk_animal', $fk_animal);
            $sql_insert->execute();
        }
    }
}

$sql_query = $conexao->prepare('SELECT 
    m.id_manejo,
    DATE_FORMAT(m.data_manutencao, "%d/%m/%Y") as data_manutencao, 
    m.data_manutencao AS data_manut,
    m.tipo_manutencao, 
    m.observacao,
    m.fk_animal,
    a.brinco
    FROM 
        manejo AS m
    LEFT JOIN 
        animal AS a 
    ON 
        a.id_animal = m.fk_animal');

$sql_query->execute();
$manejos = $sql_query->fetchAll(PDO::FETCH_ASSOC);

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
                            <label for="data_manutencao" class="form-label-lg">Data de Manejo </label>
                            <input type="date" class="form-control border-dark" id="data_manutencao" name="data_manutencao" required>
                        </div>
                        <div class="col-sm-3">
                            <label for="tipo_manutencao" class="form-label-lg">Tipo de Manejo </label>
                            <input type="text" class="form-control border-dark" id="tipo_manutencao" name="tipo_manutencao" required>
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
                    </div>
                    <div class="container">
                        <button type="submit" name="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
                <table id="tabela-manejo" class="table table-responsive-lg table-striped p-2 w-100">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
                            <th>Data de Manutenção</th>
                            <th>Tipo de Manutenção</th>
                            <th>Observação</th>
                            <th>Brinco do Animal</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($manejos as $manejo) :  ?>
                            <tr>
                                <td class="d-none"><?php echo $manejo['id_manejo']; ?></td>
                                <td><?php echo $manejo['data_manutencao']; ?></td>
                                <td><?php echo $manejo['tipo_manutencao']; ?></td>
                                <td><?php echo $manejo['observacao']; ?></td>
                                <td><?php echo $manejo['brinco']; ?></td>



                                <td>
                                    <button type="button" class="btn btn-warning mr-2 " data-toggle="modal" data-target="#modalEditar<?php echo $manejo['id_manejo']; ?>">Editar</button>

                                    <a href="excluir-manejo.php?id=<?php echo $manejo['id_manejo']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Tem certeza que deseja excluir este manejo ?')">Excluir</a>
                                </td>
                            </tr>

                            
                            
                            
                            <!-- inicio do modal  -->
                            <div class="modal fade" id="modalEditar<?php echo $manejo['id_manejo']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel">Editar manejo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editar-manejo.php" method="post">
                                                <input type="hidden" name="id_manejo" value="<?php echo $manejo['id_manejo']; ?>" required>

                                                <div class="form-group">
                                                    <label for="data_manutencao">Data Manutenção</label>
                                                    <input type="date" class="form-control" id="data_manutencao" name="data_manutencao" value="<?php echo $manejo['data_manut']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tipo_manutencao">Tipo Manutenção</label>
                                                    <input type="text" class="form-control" id="tipo_manutencao" name="tipo_manutencao" value="<?php echo $manejo['tipo_manutencao']; ?>" required>
                                                </div>


                                                <div class="form-group">
                                                     <label for="observacao">Observação</label>
                                                    <input type="text" class="form-control" id="observacao" name="observacao" value="<?php echo $manejo['observacao']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="fk_animal">Brinco Animal</label>
                                                    <select name="fk_animal" id="fk_animal" class="form-control border-dark" required>
                                                        <option value="">Selecione um Brinco</option>
                                                        <?php foreach ($animais as $animal) : ?>
                                                            <option value="<?php echo $animal['id_animal']; ?>" <?php if ($animal['id_animal'] == $manejo['fk_animal']) echo 'selected'; ?>><?php echo $animal['brinco']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <br />



                                                <button type="submit" name="submit-manejo" class="btn btn-primary">Salvar</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- fim  do modal  -->









                        <?php endforeach; ?>
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
        $('#tabela-manejo').DataTable({
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