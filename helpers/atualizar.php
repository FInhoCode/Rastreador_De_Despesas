<?php
/**
 * 
 * Função responsável por alterar os registros das despesas.
 * 
 * @param int $id Índice da despesa registrada.
 * 
 * @param string $categoria Tipo de despeza. Seu valor é passado com algum dos valores presentes no array $categoriasDespesas no escopo da função operacao().
 * 
 * @param string $descricao Nova descrição para a despesa especificada no $id.
 * 
 * @param float $valor Novo valor para a despesa especificada no $id.
 * 
 * @var object $dados Json convertido no Objeto php.
 * 
 * @return string Mensagem de sucesso ou de erro ao verificar o id.
 * 
 */
function atualizar(int $id, string $descricao = null, string $categoria, float $valor = 0)
{
    if ($dados = verificar_json()) {
        if (array_key_exists($id, $dados->despesas)) {

            foreach ($dados->despesas as $chave => $despesa) {

                if ($id == $chave) {

                    $despesa->descricao = $descricao;
                    $despesa->valor = $valor;
                    $despesa->categoria = $categoria;

                    file_put_contents('dados.json', json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

                    return "Despesa atualizada com sucesso !";
                }
            }

        } else {

            var_dump($id);
            return "id da despesa incorreto, tente novamente.";
            
        }
    }
}