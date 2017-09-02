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
          <tr tr align=center class=active>
            <th>ID</th>
            <th>CLIENTE</th>
            <th>PRODUTO</th>
            <th>QUANTIDADE</th>
            <th>STATUS</th>
           
          </tr>
          
";

foreach($venda as $vendas):
$pagina .= "
         
          <tr  align=center class=active>
            <th >$vendas->id</th>
            <th>$vendas->cliente</th>
            <th>$vendas->produto</th>
            <th>$vendas->quantidade</th>
            <th>$vendas->status</th>
            
          </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "r_clientes.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>

