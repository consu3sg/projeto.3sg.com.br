<?php

/**
 * Description of HomeController
 *
 * @author Guilherme Oliveira Toccacelli
 */
class EmissaoRelatorioController extends Object {

    private $message = 'Selecione o arquivo XML com os dados dos contribuintes para emissão do relatório.';
    private $alertType = 'info';
    private $lstContribuinte = null;

    public function __construct() {
        parent::__construct();
        if (isset($_POST['emissao'])) {
            $this->emitirRelatorio();
        }
    }

    /**
     * Método calcula o Valor Venal Territorial do contribuinte informado
     * @param type $contribuinte
     * @return type
     */
    public static function calcVenalTerritorial($contribuinte) {
        return $contribuinte->area_terreno * $contribuinte->zona;
    }

    /**
     * Método calcula o Valor Venal Predial do contribuinte informado
     * @param type $contribuinte
     * @return type
     */
    public static function calcVenalPredial($contribuinte) {
        return $contribuinte->area_construida * $contribuinte->secao;
    }

    /**
     * Calcula o débito do contribuinte informado
     * @param type $contribuinte
     * @return string
     */
    public static function calcCobranca($contribuinte) {
        try {


            if (!isset($contribuinte->cobranca->taxa)) {
                //Sem Taxa a ser calculado
                return "N/A";
            }
            if (isset($contribuinte->cobranca->taxa[0]) && isset($contribuinte->cobranca->taxa[1])) {
                $taxa1 = $contribuinte->cobranca->taxa[0]->valor;
                $taxa2 = $contribuinte->cobranca->taxa[1]->valor;
                if ($taxa2 == 0) {
                    //Divisão por Zero
                    return "Não é possível calcular";
                }
                $a = floatval($taxa1) / floatval($taxa2);
            } else {
                $a = 0;
            }
            if (isset($contribuinte->cobranca->taxa[2])) {
                $taxa3 = $contribuinte->cobranca->taxa[2]->valor;
                $b = $taxa3 * self::calcVenalPredial($contribuinte);
            } else {
                $b = 0;
            }
            if ($contribuinte->area_construida == 0) {
                if (!isset($contribuinte->cobranca->taxa[3])) {
                    return "Taxa 4 não informado...";
                }
                $taxa4 = $contribuinte->cobranca->taxa[3]->valor;
                $c = $taxa4 * self::calcVenalTerritorial($contribuinte);
            } else {
                $c = 0;
            }
            return 'R$ ' . number_format(($a + $b + $c), 2, ',', '.');
        } catch (Exception $ex) {
            return "Valores inválidos...";
        }
        
    }
   
    /**
     * Método responsável pela emissão do relatório
     */
    private function emitirRelatorio() {
        try {
            if (!$_FILES["file"]["error"]) {
                $xml = file_get_contents($_FILES['file']['tmp_name']);
                if (is_xml($xml)) {
                    $this->lstContribuinte = simplexml_load_string($xml);
                    $this->message = 'Perfeito! Aguarde alguns segundos...';
                    $this->alertType = 'success';
                } else {
                    $this->message = 'Oops... Parece que o arquivo enviado é um XML corrompido!';
                    $this->alertType = 'danger';
                }
            } else {
                $this->message = 'Oops... Parece que o arquivo enviado é inválido!';
                $this->alertType = 'danger';
            }
        } catch (Exception $ex) {
            $this->message = 'Oops... Erro inesperado. Contate o departamento de Sistemas!';
            $this->alertType = 'danger';
        }
    }

    //GETTERS AND SETTERS//
    function getMessage() {
        return $this->message;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function getAlertType() {
        return $this->alertType;
    }

    function setAlertType($alertType) {
        $this->alertType = $alertType;
    }

    function getLstContribuinte() {
        return $this->lstContribuinte;
    }

    function setLstContribuinte($lstContribuinte) {
        $this->lstContribuinte = $lstContribuinte;
    }

}
