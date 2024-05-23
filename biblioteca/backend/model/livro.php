<?php
class Livro implements JsonSerializable {
    private $id;
    private $titulo;
    private $autor;
    private $ano;
    private $isbn;

    public function __construct($id, $titulo, $autor, $ano, $isbn) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->isbn = $isbn;

    }

    public function getId() {
        return $this->id;
    }

    public function gettitulo() {
        return $this->titulo;
    }

    public function getautor() {
        return $this->autor;
    }

    public function getano() {
        return $this->ano;
    }

    public function getisbn() {
        return $this->isbn;
    }


    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'autor' => $this->autor,
            'ano' => $this->ano,
            'isbn' => $this->isbn
        ];
    }
}
?>