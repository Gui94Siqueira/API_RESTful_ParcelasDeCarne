<?php
require_once "repository/RepositoryCarne.php";
//TODO: implementar controller carne
class ControllerCarne {

    public function find($id) {
        try {
            $carne = new RepositoryCarne();
            return $carne->find($id);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAll() {
       try {
            $carne = new RepositoryCarne();
            return $carne->getAll();
       } catch (PDOException $e) {
            return [];
       }
    }

    public function add(ModelCarne $carne) {
        try {
            $new_carne = new RepositoryCarne();
            return $new_carne->add($carne);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(ModelCarne $carne) {
        try {
            $new_carne = new RepositoryCarne();
            return $new_carne->update($carne);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $new_carne = new RepositoryCarne();
            return $new_carne->delete($id);
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>