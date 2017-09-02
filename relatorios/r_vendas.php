<?php
require '../conexao.php';
include ('../pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT id, cliente, produto,quantidade, status, data  FROM tab_vendas';
	$stm = $conexao->prepare($sql);
	$stm->execute();
	$venda = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1>RELATÓRIO DE VENDAS</h1>";

$pagina .= "
        <table class=table table-striped width=100% >
          <tr class=active>
            <th>ID</th>
            <th>CLIENTE</th>
            <th>PRODUTO</th>
            <th>QUANTIDADE</th>
            <th>STATUS</th>
           
          </tr>
";

foreach($venda as $vendas):
$pagina .= "
          <tr>
            <td>$vendas->id</td>
            <td>$vendas->cliente</td>
            <td>$vendas->produto</td>
            <td>$vendas->quantidade</td>
            <td>$vendas->status</td>
            
          </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "r_clientes.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>

