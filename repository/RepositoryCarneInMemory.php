<?php

include_once ("model/ModelCarne.php");

class RepositoryCarneInMemory {
    private $storage = [];

    public function find($id) {
        if (isset($this->storage[$id])) {
            return $this->storage[$id];
        }
        return null;
    }

    public function getAll() {
        return $this->storage;
    }

    public function add(ModelCarne $carne) {
        $this->storage[] = $carne;
    }

    public function update($id, ModelCarne $carne) {
        if (isset($this->storage[$id])) {
            $this->storage[$id] = $carne;
        }
    }

    public function delete($id) {
        if (isset($this->storage[$id])) {
            unset($this->storage[$id]);
            $this->storage = array_values($this->storage);
        }
    }
}