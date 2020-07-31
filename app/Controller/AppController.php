<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array('Session', 'DateMask', 'RequestHandler', 'MoneyFormat');
    public function beforeFilter()
    {
        $url = Router::url($this->here, true);
        $siteUrl = Router::url(null, false);

        $this->Session->write(array(
            'Company.name' => '+3ID',
            'Company.copyrightYear' => '2020',
            'Site.url' => $siteUrl,
            'Site.Title' => 'Sistema +3ID',
        ));


        // Dashboard
        if (preg_match('/\bdashboard\b/', $url)) {


            if ($this->Session->read('AdmUser.session_id')) {
            } else {
                $this->redirect('/');
            }
        }
    }

    // Funções Globais

    public function edit_field($model)
    {
        debug($this->request->data);
        die();
        $this->layout = 'ajax';
        $this->loadModel($model);
        $this->$model->id = $_POST['pk'];
        $this->$model->saveField($_POST['name'], $_POST['value']);
        $this->$model->saveField('modified', date('Y-m-d H:i:s'));
        die();
    }

}
