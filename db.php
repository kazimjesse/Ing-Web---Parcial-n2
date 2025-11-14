<?php
class Database {
    private $host = "localhost";
    private $dbname = "mi_base";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function conectar() {
        try {
            $this->conn = new PDO(
                "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8",
                $this->user,
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Obtener países
    public function getPaises() {
        $sql = "SELECT id, nombre FROM paises ORDER BY nombre";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener temas
    public function getTemas() {
        $sql = "SELECT id, tema FROM temas_interes ORDER BY tema";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Guardar el formulario
    public function guardarFormulario($data) {
        $sql = "INSERT INTO formulario 
            (nombre, apellido, edad, sexo, pais_id, nacionalidad, correo, celular, observaciones) 
            VALUES 
            (:nombre, :apellido, :edad, :sexo, :pais_id, :nacionalidad, :correo, :celular, :observaciones)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $this->conn->lastInsertId();
    }

    // Guardar temas seleccionados
    public function guardarTemasFormulario($formulario_id, $tema_id) {
        $sql = "INSERT INTO formulario_temas (formulario_id, tema_id) VALUES (:fid, :tid)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':fid' => $formulario_id,
            ':tid' => $tema_id
        ]);
    }
}
?>
