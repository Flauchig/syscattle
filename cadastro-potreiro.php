<?php
include('links.php');
include('header.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $capacidade = $_POST['capacidade'];
    $tipo_pasto = $_POST['tipo_pasto'];
    $fk_fazenda = isset($_POST['fk_fazenda']) ? $_POST['fk_fazenda'] : '';

    if ($fk_fazenda == '') {
        echo '<div class="alert alert-danger text-center" style="font-weight: bold; font-size: 16px ; margin-top: 30px;">Por favor, selecione uma fazenda.</div>';
    } else {
        // Verifica se o registro já existe no banco de dados
        $sql_query = $conexao->prepare("SELECT * FROM potreiro WHERE nome = :nome AND tamanho = :tamanho AND capacidade = :capacidade AND tipo_pasto = :tipo_pasto AND fk_fazenda = :fk_fazenda");
        $sql_query->bindValue(':nome', $nome);
        $sql_query->bindValue(':tamanho', $tamanho);
        $sql_query->bindValue(':capacidade', $capacidade);
        $sql_query->bindValue(':tipo_pasto', $tipo_pasto);
        $sql_query->bindValue(':fk_fazenda', $fk_fazenda);
        $sql_query->execute();

        if ($sql_query->rowCount() == 0) {
            // Se a busca não retornar nenhum resultado, faz a inserção dos dados
            $sql_insert = $conexao->prepare("INSERT INTO potreiro (nome, tamanho, capacidade, tipo_pasto, fk_fazenda) VALUES (:nome, :tamanho, :capacidade, :tipo_pasto, :fk_fazenda)");
            $sql_insert->bindValue(':nome', $nome);
            $sql_insert->bindValue(':tamanho', $tamanho);
            $sql_insert->bindValue(':capacidade', $capacidade);
            $sql_insert->bindValue(':tipo_pasto', $tipo_pasto);
            $sql_insert->bindValue(':fk_fazenda', $fk_fazenda);
            $sql_insert->execute();
        }
    }
}

$sql_query = $conexao->prepare('SELECT p.id_potreiro, p.nome, p.tamanho, p.capacidade, p.tipo_pasto, f.nome_fazenda,p.fk_fazenda FROM potreiro AS p LEFT JOIN fazenda AS f ON f.id_fazenda = p.fk_fazenda');
$sql_query->execute();
$potreiros = $sql_query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Potreiros</title>
</head>

<body>
    <main class="main" id="main">
        <div class="card">
            <input type="hidden" name="id_potreiro" id="id_potreiro">
            <div class="card-header">
                <h2 class="text-center card-title fs-3">Cadastro de Potreiros</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <label for="nome" class="form-label-lg">Nome do Potreiro</label>
                            <input type="text" id="nome" name="nome" class="form-control border-dark" required>
                        </div>
                        <div class="col-lg-3">
                            <label for="tamanho" class="form-label-lg">Tamanho em Hectares</label>
                            <input type="text" id="tamanho" name="tamanho" class="form-control border-dark" maxlength="4" required>
                        </div>
                        <div class="col-lg-3">
                            <label for="capacidade" class="form-label-lg">Capacidade de Animais</label>
                            <input type="text" id="capacidade" name="capacidade" class="form-control border-dark" required>
                        </div>
                        <div class="col-lg-3">
                            <label for="tipo_pasto" class="form-label-lg">Tipo de Pasto</label>
                            <input type="text" id="tipo_pasto" name="tipo_pasto" class="form-control border-dark" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <select name="fk_fazenda" id="fk_fazenda" class="form-control border-dark" required>
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
                        <button type="submit" name="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>

                <table id="tabela-potreiro" class="table table-responsive-lg table-striped w-100">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
                            <th scope="col">Nome do Potreiro</th>
                            <th scope="col">Tamanho em Hectares</th>
                            <th scope="col">Capacidade de Animais</th>
                            <th scope="col">Tipo de Pasto</th>
                            <th scope="col">Fazenda</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($potreiros as $potreiro) : ?>
                            <tr>
                                <td class="d-none"><?php echo $potreiro['id_potreiro']; ?></td>
                                <td><?php echo $potreiro['nome']; ?></td>
                                <td><?php echo $potreiro['tamanho']; ?></td>
                                <td><?php echo $potreiro['capacidade']; ?></td>
                                <td><?php echo $potreiro['tipo_pasto']; ?></td>
                                <td><?php echo $potreiro['nome_fazenda']; ?></td>
                                <td>
                                    
                                        <button type="button" class="btn btn-warning mr-2 " data-toggle="modal" data-target="#modalEditar<?php echo $potreiro['id_potreiro']; ?>">Editar</button>
                                 
                              
                                        <a href="excluir-potreiro.php?id=<?php echo $potreiro['id_potreiro']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Tem certeza que deseja excluir este potreiro ?')">Excluir</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditar<?php echo $potreiro['id_potreiro']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel">Editar Potreiro</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editar-potreiro.php" method="post">
                                                <input type="hidden" name="id_potreiro" value="<?php echo $potreiro['id_potreiro']; ?>">
                                                <div class="form-group">
                                                    <label for="nome">Nome do Potreiro</label>
                                                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $potreiro['nome']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tamanho">Tamanho</label>
                                                    <input type="text" class="form-control" id="tamanho" name="tamanho" value="<?php echo $potreiro['tamanho']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="capacidade">Capacidade</label>
                                                    <input type="text" class="form-control" id="capacidade" name="capacidade" value="<?php echo $potreiro['capacidade']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tipo_pasto">Tipo de Pasto</label>
                                                    <input type="text" class="form-control" id="tipo_pasto" name="tipo_pasto" value="<?php echo $potreiro['tipo_pasto']; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fk_fazenda">Nome da Fazenda</label>
                                                    <select name="fk_fazenda" id="fk_fazenda" class="form-control border-dark" required>
                                                        <option value="">Selecione uma fazenda</option>
                                                        <?php foreach ($fazendas as $fazenda) : ?>
                                                            <option value="<?php echo $fazenda['id_fazenda']; ?>" <?php if ($fazenda['id_fazenda'] == $potreiro['fk_fazenda']) echo 'selected'; ?>><?php echo $fazenda['nome_fazenda']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <button type="submit" name="submit-potreiro" class="btn btn-primary">Salvar</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
        $('#tabela-potreiro').DataTable({
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


