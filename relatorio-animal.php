<?php
require_once('config.php');
require_once('tcpdf/tcpdf.php');

// Verifica se o parâmetro id_animal foi fornecido na URL
if (isset($_GET['id_animal'])) {
    $id_animal = $_GET['id_animal'];

    // Consulta os dados do animal com base no ID fornecido
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
    WHERE
        a.id_animal = :id_animal
    GROUP BY
        a.id_animal");

    $sql_query->bindParam(':id_animal', $id_animal);
    $sql_query->execute();
    $animal = $sql_query->fetch(PDO::FETCH_ASSOC);

    if ($animal) {
        // Cria um novo objeto TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Define o título do documento
        $pdf->SetTitle('Relatório do Animal');

        // Adiciona uma página
        $pdf->AddPage();

        // Define o conteúdo do documento
        $html = '
        <style>
            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
            }
            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }
            .table tbody + tbody {
                border-top: 2px solid #dee2e6;
            }
            .table .table {
                background-color: #fff;
            }
            .table-sm th,
            .table-sm td {
                padding: 0.3rem;
            }
        </style>
        
        <h1 class="mb-4">Relatório do Animal</h1>
        
        <h2 class="mt-4">Informações do Animal</h2>
        <table class="table table-bordered mt-2">
            <tr>
                <th>Data de Nascimento</th>
                <td>' . ((!empty($animal['data_nascimento'])) ? $animal['data_nascimento'] : '-') . '</td>
            </tr>
            <tr>
                <th>Peso</th>
                <td>' . ((!empty($animal['peso'])) ? $animal['peso'] : '-') . '</td>
            </tr>
            <tr>
                <th>Brinco</th>
                <td>' . ((!empty($animal['brinco'])) ? $animal['brinco'] : '-') . '</td>
            </tr>
            <tr>
                <th>Raça</th>
                <td>' . ((!empty($animal['raca'])) ? $animal['raca'] : '-') . '</td>
            </tr>
            <tr>
                <th>Potreiro</th>
                <td>' . ((!empty($animal['potreiro'])) ? $animal['potreiro'] : '-') . '</td>
            </tr>
            <tr>
                <th>Fazenda</th>
                <td>' . ((!empty($animal['fazenda'])) ? $animal['fazenda'] : '-') . '</td>
            </tr>
            <tr>
                <th>Lote</th>
                <td>' . ((!empty($animal['lote'])) ? $animal['lote'] : '-') . '</td>
            </tr>
        </table>';
        
        // Verifica se há dados de vacinação do animal
        if (!empty($animal['data_vacinacao']) && !empty($animal['tipo_vacinacao'])) {
            $html .= '<h2 class="mt-4">Vacinação</h2>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>';

            $datas_vacinacao = explode(', ', $animal['data_vacinacao']);
            $tipos_vacinacao = explode(', ', $animal['tipo_vacinacao']);

            // Itera sobre as datas e tipos de vacinação e cria as linhas da tabela
            foreach ($datas_vacinacao as $index => $data) {
                $tipo = $tipos_vacinacao[$index];
                $html .= '<tr><td>' . $data . '</td><td>' . $tipo . '</td></tr>';
            }

            $html .= '</tbody>
                </table>';
        } else {
            // Se não houver dados de vacinação, exibe uma mensagem indicando isso
            $html .= '<h2 class="mt-4">Vacinação</h2>
                <table class="table table-bordered mt-2">
                    <tr><td colspan="2">Nenhuma vacinação registrada.</td></tr>
                </table>';
        }

        // Verifica se há dados de manejo do animal
        if (!empty($animal['data_manutencao']) && !empty($animal['tipo_manutencao'])) {
            $html .= '<h2 class="mt-4">Manejo</h2>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Data de Manutenção</th>
                            <th>Tipo de Manutenção</th>
                        </tr>
                    </thead>
                    <tbody>';

            $datas_manutencao = explode(', ', $animal['data_manutencao']);
            $tipos_manutencao = explode(', ', $animal['tipo_manutencao']);

            // Itera sobre as datas e tipos de manejo e cria as linhas da tabela
            foreach ($datas_manutencao as $index => $data) {
                $tipo = $tipos_manutencao[$index];
                $html .= '<tr><td>' . $data . '</td><td>' . $tipo . '</td></tr>';
            }

            $html .= '</tbody>
                </table>';
        } else {
            // Se não houver dados de manejo, exibe uma mensagem indicando isso
            $html .= '<h2 class="mt-4">Manejo</h2>
                <table class="table table-bordered mt-2">
                    <tr><td colspan="2">Nenhum manejo registrado.</td></tr>
                </table>';
        }

        // Escreve o conteúdo HTML no documento PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Saída do PDF para o navegador (abre em outra aba)
        $pdf->Output('relatorio_animal.pdf', 'I');
    } else {
        // Se o animal não for encontrado, redireciona para a página principal
        header('Location: index.php');
        exit();
    }
} else {
    // Se o parâmetro id_animal não for fornecido, redireciona para a página principal
    header('Location: index.php');
    exit();
}
