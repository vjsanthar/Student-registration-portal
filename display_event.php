<?php                
require 'includes/database.php';
$display_query = "select bookings_id,purpose,from_date_time,to_date_time from bookings";             
$results = mysqli_query($con,$display_query);   
$count = mysqli_num_rows($results);  
if($count>0) 
{
	$data_arr=array();
    $i=1;
	while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{	
	$data_arr[$i]['event_id'] = $data_row['bookings_id'];
	$data_arr[$i]['title'] = $data_row['purpose'];
	$data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['from_date_time']));
	$data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['to_date_time']));
	$data_arr[$i]['color'] = '#'.substr(uniqid(),-13); 
	$i++;
	}
	
	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>