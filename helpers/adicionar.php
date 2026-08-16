<?php
/**
 * 
 * Função responsável por registrar as despesas no arquivo json.
 * 
 * @param string $descricao Nome ou detalhamento da despesa. Ex: Vestimenta, Boleto atrasado e etc.
 * 
 * @param string $categoria Tipo de despeza. Seu valor é passado com algum dos valores presentes no array $categoriasDespesas no escopo da função operacao().
 * 
 * @param float $valor Custo da despesa.
 * 
 * @var object $dados_php Objeto php que recebe em seu atributo despesas(que é um array) o array com os dados da despesa para que posteriormente seja enviado para o arquivo json através da função file_put_contents() tendo como segundo a função json_encode() para converter a variável php em json. OBS: 1 - O array dados é convertido em objeto por ser associativo. 2 - As constantes argumentadas na função json_encode() servem para o php não escapar caracteres ao registrar.
 * 
 * @var array $dados Array associativo que, além dos valores dos parâmetros, também armazena a data em que o registro da despesa é feito através da classe DateTime, onde neste caso recebe como segundo argumento a classe DateTimeZone para definição do fuso horário da cidade do Recife.
 * 
 * @return string Mensagem de sucesso com id da última despesa registrada que é somada com 1 opcionalmente para melhor experiência interativa para o usuário.
 * 
 */
function adicionar(string $descricao,string $categoria, float $valor)
{
    if ($dados_php = verificar_json()) {

        $dados = ['data' => (new DateTime(timezone: new DateTimeZone('America/Recife')))->format("d/m/Y"), 'descricao' => $descricao, 'valor' => $valor, 'categoria' => $categoria];

        array_push($dados_php->despesas, $dados);

        file_put_contents('dados.json', json_encode($dados_php, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        return "Despesa registrada com sucesso !" . " id da despesa registrada: " . array_key_last($dados_php->despesas) + 1;
    }
}