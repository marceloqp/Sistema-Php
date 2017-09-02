<?php
require '../conexao.php';
include ('../pdf/mpdf.php');

$conexao = conexao::getInstance();
$sql = 'SELECT id, nome, email, celular, status, foto FROM tab_clientes';
$stm = $conexao->prepare($sql);
$stm->execute();
$clientes = $stm->fetchAll(PDO::FETCH_OBJ);

$pagina = "";

$pagina .= "<h1>RELATÓRIO DE CLIENTES</h1>";

$pagina .= "
        <table class=table table-striped width=100% >
          <tr align='center' >
            <th>Nome</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th>Status</th>
           
          </tr>
";

foreach($clientes as $cliente):
$pagina .= "
          
          <tr align='center'>
            <th>$cliente->nome</th>
            <th>$cliente->email</th>
            <th>$cliente->celular</th>
            <th>$cliente->status</th>
            
          </tr>
";

endforeach;

$pagina .= "</table>";

$arquivo = "r_clientes.pdf";

$mpdf = new mPDF();

$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

?>