<?php include('include/config.php');
 //export table data to excel
if(isset($_GET['export']))
{

$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];
$partyid=$_GET['partyname'];
$partytype=$_GET['type'];

$query1= "select * from party where id=:id";
$exe = $con->prepare($query1);
$data = [':id' => $partyid];
$exe->execute($data);
$result = $exe->fetch(PDO::FETCH_ASSOC);


$query2= "select * from partyset where partyid=:partyid";
$exe2 = $con->prepare($query2);
$data2 = [':partyid' => $partyid];
$exe2->execute($data2);
$result2 = $exe2->fetch(PDO::FETCH_ASSOC);

   $output = "";
         
        $output .= '<table class="table table-bordered" border="1">  
        <tr rowspan="12" align="center"><td colspan="3"><img src="https://udhaarsudhaar.net/star_cargo/assets/images/Star-cargo-logo.png" style="width=10% !important;height: 10% !important;"/></td>
        <td colspan="9">
     STAR CARGO SYSTEM<br/>
     (An ultimate name in cargo services)<br/>
     CHENNAI Off : # 5/8,Macfor Lane, 1st Floor Periamet Chennai - 600 003.<br/>
     Ph: No :Ch -09362001307, 9362001301, Email id: starcargo08@gmail.com.<br/>
     GSTIN : 33EEUPS8160H1ZT, SAC Code: 996531, State Code: 33
     </td> 
     </tr>
     <tr rowspan="12">
     <td colspan="3" align="left">  To
     </td>	
     <td colspan="6" align="center">  By Train Invoice
     </td>		
     <td colspan="3"> Pan No: EEUPS8160H
     </td>			
</tr>
<tr rowspan="12">
<td colspan="3" align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result2['partyname'].'
</td>
<td colspan="6" align="center">  
  TN - Delhi
  </td>
  <td colspan="3"> 
  Bill No : '.$result['id'].'
  </td>
  </tr>					
</tr>
<tr rowspan="12">
<td colspan="3" align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result2['partyaddress'].'
</td>
<td colspan="6" align="center">  
  </td>
  <td colspan="3"> 
  Bill Date : '.$result['creationdate'].'
  </td>
  </tr>					
</tr>
         
<tr rowspan="12">
<td colspan="3" align="left">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GST : '.$result['gst'].'
</td>
<td colspan="6" align="center">  
  </td>
  <td colspan="3"> 
  From : '.$fromdate.' to '.$todate.'
  </td>
  </tr>					
</tr>
         
<tr>  
                          <th scope="col">S.No</th>
                          <th scope="col">Date</th>
                          <th scope="col">POD No</th>
                          <th scope="col">From</th>
                          <th scope="col">To</th>
                          <th scope="col">Origin</th>
                          <th scope="col">PCS</th>
                          <th scope="col">W/T</th>
                          <th scope="col">Rate</th>
                          <th scope="col">Amount Basic</th>
                          <th scope="col">Doc Charge</th>
                          <th scope="col">Total</th>
                    </tr>';
             
   $sql = "SELECT * from booking where type='Train' and (creationdate>='$fromdate' and creationdate<='$todate') and partyid='$partyid'  ORDER BY id ASC";
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
                         <td>'.$value['creationdate'].'</td> 
                         <td>'.$value['pod'].'</td>  
                         <td>'.$value['coraddress'].'</td>   
                         <td>'.$value['conaddress'].'</td>   
                         <td>'.$value['origin'].' - '.$value['destination'].'</td>   
                         <td>'.$value['quantity'].'</td> 
                         <td>'.$value['weight'].'</td>   
                         <td>'.$value['rate'].'</td>   
                         <td>'.$value['amount'].'</td>   
                         <td>'.$value['docs'].'</td>   
                         <td>'.$value['paid'].'</td>   
                       
                         
                    </tr>';  
        }
          
        $output .= '
        <tr>
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> </tr>
        <tr>
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> </tr>
        <tr>
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> </tr>
        <tr>
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> </tr>
        <tr>
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> 
        <td></td>   
        <td></td> </tr>
         
        <tr>  
        <td></td>   
        <td></td> 
        <td></td>  
        <td></td>   
          <td>Total</td>   
          <td></td>   
          <td>'.$qty.'</td>   
          <td>'.$weight.'</td>   
          <td></td>   
          <td></td>   
        <td></td>   
        <td>'.$net.'</td>   
         
   </tr>';
   if($value['igst']!=0){
    $igstamt=($value['igst']*$net)/100;
    $roffs=fmod($igstamt, 1);
     $grand=$net+$igstamt;
    $output .= '<tr>  
        <td></td>   
        <td></td> 
        <td></td>  
        <td></td>   
          <td>IGST</td>   
          <td></td>   
          <td>'.$value['igst'].'%</td>   
          <td></td>   
          <td></td>   
          <td></td>   
        <td></td>   
        <td>'.round($igstamt,2).'</td>   
   </tr><tr>  
   <td></td>   
   <td></td> 
   <td></td>  
   <td></td>   
     <td>Round Off</td>   
     <td></td>   
     <td></td>   
     <td></td>   
     <td></td>   
     <td></td>   
   <td></td>   
   <td>'.round($roffs,2).'</td>   
    
   </tr>';
   }
   else if($value['sgst']!=0 && $value['cgst']!=0) {
    $sgstamt=($value['sgst']*$net)/100;
    $cgstamt=($value['cgst']*$net)/100;
   $roff=fmod($cgstamt, 1);
$grand=$net+$sgstamt+$cgstamt;

    $output .= '<tr>  
    <td></td>   
    <td></td> 
    <td></td>  
    <td></td>   
      <td>SGST</td>   
      <td></td>   
      <td>'.$value['sgst'].'%</td>   
      <td></td>   
      <td></td>   
      <td></td>   
    <td></td>   
    <td>'.round($sgstamt,2).'</td>   
     
</tr><tr>  
<td></td>   
<td></td> 
<td></td>  
<td></td>   
  <td>CGST</td>   
  <td></td>   
  <td>'.$value['cgst'].'%</td>   
  <td></td>   
  <td></td>   
  <td></td>   
<td></td>   
<td>'.round($cgstamt,2).'</td>   
 
</tr><tr>  
<td></td>   
<td></td> 
<td></td>  
<td></td>   
  <td>Round Off</td>   
  <td></td>   
  <td></td>   
  <td></td>   
  <td></td>   
  <td></td>   
<td></td>   
<td>'.round($roff,2).'</td>   
 
</tr>';
   }
   $output .= '
   <tr>  
   <td></td>   
   <td></td> 
   <td></td>  
   <td></td>   
     <td>Grand Total</td>   
     <td></td>   
     <td></td>   
     <td></td>   
     <td></td>   
     <td></td>   
   <td></td>   
   <td>'.round($grand,0).'</td>   
    
   </tr><tr>  
   <td colspan="12" align="center"> OUR ACCOUNT DETAIL BELOW	</td>										
    </tr>
    <tr>  
       <td colspan="12" align="center">
      ICICI BANK,  A/C NAME : STAR CARGO SYSTEM, A/C NO: 602505061905, IFSC CODE : ICIC0006025											
 </td></tr>
 <tr>  
 <td colspan="12" align="center">
  BRANCH : PURSAWALKAM,  CHENNAI 600084											
  </td></tr><tr>  
  <td colspan="12" align="left">Terms And Conditions : </td>										
   </tr>
   <tr>  
  <td colspan="12" align="left"> 1 Difference, if any, may be notified within 3 days of receipt.</td>									
   </tr>
   <tr rowspan="12">
   <td colspan="6" align="left"> 2.Any difference Please reply us this id: starcargo08@gmail.com.
   </td>	
   <td colspan="6" align="center">  for STAR CARGO SYSTEM
   </td>		
  	
</tr>
<tr>  
<td colspan="12" align="left">  3.Payment should be paid as A/C payee Cheque or DD.</td>									
 </tr>				
 <tr rowspan="12">
 <td colspan="6" align="left"> .
 </td>	
 <td colspan="6" align="center">                Accountant					

 </td>		
  
</tr>
<tr>  
<td colspan="12" align="left"> Receivers Signature with Seal : ___________
</td>									
 </tr>	
  </table>';
        
        // $filename = "table_data_export_".date('Ymd') . ".xls";         
        $filename = "Train ".$result['partyname']." ".$fromdate." - ".$todate . ".xls";         
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");  
        echo $output;
      }   
?>