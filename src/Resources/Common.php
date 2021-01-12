<?php

declare(strict_types = 1);

namespace Customer\Resources;

class Common
{
    public static function convertDateToDataBase(string $date)
    {
        $aux = explode('/', $date);
        $aux = $aux[2] . '-' . $aux[1] . '-' . $aux[0];
        $dateTime = new \DateTime($aux, new \DateTimezone("America/Sao_Paulo"));
        return $dateTime->format('Y-m-d');
    }
    
    public static function convertDateToView(string $date, string $format = 'd/m/Y')
    {
        $dateTime = new \DateTime($date, new \DateTimezone("America/Sao_Paulo"));
        return $dateTime->format($format);
    }

    public static function listStates()
    {
        $return = RequestAPI::sendRequest('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
        return $return;
    }

    public static function listCities()
    {
        $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
        $return = RequestAPI::sendRequest("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios");
        return $return;
    }

    public static function returnOnlyNumbers(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function cpfFormatter(?string $cpf): ?string
    {
 
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $qtd = strlen($cpf);

        if($qtd >= 11) {

            if($qtd === 11 ) {

               return substr($cpf, 0, 3) . '.' .
                                substr($cpf, 3, 3) . '.' .
                                substr($cpf, 6, 3) . '-' .
                                substr($cpf, 9, 2);
            }
        }
        return null;
    }
}