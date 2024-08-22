<?php
include_once ("repository/RepositoryCarneInMemory.php");
//TODO: implementar controller carne
class ControllerCarne implements BaseRepository {

    public function find($id) {
        try {
            $carne = new RepositoryCarneInMemory();
            return $carne->find($id);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAll() {
       try {
            $carne = new RepositoryCarneInMemory();
            return $carne->getAll();
       } catch (PDOException $e) {
            return [];
       }
    }

    public function add(ModelCarne $carne) {
        try {
            $new_carne = new RepositoryCarneInMemory();
            $new_carne->add($carne);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, ModelCarne $carne) {
        try {
            $new_carne = new RepositoryCarneInMemory();
            return $new_carne->update($id, $carne);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id) {
        try {
            $new_carne = new RepositoryCarneInMemory();
            return $new_carne->delete($id);
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>