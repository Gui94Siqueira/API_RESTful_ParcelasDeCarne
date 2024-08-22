<?php

interface BaseRepository {
    public function find($id);
    public function getAll();
    public function add(ModelCarne $carne);
    public function update($id, ModelCarne $carne);
    public function delete($id);
}

?>