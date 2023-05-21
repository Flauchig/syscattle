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
      <div class="card-header">
        <h2 class="text-center card-title fs-3"> Cadastrar Fazenda </h2>
      </div>
      <div class="card-body">
      <form method="post">
  <input type="hidden" name="id_fazenda">
  <div class="row mb-4">
    <div class="col-lg-3">
      <label for="inputText" class="col-form-label">Nome da Fazenda</label>
      <input type="text" class="form-control border-dark">
    </div>

    <div class="col-lg-3">
      <label for="inputAddress5" class="col-form-label">Endereço</label>
      <input type="text" class="form-control border-dark" id="inputAddress5">
    </div>

    <div class="col-lg-3">
      <label for="inputCity" class="col-form-label">Cidade</label>
      <input type="text" class="form-control border-dark" id="inputCity">
    </div>

    <div class="col-lg-3">
      <label for="cep" class="col-form-label">CEP</label>
      <input type="text" class="form-control border-dark" id="cep" name="cep" placeholder="00000-000">
    </div>

   

    
  </div>

  <div class="row mb-4">
    <div class="col-lg-3">
      <label for="telefone" class="col-form-label">Telefone</label>
      <input type="text" class="form-control border-dark" id="telefone" name="telefone" placeholder="(00) 0000-0000">
    </div>
    <div class="col-lg-3">
  <label for="estado" class="col-form-label">Estado</label>
  <select class="form-select border-dark" id="estado" name="estado">
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
  

  <div class="container">
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </div>
</form>


        <table id="tabela-fazenda"  class="table table-responsive-lg table-striped p-2">
          <thead>
            <tr>
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
            <tr>
              <td>Fazenda A</td>
              <td>Endereço A</td>
              <td>Cidade A</td>
              <td>Estado A</td>
              <td>00000-000</td>
              <td>(00) 0000-0000</td>
              <td>
                <a href="#" class="btn btn-warning">Editar</a>
                <a href="#" class="btn btn-danger">Excluir</a>
              </td>
            </tr>
            <tr>
              <td>Fazenda B</td>
              <td>Endereço B</td>
              <td>Cidade B</td>
              <td>Estado B</td>
              <td>11111-111</td>
              <td>(11) 1111-1111</td>
              <td>
                <a href="#" class="btn btn-warning">Editar</a>
                <a href="#" class="btn btn-danger">Excluir</a>

      </div>
      </td>
      </tr>
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
    $('#tabela-fazenda').DataTable({
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