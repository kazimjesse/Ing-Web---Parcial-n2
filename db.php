<?php

class Database {

    private $host = "localhost";
    private $dbname = "parcial_2";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function conectar() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }

        return $this->conn;
    }

    /*
       OBTENER PAISES Y TEMAS
    */

    public function getPaises() {
        $stmt = $this->conn->prepare("SELECT ID, Nombre FROM pais ORDER BY Nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTemas() {
        $stmt = $this->conn->prepare("SELECT ID, Nombre FROM temas ORDER BY Nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
       GUARDAR FORMULARIO
     */

    public function guardarInscriptor($data) {
        $sql = "INSERT INTO inscriptor 
                (Nombre, Apellido, Edad, Sexo, Pais_Residente, Nacionalidad, 
                 Correo, Telefono, Observaciones, Fecha_Registro)
                VALUES
                (:Nombre, :Apellido, :Edad, :Sexo, :Pais_Residente, :Nacionalidad,
                 :Correo, :Telefono, :Observaciones, :Fecha_Registro)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $this->conn->lastInsertId();
    }

    /* 
       GUARDAR TEMAS DEL INSCRIPTOR
     */

    public function guardarTemas($id_inscriptor, $temas) {
        $sql = "INSERT INTO `inscriptor-tema` (ID_Inscriptor, ID_Tema)
                VALUES (:ID_Inscriptor, :ID_Tema)";

        $stmt = $this->conn->prepare($sql);

        foreach ($temas as $tema) {
            $stmt->execute([
                ":ID_Inscriptor" => $id_inscriptor,
                ":ID_Tema" => $tema
            ]);
        }
    }
}

