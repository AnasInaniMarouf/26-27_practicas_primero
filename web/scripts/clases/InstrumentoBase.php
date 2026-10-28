<?php
Class InstrumentoBase {
    private string $_descripcion;
    protected int $edad = 10;

    public function __construct(string $desc, int $edad) {
        $_descripcion = $desc;
    }
}

?>