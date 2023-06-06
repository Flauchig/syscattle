<?php
include('links.php');
include('header.php');


// faz a verificação do envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $nome_fazenda = $_POST['nome_fazenda'];
  $endereco = $_POST['endereco'];
  $cidade = $_POST['cidade'];

  $estado = isset($_POST['estado']) ? $_POST['estado'] : '';  // Verifica se o campo 'estado' foi enviado através do formulário.
  // Se sim, atribui o valor do campo à variável $estado.
  // Caso contrário, define a variável $estado como uma string vazia.
  $cep = $_POST['cep'];
  $telefone = $_POST['telefone'];

  // Verifica se o estado foi selecionado
  if ($estado == '') {
    // Estado não foi selecionado, exibe uma mensagem de erro
    echo '<div class="alert alert-danger text-center" style="font-weight: bold; font-size: 16px ; margin-top: 30px;">Por favor, selecione um estado.</div>';
  } else {
    // O estado foi selecionado, continua com o processamento do formulário

    // Verifica se o registro já existe no banco de dados
    $sql_query = $conexao->prepare("SELECT * FROM 
                                      fazenda 
                                    WHERE 
                                    nome_fazenda = :nome_fazenda 
                                    AND 
                                    endereco = :endereco 
                                    AND 
                                    cidade = :cidade 
                                    AND 
                                    estado = :estado 
                                    AND 
                                    cep = :cep 
                                    AND telefone = :telefone");
    $sql_query->bindValue(':nome_fazenda', $nome_fazenda);
    $sql_query->bindValue(':endereco', $endereco);
    $sql_query->bindValue(':cidade', $cidade);
    $sql_query->bindValue(':estado', $estado);
    $sql_query->bindValue(':cep', $cep);
    $sql_query->bindValue(':telefone', $telefone);
    $sql_query->execute();

    if ($sql_query->rowCount() == 0) {
      // O registro não existe, realizar a inserção
      $sql_insert = $conexao->prepare("INSERT INTO fazenda (endereco, cidade, estado, cep, telefone, nome_fazenda) VALUES (:endereco, :cidade, :estado, :cep, :telefone, :nome_fazenda)");
      $sql_insert->bindValue(':endereco', $endereco);
      $sql_insert->bindValue(':cidade', $cidade);
      $sql_insert->bindValue(':estado', $estado);
      $sql_insert->bindValue(':cep', $cep);
      $sql_insert->bindValue(':telefone', $telefone);
      $sql_insert->bindValue(':nome_fazenda', $nome_fazenda);
      $sql_insert->execute();
    }
  }
}

// Recupera as fazendas cadastradas no banco de dados
$sql_query = $conexao->query('SELECT * FROM fazenda');
$fazendas = $sql_query->fetchAll(PDO::FETCH_ASSOC);
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
      <div class="card-header">
        <h2 class="text-center card-title fs-3"> Cadastrar Fazenda </h2>
      </div>
      <div class="card-body">
        <form method="post">
          <input type="hidden" name="id_fazenda">
          <div class="row mb-4">
            <div class="col-lg-3">
              <label for="inputText" class="col-form-label">Nome da Fazenda</label>
              <input type="text" class="form-control border-dark" name="nome_fazenda" required>
            </div>

            <div class="col-lg-3">
              <label for="inputAddress5" class="col-form-label">Endereço</label>
              <input type="text" class="form-control border-dark" id="inputAddress" name="endereco" required>
            </div>

            <div class="col-lg-3">
              <label for="inputCity" class="col-form-label">Cidade</label>
              <input type="text" class="form-control border-dark" id="inputCity" name="cidade" required>
            </div>

            <div class="col-lg-3">
              <label for="cep" class="col-form-label">CEP</label>
              <input type="text" class="form-control border-dark" id="cep" name="cep" required>
            </div>




          </div>

          <div class="row mb-4">
            <div class="col-lg-3">
              <label for="telefone" class="col-form-label">Telefone</label>
              <input type="text" class="form-control border-dark" id="telefone" name="telefone">
            </div>
            <div class="col-lg-3">
              <label for="estado" class="col-form-label">Estado</label>
              <select class="form-select border-dark" id="estado" name="estado" required>
                <option selected disabled>Selecione um estado</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
              </select>
            </div>
          </div>


          <button type="submit" name="submit" class="btn btn-primary">Adicionar</button>
        </div>
      </form>
      
      <div class="container">


        <table id="tabela-fazenda" class="table table-responsive-lg table-striped p-2 w-100">
          <thead>
            <tr>
              <th class="d-none">ID</th>
              <th scope="col">Nome da Fazenda</th>
              <th scope="col">Endereço</th>
              <th scope="col">Cidade</th>
              <th scope="col">Estado</th>
              <th scope="col">CEP</th>
              <th scope="col">Telefone</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($fazendas as $fazenda) : ?>
              <tr>
                <td class="d-none"><?php echo $fazenda['id_fazenda']; ?></td>
                <td><?php echo $fazenda['nome_fazenda']; ?></td>
                <td><?php echo $fazenda['endereco']; ?></td>
                <td><?php echo $fazenda['cidade']; ?></td>
                <td><?php echo $fazenda['estado']; ?></td>
                <td><?php echo $fazenda['cep']; ?></td>
                <td><?php echo $fazenda['telefone']; ?></td>
                <td>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditar<?php echo $fazenda['id_fazenda']; ?>">Editar</button>
                  <a href="excluir-fazenda.php?id=<?php echo $fazenda['id_fazenda']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta fazenda?')">Excluir</a>

                </td>
              </tr>

              

              <!-- Modal de Edição -->
              <div class="modal fade" id="modalEditar<?php echo $fazenda['id_fazenda']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalEditarLabel">Editar Fazenda</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="editar-fazenda.php" method="POST">
                        <!-- Campos do formulário -->
                        <input type="hidden" name="id_fazenda" value="<?php echo $fazenda['id_fazenda']; ?>">
                        <div class="form-group">
                          <label for="nome_fazenda">Nome da Fazenda</label>
                          <input type="text" class="form-control" id="nome_fazenda" name="nome_fazenda" value="<?php echo $fazenda['nome_fazenda']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="endereco">Endereço</label>
                          <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $fazenda['endereco']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="edit-cidade">Cidade</label>
                          <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $fazenda['cidade']; ?>" required>
                        </div>

                        <div class="form-group">
                          <label for="estado"> Estado </label>
                          <select class="form-control" id="estado" name="estado">
                            <option value="" disabled>Selecione um estado</option> 
                            <option value="AC" <?php echo ($fazenda['estado'] == 'AC') ? 'selected' : ''; ?>>Acre</option>
                            <option value="AL" <?php echo ($fazenda['estado'] == 'AL') ? 'selected' : ''; ?>>Alagoas</option>
                            <option value="AP" <?php echo ($fazenda['estado'] == 'AP') ? 'selected' : ''; ?>>Amapá</option>
                            <option value="AM" <?php echo ($fazenda['estado'] == 'AM') ? 'selected' : ''; ?>>Amazonas</option>
                            <option value="BA" <?php echo ($fazenda['estado'] == 'BA') ? 'selected' : ''; ?>>Bahia</option>
                            <option value="CE" <?php echo ($fazenda['estado'] == 'CE') ? 'selected' : ''; ?>>Ceará</option>
                            <option value="DF" <?php echo ($fazenda['estado'] == 'DF') ? 'selected' : ''; ?>>Distrito Federal</option>
                            <option value="ES" <?php echo ($fazenda['estado'] == 'ES') ? 'selected' : ''; ?>>Espírito Santo</option>
                            <option value="GO" <?php echo ($fazenda['estado'] == 'GO') ? 'selected' : ''; ?>>Goiás</option>
                            <option value="MA" <?php echo ($fazenda['estado'] == 'MA') ? 'selected' : ''; ?>>Maranhão</option>
                            <option value="MT" <?php echo ($fazenda['estado'] == 'MT') ? 'selected' : ''; ?>>Mato Grosso</option>
                            <option value="MS" <?php echo ($fazenda['estado'] == 'MS') ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                            <option value="MG" <?php echo ($fazenda['estado'] == 'MG') ? 'selected' : ''; ?>>Minas Gerais</option>
                            <option value="PA" <?php echo ($fazenda['estado'] == 'PA') ? 'selected' : ''; ?>>Pará</option>
                            <option value="PB" <?php echo ($fazenda['estado'] == 'PB') ? 'selected' : ''; ?>>Paraíba</option>
                            <option value="PR" <?php echo ($fazenda['estado'] == 'PR') ? 'selected' : ''; ?>>Paraná</option>
                            <option value="PE" <?php echo ($fazenda['estado'] == 'PE') ? 'selected' : ''; ?>>Pernambuco</option>
                            <option value="PI" <?php echo ($fazenda['estado'] == 'PI') ? 'selected' : ''; ?>>Piauí</option>
                            <option value="RJ" <?php echo ($fazenda['estado'] == 'RJ') ? 'selected' : ''; ?>>Rio de Janeiro</option>
                            <option value="RN" <?php echo ($fazenda['estado'] == 'RN') ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                            <option value="RS" <?php echo ($fazenda['estado'] == 'RS') ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                            <option value="RO" <?php echo ($fazenda['estado'] == 'RO') ? 'selected' : ''; ?>>Rondônia</option>
                            <option value="RR" <?php echo ($fazenda['estado'] == 'RR') ? 'selected' : ''; ?>>Roraima</option>
                            <option value="SC" <?php echo ($fazenda['estado'] == 'SC') ? 'selected' : ''; ?>>Santa Catarina</option>
                            <option value="SP" <?php echo ($fazenda['estado'] == 'SP') ? 'selected' : ''; ?>>São Paulo</option>
                            <option value="SE" <?php echo ($fazenda['estado'] == 'SE') ? 'selected' : ''; ?>>Sergipe</option>
                            <option value="TO" <?php echo ($fazenda['estado'] == 'TO') ? 'selected' : ''; ?>>Tocantins</option>
                          </select>
                          <div class="form-group">
                            <label for="editar-cep">CEP</label>
                            <input type="text" class="form-control" id="editar-cep" name="cep" value="<?php echo $fazenda['cep']; ?>" required>
                          </div>

                          <div class="form-group">
                            <label for=" editar-telefone">Telefone</label>
                            <input type="text" class="form-control" id="editar-telefone" name="telefone" value="<?php echo $fazenda['telefone']; ?>" placeholder="(99) 9999-9999" required>
                          </div>



                        </div>
                                     
                      
                        <button type="submit" name="submit-editar" class="btn btn-primary mt-3">Salvar</button>


                      </form>






                    </div>
                  </div>
                </div>
              </div>
              <!-- Fim do Modal de Edição -->



       



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
        $('#tabela-fazenda').DataTable({
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