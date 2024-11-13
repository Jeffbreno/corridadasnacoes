<?php
require_once '../session.php';

define("FPDF_FONTPATH", "fpdf/font/");
require_once("fpdf/fpdf.php");

class PDF extends FPDF
{

    function CabecalhoNovo()
    {
        // $ini = parse_ini_file('../config.ini');
        // $habilitarBloco = $ini['habilitarBloco'];
        // $nomeBloco = $ini['nomebloco'];
        // $nomeUnidade = $ini['nomeUnidade'];
        // $this->Ln(10);
        //        $this->SetFont("Arial", "B", 8);
        //        if ($habilitarBloco) {
        //            $this->Cell(15, 8, $nomeBloco, 1, 0, 'A');
        //            $this->Cell(18, 8, $nomeUnidade, 1, 0, 'A');
        //        } else {
        //            $this->Cell(18, 8, $nomeUnidade, 1, 0, 'A');
        //        }
        //        $this->Cell(75, 8, "Voto", 1, 0, 'A');
        //        $this->Cell(35, 8, "Data voto", 1, 0, 'A');
        //        $this->Cell(35, 8, utf8_decode("Data alteração voto"), 1, 1, 'A');
    }

    function Header()
    {
        $this->SetFont('Arial', '', 7);
        $this->Cell(195, 7, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 1, 'R');
        $this->Image('logo.png', 0, 1, 50);
        $this->Ln(3);
        // if ($this->PageNo() > 1) {
        //     $this->CabecalhoNovo();
        // }
    }

    function Footer()
    {
        $this->ln(5);
        $this->SetFont("Arial", "B", 7);
        $this->Cell(0, 5, "ECOCIL ECOVILLE CONDOMINIO CLUBE - CNPJ: 25.341.634/0001-39", 0, 0);
        $this->ln();
        $this->Cell(0, 5, utf8_decode("Endereço: Av. Olavo Lacerda Montenegro, 2600 - Parque das Nacoes, Parnamirim - RN, 59148-902"), 0, 0);
    }
}

#ID DA PAUTA
$id_pauta = $_GET['idPauta'];

$sql = mysql_query(""
    . "SELECT distinct p.titulo_pau, "
    . "v.id, "
    . "v.id_opc_vot as voto, "
    . "date_format(v.data_cadastro_vot, '%d/%m/%Y %H:%i' ) as datacadastro, "
    . "date_format(v.data_alteracao_vot, '%d/%m/%Y %H:%i' ) as dataalteracao, "
    . "u.id_usu, u.nome_usu as usuario, "
    . "u.bloco_usu, "
    . "u.apt_casa_usu, "
    . "o.desc_opc, "
    . "(SELECT count(*) FROM voto v1 "
    . "INNER JOIN opcao o1 ON o1.id_opc = v1.id_opc_vot "
    . "INNER JOIN pauta p1 ON p1.id_pau = o1.id_pau_opc "
    . "WHERE md5(p1.id_pau) = '$id_pauta') as total "
    . "FROM pauta p "
    . "INNER JOIN opcao o ON o.id_pau_opc = p.id_pau "
    . "INNER JOIN voto v ON v.id_opc_vot = o.id_opc "
    . "LEFT JOIN usuario u ON u.id_usu = v.id_usu_vot "
    . "WHERE md5(p.id_pau) = '$id_pauta'");

$sql2 = mysql_query(""
    . "SELECT count(*) as votos, "
    . "id, "
    . "p1.titulo_pau, "
    . "o1.desc_opc, "
    . "(SELECT count(*) FROM voto v1 "
    . "INNER JOIN opcao o1 ON o1.id_opc = v1.id_opc_vot "
    . "INNER JOIN pauta p1 ON p1.id_pau = o1.id_pau_opc "
    . "WHERE md5(p1.id_pau) = '$id_pauta') as total "
    . "FROM voto v1 "
    . "INNER JOIN opcao o1 ON o1.id_opc = v1.id_opc_vot "
    . "INNER JOIN pauta p1 ON p1.id_pau = o1.id_pau_opc "
    . "WHERE md5(p1.id_pau) = '$id_pauta' "
    . "GROUP BY id_opc_vot ORDER BY votos desc LIMIT 1");

$row = mysql_num_rows($sql);

#VERIFICA SE RETORNOU ALGUMA LINHA
if (!$row) {
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '	<head>';
    echo '		<meta charset="UTF-8">';
    echo '		<link href="css/login.css" rel="stylesheet" type="text/css">';
    echo '		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">';
    echo '		<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css"> ';
    echo '		<script type="text/javascript" src="../js/jquery.js"></script>';
    echo '		<script type="text/javascript" src="../js/jquery-ui.js"></script>';

    echo '		<title>SISCON</title>';
    echo '		<script type="text/javascript">';
    echo '				$(function () {';
    echo '					$("#dialog-message").dialog({';
    echo '						position: {my: "left-120", at: "top+300"},';
    echo '						modal: true,';
    echo '						title: "INFORMAÇÃO!",';
    echo '						buttons: {';
    echo '							Ok: function () {';
    echo '								self.close();';
    echo '							}';
    echo '						}';
    echo '					});';
    echo '				});';

    echo '		</script>';
    echo '	</head>';
    echo '	<body>';
    echo '		<div id="dialog-message">';
    echo '			<font color="#FF0000">NÃO EXISTE REGISTROS DE VOTOS COMPUTADOS</font></p>';
    echo '		</div>';
    echo '	</body>';
    echo '</html>';
    exit;
}

#PREPARA PARA GERAR O PDF
$pdf = new PDF();
$pdf->Open();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetTitle(utf8_decode('Relatório de votação analítico'));

#MONTA O CABEÇALHO      
#TITULO DO RELATÓRIO        
$pdf->SetFont("Arial", "B", 8);
$pdf->Cell(0, 5, utf8_decode("RELATÓRIO DE VOTAÇÃO"), 0, 0, 'C');

$info = mysql_fetch_array($sql2);
$titulo_pauta = $info['titulo_pau'];
$total = $info['total'];
$desc = $info['desc_opc'];
$votos = $info['votos'];

$pdf->Ln(20);
$pdf->Text(165, 35, "Total de votos: " . $total);
$pdf->MultiCell(180, 5, "Pauta: " . utf8_decode($titulo_pauta));
$pdf->Ln(5);
// $pdf->Cell(0, 5, utf8_decode(mb_strtoupper("Opção mais votada : " . $desc)), 0, 1);
$pdf->Cell(0, 5, $pdf->MultiCell(0, $altura, utf8_decode(mb_strtoupper("Opção mais votada : " . $desc))), 0, 1);
$pdf->Cell(0, 5, "Quantidade de votos: " . $votos, 0, 1);
$pdf->Ln(5);

$altura = 6;
$pdf->SetFont("Arial", "B", 8);
$pdf->Cell(30);
if ($habilitarBloco) {
    $pdf->Cell(20, $altura, $nomeBloco, 1, 0, 'A');
    $pdf->Cell(20, $altura, $nomeUnidade, 1, 0, 'A');
} else {
    $pdf->Cell(20, $altura, "Unidade", 1, 0, 'A');
}
// $pdf->Cell(40, $altura, "Data do voto", 1, 0, 'A');
$pdf->Cell(80, $altura, utf8_decode("Opção de voto"), 1, 1, 'A');

$pdf->SetFont("Arial", "", 8);

while ($view_votos = mysql_fetch_array($sql)) {
    $pdf->Cell(30);
    if ($habilitarBloco) {
        $pdf->Cell(20, $altura, $view_votos['bloco_usu'], 1, 0, 'L');
        $pdf->Cell(20, $altura, $view_votos['apt_casa_usu'], 1, 0, 'L');
    } else {
        $pdf->Cell(20, $altura, $view_votos['apt_casa_usu'], 1, 0, 'L');
    }

    // $pdf->Cell(80, $altura, $pdf->MultiCell(80, $altura, html_entity_decode(strip_tags(utf8_decode(mb_strtoupper($view_votos['desc_opc']))), ENT_QUOTES, "ISO-8859-1"), 'J', 1), 1, 0, 'A', false);
    $pdf->SetX(80); // abscissa of Horizontal position 
    // $pdf->Cell(40, $altura, $view_votos['datacadastro'], 1, 0, 'A');
    $pdf->MultiCell(80, $altura, html_entity_decode(strip_tags(utf8_decode(mb_strtoupper($view_votos['desc_opc']))), ENT_QUOTES, "ISO-8859-1"), 1, 'L');
}
$pdf->ln();

$pdf->Output('lista_de_votos_analitica' . date('YmdHis') . '.pdf', 'I');
