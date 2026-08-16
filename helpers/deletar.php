<?php
/**
 * 
 * Função responsável por apagar os registros das despesas.
 * 
 * @param int $id Índice da despesa registrada.
 * 
 * @var object $dados Json convertido no Objeto php.
 * 
 * @return string Mensagem de sucesso ou falha ao verificar o id.
 * 
 */
function deletar(int $id)
{
    if ($dados = verificar_json()) {
        if (array_key_exists($id, $dados->despesas)) {
            unset($dados->despesas[$id]);

            $dados->despesas = array_values($dados->despesas);

            file_put_contents('dados.json', json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            return "Despesa apagada com sucesso !";

        } else {

            return "O id da despesa informado está incorreto ou não existe. Tente novamente.";

        }
    }
}