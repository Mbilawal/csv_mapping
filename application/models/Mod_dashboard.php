<?php
class mod_dashboard extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //get_orders_graphs
    public function get_orders_graphs($data){

        extract($data);

        $return_array = [];

        return $return_array;   

    }//End get_orders_graphs

    //get_products_graphs
    public function get_products_graphs($data){

        extract($data);

        $return_array = [];
       
        return $return_array;   

    }//End get_products_graphs


    //get_manual_product_average
    public function get_manual_product_average(){

        $response_arr = array();

        return $response_arr;

    }//End get_manual_product_average


    //get_order_status_report
    public function get_order_status_report(){

        $response_arr = array();

        return $response_arr;

    }//End get_order_status_report


    //lead_insert_from_csv
    public function lead_insert_from_csv($data){

        $created_date = date('Y-m-d G:i:s');
        
        extract($data);
        
        //Insert Contact CSV Name
        $int_csv_data = array(
            'id'                        => '',
            'csv_name'                  => (string) $file_name,
            'path'                      => (string) $file_name_path,
            'filter'                    => (string) json_encode($lead_fields),
            'created_date'              => $created_date,
        );
        
        $this->db->insert('cc_csv_names', $int_csv_data);
        $ins = $this->db->insert_id();
        $csv_id = (int) $ins;

        return $csv_id;
        
    }//End lead_insert_from_csv


    //lead_insert_temp_csv
    public function lead_insert_temp_csv(){

        $created_date = date('Y-m-d G:i:s');
        
        //
        $this->db->where('status', 0);
        $this->db->limit('1');
        $result_arr = $this->db->get('cc_csv_names')->result_array();

        foreach($result_arr as $data__){

            $csv_id         = (int) $data__['id'];
            $file_name_path = (string) $data__['path'];
            $lead_fields    =  json_decode($data__['filter'],true);
            
            // Read CSV with fopen
            include 'Classes/PHPExcel/IOFactory.php';
            $inputFileName = $file_name_path; 
            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            $arrayCount = count($allDataInSheet);

            $fields_names_arr = array();
            $fields_index_arr = array();

            //Check Consider Fields
            for($i=0; $i<count($lead_fields); $i++){

                //Check Ignore Field
                if($lead_fields[$i] !="0" && $lead_fields[$i] !=""){
                    $fields_names_arr[] = $lead_fields[$i];
                    $fields_index_arr[] = $i;
                }
            }
            
            
            for($i=1; $i<= $arrayCount; $i++){
                if($i != 1){

                    $DataInSheet_arr = array_values($allDataInSheet[$i]);

                    $ins_temp_data = array();
                    $ins_temp_data['csv_id'] = $csv_id;

                    for($z=0; $z<count($fields_index_arr); $z++){

                        $key = $fields_index_arr[$z];
                        $name = $fields_names_arr[$z];

                        $name_arr = explode('****', $name);

                        if($name_arr[0] =="home_phone" && $DataInSheet_arr[$key] !=""){
                            $DataInSheet_arr[$key] = str_replace(' ', '', $DataInSheet_arr[$key]);
                            $ins_temp_data['home_phone'] = (string) $DataInSheet_arr[$key];
                        }elseif($name_arr[0] =="email" && $DataInSheet_arr[$key] !=""){
                            $DataInSheet_arr[$key] = str_replace(' ', '', $DataInSheet_arr[$key]);
                            $ins_temp_data['email'] = (string) $DataInSheet_arr[$key];
                        }elseif($name_arr[0] =="first_name" && $DataInSheet_arr[$key] !=""){
                            $DataInSheet_arr[$key] = str_replace(' ', '', $DataInSheet_arr[$key]);
                            $ins_temp_data['first_name'] = (string) $DataInSheet_arr[$key];
                        }elseif($name_arr[0] =="last_name" && $DataInSheet_arr[$key] !=""){
                            $DataInSheet_arr[$key] = str_replace(' ', '', $DataInSheet_arr[$key]);
                            $ins_temp_data['last_name'] = (string) $DataInSheet_arr[$key];
                        }elseif($name_arr[0] =="postal_code" && $DataInSheet_arr[$key] !=""){
                            $DataInSheet_arr[$key] = str_replace(' ', '', $DataInSheet_arr[$key]);
                            $ins_temp_data['postal_code'] = (string) $DataInSheet_arr[$key];
                        }elseif($name_arr[0] =="address" && $DataInSheet_arr[$key] !=""){
                            $ins_temp_data['address'] = (string) $DataInSheet_arr[$key];
                        }else{
                            // $DataInSheet_arr[$key] = str_replace(' ', '', $DataInSheet_arr[$key]);
                            $ins_temp_data['email']      = (string) '';
                            $ins_temp_data['home_phone'] = (string) '';
                            $ins_temp_data['first_name'] = (string) '';
                            $ins_temp_data['last_name']  = (string) '';
                            $ins_temp_data['address']  = (string) '';
                            $ins_temp_data['postal_code']  = (string) '';
                        }
                    }

                    $ins_temp_data['record_processed']=0;

                    // if($ins_temp_data['home_phone']!="" || $ins_temp_data['email']!=""){
                        //Insert Temp Record
                    $this->db->insert('cc_temp_csv_data', $ins_temp_data);
                    // }

                }
            }
            
            //Update total csv records
            $get_lead = $this->db->query("SELECT COUNT(id) as total_record FROM cc_temp_csv_data WHERE csv_id=$csv_id");            
            $lead_arr = $get_lead->row_array();
            $count = $lead_arr['total_record'];

            $upd_arr = array( 
                'total_csv_records'         => (int) $count,
                'total_processed_records'   => (int) 0,
                'total_new_records'         => (int) 0,
                'total_duplicate_records'   => (int) 0,
                'total_empty_phone'         => (int) 0,
                'status'                    => (int) 1,
            );

            $this->db->where(array( 'id' =>  $csv_id));
            $this->db->set( $upd_arr);
            $this->db->update('cc_csv_names');
        }

        return $csv_id;
        
    }//End lead_insert_temp_csv


    //lead_insert_from_csv_final
    public function lead_insert_from_csv_final(){
        
        $created_date = date('Y-m-d G:i:s');

        //
        $this->db->where('record_processed', 0);
        // $this->db->where('csv_id', $csv_id);
        $this->db->limit('100');
        $result_arr = $this->db->get('cc_temp_csv_data')->result_array();
        
        for($i=0; $i<count($result_arr); $i++){

            $lead_email         = $result_arr[$i]['email'];
            $lead_data          = $result_arr[$i]['home_phone'];
            $lead_first_name    = $result_arr[$i]['first_name'];
            $lead_address       = $result_arr[$i]['address'];
            $lead_postal_code   = $result_arr[$i]['postal_code'];
            $lead_last_name     = $result_arr[$i]['last_name'];
            $temp_id            = $result_arr[$i]['id'];
            $csv_id             = $result_arr[$i]['csv_id'];

            $ins_data = array();
            $ins_data['csv_id']         = (int) $csv_id;
            
            if($lead_data !=""){
                $ins_data['home_phone'] = (string) stripcslashes(trim($lead_data));
            }else{
                $count_emtpy_phone +=1;
                $home_phone = '';
                $ins_data['home_phone'] = (string) '';
            }

            if($lead_email !=""){
                $ins_data['email'] = (string) stripcslashes(trim($lead_email));
            }else{
                $ins_data['email'] = (string) '';
            }

            if($lead_first_name !=""){
                $ins_data['first_name'] = (string) stripcslashes(trim($lead_first_name));
            }else{
                $ins_data['first_name'] = (string) '';
            }

            if($lead_last_name !=""){
                $ins_data['last_name'] = (string) stripcslashes(trim($lead_last_name));
            }else{
                $ins_data['last_name'] = (string) '';
            }

            if($lead_address !=""){
                $ins_data['address'] = (string) stripcslashes(trim($lead_address));
            }else{
                $ins_data['address'] = (string) '';
            }

            if($lead_postal_code !=""){
                $ins_data['postal_code'] = (string) stripcslashes(trim($lead_postal_code));
            }else{
                $ins_data['postal_code'] = (string) '';
            }
        
            $duplicate_status= '0';
            $parent_id = 0;
            ///////////////////////// Check Duplication //////////////////////
            //////////////////////////////////////////////////////////////////
            
            $this->db->where(array('id' => $temp_id));
            $this->db->set( array('record_processed' => 1 ) );
            $upded = $this->db->update("cc_temp_csv_data");
                
            if($upded){
                
                $total_new_leads +=1;

                /**Get API**/
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://epc.opendatacommunities.org/api/v1/domestic/search?address=1+Vere+Road&postcode=DL128AD",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Basic cHJpbmNldmFzaEBnbWFpbC5jb206NWEwZjBlMDk4Yzg3MzYyNzA4ZTk2NmZiMzM4NDY2ZjUwMmMzYjQ5Mw=="
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                $res_arr = json_decode($response,true);
                $api_response = $res_arr['rows'];

                if(count($api_response) > 0){

                    $api_res_arr = $api_response[0];

                    $ins_data['current_energy_rating']     = $api_res_arr['current-energy-rating'];
                    $ins_data['current_energy_efficiency'] = $api_res_arr['current-energy-efficiency'];
                    $ins_data['property_type']             = $api_res_arr['property-type'];
                    $ins_data['built_form']                = $api_res_arr['built-form'];
                    $ins_data['lodgement_date']            = $api_res_arr['lodgement-date'];
                    $ins_data['walls_description']         = $api_res_arr['walls-description'];
                    $ins_data['roof_description']          = $api_res_arr['roof-description'];
                    $ins_data['mainheat_description']      = $api_res_arr['mainheat-description'];
                    $ins_data['floor_description']         = $api_res_arr['floor-description'];
                    $ins_data['tenure']                    = $api_res_arr['tenure'];

                }else{
                    $ins_data['current_energy_rating']     = "No EPC";
                    $ins_data['current_energy_efficiency'] = "";
                    $ins_data['property_type']             = "";
                    $ins_data['built_form']                = "";
                    $ins_data['lodgement_date']            = "";
                    $ins_data['walls_description']         = "";
                    $ins_data['roof_description']          = "";
                    $ins_data['mainheat_description']      = "";
                    $ins_data['floor_description']         = "";
                    $ins_data['tenure']                    = "";
                }
                /**END Get API**/ 

                //Insert the record into the database.
                $this->db->insert('cc_contacts', $ins_data);
                $ins = $this->db->insert_id();
                $contact_id = (int) $ins;
            }
        
        }
    
        //Update total csv records
        // $inc_arr = array(
        //     'total_processed_records'   => (int) count($result_arr),
        //     'total_new_records'         => (int) $total_new_leads,
        //     'total_duplicate_records'   => (int) 0,
        //     'all_duplicates'            => (int) 0,
        //     'total_empty_phone'         => (int) $count_emtpy_phone
        // );

        // $this->db->where( array( 'id' =>  $csv_id) );
        // $this->db->set( $inc_arr );
        // $this->db->update('cc_csv_names');

        return true;
        
    }//End lead_insert_from_csv_final


    //get_client_campaigns_analysis
    public function get_client_campaigns_analysis($campaign_id=""){

        $time_filter ="";
        $time_filter =" and created_date >= '".date('Y-m-d G:i:s',strtotime('first day of this month'))."' and created_date <= '".date('Y-m-d G:i:s',strtotime('last day of this month'))."' ";

        $campaign_filter ="";
        
        if($campaign_id !=''){
            $campaign_filter=" and campaign_id=".$campaign_id;
        }

        $get_sent = $this->db->query("SELECT status,COUNT(status) as total_record FROM cc_contacts_sms_record WHERE 1=1 ".$campaign_filter." group by status  ");
        $total_record=$get_sent->result_array();

        $data_arr = array();
        $total = 0;
        foreach ($total_record as  $value) {
            
            $data_arr[$value['status']] = round($value['total_record'],2);
        }

        $get_sent = $this->db->query("SELECT COUNT(id) as total_record FROM cc_contacts_sms_record WHERE 1=1 ".$campaign_filter." ");
        $total_record=$get_sent->row_array();
        $data_arr['recipients'] = round($total_record['total_record'],2);
        
        return $data_arr;
    
    }//End get_client_campaigns_analysis


    //get_client_email_campaigns_analysis
    public function get_client_email_campaigns_analysis($campaign_id=""){

        $time_filter ="";
        $time_filter =" and created_date >= '".date('Y-m-d G:i:s',strtotime('first day of this month'))."' and created_date <= '".date('Y-m-d G:i:s',strtotime('last day of this month'))."' ";

        $campaign_filter ="";
        
        if($campaign_id !=''){
            $campaign_filter=" and campaign_id=".$campaign_id;
        }

        $get_sent = $this->db->query("SELECT status,COUNT(status) as total_record FROM cc_contacts_email_record WHERE 1=1 ".$campaign_filter." group by status  ");
        $total_record=$get_sent->result_array();

        $data_arr = array();
        $total = 0;
        foreach ($total_record as  $value) {
            
            $data_arr[$value['status']] = round($value['total_record'],2);
        }

        $get_sent = $this->db->query("SELECT COUNT(id) as total_record FROM cc_contacts_email_record WHERE 1=1 ".$campaign_filter." ");
        $total_record=$get_sent->row_array();
        $data_arr['recipients'] = round($total_record['total_record'],2);
        
        return $data_arr;
    
    }//End get_client_email_campaigns_analysis


    //get_client_campaigns_graphs
    public function get_client_campaigns_graphs($data){

        extract($data);

        $time_filter ="";
        $campaign_filter ="";

        if($campaign_id !=''){
            $campaign_filter =" and campaign_id=".$campaign_id;
        }

        $data_arr[0]['name'] ='Upload';
        $data_arr[1]['name'] ='Pending';
       
        $dates = array();

        $begin = new DateTime( date('Y-m-d',strtotime('first day of this month')) );
        $end = new DateTime( date('Y-m-d',strtotime('last day of this month')) );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);   

        foreach($daterange as $date){

            $get_record = $this->db->query("SELECT COUNT(status) as total_record FROM cc_csv_names WHERE DATE_FORMAT(created_date,'%Y-%m-%d')='".$date->format("Y-m-d")."'  and status=1 ".$campaign_filter." ");
            $total_record = $get_record->row_array();

            if($total_record['total_record'] ==''){$total_record['total_record'] =0;}
            $data_arr[0]['data'][] = intval($total_record['total_record']);

            $get_record = $this->db->query("SELECT COUNT(status) as total_record FROM cc_csv_names WHERE DATE_FORMAT(created_date,'%Y-%m-%d')='".$date->format("Y-m-d")."'  and status=0 ".$campaign_filter." ");
            $total_record = $get_record->row_array();

            if($total_record['total_record']==''){$total_record['total_record'] =0;}
            $data_arr[1]['data'][] = intval($total_record['total_record']);

            array_push($dates,date('M d', strtotime($date->format("Y-m-d"))));
        }
        

        $return_array['data'] = $data_arr;
        $return_array['date'] = $dates;

        return $return_array;   

    }//End get_client_campaigns_graphs

}
?>
