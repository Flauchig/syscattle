<?php
require_once('config.php');
require_once('tcpdf/tcpdf.php');

if (isset($_GET['id_animal'])) {
    $id_animal = $_GET['id_animal'];

    // Consulta SQL para obter as informações do animal
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
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Relatório do Animal');
        $pdf->AddPage();

        // HTML do relatório
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
                border-bottom: 1px solid #fff; /* Add bottom border */
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
                background-color: #343a40;
                color: #fff;
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
                <th style="color: #fff; background-color: #343a40;">Data de Nascimento</th>
                <td style="color: #fff; background-color: #343a40;">' . ((!empty($animal['data_nascimento'])) ? $animal['data_nascimento'] : '-') . '</td>
            </tr>
            <tr>
                <th style="color: #fff; background-color: #343a40;">Peso</th>
                <td style="color: #fff; background-color: #343a40;">' . ((!empty($animal['peso'])) ? $animal['peso'] : '-') . '</td>
            </tr>
            <tr>
                <th style="color: #fff; background-color: #343a40;">Brinco</th>
                <td style="color: #fff; background-color: #343a40;">' . ((!empty($animal['brinco'])) ? $animal['brinco'] : '-') . '</td>
            </tr>
            <tr>
                <th style="color: #fff; background-color: #343a40;">Raça</th>
                <td style="color: #fff; background-color: #343a40;">' . ((!empty($animal['raca'])) ? $animal['raca'] : '-') . '</td>
            </tr>
            <tr>
                <th style="color: #fff; background-color: #343a40;">Potreiro</th>
                <td style="color: #fff; background-color: #343a40;">' . ((!empty($animal['potreiro'])) ? $animal['potreiro'] : '-') . '</td>
            </tr>
            <tr>
                <th style="color: #fff; background-color: #343a40;">Fazenda</th>
                <td style="color: #fff; background-color: #343a40;">' . ((!empty($animal['fazenda'])) ? $animal['fazenda'] : '-') . '</td>
            </tr>
            <tr>
                <th style="color: #fff; background-color: #343a40;">Lote</th>
                <td style="color: #fff; background-color: #343a40;">' . ((!empty($animal['lote'])) ? $animal['lote'] : '-') . '</td>
            </tr>
        </table>';

        // Vacinação
        $vacinas = array();

        if (!empty($animal['data_vacinacao']) && !empty($animal['tipo_vacinacao'])) {
            $html .= '<h2 class="mt-4">Vacinação</h2>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th style="color: #fff; background-color: #343a40;">Data Vacinação </th>
                            <th style="color: #fff; background-color: #343a40;">Tipo Vacinação </th>
                        </tr>
                    </thead>
                    <tbody>';

            $datas_vacinacao = explode(', ', $animal['data_vacinacao']);
            $tipos_vacinacao = explode(', ', $animal['tipo_vacinacao']);

            foreach ($datas_vacinacao as $index => $data) {
                $tipo = $tipos_vacinacao[$index];
                $vacina = $data . ' - ' . $tipo;

                if (!in_array($vacina, $vacinas)) {
                    $vacinas[] = $vacina;
                    $html .= '<tr><td style="color: #fff; background-color: #343a40;">' . $data . '</td><td style="color: #fff; background-color: #343a40;">' . $tipo . '</td></tr>';
                }
            }

            $html .= '</tbody>
                </table>';
        } else {
            $html .= '<h2 class="mt-4">Vacinação</h2>
                <p style="color: #fff ; background-color: #343a40;">Não há registros de vacinação para este animal.</p>';
        }

        // Manutenção
        $manutencoes = array();

        if (!empty($animal['data_manutencao']) && !empty($animal['tipo_manutencao'])) {
            $html .= '<h2 class="mt-4">Manejo</h2>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th style="color: #fff; background-color: #343a40;">Data Manejo </th>
                            <th style="color: #fff; background-color: #343a40;">Tipo Manejo</th>
                        </tr>
                    </thead>
                    <tbody>';

            $datas_manutencao = explode(', ', $animal['data_manutencao']);
            $tipos_manutencao = explode(', ', $animal['tipo_manutencao']);

            foreach ($datas_manutencao as $index => $data) {
                $tipo = $tipos_manutencao[$index];
                $manutencao = $data . ' - ' . $tipo;

                if (!in_array($manutencao, $manutencoes)) {
                    $manutencoes[] = $manutencao;
                    $html .= '<tr><td style="color: #fff; background-color: #343a40;">' . $data . '</td><td style="color: #fff; background-color: #343a40;">' . $tipo . '</td></tr>';
                }
            }

            $html .= '</tbody>
                </table>';
        } else {
            $html .= '<h2 class="mt-4">Manejo</h2>
                <p style="color: #fff; background-color: #343a40;">Não há registros de manutenção para este animal.</p>';
        }

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('relatorio_animal.pdf', 'I');
    } else {
        echo 'Animal não encontrado.';
    }
} else {
    echo 'ID do animal não fornecido.';
}
?>
