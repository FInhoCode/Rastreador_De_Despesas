<?php
/**
 * 
 * Função responsável por verificar a existência e validade do arquivo json para conversão do conteúdo para uma variável do tipo objeto no php.
 * 
 * @var string|false $conteudo_json responsável por receber o conteúdo do json, se sucesso, o mesmo é retornado.
 * 
 * @return object $conteudo_json json convertido em objeto php.
 * 
 * @return false falha na tentativa de conversão.
 * 
 */
function verificar_json()
{
    if (file_exists('dados.json')) {
        $conteudo_json = file_get_contents('dados.json');

        if ($conteudo_json) {
            $conteudo_json = json_decode($conteudo_json);

            if (json_last_error() === JSON_ERROR_NONE && is_object($conteudo_json)) {

                return $conteudo_json;
                
            } else {

                echo "Falha no arquivo JSON, verifique-o e tente novamente.";

                return false;
            }
        }
    }
}