<?php

require '../conexao.php';
include ('../pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT id, nome, quantidade, preco FROM tab_produtos';
$stm = $conexao->prepare($sql);
$stm->execute();
$produtos = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1>RELATÓRIO DE PRODUTOS</h1>";

$pagina .= "
        <table align=left class=table table-striped width=100% >
          <tr class=active>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço</th>
           
           
          </tr>
";

foreach($produtos as $produto):
$pagina .= "
          <tr  align=left class=active>
            <th>$produto->nome</th>
            <th>$produto->quantidade</th>
            <th>$produto->preco</th>
           
            
          </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "r_produtos.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>