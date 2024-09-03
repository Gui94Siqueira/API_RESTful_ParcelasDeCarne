<?php
class ModelCarne implements JsonSerializable {
    private $id;
    private $valor_total;
    private $qtd_parcelas;
    private $data_primeiro_vencimento;
    private $periodicidade;
    private $valor_entrada;

    public function __construct($id, $valor_total, $qtd_parcelas, $data_primeiro_vencimento, $periodicidade, $valor_entrada) {
        $this->id = $id;
        $this->valor_total = $valor_total;
        $this->qtd_parcelas = $qtd_parcelas;
        $this->data_primeiro_vencimento = $data_primeiro_vencimento;
        $this->periodicidade = $periodicidade;
        $this->valor_entrada = $valor_entrada;
    }

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    public function getValorTotal() { return $this->valor_total; }

    public function setValorTotal($valorTotal) { $this->valor_total = $valorTotal; }

    public function getQtd_parcelas() { return $this->qtd_parcelas; }

    public function setQtd_parcelas($qtd_parcelas) { $this->qtd_parcelas = $qtd_parcelas; }

    public function getDataPrimeiro_vencimento() { return $this->data_primeiro_vencimento; }

    public function setDataPrimeiro_vencimento($data_primeiro_vencimento) { $this->data_primeiro_vencimento = $data_primeiro_vencimento; }

    public function getPeriodicidate() { return $this->periodicidade; }

    public function setPeriodicidade($periodicidade) { $this->periodicidade = $periodicidade; }

    public function getValorEntrada() { return $this->valor_entrada; }

    public function setValorEntrada($valorEntrada){ $this->valor_entrada = $valorEntrada; }

    private function calcularParcelas() {
        $parcelas = [];
        $valor_restante = $this->valor_total - $this->valor_entrada;
        $valor_parcela = $this->qtd_parcelas > 0 ? $valor_restante / $this->qtd_parcelas : 0;
        $data_vencimento = new DateTime($this->data_primeiro_vencimento);

        // Adiciona a entrada como primeira parcela, se existir
        if ($this->valor_entrada > 0) {
            $parcelas[] = [
                'data_vencimento' => $data_vencimento->format('Y-m-d'),
                'valor' => $this->valor_entrada,
                'numero' => 1,
                'entrada' => true
            ];
        }

        
        // Adiciona as parcelas restantes
        for ($i = 0; $i < $this->qtd_parcelas; $i++) {
            // Define o incremento com base na periodicidade
            if ($i > 0 || $this->valor_entrada > 0) {
                if ($this->periodicidade === 'mensal') {
                    $data_vencimento->modify('+1 month');
                } elseif ($this->periodicidade === 'semanal') {
                    $data_vencimento->modify('+1 week');
                }
            }

            $parcelas[] = [
                'data_vencimento' => $data_vencimento->format('Y-m-d'),
                'valor' => $valor_parcela,
                'numero' => count($parcelas) + 1,
                'entrada' => false
            ];
        }

        return $parcelas;
    }


    public function jsonSerialize(): array {
        return [
            'total' => $this->valor_total,
            'valor_entrada' => $this->valor_entrada,
            'parcelas' => $this->calcularParcelas()
        ];
    }
}