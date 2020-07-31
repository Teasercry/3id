<?php
/**
 * Estoque Fixture
 */
class EstoqueFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'estoque';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'Cai' => array('type' => 'string', 'null' => false, 'length' => 20, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ID' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'Descricao' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 70, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Medida' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Loja' => array('type' => 'string', 'null' => false, 'length' => 10, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'TabA' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'TabB' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'Estoque' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'Calculo' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '8,2', 'unsigned' => false),
		'CEspeciais' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Marca' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 31, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'Modelo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 31, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('Loja', 'Cai'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'Cai' => 'Lorem ipsum dolor ',
			'ID' => 1,
			'Descricao' => 'Lorem ipsum dolor sit amet',
			'Medida' => 'Lorem ips',
			'Loja' => 'Lorem ip',
			'TabA' => '',
			'TabB' => '',
			'Estoque' => 1,
			'Calculo' => '',
			'CEspeciais' => 'Lorem ipsum dolor sit amet',
			'Marca' => 'Lorem ipsum dolor sit amet',
			'Modelo' => 'Lorem ipsum dolor sit amet'
		),
	);

}
