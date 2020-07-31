<?php
App::uses('AppController', 'Controller');
/**
 * Tires Controller
 *
 * @property Tire $Tire
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class TiresController extends AppController
{

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session', 'Flash');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->layout = 'admin';

		$this->Tire->recursive = 0;
		$this->set('tires', $this->Paginator->paginate());
	}


	public function getTires()
	{
		$this->layout = 'ajax';

		if (isset($this->params->query['draw'])) {
			$this->layout = 'ajax';
			//filtro por status
			//$filter = array('Course.status' => true); //ativo
			$filter = array('1' => 1);

			if (isset($this->request->query['dt_start'])) {
				if ($this->request->query['dt_start'] != '' and $this->request->query['dt_end'] != '') {
					$startDate = $this->request->query['dt_start'];
					$endDate = $this->request->query['dt_end'];
					$filter[] = array('DATE(Tire.created) BETWEEN ? AND ?' => array($startDate, $endDate));
				}
			}


			$data = array();
			$total_registros = $this->Tire->find('count', array('conditions' => $filter));
			$data['draw'] = $_REQUEST['draw'];
			$data['recordsTotal'] = $total_registros;
			//debug($_GET);
			$array_filtro = array();

			if (isset($_REQUEST['search'])) {
				if ($_REQUEST['search']['value'] != '') {
					$array_filtro['AND'][] = $filter;

					$array_filtro['OR'][] = array(
						"Tire.id LIKE" => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.model LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.provider LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.measure LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.brand LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.height LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.width LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.wheel LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.created LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.status LIKE' => "%{$_REQUEST['search']['value']}%",
					);
				} else {
					//$array_filtro = array('1' => 1);
					$array_filtro = $filter;
				}
			}

			$colunas = array(
				'Tire.id',
				'Tire.model',
				'Tire.provider',
				'Tire.measure',
				'Tire.brand',
				'Tire.height',
				'Tire.width',
				'Tire.wheel',
				'Tire.created',
				'Tire.status',
				'',
			);

			$order_coluna = $colunas[$_REQUEST['order'][0]['column']];
			$order_direction = $_REQUEST['order'][0]['dir'];

			$options = array(
				'conditions' => array($array_filtro),
			);
			$requisoes_tot = $this->Tire->find('count', $options);

			$data['recordsFiltered'] = $requisoes_tot;

			$options = array(
				'conditions' => array($array_filtro),
				'order' => array($order_coluna => $order_direction),
				'offset' => (int) $_REQUEST['start'],
				'limit' => (int) $_REQUEST['length'],
			);

			$registros = $this->Tire->find('all', $options);
			// debug($log);die();
			// debug($registros);
			$data['data'] = array();
			foreach ($registros as $i => $registro) {
				$status = $registro['Tire']['status'] ? '<a href="#" class="btn btn-success"><span class="text">Ativo</span></a>' : '<a href="#" class="btn btn-danger"><span class="text">inativo</span></a>';


				$info = array();

				$info[] = $registro['Tire']['id'];
				$info[] = $registro['Tire']['model'];
				$info[] = $registro['Tire']['provider'];
				$info[] = $registro['Tire']['measure'];
				$info[] = $registro['Tire']['brand'];
				$info[] = $registro['Tire']['height'];
				$info[] = $registro['Tire']['width'];
				$info[] = $registro['Tire']['wheel'];
				$info[] = $registro['Tire']['created'];
				$info[] = $status;
				$info[] = "
							<button type='button' onclick=deleteRecord('Tires',{$registro['Tire']['id']},'#dataTableTires') class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></button> 
							<a href='/editar-pneu/{$registro['Tire']['id']}' class='btn btn-info btn-circle btn-sm'><i class='fas fa-edit'></i></a>
						";
				$data['data'][] = $info;
			}
			echo json_encode($data);

			die();
		}
	}
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		if (!$this->Tire->exists($id)) {
			throw new NotFoundException(__('Invalid tire'));
		}
		$options = array('conditions' => array('Tire.' . $this->Tire->primaryKey => $id));
		$this->set('tire', $this->Tire->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Tire->create();
			if ($this->Tire->save($this->request->data)) {
				$retorno = array(
					'status' => true,
					'title' => 'Sucesso',
					'message' => 'Cadastro realizado com sucesso!',
					'icon' => 'success',
					'redirect' => false
				);
			} else {
				$retorno = array(
					'status' => false,
					'title' => 'Ops',
					'message' => 'Não foi possivel realizar este cadastro. Tente novamente mais tarde!',
					'icon' => 'error',
					'redirect' => false
				);
			}

			echo json_encode($retorno);
			die();
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null)
	{
		$this->layout = 'admin';

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tire->save($this->request->data)) {
				$retorno = array(
					'status' => true,
					'title' => 'Sucesso',
					'message' => 'Cadastro realizado com sucesso!',
					'icon' => 'success',
					'redirect' => false
				);
			} else {
				$retorno = array(
					'status' => false,
					'title' => 'Ops',
					'message' => 'Não foi possivel realizar este cadastro. Tente novamente mais tarde!',
					'icon' => 'error',
					'redirect' => false
				);
			}

			echo json_encode($retorno);
			die();

		} else {
			$options = array('conditions' => array('Tire.' . $this->Tire->primaryKey => $id));
			$this->request->data = $this->Tire->find('first', $options);
		}
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		if (!$this->Tire->exists($id)) {
			$retorno = array(
				'status' => false,
				'title' => 'Ops',
				'message' => 'Não encontramos o registro! Tente novamente mais tarde!',
				'icon' => 'error',
				'redirect' => false
			);
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Tire->delete($id)) {
			$retorno = array(
				'status' => true,
				'title' => 'Poof!',
				'message' => 'Registro deletado com sucesso!',
				'icon' => 'success',
				'redirect' => false
			);
		} else {
			$retorno = array(
				'status' => false,
				'title' => 'Ops',
				'message' => 'Não foi possivel deletar este arquivo! Verifique se este pneu não esta vinculado a um Pneu Relaciona e tente novamente!',
				'icon' => 'error',
				'redirect' => false
			);
		}
		echo json_encode($retorno);
		die();
	}
}
