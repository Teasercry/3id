<?php

App::uses('Component', 'Controller');

class MailComponent extends Component {

    public function manda_email($to, $assunto, $template, $data) {
        $Email = new CakeEmail('smtp');
        $Email->to($to)
                ->subject($assunto)
                ->template($template, null)
                ->emailFormat('html')
                ->viewVars(array('info' => $data))
                ->send();
        return $Email;
    }

}
