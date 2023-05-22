<?php 
include_once('header.php');
include_once('links.php');
include_once('config.php');


if (!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    echo "<script>alert('É necessário estar logado para acessar o sistema'); window.location.href = 'login.php';</script>";
    exit;
} else {
    $logado = $_SESSION['usuario'];
}
?>



 



  <main id="main" class="main">
    
    <div class="card">

    <div class="card-body">

<h5 class="card-title">Listagem de Animais </h5>

<table id="tabela" class="table table-responsive-lg table-striped p-2">
  <thead>
    <tr>
      <th>ID</th>
      <th>Data de Nascimento</th>
      <th>Peso </th>
      <th>Raça</th>
      <th>Potreiro</th>
      <th>Fazenda</th>
      <th>Lote</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td>1</td>
      <td>2008-12-11</td>
      <td>500</td>
      <td>Aberdeen Angus</td>
      <td>potreiro1</td>
      <td>fazenda1</td> 
      <td>1</td>
      <td>
        <a href="#" class="btn btn-primary mt-1">Detalhes</a>
        <a href="#" class="btn btn-warning mt-1">Editar</a>
        <a href="#" class="btn btn-danger mt-1">Excluir</a>
      </td>
    </tr>

    <tr>
      <td>2</td>
      <td>2011-05-03</td>
      <td>400</td>
      <td>Hereford</td>
      <td>potreiro2</td>
      <td>fazenda2</td>
      <td>2</td>
      <td>
        <a href="#" class="btn btn-primary mt-1">Detalhes</a>
        <a href="#" class="btn btn-warning mt-1">Editar</a>
        <a href="#" class="btn btn-danger mt-1">Excluir</a>

      </td>
    </tr>

  </tbody>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Data de Nascimento</th>
      <th>Peso </th>
      <th>Raça</th>
      <th>Potreiro</th>
      <th>Ações</th>
    </tr>
  </tfoot>
</table>
</div>




    </div>

    









  </main><!-- End #main -->

  <?php
  include('footer.php');  
  ?>





  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#tabela').DataTable({
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
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>



</body>

</html>