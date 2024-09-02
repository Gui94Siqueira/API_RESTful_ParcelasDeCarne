<?php
//TODO: implementar comunicação com db
require_once "config/Database_config.php";
require_once "repository/BaseRepository.php";
require_once "model/ModelCarne.php";

class RepositoryCarne implements BaseRepository
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }


    public function find($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tbl_carne WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result) {
                $carne = new ModelCarne($result['id'], $result['valor_total'], $result['qtd_parcelas'], $result['data_primeiro_vencimento'], $result['periodicidade'], $result['valor_entrada']);
            } else {
                return "Carne Nao encontrado";
            }
            return $carne;
        } catch (PDOException $e) {
            return false;
        }
        
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM tbl_carne";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $lista = [];
            foreach($result as $row) {
                $carne = new ModelCarne($row['id'], $row['valor_total'], $row['qtd_parcelas'], $row['data_primeiro_vencimento'], $row['periodicidade'], $row['valor_entrada']);
                $lista[] = $carne;
            }

            return $lista;
    
            
        } catch (PDOException $e) {
            return false;
        }
    }

    public function add(ModelCarne $carne) {
        try {
            $sql = "INSERT INTO tbl_carne (valor_total, qtd_parcelas, data_primeiro_vencimento, periodicidade, valor_entrada) VALUES
            (:valor_total, :qtd_parcelas, :data_primeiro_vencimento, :periodicidade, :valor_entrada)";
            $stmt = $this->db->prepare($sql);

            $valor_total = $carne->getValorTotal();
            $qtd_parcelas = $carne->getQtd_parcelas();
            $data_primeiro_vencimento = $carne->getDataPrimeiro_vencimento();
            $periodicidade = $carne->getPeriodicidate();
            $valor_entrada = $carne->getValorEntrada();

            $stmt->bindParam(':valor_total', $valor_total, PDO::PARAM_INT);
            $stmt->bindParam(':qtd_parcelas', $qtd_parcelas, PDO::PARAM_INT);
            $stmt->bindParam(':data_primeiro_vencimento', $data_primeiro_vencimento, PDO::PARAM_STR);
            $stmt->bindParam(':periodicidade', $periodicidade, PDO::PARAM_STR);
            $stmt->bindParam(':valor_entrada', $valor_entrada, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(ModelCarne $carne) {
        try {
            $existingCarne = $this->find($carne->getId());
            if(!$existingCarne) {
                return false;
            }

            $sql = "UPDATE tbl_carne SET valor_total = :valor_total, qtd_parcelas = :qtd_parcelas, data_primeiro_vencimento = :data_primeiro_vencimento, periodicidade = :periodicidade, valor_entrada = :valor_entrada WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $id = $carne->getId();
            $valor_total = $carne->getValorTotal();
            $qtd_parcelas = $carne->getQtd_parcelas();
            $data_primeiro_vencimento = $carne->getDataPrimeiro_vencimento();
            $periodicidade = $carne->getPeriodicidate();
            $valor_entrada = $carne->getValorEntrada();

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':valor_total', $valor_total);
            $stmt->bindParam(':qtd_parcelas', $qtd_parcelas);
            $stmt->bindParam(':data_primeiro_vencimento', $data_primeiro_vencimento);
            $stmt->bindParam(':periodicidade', $periodicidade);
            $stmt->bindParam(':valor_entrada', $valor_entrada);

            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare('DELETE FROM tbl_carne WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
