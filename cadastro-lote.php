<?php
include('links.php');
include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $lote = $_POST['lote'];
    $data_entrada = $_POST['data_entrada'];
    $observacao = $_POST['observacao'];
    $fk_potreiro = isset($_POST['fk_potreiro']) ? $_POST['fk_potreiro'] : '';
    $fk_fazenda = isset($_POST['fk_fazenda']) ? $_POST['fk_fazenda'] : '';

    if ($fk_fazenda == '' && $fk_potreiro == '') {
        echo '<div class="alert alert-danger text-center" style="font-weight: bold; font-size: 16px ; margin-top: 30px;">Por favor, Não deixe espaços em branco .</div>';
    } else {

        // Verifica se o registro já existe no banco de dados
        $sql_query = $conexao->prepare("SELECT * FROM lote_animal 
                                            WHERE 
                                            lote = :lote 
                                            AND 
                                            data_entrada = :data_entrada 
                                            AND 
                                            observacao = :observacao 
                                            AND 
                                            fk_potreiro = :fk_potreiro 
                                            AND 
                                            fk_fazenda = :fk_fazenda");
        $sql_query->bindValue(':lote', $lote);
        $sql_query->bindValue(':data_entrada', $data_entrada);
        $sql_query->bindValue(':observacao', $observacao);
        $sql_query->bindValue(':fk_potreiro', $fk_potreiro);
        $sql_query->bindValue(':fk_fazenda', $fk_fazenda);
        $sql_query->execute();

        if ($sql_query->rowCount() == 0) {
            // Se a busca não retornar nenhum resultado, faz a inserção dos dados
            $sql_insert = $conexao->prepare("INSERT INTO lote_animal (lote, data_entrada, observacao, fk_potreiro, fk_fazenda) VALUES (:lote, :data_entrada, :observacao, :fk_potreiro, :fk_fazenda)");
            $sql_insert->bindValue(':lote', $lote);
            $sql_insert->bindValue(':data_entrada', $data_entrada);
            $sql_insert->bindValue(':observacao', $observacao);
            $sql_insert->bindValue(':fk_potreiro', $fk_potreiro);
            $sql_insert->bindValue(':fk_fazenda', $fk_fazenda);
            $sql_insert->execute();
        }
    }
}

$sql_query = $conexao->prepare('SELECT 
                                l.id_lote_animal, 
                                l.lote, 
                                DATE_FORMAT(l.data_entrada, "%d/%m/%Y") as data_entrada,
                                data_entrada as data_entrada,
                                l.observacao, 
                                l.fk_fazenda, 
                                l.fk_potreiro,
                                p.nome, 
                                f.nome_fazenda
                            FROM 
                                lote_animal AS l 
                            LEFT JOIN 
                                fazenda AS f 
                            ON 
                                f.id_fazenda = l.fk_fazenda
                            LEFT JOIN 
                                potreiro AS p
                            ON
                                p.id_potreiro = l.fk_potreiro');
$sql_query->execute();
$lotes = $sql_query->fetchAll(PDO::FETCH_ASSOC);






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
                            <label for="lote" class="form-label-lg">Lote</label>
                            <input type="text" class="form-control border-dark" id="lote" name="lote">
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
                            <label for="lote" class="form-label-lg">Potreiro</label>
                            <select class="form-select border-dark" id="fk_potreiro" name="fk_potreiro">
                                <option value="">Selecione um potreiro</option>
                                <?php
                                $potreiros_query = $conexao->query('SELECT * FROM potreiro');
                                $potreiros = $potreiros_query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($potreiros as $potreiro) {
                                    echo '<option value="' . $potreiro['id_potreiro'] . '">' . $potreiro['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="fk_fazenda" class="form-label-lg">Fazenda</label>
                            <select class="form-select border-dark" id="fk_fazenda" name="fk_fazenda">
                                <option value="">Selecione uma fazenda</option>
                                <?php
                                $fazendas_query = $conexao->query('SELECT * FROM fazenda');
                                $fazendas = $fazendas_query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($fazendas as $fazenda) {
                                    echo '<option value="' . $fazenda['id_fazenda'] . '">' . $fazenda['nome_fazenda'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="container">
                        <button type="submit"  name="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>

                <table id="tabela-lote" class="table table-responsive-lg table-striped p-2 w-100">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
                            <th>Lote</th>
                            <th>Data de Entrada</th>
                            <th>Observação</th>
                            <th>Fazenda</th>
                            <th>potreiro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lotes as $lote) : ?>

                            <tr>
                                <td class="d-none"><?php echo $lote['id_lote_animal']; ?></td>
                                <td><?php echo $lote['lote']; ?></td>
                                <td><?php echo $lote['data_entrada']; ?></td>
                                <td><?php echo $lote['observacao']; ?></td>
                                <td><?php echo $lote['nome_fazenda']; ?></td>
                                <td><?php echo $lote['nome']; ?></td>
                                
                                <td>
                                <button type="button" class="btn btn-warning mr-2 " data-toggle="modal" data-target="#modalEditar<?php echo $lote['id_lote_animal']; ?>">Editar</button>
                                  
                                <a href="excluir-lote.php?id=<?php echo $lote['id_lote_animal']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Tem certeza que deseja excluir este lote ?')">Excluir</a>
                                </td>
                            </tr>

                            <!-- inicio do modal  -->


                            <div class="modal fade" id="modalEditar<?php echo $lote['id_lote_animal']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel">Editar lote</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editar-lote.php" method="post">
                                                <input type="hidden" name="id_lote_animal" value="<?php echo $lote['id_lote_animal']; ?>">
                                                <div class="form-group">
                                                    <label for="lote">Lote</label>
                                                    <input type="text" class="form-control" id="lote" name="lote" value="<?php echo $lote['lote']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="data_entrada">Data_entrada</label>
                                                    <input type="date"class="form-control" id="data_entrada" name="data_entrada" value="<?php echo $lote['data_entrada']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="observacao">Observação</label>
                                                    <input type="text" class="form-control" id="observacao" name="observacao" value="<?php echo $lote['observacao']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="fk_potreiro">Nome do Potreiro</label>
                                                    <select name="fk_potreiro" id="fk_potreiro" class="form-control border-dark" required>
                                                        <option value="">Selecione uma Potreiro</option>
                                                        <?php foreach ($potreiros as $potreiro) : ?>
                                                            <option value="<?php echo $potreiro['id_potreiro']; ?>" <?php if ($potreiro['id_potreiro'] == $lote['fk_potreiro']) echo 'selected'; ?>><?php echo $potreiro['nome']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="fk_fazenda">Nome da Fazenda</label>
                                                    <select name="fk_fazenda" id="fk_fazenda" class="form-control border-dark" required>
                                                        <option value="">Selecione uma fazenda</option>
                                                        <?php foreach ($fazendas as $fazenda) : ?>
                                                            <option value="<?php echo $fazenda['id_fazenda']; ?>" <?php if ($fazenda['id_fazenda'] == $lote['fk_fazenda']) echo 'selected'; ?>><?php echo $fazenda['nome_fazenda']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <button type="submit" name="submit-lote" class="btn btn-primary">Salvar</button>

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
        $('#tabela-lote').DataTable({
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