<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentrouteallocation extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['busnomaster'] = $this->dbcon->GetBusMaster();
		$this->render_template('transport_management/studentrouteallocation/index',$data);
	}
	public function load_data(){
		$vehicleno 	  = $this->input->post('vehicleno');
		$trip_id   	  = $this->input->post('trip_id');
		$preference   = $this->input->post('preference');
		$stoppage   = $this->input->post('stoppage');
		
		$getCode = $this->dbcon->select('bus_route_master','Route_Id',"BusCode='$vehicleno' AND Trip_ID='$trip_id' AND Prefer_ID='$preference' AND STOPNO='$stoppage'");
		
		if(!empty($getCode)){
			$Route_Id = $getCode[0]->Route_Id;
		
			$data['data'] = $this->dbcon->select('student','*',"Student_Status='ACTIVE' AND route_id='$Route_Id' OR STOPNO='$stoppage'");
			
			$this->load->view('transport_management/studentrouteallocation/GetData',$data);
			// echo $Route_Id;
			// echo "<pre>";
			// print_r($data);
			// exit;
		}
		
	}
	public function gettripid()
	{
		$vehicleno = $this->input->post('vehicleno');
		$vehcap = $this->dbcon->select('busnomaster','seats',"BusCode='$vehicleno'");
		$cap = $vehcap[0]->seats;
		$tripmaster = $this->dbcon->GetTrip($vehicleno);
		$appdata = array($cap,$tripmaster);
		echo json_encode($appdata);
	}
	public function getpreference()
	{
		$vehicleno = $this->input->post('vehicleno');
		$trip_id   = $this->input->post('trip_id');
		
		$prefid = $this->dbcon->select('bus_route_master','Prefer_ID',"BusCode='$vehicleno' AND Trip_ID='$trip_id' GROUP BY Prefer_ID");
		?>
			<option value=''>Select</option>
		<?php
		foreach($prefid as $key=>$value){
			?>
				<option value='<?php echo $value->Prefer_ID; ?>'><?php if($value->Prefer_ID == 1){ echo "Boys";}elseif($value->Prefer_ID == 2){echo "Girls";}elseif($value->Prefer_ID == 3){echo "Co.Ed";} ?></option>
			<?php
		}
	}
	public function GetStoppage(){
		$vehicleno 	  = $this->input->post('vehicleno');
		$trip_id   	  = $this->input->post('trip_id');
		$preference   = $this->input->post('preference');
		
		$stoppage = $this->dbcon->GetStoppage($vehicleno,$trip_id,$preference);
		
		echo json_encode($stoppage);
	}
	public function getAllDetails(){
		$vehicleno 	  = $this->input->post('vehicleno');
		$trip_id   	  = $this->input->post('trip_id');
		$preference   = $this->input->post('preference');
		$stoppage     = $this->input->post('stoppage');
		
		$getCode = $this->dbcon->select('bus_route_master','Route_Id',"BusCode='$vehicleno' AND Trip_ID='$trip_id' AND Prefer_ID='$preference' AND STOPNO='$stoppage'");
		$Route_Id = $getCode[0]->Route_Id;
		
		$data = $this->dbcon->select('student','*',"Student_Status='ACTIVE' AND route_id='$Route_Id'");
		$cnt =count($data);
		$array = array($Route_Id,$cnt);
		echo json_encode($array);
		
	}
	public function save_data(){
		$adm_no = $this->input->post('adm_no[]');
		$route_id = $this->input->post('route_id');
		$array = array('route_id'=>$route_id);
		foreach($adm_no as $key=>$value){
			$this->dbcon->update('student',$array,"ADM_NO='$value'");
		}
		echo "Data Updated Successfully";
	}
}