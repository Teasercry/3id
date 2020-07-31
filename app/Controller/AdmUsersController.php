<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email', 'HttpSocket', 'Network/Http');


class AdmUsersController extends AppController {

  public $components = array('Paginator', 'DateMask','Mail');

  public function index() {
    $this->layout = 'admin';
    //Datatable
    if (isset($this->params->query['draw'])) {
      $this->layout = 'ajax';
      //filtro por status
      $filter = array('AdmUser.status' => true); //ativo
      //$filter = array('1' => 1);

      $data = array();
      $total_registros = $requisoes = $this->AdmUser->find('count', array('conditions' => $filter));
      $data['draw'] = $_REQUEST['draw'];
      $data['recordsTotal'] = $total_registros;
      //debug($_GET);
      $array_filtro = array();

      if (isset($_REQUEST['search'])) {
        if ($_REQUEST['search']['value'] != '') {
          $array_filtro['AND'][] = $filter;

          $array_filtro['OR'][] = array(
            "AdmUser.type LIKE" => "%{$_REQUEST['search']['value']}%",
          );
          $array_filtro['OR'][] = array(
            'AdmUser.name LIKE' => "%{$_REQUEST['search']['value']}%",
          );
          $array_filtro['OR'][] = array(
            'AdmUser.email LIKE' => "%{$_REQUEST['search']['value']}%",
          );
          $array_filtro['OR'][] = array(
            'AdmUser.created LIKE' => "%{$_REQUEST['search']['value']}%",
          );
          $array_filtro['OR'][] = array(
            'AdmUser.modified LIKE' => "%{$_REQUEST['search']['value']}%",
          );
        } else {
          //$array_filtro = array('1' => 1);
          $array_filtro = $filter;
        }
      }

      $colunas = array(
        'AdmUser.id',
        'AdmUser.type',
        'AdmUser.name',
        'AdmUser.email',
        '',
        'AdmUser.created',
        'AdmUser.modified',
      );

      $order_coluna = $colunas[$_REQUEST['order'][0]['column']];
      $order_direction = $_REQUEST['order'][0]['dir'];

      $options = array(
        'conditions' => array($array_filtro),
      );
      $requisoes_tot = $this->AdmUser->find('count', $options);

      $data['recordsFiltered'] = $requisoes_tot;

      $options = array(
        'conditions' => array($array_filtro),
        'order' => array($order_coluna => $order_direction),
        'offset' => (int) $_REQUEST['start'],
        'limit' => (int) $_REQUEST['length'],
      );
      $registros = $this->AdmUser->find('all', $options);
      $log = $this->AdmUser->getDataSource()->getLog(false, false);
      //debug($log);die();
      //debug($customers);
      $data['data'] = array();
      foreach ($registros as $registro) {
        $info = array();

        $json_tipo = json_encode($this->get_types_fornecedor(), JSON_UNESCAPED_UNICODE);
        //$json_tipo = "{'Administrador':'Administrador','Simples':'Simples'}";
        $link_tipo = "<a href='#'
        data-name='type'
        data-type='select'
        data-url='/AdmUsers/edit_field/AdmUser'
        data-source='$json_tipo'
        data-pk='{$registro['AdmUser']['id']}'
        data-value='{$registro['AdmUser']['type']}'
        class='editable'>
        {$registro['AdmUser']['type']}
        </a>";

        $name = '<a href="#"
        data-name="name"
        data-type="text"
        data-url="/AdmUsers/edit_field/AdmUser"
        data-pk="' . $registro['AdmUser']['id'] . '"
        class="editable">
        ' . $registro['AdmUser']['name'] . '
        </a>';

        $email = '<a href="#"
        data-name="email"
        data-type="text"
        data-url="/AdmUsers/edit_field/AdmUser"
        data-pk="' . $registro['AdmUser']['id'] . '"
        class="editable">
        ' . $registro['AdmUser']['email'] . '
        </a>';


        $link = Router::url('/', true) . 'dashboard?token=' . base64_encode($registro['AdmUser']['token']);
        $link_id = '#link_' . $registro['AdmUser']['id'];

        $info['DT_RowId'] = 'tr_usuarios_' . $registro['AdmUser']['id'];
        $info[] = $registro['AdmUser']['id'];
        $info[] = $link_tipo;
        $info[] = $name;
        $info[] = $email;
        $info[] = '<a href="javascript:void(0);" data-link="' . $link . '" id="link_' . $registro['AdmUser']['id'] . '" onclick="copyToClipboard(\' ' . $link_id . ' \')" class="btn btn-xs dark">Copiar Link</a> ';
        $info[] = $this->DateMask->date_mysql_to_php_sem_hora($registro['AdmUser']['created']);
        $info[] = $this->DateMask->date_mysql_to_php_sem_hora($registro['AdmUser']['modified']);
        $actions = '';
        $actions .= '<a href = "javascript:void(0)" onclick = "apagar_usuario_adm(' . $registro['AdmUser']['id'] . ')" class = "btn default btn-xs red-stripe">
        <i class = "fa fa-trash-o"></i> Apagar
        </a> ';
        $actions .= '<a href = "javascript:void(0)" onclick = "modal_altera_senha(' . $registro['AdmUser']['id'] . ')" class = "btn default btn-xs blue-stripe">
        <i class = "fa fa-lock"></i> Alterar Senha
        </a> ';
        $info[] = $actions;
        $data['data'][] = $info;
      }
      echo json_encode($data);

      die();
    }

    $types_fornecedor = $this->get_types_fornecedor();
    $this->set(compact('types_fornecedor'));
  }

  public function esqueceu_senha(){
    $this->layout = 'admin_login';
    if ($this->request->is('post')){
      $forgetEmail = $this->request->data['admUserForget']['email'];
      $acesso = $this->AdmUser->find('all', array('conditions' => array('AdmUser.email' => $forgetEmail)));
      // debug($acesso);die();

      if ($acesso) {
        //Reenviando senha do usuário
        $name_blox = $acesso[0]['AdmUser']['name'];
        $token = bin2hex(random_bytes(12));
        $id_token = base64_encode($token);
        $id_adm = $acesso[0]['AdmUser']['id'];
        $link = Router::url('/', true) . "recuperar-senha-adm/{$id_adm}/{$id_token}";
        //Atualizando password do usuario.
        $this->AdmUser->id = $acesso[0]['AdmUser']['id'];
        $this->AdmUser->saveField('token_password', $id_token);
        //mandando para a recuperação de senha
        $data = array(
          'nome' => $name_blox,
          'link' => $link
        );
        $email_send = $this->Mail->manda_email($forgetEmail, 'Ibegesp - Recuperar senha de acesso', 'adm_esqueceu_senha', $data);

        $retorno = array(
          'status' => true,
          'title' => 'Sucesso!',
          'message' => 'Enviamos um email para '.$forgetEmail.', por favor verifique seu email para recuperar sua senha!',
          'redirect' => '/'
        );
      }else {
        $retorno = array(
          'status' => false,
          'title' => 'Ops!',
          'message' => 'E-mail não encontrado, por favor verifique as informações e tente novamente!',
          'redirect' => false
        );
      }echo json_encode($retorno);die();
    }
  }

  public function recuperar_senha_adm($id, $token){
    if (!$token or ! $id) {
      $this->redirect('/'); // Redireciona o cliente
    }
    $this->layout = 'admin_login';
    // Validando se o token e IGUAL ao meu password
    $check_token = $this->AdmUser->find('all', array(
      'conditions' =>
      array(
        'AdmUser.token_password' => $token,
        'AdmUser.id' => $id
      )
    ));
    if (!$check_token) {
      throw new MissingBehaviorException('Senha Expirada');
    }
    // debug($check_token);
    $name = $check_token[0]['AdmUser']['name'];
    $this->set(compact('check_token', 'name'));
  }

  public function env_recuperar_senha_adm(){
    if ($this->request->is('post')) {
      // debug($this->request->data);die();
      $info_student = $this->AdmUser->find('all', array(
        'conditions' => array(
          'AdmUser.id' => $this->request->data['idUser']
        )
      ));
      //validando se as senhas coincidem
      if ($this->request->data['admUserRecoveryPassword']['password'] == $this->request->data['admUserRecoveryPassword']['password_again']) {
        $this->request->data['AdmUser']['id'] = $this->request->data['idUser'];
        $this->request->data['AdmUser']['senha'] = sha1($this->request->data['admUserRecoveryPassword']['password']);
        $this->request->data['AdmUser']['token_password'] = bin2hex(random_bytes(12));
        if ($this->AdmUser->save($this->request->data['AdmUser'])) {
          $retorno = array(
            'status' => true,
            'title' => 'Senha atualizada',
            'message' => 'Sua senha foi atualizada com sucesso.',
            'redirect' => '/'
          );
        } else {
          $retorno = array(
            'status' => false,
            'title' => 'Ops!',
            'message' => 'Erro ao atualizar sua senha, tente novamente mais tarde!',
            'redirect' => false
          );
        }
      } else {
        //erro, a senha nao confere
        $retorno = array(
          'status' => false,
          'title' => 'Senha não atualizada',
          'message' => 'Sua senha atual não confere.',
          'redirect' => false
        );
      }
      echo json_encode($retorno);
    }
    die();
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->AdmUser->create();
      $this->request->data['AdmUser']['status'] = true;
      $this->request->data['AdmUser']['senha'] = sha1($this->request->data['AdmUser']['senha']);
      $this->request->data['AdmUser']['token'] = $this->gera_token();

      if ($this->AdmUser->save($this->request->data)) {
        $retorno = array(
          'status' => true,
          'title' => 'Usuário adicionado com sucesso.',
          'message' => '',
          'redirect' => false
        );
      } else {
        $retorno = array(
          'status' => false,
          'title' => 'Erro ao adicionar usuário',
          'message' => '',
          'redirect' => false
        );
      }
      echo json_encode($retorno);
    }
    die();
  }

  public function delete() {
    if ($this->request->is(array('post'))) {
      $id = $this->request->data['id'];
      $this->AdmUser->id = $id;
      if (!$this->AdmUser->exists()) {
        $retorno = array(
          'status' => false,
          'title' => 'Erro ao apagar usuário.',
          'message' => 'Usuário não existe em nosso sistema.',
          'redirect' => false
        );
        echo json_encode($retorno);
        die();
      }

      if ($this->AdmUser->delete()) {
        $retorno = array(
          'status' => true,
          'title' => 'Usuário apagado com sucesso.',
          'message' => 'Usuário apagado com sucesso no sistema.',
          'redirect' => false,
          'data' => array()
        );
      } else {
        $retorno = array(
          'status' => false,
          'title' => 'Erro ao adicionar usuário.',
          'message' => 'Erro ao adicionar usuário no sistema.',
          'redirect' => false
        );
      }
      echo json_encode($retorno);
    }
    die();
  }

  public function altera_senha() {
    $this->layout = 'ajax';
    if ($this->request->is(array('post', 'put'))) {
      $this->AdmUser->create();

      if ($this->request->data['AdmUser']['senha']) {
        $this->request->data['AdmUser']['senha'] = sha1($this->request->data['AdmUser']['senha']);
      }

      if ($this->AdmUser->save($this->request->data)) {
        $retorno = array(
          'status' => true,
          'title' => "Senha alterada.",
          'message' => "Senha alterada com sucesso.",
          'redirect' => false
        );
      } else {
        $retorno = array(
          'status' => false,
          'title' => 'Erro ao alterar senha',
          'message' => 'Erro ao alterar senha usuário no sistema.',
          'redirect' => false
        );
      }
      echo json_encode($retorno);
    }
    die();
  }

  public function login() {
    $this->layout = 'admin_login';

    if ($this->request->is(array('post', 'put')) == true OR isset($this->params->query['token'])) {
      header('Content-Type: text/html; charset=utf-8');
      // debug($this->request->data);die();
      $login = $this->request->data['AdmUser']['email'];
      $senha = sha1($this->request->data['AdmUser']['password']);
      $acesso = $this->AdmUser->find('all', array('conditions' => array('AdmUser.email' => $login, 'AdmUser.senha' => $senha)));

      if (count($acesso) > 0) {
        //atualiza a session id
        $session_id = $this->Session->id();
        $this->AdmUser->id = $acesso[0]['AdmUser']['id'];
        $this->AdmUser->saveField('session_id', $session_id);
        $this->AdmUser->saveField('modified', date('Y-m-d H:i:s'));
        //Cria Session Adm
        $this->Session->write(array(
          'AdmUser.id' => $acesso[0]['AdmUser']['id'],
          'AdmUser.user_name' => $acesso[0]['AdmUser']['name'],
          'AdmUser.user_email' => $acesso[0]['AdmUser']['email'],
          'AdmUser.user_type' => $acesso[0]['AdmUser']['type'],
          'AdmUser.token' => $acesso[0]['AdmUser']['token'],
          'AdmUser.token_iset' => $acesso[0]['AdmUser']['token_iset'],
          'AdmUser.session_id' => $session_id,
        ));
        //Redireciona
        $retorno = array(
          'status' => true,
          'icon' => 'success',
          'title' => 'Sucesso',
          'message' => 'Acesso Liberado, aguarde já estamos te redirecionando!',
          'redirect' => '/listar-estoque-manual'
        );
      } else {
        $retorno = array(
          'status' => false,
          'icon' => 'error',
          'title' => 'Acesso negado!',
          'message' => 'por favor verifique seus dados de acesso!',
          'redirect' => false
        );
      }
      echo json_encode($retorno);die();
    }
  }

  public function keepalive() {
    if ($this->Session->check('Shopkeeper')) {
      echo 'OK';
    } else {
      echo 'ERROR';
    }
    die();
  }

  public function dashboard() {
    $this->layout = 'admin';
    $this->loadModel('Vehicle');
    $this->loadModel('Tire');
    $this->loadModel('RelatedTires');

    $allAdmUsers = $this->AdmUser->find('count', array(
      'conditions' => array('AdmUser.status' => '1'),
      'fields' => array('AdmUser.id')
    ));

    $allVehicles = $this->Vehicle->find('count', array(
      'conditions' => array('Vehicle.status' => '1'),
      'fields' => array('Vehicle.id')
    ));

    $allTires = $this->Tire->find('count', array(
      'conditions' => array('Tire.status' => '1'),
      'fields' => array('Tire.id')
    ));

    $allRelatedTires = $this->RelatedTires->find('count', array(
      'conditions' => array('RelatedTires.status' => '1'),
      'fields' => array('RelatedTires.id')
    ));

    $this->set(compact('allAdmUsers', 'allVehicles', 'allTires', 'allRelatedTires'));
  }

  

  public function readNotificationInMatriculation(){
    if ($this->request->is(array('post', 'put'))) {

      $this->Matriculation->id = $this->request->data['id_matriculation'];
      $this->Matriculation->saveField('notification', '0');

      if ($this->Matriculation->save($this->request->data)) {
        $retorno = array(
          'status' => true,
          'title' => 'Sucesso',
          'message' => 'Notificação marcada como lida, estamos te redirecionando!',
          'redirect' => false
        );
      }
      else {
        $retorno = array(
          'status' => false,
          'title' => 'Ops',
          'message' => 'Não foi possível realizar esta operação',
          'redirect' => false
        );
      }echo json_encode($retorno);
      die();
    }
}

    public function sair() {
      if ($this->Session->valid()) {
        $this->Session->destroy();
        $this->redirect('/');
      }
    }

  }
