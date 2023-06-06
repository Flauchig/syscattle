<?php
include('links.php');
include('header.php');
 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $data_nascimento = $_POST['data_nascimento'];
    $brinco = $_POST['brinco'];
    $peso = $_POST['peso'];
    $raca = $_POST['raca'];
    $fk_lote = isset($_POST['fk_lote']) ? $_POST['fk_lote'] : '';
    $fk_potreiro = isset($_POST['fk_potreiro']) ? $_POST['fk_potreiro'] : '';


    if ($fk_lote == '' && $fk_potreiro == '') {
        echo '<div class="alert alert-danger text-center" style="font-weight: bold; font-size: 16px ; margin-top: 30px;">Por favor, Não deixe espaços em branco .</div>';
    } else {

        // Verifica se o registro já existe no banco de dados
        $sql_query = $conexao->prepare("SELECT * FROM animal 
                                            WHERE 
                                            data_nascimento = :data_nascimento 
                                            AND 
                                            brinco = :brinco 
                                            AND 
                                            peso = :peso  
                                            AND 
                                            raca = :raca 
                                            AND 
                                            fk_lote = :fk_lote
                                            AND
                                            fk_potreiro = :fk_potreiro");
        $sql_query->bindValue(':data_nascimento', $data_nascimento);
        $sql_query->bindValue(':brinco', $brinco);
        $sql_query->bindValue(':peso', $peso);
        $sql_query->bindValue(':raca', $raca);
        $sql_query->bindValue(':fk_lote', $fk_lote);
        $sql_query->bindValue(':fk_potreiro', $fk_potreiro);
        $sql_query->execute();

        if ($sql_query->rowCount() == 0) {
            // Se a busca não retornar nenhum resultado, faz a inserção dos dados
            $sql_insert = $conexao->prepare("INSERT INTO animal (data_nascimento, brinco, peso, raca, fk_lote, fk_potreiro) VALUES (:data_nascimento, :brinco, :peso, :raca, :fk_lote, :fk_potreiro)");
            $sql_insert->bindValue(':data_nascimento', $data_nascimento);
            $sql_insert->bindValue(':brinco', $brinco);
            $sql_insert->bindValue(':peso', $peso);
            $sql_insert->bindValue(':raca', $raca);
            $sql_insert->bindValue(':fk_lote', $fk_lote);
            $sql_insert->bindValue(':fk_potreiro', $fk_potreiro);
            $sql_insert->execute();
        }
    }
}

$sql_query = $conexao->prepare('SELECT 
                                a.id_animal,
                                DATE_FORMAT(a.data_nascimento, "%d/%m/%Y") as data_nascimento,
                                a.data_nascimento as data_nasc,
                                a.brinco, 
                                a.peso,  
                                a.raca, 
                                a.fk_lote, 
                                a.fk_potreiro,
                                p.nome, 
                                l.lote
                            FROM 
                                animal AS a 
                            LEFT JOIN 
                                lote_animal AS l 
                            ON 
                                l.id_lote_animal = a.fk_lote
                            LEFT JOIN 
                                potreiro AS p
                            ON
                                p.id_potreiro = a.fk_potreiro');
$sql_query->execute();
$animais = $sql_query->fetchAll(PDO::FETCH_ASSOC);




?>





<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title> Cadastro da Animais </title>
</head>


<body>
    <main class="main" id="main">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center card-title fs-3">Cadastro de Animais</h2>
            </div>
            <div class="card-body w-100">
                <form method="post">
                    <div class="row mb-4 d-flex justify-content-between">
                        <input type="hidden" id="id_animal" name="id_animal">
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Data de Nascimento</label>
                            <input type="date" class="form-control border-dark" id="data_nascimento" name="data_nascimento" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Brinco</label>
                            <input type="text" class="form-control border-dark" id="brinco" name="brinco" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Peso</label>
                            <input type="text" class="form-control border-dark" id="peso" name="peso" required>
                        </div>
                    </div>
                    <div class="row mb-4 d-flex justify-content-between">
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Raça</label>
                            <input type="text" class="form-control border-dark" id="raca" name="raca" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Lote</label>
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
                        <div class="col-sm-4">
                            <label for="inputText" class="form-label-lg">Potreiro</label>
                            <select class="form-select border-dark" id="fk_potreiro" name="fk_potreiro">
                                <option value="" selected>Selecione um potreiro</option>
                                <?php
                                $potreiros_query = $conexao->query('SELECT * FROM potreiro');
                                $potreiros = $potreiros_query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($potreiros as $potreiro) {
                                    echo '<option value="' . $potreiro['id_potreiro'] . '">' . $potreiro['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Adicionar</button>
            </div>
            </form>
            <div class="container">
                <table id="tabela-animal" class="table table-responsive-lg table-striped p-2 w-100">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
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
                        <?php foreach ($animais as $animal) : ?>

                            <tr>
                                <td class="d-none"><?php echo $animal['id_animal']; ?></td>
                                <td><?php echo $animal['data_nascimento']; ?></td>
                                <td><?php echo $animal['brinco']; ?></td>
                                <td><?php echo $animal['peso']; ?>KG</td>
                                <td><?php echo $animal['raca']; ?></td>
                                <td><?php echo $animal['lote']; ?></td>
                                <td><?php echo $animal['nome']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalEditar<?php echo $animal['id_animal']; ?>">Editar</a>

                                    <a href="excluir-animal.php?id=<?php echo $animal['id_animal']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Tem certeza que deseja excluir este animal ?')">Excluir</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditar<?php echo $animal['id_animal']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel">Editar Animal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editar-animal.php" method="post">
                                                <input type="hidden" name="id_animal" value="<?php echo $animal['id_animal']; ?>">
                                                <div class="form-group">
                                                    <label for="data_nascimento">Data de Nascimento</label>
                                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $animal['data_nasc']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="brinco">Brinco</label>
                                                    <input type="text" class="form-control" id="brinco" name="brinco" value="<?php echo $animal['brinco']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="peso">Peso</label>
                                                    <input type="text" class="form-control" id="peso" name="peso" value="<?php echo $animal['peso']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="raca">Raça</label>
                                                    <input type="text" class="form-control" id="raca" name="raca" value="<?php echo $animal['raca']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fk_lote">Nome do Lote</label>
                                                    <select name="fk_lote" id="fk_lote" class="form-control border-dark" required>
                                                        <option value="">Selecione um lote</option>
                                                        <?php foreach ($lotes as $lote) : ?>
                                                            <option value="<?php echo $lote['id_lote_animal']; ?>" <?php if ($lote['id_lote_animal'] == $animal['fk_lote']) echo 'selected'; ?>><?php echo $lote['lote']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fk_potreiro">Nome do Potreiro</label>
                                                    <select name="fk_potreiro" id="fk_potreiro" class="form-control border-dark" required>
                                                        <option value="">Selecione um potreiro</option>
                                                        <?php foreach ($potreiros as $potreiro) : ?>
                                                            <option value="<?php echo $potreiro['id_potreiro']; ?>" <?php if ($potreiro['id_potreiro'] == $animal['fk_potreiro']) echo 'selected'; ?>><?php echo $potreiro['nome']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <button type="submit" name="submit-animal" class="btn btn-primary">Salvar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabela-animal').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/Portuguese-Brasil.json"
            }
        });

        $('#editar-cep').inputmask("99999-999");
        $('#editar-telefone').inputmask('(99) 9999-9999');
        $('#cep').inputmask("99999-999");
        $('#telefone').inputmask('(99) 9999-9999');
    });
</script>



<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>


</html>