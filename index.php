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

$sql_query = $conexao->prepare("SELECT
    a.id_animal,
    DATE_FORMAT(data_nascimento, '%d/%m/%Y') AS data_nascimento,
    peso,
    brinco,
    raca,
    GROUP_CONCAT(DATE_FORMAT(data_manutencao, '%d/%m/%Y') ORDER BY data_manutencao SEPARATOR ', ') AS data_manutencao,
    GROUP_CONCAT(tipo_manutencao ORDER BY data_manutencao SEPARATOR ', ') AS tipo_manutencao,
    nome AS potreiro,
    lote,
    nome_fazenda AS fazenda,
    GROUP_CONCAT(DATE_FORMAT(data_vacinacao, '%d/%m/%Y') ORDER BY data_vacinacao SEPARATOR ', ') AS data_vacinacao,
    GROUP_CONCAT(tipo_vacinacao ORDER BY data_vacinacao SEPARATOR ', ') AS tipo_vacinacao
FROM
    fazenda
    LEFT JOIN potreiro p ON (p.fk_fazenda = id_fazenda)
    LEFT JOIN animal a ON (a.fk_potreiro = p.id_potreiro)
    LEFT JOIN manejo m ON (m.fk_animal = a.id_animal)
    LEFT JOIN lote_animal l ON (a.fk_lote = id_lote_animal)
    LEFT JOIN vacinacao v ON (v.fk_animal = a.id_animal)
GROUP BY
    a.id_animal");

$sql_query->execute();
$relatorios = $sql_query->fetchAll(PDO::FETCH_ASSOC);
?>

<main id="main" class="main">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Listagem de Animais</h5>
      <table id="tabela" class="table table-responsive-lg table-striped p-2">
        <thead>
          <tr>
            <th>Data de Nascimento</th>
            <th>Peso</th>
            <th>Brinco</th>
            <th>Potreiro</th>
            <th>Fazenda</th>
            <th>Lote</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($relatorios as $relatorio) : ?>
  <tr>
    <td><?php echo !empty($relatorio['data_nascimento']) ? $relatorio['data_nascimento'] : '-'; ?></td>
    <td><?php echo !empty($relatorio['peso']) ? $relatorio['peso'] : '-'; ?></td>
    <td><?php echo !empty($relatorio['brinco']) ? $relatorio['brinco'] : '-'; ?></td>
    <td><?php echo !empty($relatorio['potreiro']) ? $relatorio['potreiro'] : '-'; ?></td>
    <td><?php echo !empty($relatorio['fazenda']) ? $relatorio['fazenda'] : '-'; ?></td>
    <td><?php echo !empty($relatorio['lote']) ? $relatorio['lote'] : '-'; ?></td>

    <td>
      <a href="relatorio-animal.php?id_animal=<?php echo $relatorio['id_animal']; ?>" class="btn btn-primary mt-1" target="_blank">Detalhes</a>
    </td>
  </tr>
<?php endforeach; ?>

        </tbody>
        <tfoot>
          <tr>
            <th>Data de Nascimento</th>
            <th>Peso</th>
            <th>Brinco</th>
            <th>Potreiro</th>
            <th>Fazenda</th>
            <th>Lote</th>
            <th>Ações</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</main><!-- End #main -->

<?php include('footer.php'); ?>

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