<?php

require 'helpers/verificar_json.php';
require 'helpers/adicionar.php';
require 'helpers/deletar.php';
require 'helpers/visualizar.php';
require 'helpers/atualizar.php';
require 'helpers/orcamento.php';

$categoriasDespesas = [
    'Moradia',
    'Alimentação',
    'Transporte',
    'Saúde',
    'Educação',
    'Lazer',
    'Vestuário',
    'Serviços Financeiros',
    'Outros'
];

$meses_do_ano = [
    "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "Dezembro"
];

/**
 * 
 * Função responsável por chamar as funções no helpers a depender da operação desejada, e passa seus respectivos argumentos com os valores sanitizados.
 * 
 * @param string $operacao aqui é passado a operação desejada pelo usuário. Operações: add(adicionar), upd(atualizar), d(deletar, v(visualizar).
 * 
 * @var string $descricao nome ou detalhamento da despesa. Ex: Vestimenta, Boleto atrasado e etc.
 * 
 * @var float $valor custo da despesa.
 * 
 * @global array $categoriasDespesas tipos de categorias. Seus valores serão de uso para argumentar as funções do helpers(adicionar e atualizar).
 * 
 * @var int $id_categoria representa o que seria o índice do array $categoriasDespesas.
 * 
 * @var int $id índice do registro/despesa. Seu valor é somado para exibição ao usuário, em seguida é subtraído ao passar para alguma função. Isto é feito para que o usuário tenha melhor experiência interativa.
 * 
 * @return void O resultado das operações é exibido no index.
 * 
 */
function operacao(string $operacao): void
{

    global $categoriasDespesas;

    switch ($operacao) {

        case "add":

            echo "Informe as seguintes informações:\n";

            $descricao = readline("Descrição da despesa: ");
            $valor = readline("Valor da despesa: ");

            foreach ($categoriasDespesas as $id => $cat) {
                echo "id: " . $id + 1 . " - categoria: $cat \n";
            }

            $id_categoria = readline("Digite o id de alguma das categorias acima que corresponde a sua despesa: ");

            if (mb_strlen($descricao) && settype($valor, "float")) {
                if (settype($id_categoria, 'int')) {

                    $id_categoria--;

                    if (array_key_exists($id_categoria, $categoriasDespesas)) {

                        $categoria = $categoriasDespesas[$id_categoria];
                        echo adicionar($descricao, $categoria, $valor);

                    } else {
                        echo "Este id para categoria não existe. Tente novamente.";
                    }
                } else {
                    echo "Valor não numérico para id da categoria ou não existe. Tente novamente.";
                }
            } else {
                echo "Informação(ões) de id e/ou valor está(ão) incorreta(ão). Tente novamente.";
            }

            break;

        case "upd":

            echo "Informe as seguintes informações:\n";

            $id = readline('Digite o id da despesa: ');
            $descricao = readline('Digite a nova descrição: ');
            $valor = readline('Digite o novo valor: ');

            foreach ($categoriasDespesas as $id_c => $cat) {
                echo "id: " . $id_c + 1 . " - categoria: $cat \n";
            }

            $id_categoria = readline('Digite o id de alguma das categorias acima para a nova categoria da despesa: ');

            if (settype($id, 'int') && settype($valor, 'float')) {
                if(settype($id_categoria, 'int')){

                    $id_categoria--;

                    if(array_key_exists($id_categoria, $categoriasDespesas))
                    {

                        $id--;

                        $categoria = $categoriasDespesas[$id_categoria];
                        echo atualizar($id, $descricao, $categoria, $valor);

                    }else{
                        echo "Este id para categoria não existe. Tente novamente.";
                    }
                }else{
                    echo "Valor não numérico para id da categoria. Tente novamente.";
                }
            } else {
                echo "Informação(ões) de id e/ou valor está(ão) incorreta(ão). Tente novamente.";
            }

            break;

        case "d":

            $id = readline("Digite o id da despesa registrada: ");

            if (settype($id, "int")) {

                $id--;

                echo deletar($id);

            } else {
                echo "Informação incorreta. Tente novamente.";
            }

            break;

        case "v":

            echo "Informe a opção para visualização das depesas.\n";
            echo "todas - exibe todas despesas" . PHP_EOL . "resumo - exibe o resumo de todas despesas" . PHP_EOL . "rsMes - resumo das despesas do mês em específico do ano atual.\n";

            $opcao = readline("Opção: ");

            if (mb_strlen($opcao)) {

                visualizar($opcao);

            } else {
                echo "Informações vazias ou incorretas, tente novamente.";
            }

            break;

        case "orc":

            orcamento();

            break;

        default:

            echo "Operação inválida ! tente novamente.";

            break;
    }
}
