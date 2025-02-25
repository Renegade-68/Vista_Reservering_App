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

        HTML;

        return $html;
    }


}