<?php
    require_once 'controller/ControllerCarne.php';
    require_once 'model/ModelCarne.php';
    
    $action = $_GET['action'];

    Handle::handleRequest($action);

    class Handle {
        public static function handleRequest($action) {
            switch ($action) {
                case 'listar':
                    self::listar();
                    break;
                
                case 'buscar':
                    self::buscarPorId();
                    break;

                case 'cadastrar':
                    self::cadastrar();
                    break;
                
                case 'atualizar':
                    self::atualizar();
                    break;

                case 'excluir':
                    self::deletar();
                    break;

                default:
                    http_response_code(400); // Requisição inválida
                    echo json_encode(['error' => 'Ação inválida']);
                    break;
            }
        }
        
        public static function listar() {
            $new_controller = new ControllerCarne();
            $new_controller->getAll();
            echo json_encode($new_controller);
        }

        public static function buscarPorId() {
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                $id = $_GET['id'];
                $new_controller = new ControllerCarne();
                $new_carne = $new_controller->find($id);
                if ($new_carne) {
                    echo json_encode($new_carne);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Ação inválida']);
                }
            } else {
                http_response_code(405);
            }
        }

        public static function cadastrar() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents("php://input"));
                $valor_total = $data->valor_total; 
                $qtd_parcelas = $data->qtd_parcelas;
                $data_primeiro_vencimento = $data->data_primeiro_vencimento;
                $periodicidade = $data->periodicidade;
                $valor_entrada = $data->valor_entrada;
                
                $carne = new ModelCarne(null, $valor_total, $qtd_parcelas, $data_primeiro_vencimento, $periodicidade, $valor_entrada);

                $new_controller = new ControllerCarne();
                $success = $new_controller->add($carne);
                echo json_encode(['success' => $success]);
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Ação inválida']);
            } 
        } 
        
        public static function atualizar() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents("php://input"));
                $id = $data->id;
                $valor_total = $data->valor_total; 
                $qtd_parcelas = $data->qtd_parcelas;
                $data_primeiro_vencimento = $data->data_primeiro_vencimento;
                $periodicidade = $data->periodicodade;
                $valor_entrada = $data->valor_entrada;
    
                // Existindo um pedido!
                $new_controller = new ControllerCarne();
                $new_carne = $new_controller->find($id);
                if($new_carne) {
                    //update das propriedades do pedido
                    $new_carne->setValorTotal($valor_total);
                    $new_carne->setQtd_parcelas($qtd_parcelas);
                    $new_carne->setDataPrimeiro_vencimento($data_primeiro_vencimento);
                    $new_carne->etPeriodicidade($periodicidade);
                    $new_carne->setData($valor_entrada);
    
                    $new_carne = new ControllerCarne();
                    $success = $new_carne->update($new_carne, $id);
                    echo json_encode(['success' => $success]);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Pedido não encontrado']);
                }
            } else {
                http_response_code(405);
            }        
        }

        public static function deletar() {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents("php://input"));
                $id = $data->id;

                $new_controller = new ControllerCarne();
                $success = $new_controller->delete($id);
                echo json_encode(['success' => $success]);
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Ação inválida']);
            }
        }
    }