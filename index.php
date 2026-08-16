<?php

require 'controller.php';

// Sistema CLI Rastreador_De_Despesas

do{

echo "Olá, qual operação deseja ? Digite: \n";
echo "add - para adicionar despesa(s)" . PHP_EOL . "upd - para atualizar despesa(s)" . PHP_EOL . "d - para deletar despesa(s)" . PHP_EOL .  "v - para visualizar despesa(s)" . PHP_EOL . "orc - para definir orçamento\n";

$operacao = readline("Operação: ");

mb_strlen($operacao) ? print operacao($operacao) : print "Nenhuma operação foi digitada, tente novamente.";

echo PHP_EOL;

$parada = readline("Deseja tentar novamente ? Se sim, digite: s  ");

$parada = $parada == "s" ? true:false;

}while($parada);