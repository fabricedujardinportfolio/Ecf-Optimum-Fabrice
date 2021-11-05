<?php

class ContactListTable extends WP_List_Table
{

	function prepare_items()
	{
		$data = $this->get_data();
		$columns = $this->get_columns();
		$sortable = $this->get_sortable_columns();

		$perPage = 4;
		$currentPage = $this->get_pagenum();
		$totalItems = count($data);

		$this->set_pagination_args(array(
			'total_items' => $totalItems,
			'per_page'    => $perPage
		));

		$data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);

		$this->_column_headers = array($columns, array(), $sortable);
		$this->items = $data;
	}

	function get_data()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'contacts';
		return $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
	}

	function get_columns()
	{
		$columns = array(
			'id' => 'ID',
			'first_name' => 'Prénom',
			'last_name' => 'Nom de famille',
			'phone' => 'Numéro de téléphone',
			'comment' => 'Commentaire',
		);
		return $columns;
	}

	function get_sortable_columns()
	{
		return array('id' => array('id', false));
	}

	function column_default($item, $column_name)
	{
		switch ($column_name) {
			case 'id':
			case 'first_name':
			case 'last_name':
			case 'phone':
			case 'comment':
				return $item[$column_name];
			default:
				return print_r($item, true);
		}
	}
}
