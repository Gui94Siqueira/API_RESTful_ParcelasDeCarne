<?php
class ModelCarne {
    private $valor_total;
    private $qtd_parcelas;
    private $data_primeiro_vencimento;
    private $periodicidade;
    private $valor_entrada;

    public function __construct($valor_total, $qtd_parcelas, $data_primeiro_vencimento, $periodicidade, $valor_entrada) {
        $this->valor_total = $valor_total;
        $this->qtd_parcelas = $qtd_parcelas;
        $this->data_primeiro_vencimento = $data_primeiro_vencimento;
        $this->periodicidade = $periodicidade;
        $this->valor_entrada = $valor_entrada;
    }

    public function getValorTotal() {
        return $this->valor_total;
    }

    public function setValorTotal($valorTotal) {
        $this->valor_total = $valorTotal;
    }

    public function getQtd_parcelas() {
        return $this->qtd_parcelas;
    }

    public function setQtd_parcelas($qtd_parcelas) {
        $this->qtd_parcelas = $qtd_parcelas;
    }

    public function getDataPrimeiro_vencimento() {
        return $this->data_primeiro_vencimento;
    }

    public function setDataPrimeiro_vencimento($data_primeiro_vencimento) {
        $this->data_primeiro_vencimento = $data_primeiro_vencimento;
    }

    public function getPeriodicidate() {
        return $this->periodicidade;
    }

    public function setPeriodicidade($periodicidade) {
        $this->periodicidade = $periodicidade;
    }

    public function getValorEntrada() {
        return $this->valor_entrada;
    }

    public function setValorEntrada($valorEntrada){
        $this->valor_entrada = $valorEntrada;
    }
}