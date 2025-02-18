<?php

class Components {

    public function __construct($function = NULL, $data = NULL) {

        if ($function != NULL) {
            switch($function) {
                case "head":
                    echo $this->head($data);
                    break;
            }
        }

    }

    private function head($title) {
        $html = <<<HTML



        HTML;

        return $html;
    }


}