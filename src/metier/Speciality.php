<?php
class Speciality {
    private ?int $id;
    private ?string $type;

    public function __construct(?int $id = 0, ?string $type = null) {
        if($id != NULL) $this->id = $id;
        if($type != NULL)$this->type =  $type;
    }

    public function get_id() : int {
        return $this->id;
    }

    public function get_type() : string {
        return $this->type;
    }

    public function set_id(int $id) {
        $this->id = $id;
    }

    public function set_type(string $type) {
        $this->type = $type;
    }
}