<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculate extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct() {
		parent::__construct();

		$this->load->model("M_Calculate");
	}
	public function index()
	{
		$data['wargas'] = $this->db->get("wargas")->result();
		$data['totalSampleData'] = $this->db->get("sample_data")->num_rows();
		$data['wargas_normalized'] = $this->db->select(['w.nama', 'wn.*'])
			->from('wargas_normalized as wn')
			->join('wargas as w', 'w.id = wn.wargas_id', 'left')
			->get()
			->result();
		
		$this->load->view('layouts/header');
		$this->load->view('calculate/index', $data);
		$this->load->view('layouts/footer');
	}

	public function calculate() {
		$post = $this->input->post();

        $this->db->empty_table("wargas_normalized");
        $files = $this->db->get('wargas')->result();
		
        $min_max = $this->M_Calculate->get_min_max( );

        // prosedur untuk menormalisasi
		$dataToInsert = [];
        for( $i=0; $i< count( $files ); $i++ )
        {
            $len = $min_max["max_pns"] -  $min_max["min_pns"];
            $files[ $i ]->is_pns  =  ( ( $files[ $i ]->is_pns - $min_max["min_pns"] )/( $len ) )* 1 + 0 ;
            $files[ $i ]->is_pns = round( $files[ $i ]->is_pns, 4 );

            $len = $min_max["max_type_gaji"] -  $min_max["min_type_gaji"];
            $files[ $i ]->type_gaji  =  ( ( $files[ $i ]->type_gaji - $min_max["min_type_gaji"] )/( $len ) )* 1 + 0 ;
            $files[ $i ]->type_gaji = round( $files[ $i ]->type_gaji, 4 );

			$dataToInsert[] = array(
				'wargas_id' => $files[$i]->id,
				'is_pns' => $files[$i]->is_pns,
				'type_gaji' => $files[$i]->type_gaji
			);
        }

		$this->db->insert_batch('wargas_normalized', $dataToInsert); 
        
		$this->uji_batch_2($post['k_value']);
		$this->session->set_flashdata('info', array(
			'from' => 1,
			'message' =>  'item berhasil di normalisasi'
		));
		redirect(site_url('calculate'));
		return;
	}

	public function uji_batch_2($k_value)
	{
		$data_uji = $this->db->select("id, is_pns, type_gaji, wargas_id")->from('wargas_normalized')->get()->result_array();
		$data_testing = $this->db->get('sample_data')->result_array();

		$min_max = $this->M_Calculate->get_min_max( );

		for( $i=0; $i< count( $data_uji ); $i++ )
		{
			$DISTANCES = array();
			for( $j=0; $j< count( $data_testing ); $j++ )
			{
				$dist['distances'] = $this->distance( $data_uji[ $i ], $data_testing[ $j ] );
				$dist['status'] = $data_testing[ $j ]['status'];

				array_push($DISTANCES , $dist) ;
			}
			sort($DISTANCES);//mengurutkan distance dari terdekat

			$K_VALUE = $k_value;
			$NEIGHBOUR = array();
			for( $k=0; $k< $K_VALUE ; $k++ ) //memetakan tetangga
			{
				if( !isset( $NEIGHBOUR[ $DISTANCES[ $k ]['status'] ] ) )
					$NEIGHBOUR[ $DISTANCES[ $k ]['status'] ] = array();
				
				array_push( $NEIGHBOUR[ $DISTANCES[ $k ]['status'] ] , $DISTANCES[ $k ]) ;
			}

			$terbesar =  array();
			foreach(array_keys($NEIGHBOUR) as $paramName)
			{
				if(  count( $NEIGHBOUR[ $paramName ] )  > count( $terbesar ) )
				{
					$terbesar = $NEIGHBOUR[ $paramName ];
				}
			}
			$lulus = isset( $NEIGHBOUR[ 1 ] )  ? count( $NEIGHBOUR[ 1 ] )  : 0;
			$sum = 0;
			$count = count( $NEIGHBOUR[ 1 ] ) ; 
			foreach( $NEIGHBOUR[ 1 ] as $_length )
			{
				$sum += $_length['distances'];
			}
			$avrg = $sum / $count; // perhitungan nilai jarak rata-rata

			
			$data_uji[ $i ]['status']        = $terbesar[0]['status'];//update nilai label (lulus / tidak lulus)
			$data_uji[ $i ]['tetangga_terdekat'] =  $avrg;
			$data_uji[ $i ]['k_value']           = $K_VALUE;
			$data_uji[ $i ]['distances']         = json_encode($DISTANCES);
			$data_uji[ $i ]['neighbours']        = json_encode($NEIGHBOUR);

			$data_uji_param['id'] = $data_uji[ $i ]['id'];

			$this->db->set($data_uji[$i])->where('id', $data_uji[$i]['id'])->update("wargas_normalized");
		}
	}
  
	  //   fungsi untuk menghitung jarak
	private function distance($data_uji, $data_testing )
	{     
		  $attrs = array(
			  'is_pns', 'type_gaji'
		  );
		  $value = 0;
		  foreach( $attrs as $attr )
		  {
			  $value+= pow( ( $data_uji[ $attr ] - $data_testing[ $attr ] ), 2 );
		  }
		  return round( sqrt( $value ), 6 );
	}
}
