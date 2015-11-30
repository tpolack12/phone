<?php
require('../common/config.php');
require('../common/functions.php');

$location=preg_replace('/ +/', '', $_POST['location']);
$srchtext=preg_replace('/ +/', '', $_POST['text']);
$query="Select Location,Caller_ID,Contact_NUM from Directory where Location like '{$location}%' and Caller_ID like '%{$srchtext}%'";

$result = $link->query($query) or die("An error has occurred");

echo '
<table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Number</th>
        <th></th>
      </tr>
    </thead>
    <tbody>';

while($row = $result->fetch_row()) {
echo "      
      <tr>
        <td class='col-md-3'>{$row[1]}</td>
        <td class='col-md-3'>{$row[2]}</td>
        <td class='col-md-3'></td>
      </tr>";
  }
echo '
    </tbody>
</table>';
?>

