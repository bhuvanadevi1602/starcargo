<?php include('include/config.php');
 //export table data to excel
if(isset($_GET['export']))
{

$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];

$time=strtotime($fromdate);
$month=date("M",$time);

   $output = "";
         
        $output .= '<table   class="table table-bordered" border="1" style="border-collapse:collapse">  
        <tr rowspan="16" align="center"><td colspan="5"><img src="http://localhost/star_cargo/assets/images/Star-cargo-logo.png" style="width:50px !important;height: 50px !important;"/></td>
        <td colspan="11">
     STAR CARGO SYSTEM<br/>
     (An ultimate name in cargo services)<br/>
     CHENNAI Off : # 5/8,Macfor Lane, 1st Floor Periamet Chennai - 600 003.<br/>
     Ph: No :Ch -09362001307, 9362001301, Email id: starcargo08@gmail.com.<br/>
     GSTIN : 33EEUPS8160H1ZT, SAC Code: 996531, State Code: 33
     </td> 
     </tr>
     <tr rowspan="16">
     <td colspan="16" align="center"> DAY ENTRY FOR THE MONTH OF '.$month.' -  2023
     </td>	
    	
</tr>
<tr>  
                          <th scope="col">S.No</th>
                          <th scope="col">M.No</th>
                          <th scope="col">Booking</th>
                          <th scope="col">Transport</th>
                          <th scope="col">PCS</th>
                          <th scope="col">W/T</th>
                          <th scope="col">TRAIN</th>
                          <th scope="col">DATE</th>
                          <th scope="col">POD</th>
                          <th scope="col">FROM</th>
                          <th scope="col">TO</th>
                          <th scope="col">KGS</th>
                          <th scope="col">TOPAY</th>
                          <th scope="col">DE/CR</th>
                          <th scope="col">BILL</th>
                          <th scope="col">POD</th>
                    </tr>';
             
   $sql = "SELECT * from booking where (creationdate>='$fromdate' and creationdate<='$todate')  ORDER BY id ASC";
   $stmt = $con->prepare($sql);
   $stmt->execute();
   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        $i=0;
        $qty=0;
        $weight=0;
        $net=0;
        foreach($data as $key=>$value){
 $i++;
 $qty+=$value['quantity'];
 $weight+=$value['weight'];
 $net+=$value['paid'];
    $output .= '<tr>  
                         <td>'.($key+1).'</td>   
                         <td>'.$value['mno'].'</td> 
                         <td>'.$value['origin'].'</td>  
                         <td>'.$value['transport'].'</td>   
                         <td>'.$value['quantity'].'</td>   
                         <td>'.$value['gross'].'</td>   
                         <td>'.$value['trainname'].'</td>   
                         <td>'.$value['creationdate'].'</td>   
                         <td>'.$value['pod'].'</td>   
                         <td>'.$value['conaddress'].'</td>   
                         <td>'.$value['coraddress'].'</td>   
                         <td>'.$value['weight'].'</td>   
                         <td>'.$value['rate'].'</td>   
                         <td>-</td>   
                         <td>'.$value['paymentmode'].'</td>   
                         <td>'.$value['pod'].'</td>   
                         </tr>';  
        }
          
        $output .= ' 
</table>';
        
        // $filename = "table_data_export_".date('Ymd') . ".xls";         
      //   $filename = "Details ".$month. ".xls";         
      //   header("Content-Type: application/vnd.ms-excel");
      //   header("Content-Disposition: attachment; filename=\"$filename\"");  
        echo $output;
      }   
?>