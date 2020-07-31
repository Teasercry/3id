<?php
App::uses('Component', 'Controller');

class MoneyFormatComponent extends Component {

    public function brl_to_mysql($data) {
        $data = str_replace('R$ ', '', $data);
        $data = str_replace('.', '', $data);
        $data = str_replace(',', '.', $data);
        return $data;
    }

}

?>