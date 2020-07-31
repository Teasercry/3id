<?php
App::uses('AppController', 'Controller');
/**
 * Vehicles Controller
 *
 * @property Vehicle $Vehicle
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class VehiclesController extends AppController
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
	public function getVehicle()
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
					$filter[] = array('DATE(Vehicle.created) BETWEEN ? AND ?' => array($startDate, $endDate));
				}
			}


			$data = array();
			$total_registros = $this->Vehicle->find('count', array('conditions' => $filter));
			$data['draw'] = $_REQUEST['draw'];
			$data['recordsTotal'] = $total_registros;
			//debug($_GET);
			$array_filtro = array();

			if (isset($_REQUEST['search'])) {
				if ($_REQUEST['search']['value'] != '') {
					$array_filtro['AND'][] = $filter;

					$array_filtro['OR'][] = array(
						"Vehicle.id LIKE" => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.brand LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.model LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.year LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.version LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.category LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.load_index LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.created LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.modified LIKE' => "%{$_REQUEST['search']['value']}%",
					);
					$array_filtro['OR'][] = array(
						'Vehicle.status LIKE' => "%{$_REQUEST['search']['value']}%",
					);
				} else {
					//$array_filtro = array('1' => 1);
					$array_filtro = $filter;
				}
			}

			$colunas = array(
				'Vehicle.id',
				'Vehicle.brand',
				'Vehicle.model',
				'Vehicle.year',
				'Vehicle.version',
				'Vehicle.category',
				'Vehicle.load_index',
				'Vehicle.created',
				'Vehicle.status',
				'',
			);

			$order_coluna = $colunas[$_REQUEST['order'][0]['column']];
			$order_direction = $_REQUEST['order'][0]['dir'];

			$options = array(
				'conditions' => array($array_filtro),
			);
			$requisoes_tot = $this->Vehicle->find('count', $options);

			$data['recordsFiltered'] = $requisoes_tot;

			$options = array(
				'conditions' => array($array_filtro),
				'order' => array($order_coluna => $order_direction),
				'offset' => (int) $_REQUEST['start'],
				'limit' => (int) $_REQUEST['length'],
			);

			$registros = $this->Vehicle->find('all', $options);
			// debug($log);die();
			// debug($registros);
			$data['data'] = array();
			foreach ($registros as $i => $registro) {
				$status = $registro['Vehicle']['status'] ? '<a href="#" class="btn btn-success"><span class="text">Ativo</span></a>' : '<a href="#" class="btn btn-danger"><span class="text">inativo</span></a>';


				$info = array();

				$info[] = $registro['Vehicle']['id'];
				$info[] = $registro['Vehicle']['brand'];
				$info[] = $registro['Vehicle']['model'];
				$info[] = $registro['Vehicle']['year'];
				$info[] = $registro['Vehicle']['version'];
				$info[] = $registro['Vehicle']['category'];
				$info[] = $registro['Vehicle']['load_index'];
				$info[] = $registro['Vehicle']['created'];
				$info[] = $status;
				$info[] = "
							<button type='button' onclick=deleteRecord('Vehicles',{$registro['Vehicle']['id']},'#dataTableVehicle') class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></button>
							<a href='/editar-veiculo/{$registro['Vehicle']['id']}' class='btn btn-info btn-circle btn-sm'><i class='fas fa-edit'></i></a>
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
		if (!$this->Vehicle->exists($id)) {
			throw new NotFoundException(__('Invalid vehicle'));
		}
		$options = array('conditions' => array('Vehicle.' . $this->Vehicle->primaryKey => $id));
		$this->set('vehicle', $this->Vehicle->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Vehicle->create();
			if ($this->Vehicle->save($this->request->data)) {
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
			if ($this->Vehicle->save($this->request->data)) {
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
			$options = array('conditions' => array('Vehicle.' . $this->Vehicle->primaryKey => $id));
			$this->request->data = $this->Vehicle->find('first', $options);
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
		if (!$this->Vehicle->exists($id)) {
			$retorno = array(
				'status' => false,
				'title' => 'Ops',
				'message' => 'Não encontramos o registro! Tente novamente mais tarde!',
				'icon' => 'error',
				'redirect' => false
			);
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Vehicle->delete($id)) {
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
