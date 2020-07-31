<?php
App::uses('AppController', 'Controller');
/**
 * RelatedTires Controller
 *
 * @property RelatedTire $RelatedTire
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RelatedTiresController extends AppController
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
	public function getRelatedTires()
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
					$filter[] = array('DATE(RelatedTire.created) BETWEEN ? AND ?' => array($startDate, $endDate));
				}
			}


			$data = array();
			$total_registros = $this->RelatedTire->find('count', array('conditions' => $filter));
			$data['draw'] = $_REQUEST['draw'];
			$data['recordsTotal'] = $total_registros;
			//debug($_GET);
			$array_filtro = array();

			if (isset($_REQUEST['search'])) {
				if ($_REQUEST['search']['value'] != '') {
					$array_filtro['AND'][] = $filter;

					$array_filtro['OR'][] = array(
						"RelatedTire.id LIKE" => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'RelatedTire.measure LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.brand LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.model LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.version LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.year LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.category LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Tire.model LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'RelatedTire.created LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'RelatedTire.status LIKE' => "%{$_REQUEST['search']['value']}%",
					);
				} else {
					//$array_filtro = array('1' => 1);
					$array_filtro = $filter;
				}
			}

			$colunas = array(
				'RelatedTire.id',
				'RelatedTire.measure',
				'Vehicle.model',
				'Vehicle.category',
				'Tire.model',
				'RelatedTire.created',
				'RelatedTire.status',
				'',
			);

			$order_coluna = $colunas[$_REQUEST['order'][0]['column']];
			$order_direction = $_REQUEST['order'][0]['dir'];

			$options = array(
				'conditions' => array($array_filtro),
			);
			$requisoes_tot = $this->RelatedTire->find('count', $options);

			$data['recordsFiltered'] = $requisoes_tot;

			$options = array(
				'conditions' => array($array_filtro),
				'order' => array($order_coluna => $order_direction),
				'offset' => (int) $_REQUEST['start'],
				'limit' => (int) $_REQUEST['length'],
			);

			$registros = $this->RelatedTire->find('all', $options);
			// debug($log);die();
			// debug($registros);
			$data['data'] = array();
			foreach ($registros as $i => $registro) {


				$info = array();
				// info Pneu
				$tire_model = $registro['Tire']['model'];
				$tire_measure = $registro['Tire']['measure'];
				$tire_provider = $registro['Tire']['provider'];
				// info Veiculo
				$vehicle_brand = $registro['Vehicle']['brand'];
				$vehicle_model = $registro['Vehicle']['model'];
				$vehicle_version = $registro['Vehicle']['version'];
				$vehicle_year = $registro['Vehicle']['year'];
				// Status 
				$status = $registro['RelatedTire']['status'] ? '<a href="#" class="btn btn-success"><span class="text">Ativo</span></a>' : '<a href="#" class="btn btn-danger"><span class="text">inativo</span></a>';


				$info[] = $registro['RelatedTire']['id'];
				$info[] = $registro['RelatedTire']['measure'];
				$info[] = "{$vehicle_brand}, {$vehicle_model} - {$vehicle_version} , {$vehicle_year}";
				$info[] = $registro['Vehicle']['category'];
				$info[] = "Fabricante: {$tire_provider} - Modelo: {$tire_model}, Medida: {$tire_measure}";
				$info[] = $registro['RelatedTire']['created'];
				$info[] = $status;
				$info[] = "
							<button type='button' onclick=deleteRecord('RelatedTires',{$registro['RelatedTire']['id']},'#dataRelatedTires') class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></button>
							<a href='/editar-pneu-relacionado/{$registro['RelatedTire']['id']}' class='btn btn-info btn-circle btn-sm'><i class='fas fa-edit'></i></a>

						  ";

				$data['data'][] = $info;
			}
			echo json_encode($data);

			die();
		}
	}


	public function index()
	{
		$this->layout = 'admin';
		$this->loadModel('Tire');
		$this->loadModel('Vehicle');

		$vehicles = $this->Vehicle->find('all', array(
			'fields' => array(
				'Vehicle.id',
				'Vehicle.brand',
				'Vehicle.model',
				'Vehicle.year',
				'Vehicle.version'
			),
			'conditions' => array(
				'Vehicle.status' => '1'
			),
			'recursive' => '-1'
		));
		$array_vehicles = array();

		foreach ($vehicles as $vehicle) {
			$array_vehicles[] = array(
				'vehicle_id' => "{$vehicle['Vehicle']['id']}",
				'vehicle' => "{$vehicle['Vehicle']['brand']} - {$vehicle['Vehicle']['model']} {$vehicle['Vehicle']['version']} {$vehicle['Vehicle']['year']}",
			);
		}
		$tires = $this->Tire->find('all', array(
			'fields' => array(
				'Tire.id',
				'Tire.provider',
				'Tire.measure',
			),
			'conditions' => array(
				'Tire.status' => '1'
			),
			'recursive' => '-1'
		));


		$array_tires = array();

		foreach ($tires as $tire) {
			$array_tires[] = array(
				'tire_id' => "{$tire['Tire']['id']}",
				'tire' => "{$tire['Tire']['provider']} - {$tire['Tire']['measure']}"
			);
		}

		// debug($array_tires);die();
		$this->set(compact('array_vehicles', 'array_tires'));
		// $this->RelatedTire->recursive = 0;
		// $this->set('relatedTires', $this->Paginator->paginate());
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
		if (!$this->RelatedTire->exists($id)) {
			throw new NotFoundException(__('Invalid related tire'));
		}
		$options = array('conditions' => array('RelatedTire.' . $this->RelatedTire->primaryKey => $id));
		$this->set('relatedTire', $this->RelatedTire->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->RelatedTire->create();
			if ($this->RelatedTire->save($this->request->data)) {
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

		// if (!$this->RelatedTire->exists($id)) {
		// 	throw new NotFoundException(__('Invalid related tire'));
		// }
		$this->loadModel('Tire');
		$this->loadModel('Vehicle');

		$vehicles = $this->Vehicle->find('all', array(
			'fields' => array(
				'Vehicle.id',
				'Vehicle.brand',
				'Vehicle.model',
				'Vehicle.year',
				'Vehicle.version'
			),
			'conditions' => array(
				'Vehicle.status' => '1'
			),
			'recursive' => '-1'
		));
		$array_vehicles = array();

		foreach ($vehicles as $vehicle) {
			$array_vehicles[] = array(
				'vehicle_id' => "{$vehicle['Vehicle']['id']}",
				'vehicle' => "{$vehicle['Vehicle']['brand']} - {$vehicle['Vehicle']['model']} {$vehicle['Vehicle']['version']} {$vehicle['Vehicle']['year']}",
			);
		}
		$tires = $this->Tire->find('all', array(
			'fields' => array(
				'Tire.id',
				'Tire.provider',
				'Tire.measure',
			),
			'conditions' => array(
				'Tire.status' => '1'
			),
			'recursive' => '-1'
		));


		$array_tires = array();

		foreach ($tires as $tire) {
			$array_tires[] = array(
				'tire_id' => "{$tire['Tire']['id']}",
				'tire' => "{$tire['Tire']['provider']} - {$tire['Tire']['measure']}"
			);
		}

		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RelatedTire->save($this->request->data)) {
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
			$options = array('conditions' => array('RelatedTire.' . $this->RelatedTire->primaryKey => $id));
			$this->request->data = $this->RelatedTire->find('first', $options);
		}
		$this->set(compact('array_vehicles', 'array_tires'));
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
		if (!$this->RelatedTire->exists($id)) {
			$retorno = array(
				'status' => false,
				'title' => 'Ops',
				'message' => 'Não encontramos o registro! Tente novamente mais tarde!',
				'icon' => 'error',
				'redirect' => false
			);
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RelatedTire->delete($id)) {
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
