<?php
/**
 * 
 * Função reponsável por exibir as despesas como o usuário solicitar no controller.
 * 
 * @param string $opcao Forma em que o usuário quer visualizar os registros.
 * 
 * @var string $ano_atual Armazena o ano atual através da classe DateTime com fuso horário da cidade do Recide.
 * 
 * @global array $categoriasDespesas Refere-se ao array no escopo global do controller.
 * 
 * @global array $meses_do_ano Refere-se ao array no escopo global do controller.
 * 
 * @var array $despesas_do_ano Array responsável por armazenar os custos de cada mês.
 * 
 * @var array $total_categorias Array responsável por armazenar os valores por categoria.
 * 
 * @var int $chave Índice dos registros. Seu valor é incrementado opcionalmente para melhor experiência interativa para o usuário.
 * 
 * @return void Exibe os resultados quando chamado.
 * 
 */
function visualizar(string $opcao)
{
    $ano_atual = (new DateTime(timezone: new DateTimeZone('America/Recife')))->format('Y');

    global $categoriasDespesas;

    global $meses_do_ano;

    $despesas_do_ano = [];

    $total_categorias = [];

    if ($dados = verificar_json()) {
        if (isset($dados->despesas)) {

            switch ($opcao) {

                case "todas":

                    $valores = [];

                    foreach ($dados->despesas as $chave => $despesa) {

                        $chave++;

                        echo "id: $chave | descrição: {$despesa->descricao} | valor: R$ " . number_format($despesa->valor, 2, ',', '.') . " | data: {$despesa->data} | categoria: {$despesa->categoria}\n";

                        $valores[] += $despesa->valor;
                    }

                    echo "-------------------\n";
                    if($resultado = orcamento($valores)) echo $resultado;

                    break;

                case "resumo":
                    
                    // Verifica os valores por mês de cada despesa, somando-as, em seguida são agrupadas num array referente ao seu mês.

                    for ($m = 1; $m <= 12; $m++) {

                        $total_mês = 0;

                        $mes = $m < 10 ? "/0$m/" : "/$m/";

                        foreach ($dados->despesas as $despesa) {

                            if (str_contains($despesa->data, $mes)) $total_mês += $despesa->valor;

                        }

                        $despesas_do_ano[] = $total_mês;

                    }

                    $custo_mes = array_combine($meses_do_ano, $despesas_do_ano);
                    
                    echo "-------------------\n";
                    echo "Custo total por mês:\n";

                    foreach ($custo_mes as $mes => $custo_total) {
                        echo "$mes: R$ " . number_format($custo_total, 2, ',', '.') . PHP_EOL;
                    }
                    
                    // Verifica a soma dos valores por categoria. Em seguida são agrupadas num array referente as suas respectivas categorias. $categoriasDespesas as $categoria

                    foreach ($categoriasDespesas as $categoria){

                        $total_categoria = 0;

                        foreach($dados->despesas as $despesa){

                            if($despesa->categoria == $categoria) $total_categoria += $despesa->valor;

                        }

                        $total_categorias[] = $total_categoria;

                    }

                    $custo_categoria = array_combine($categoriasDespesas, $total_categorias);

                    echo "-------------------\n";
                    echo "Custo total por categoria:\n";

                    foreach($custo_categoria as $categoria => $total){
                        echo "$categoria: R$ " . number_format($total, 2, ',', '.') . PHP_EOL;
                    }
                    
                    // Exibe a soma do valor de todas as despesas.

                    echo "-------------------\n";
                    echo "Custo total em despesas: R$ " . number_format(array_sum($custo_mes), 2, ',', '.') . PHP_EOL;
                    echo "-------------------\n";

                    if($resultado = orcamento($custo_mes)) echo $resultado;

                    break;

                case "rsMes":

                    $mes = readline('Mês para resumo(Digite entre 1 e 12) ');

                    if (settype($mes, "int") && ($mes >= 1 && $mes <= 12)) {

                        $total_mês = 0;

                        $despesas_do_mes = [];

                        $total_categorias = [];

                        // Soma todos os valores das despesas do mês do ano atual solicitado pelo usuário. E em seguida passa as despesas deste período para um array que será usado usado para agrupamento dos valores do mês pelas suas respectivas categorias.
                        foreach ($dados->despesas as $despesa) {

                            if (str_contains($despesa->data, "$mes/$ano_atual")){

                                $total_mês += $despesa->valor;

                                $despesas_do_mes[] = $despesa;

                            }

                        }

                        $custo_total = $total_mês;

                        foreach($categoriasDespesas as $categoria){

                            $total_categoria = 0;

                            foreach($despesas_do_mes as $despesa_mes){

                                if($despesa_mes->categoria == $categoria) $total_categoria += $despesa_mes->valor;

                            }

                            $total_categorias[] = $total_categoria;

                        }

                        $custo_categoria = array_combine($categoriasDespesas, $total_categorias);

                        echo "-------------------\n";
                        echo "Custo total por categoria: \n";

                        foreach($custo_categoria as $categoria => $valor_cat){
                            echo "$categoria: R$ " . number_format($valor_cat, 2, ',', '.') . PHP_EOL;
                        }

                        $mes--; // É decrementado para acesso ao índice do array.

                        echo "-------------------\n";
                        echo "Custo total em despesas no mês de {$meses_do_ano[$mes]}: R$ " . number_format($custo_total, 2, ',', '.') . PHP_EOL;

                        $comparacao_custo = [$meses_do_ano[$mes] => $custo_total];

                        echo "-------------------\n";
                        if($resultado = orcamento($comparacao_custo)) echo $resultado;

                    } else {
                        echo "Valor não numérico ou mês inexistente. Tente novamtente.";
                    }
                    break;

                default:
                    echo "Opção incorreta. Tente novamente.";
                    break;
            }
            
        } else {
            echo "Nenhuma despesa registrada. Registre nova(s) despesa(s) e tente novamente.";
        }
    }
}
