<?php
class emprestimo implements JsonSerializable {
    private $id;
    private $data_emprestimo;
    private $status;

    public function __construct($id, $data_emprestimo, $status) {
        $this->id = $id;
        $this->data_emprestimo = $data_emprestimo;
        $this->status = $status;
    }

    public function getDataemprestimo() {
        return $this->data_emprestimo;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setData($data) {
        $this->data_emprestimo = $data;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'data_emprestimo' => $this->data_emprestimo,
            'status' => $this->status
        ];
    }
}
?>