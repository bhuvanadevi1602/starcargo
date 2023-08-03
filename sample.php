
<?php
include('include/config.php');
$fromdate="2023-07-25";
$todate="2023-07-25";
$from="Bhu";
$to="Dev";
$origin="Chennai";
$destination="Agra";
$sql = "SELECT * from booking where type='Air' and (creationdate>='$fromdate' and creationdate<='$todate')  and coraddress='$from' and conaddress='$to' and origin='$origin' and partyid=18 and destination='$destination' ORDER BY id ASC";
$stmt = $con->prepare($sql);
   $stmt->execute();
   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
 
<div class="container mt-3" style="width:60%;">
  <a href="export.php?export&fromdate=2023-07-25&todate=2023-07-25&from=Bhu&to=Dev&origin=Chennai&destination=Agra&partyid=18" class="btn btn-info btn-sm">Export to Excel</a><hr>
  <br>   
  <table class="table table-bordered" id="myTable">
    <thead>
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
      </tr>
    </thead>
    <tbody>
      <?php
        if(count($data)>0)
        {
          foreach($data as $key=>$value)
          {
          ?>
            <tr>
                     <td><?=$key+1?></td>   
                         <td><?=$value['creationdate']?></td> 
                         <td><?=$value['pod']?></td>  
                         <td><?=$value['coraddress']?></td>   
                         <td><?=$value['conaddress']?></td>   
                         <td><?=$value['origin']." - ".$value['destination']?></td>   
                         <td><?=$value['quantity']?></td> 
                         <td><?=$value['weight']?></td>   
                         <td><?=$value['rate']?></td>   
                         <td><?=$value['amount']?></td>   
                         <td><?=$value['docs']?></td>   
                         <td><?=$value['paid']?></td>   
                  </tr>
            <?php
          }
        }
      ?>  
       
    </tbody>
  </table>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="jquery-table2excel-master/src/jquery.table2excel.js"></script>
</body>
</html>