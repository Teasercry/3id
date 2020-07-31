<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'AdmUsers', 'action' => 'login'));
Router::connect('/esqueceu-senha', array('controller' => 'AdmUsers', 'action' => 'esqueceu_senha'));
Router::connect('/recuperar-senha-adm/*', array('controller' => 'AdmUsers', 'action' => 'recuperar_senha_adm'));
Router::connect('/env-recuperar-senha-adm', array('controller' => 'AdmUsers', 'action' => 'env_recuperar_senha_adm'));
Router::connect('/dashboard', array('controller' => 'AdmUsers', 'action' => 'dashboard'));
Router::connect('/env_recuperar_senha', array('controller' => 'AdmUsers', 'action' => 'env_recuperar_senha'));

// Rota Pneu
Router::connect('/listar-pneus', array('controller' => 'Tires', 'action' => 'index'));
Router::connect('/editar-pneu/*', array('controller' => 'Tires', 'action' => 'edit'));

// Rota Veículos
Router::connect('/listar-veiculos', array('controller' => 'Vehicles', 'action' => 'index'));
Router::connect('/editar-veiculo/*', array('controller' => 'Vehicles', 'action' => 'edit'));

// Rota Pneu Relacionado
Router::connect('/listar-pneus-relacionados', array('controller' => 'RelatedTires', 'action' => 'index'));
Router::connect('/editar-pneu-relacionado/*', array('controller' => 'RelatedTires', 'action' => 'edit'));


//Estoque PneuIdeal
Router::connect('/listar-estoque-manual', array('controller' => 'Pages', 'action' => 'estoque_manual'));
Router::connect('/listar-estoque-automatico', array('controller' => 'Pages', 'action' => 'estoque_automatico'));



/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
