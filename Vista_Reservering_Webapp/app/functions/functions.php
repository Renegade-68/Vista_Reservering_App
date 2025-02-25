<?php

class Components {

    public function __construct($function = NULL, $data = NULL) {

        if ($function != NULL) {
            switch($function) {
                case "head":
                    echo $this->head($data);
                    break;
                case "header":
                    echo $this->header();
                    break;
            }
        }

    }

    private function head($title) {
        $html = <<<HTML
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel=stylesheet href="../../assets/css/main.css">



        HTML;

        return $html;
    }
    private function header() {
        $html = <<<HTML

        <nav class="navbar navbar-expand-lg bg-body-tertiary nav">
                <div>
                    <a class="navbar-brand" href="login.php">
                        <img src="../../assets/img/logo-vista.png"width="120px" height="50px">
                    </a>
                </div>
                <div>
                    <a class="btn nav" href="login.php">Login</a>
                </div>
                <div>
                    <a class="btn nav" href="register.php">Registratie</a>
                </div>
                <div>
                    <a class="btn nav" href="Faq.php">Faq</a>
                </div>
                <div>
                    <h1 class="title">Vista Reservering app</h1>
                </div>
        </nav>
}

        HTML;
class Database {

    private $conn;
    private string $db_host = "localhost";
    private string $db_name = "vista_app_db";
    private string $db_user = "root";
    private string $db_pw = "";
    private string $charset = 'utf8mb4';



    public function __construct($function = NULL, $data = NULL) {

        $this->conn = $this->pdoConnect();



    }

    public function pdoConnect() {
        try {
            $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->charset";
            $pdo = new PDO($dsn, $this->db_user, $this->db_pw);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($pdo) {
                echo "Succesful Connection!";
            }

            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

    }

    public function getConnection() {
        return $this->conn;
    }

}

class Register {

    // Variables
    private string $user_name;
    private string $user_lname;
    private string $user_mail;
    private string $user_pw;
    private int $user_role;

    public function __construct($function = NULL, $data = NULL) {
        if ($function != NULL) {
            switch ($function) {
                case "formHandling":
                    $this->formHandling($data);
                    break;
            }
        } else {
        }
    }

    private function formHandling($formData) {

        $this->user_name = $formData["user_name"];
        $this->user_lname = $formData["user_lname"];
        $this->user_mail = $formData["user_mail"];
        $this->user_pw = $formData["user_pw"];
        $this->user_role = $formData["user_role"];

        // echo 'assigned';

        $this->addUser(
            $this->user_name,
            $this->user_lname, 
            $this->user_mail, 
            $this->user_pw, 
            $this->user_role
        );

    }

    private function addUser($name, $lname, $mail, $pw, $role) {
        try {

            // echo "addUser";


            $database = new Database();
            $conn = $database->getConnection();


            // Hash the password before storing it
            $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);
    
            // SQL queries using prepared statements
            $query1 = "INSERT INTO vista_users (email, password) VALUES (:user_mail, :user_pw)";
            $query2 = "INSERT INTO vista_profiles (name, lname, role) VALUES (:user_name, :user_lname, :user_role)";
            
            // Prepare first query
            $stmt1 = $conn->prepare($query1);
            $stmt1->bindParam(':user_mail', $mail, PDO::PARAM_STR);
            $stmt1->bindParam(':user_pw', $hashed_pw, PDO::PARAM_STR);
    
            if (!$stmt1->execute()) {
                die("Error adding user: " . implode(", ", $stmt1->errorInfo()));
            }
    
            // Prepare second query
            $stmt2 = $conn->prepare($query2);
            $stmt2->bindParam(':user_name', $name, PDO::PARAM_STR);
            $stmt2->bindParam(':user_lname', $lname, PDO::PARAM_STR);
            $stmt2->bindParam(':user_role', $role, PDO::PARAM_INT);

            if (!$stmt2->execute()) {
                die("Error adding user profile: " . implode(", ", $stmt2->errorInfo()));
            }
    
        } catch (PDOException $e) {
            return "Database error: " . $e->getMessage();
        }
    }
    

}