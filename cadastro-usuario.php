<?php
include('links.php');
include('header.php');




$cargos_nome = [
    '0' => 'Suporte',
    '1' => 'Administrador'

];




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';


    if ($cargo == '') {
        // Estado não foi selecionado, exibe uma mensagem de erro
        echo '<div class="alert alert-danger text-center" style="font-weight: bold; font-size: 16px ; margin-top: 30px;">Por favor, selecione um cargo .</div>';
    } else {

        $sql_query = $conexao->prepare("SELECT * FROM
                                                    login 
                                                WHERE
                                                    usuario = :usuario
                                                AND 
                                                    senha = :senha
                                                AND 
                                                    cargo = :cargo 
                                                                ");
        $sql_query->bindValue(':usuario', $usuario);
        $sql_query->bindValue(':senha', $senha);
        $sql_query->bindValue(':cargo', $cargo);
        $sql_query->execute();

        if ($sql_query->rowCount() == 0) {

            $sql_insert = $conexao->prepare("INSERT INTO login (usuario, senha, cargo) VALUES (:usuario, :senha, :cargo)");

            $sql_insert->bindValue(':usuario', $usuario);
            $sql_insert->bindValue(':senha', $senha);
            $sql_insert->bindValue(':cargo', $cargo);
            $sql_insert->execute();
        }
    }
}

$sql_query = $conexao->query("SELECT * FROM login");
$cargos = $sql_query->fetchAll(PDO::FETCH_ASSOC);







?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <title>Cadastro de Usuário </title>
</head>


<body>
    <main class="main" id="main">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center card-title fs-3">Cadastro de Usuário</h2>
            </div>
            <div class="card-body">
                <form method="post">

                    <div class="row mb-4 d-flex justify-content-between">
                        <input type="hidden" id="id_login" name="id_login">
                        <div class="col-sm-4">
                            <label for="usuario" class="form-label-lg">Usuario</label>
                            <input type="text" class="form-control border-dark" id="usuario" name="usuario" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="senha" class="form-label-lg">Senha</label>
                            <input type="password" class="form-control border-dark" id="senha" name="senha" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="cargo" class="form-label-lg">Cargo</label>
                            <select class="form-control border-dark" id="cargo" name="cargo">
                                <option value="">Selecione uma Permissão </option>
                                <option value="1">Administrador</option>
                                <option value="0">Suporte</option>
                            </select>
                        </div>
                    </div>
                    <div class="container">
                        <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
                <table id="tabela-usuario" class="table table-responsive-lg table-striped p-2 w-100">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
                            <th>Login</th>
                            <th>Senha</th>
                            <th>Permissão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cargos as $cargo) : ?>
                            <tr>
                                <td class="d-none"><?php echo $cargo['id_login']; ?></td>

                                <td><?php echo $cargo['usuario']; ?></td>
                                <td><?php echo $cargo['senha']; ?></td>
                                <td><?php echo $cargos_nome[$cargo['cargo']]; ?></td>

                                <td>
                                    <button type="button" class="btn btn-warning mr-2 " data-toggle="modal" data-target="#modalEditar<?php echo $cargo['id_login']; ?>">Editar</button>
                                    
                                    <a href="excluir-usuario.php?id=<?php echo $cargo['id_login']; ?>" class="btn btn-danger mr-2" onclick="return confirm('Tem certeza que deseja excluir este usuário ?')">Excluir</a>
                                </td>
                            </tr>



                            <!-- inicio do modal  -->
                            <div class="modal fade" id="modalEditar<?php echo $cargo['id_login']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel">Editar Login</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editar-usuario.php" method="post">
                                                <input type="hidden" name="id_login" value="<?php echo $cargo['id_login']; ?>">

                                                <div class="form-group">
                                                    <label for="usuario">Usuário</label>
                                                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $cargo['usuario']; ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="senha">senha</label>
                                                    <input type="password" class="form-control" id="senha" name="senha" value="<?php echo $cargo['senha']; ?>" required>
                                                </div>


                                                <div class="form-group">
                                                    <label for="cargo">Cargo</label>
                                                    <select name="cargo" id="cargo" class="form-control border-dark" required>
                                                        <option value="">Selecione um cargo</option>
                                                        <?php foreach ($cargos_nome as $key => $cargo) : ?>
                                                            <option value="<?php echo $key; ?>"><?php echo $cargo; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>





                                                <br />



                                                <button type="submit" name="submit-usuario" class="btn btn-primary">Salvar</button>

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
        $('#tabela-usuario').DataTable({
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