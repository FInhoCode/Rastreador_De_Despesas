<?php

/**
 * 
 * Função responsável por 2 papeis: verificar orçamento caso receba valor no parâmetro, ou adicionar orçamento por mês caso não receba um array das despesas.
 * 
 * @param array|null $custo Refere-se as variáveis de custo no escopo da função de visualizar.
 * 
 * @global array $meses_do_ano Refere-se ao array no escopo global no controller.
 * 
 * @return bool $orcamento_ultrapassado true se a média dos valores das despesas for maior que a média do orçamento.
 * 
 * @return void É exibido uma mensagem de nenhum orçamento disponível caso não tenha valor na propriedade orçamento quando tentar verificar orçamento. E em caso do usuário por novo orçamento, se sucesso, lhe é exibido a mensagem de sucesso.
 * 
 */
function orcamento(array $custo = null)
{
    global $meses_do_ano;

    if ($dados = verificar_json()) {
        // Verifica se o orçamento foi ultrapassado.
        if ($custo) {
            if ($dados->orcamento) {

                // O objeto no atributo orçamento é convertido para array para a soma dos valores através da função interna array_sum.
                $orcamento = (array) $dados->orcamento;

                // Verifica se o array tem mais de um elemento(Porque 2 das 3 variáveis de custo na função visualizar possuem 12 elementos). Se não tiver, verifica se o orcamento para um mês específico é menor que o custo das despesas neste mesmo mês.
                if (count($custo) > 1) {

                    $orcamento_ultrapassado = array_sum($custo) / count($custo) > array_sum($orcamento) / count($orcamento) ? true : false;

                    return $orcamento_ultrapassado ? "Em média, suas despesas ultrapassam o seu orçamento.":false;

                }else{

                    // Verifica se o valor da despesa é maior do que a média do orçamento. Foi utilizado a função key para retornar o valor do custo independente se o array é associativo ou indexado.
                    $orcamento_ultrapassado = $custo[key($custo)] > array_sum($orcamento) / count($orcamento) ? true:false;

                    return $orcamento_ultrapassado ? "Em média, sua despesa ultrapassa o seu orçamento.":false;

                }

            } else {
                return "Nenhum orçamento disponível para verificação. Adicione um orçamento e tente novamente. ";
            }
        } else {
            // Adiciona o orçamento por mês
            $total_orcamento = [];

            foreach ($meses_do_ano as $mes) {

                $orcamento = readline("Qual o seu orçamento para o mês de $mes ? ");

                settype($orcamento, 'float') && $orcamento > 0 ? $orcamento_mes = $orcamento : $orcamento_mes = 0;

                $total_orcamento[] = $orcamento_mes;
            }

            $orcamento = array_combine($meses_do_ano, $total_orcamento);

            $dados->orcamento = $orcamento;

            file_put_contents('dados.json', json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            echo "Orçamento adicionado com sucesso !";
        }
    }
}
