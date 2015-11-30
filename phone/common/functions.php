<?php 

function getTotals($dbconn,$query)
{

  $i=0;
  $out='';
  $jout='';

  if ($dbconn->multi_query($query)) {
    do {
    /* store first result set */
       if ($result = $dbconn->store_result()) {
             while ($row = $result->fetch_row()) {
                $out[$result->fetch_field_direct(0)->name]=$row[0];
                $i++;
             }
             $result->free();
        }
     } while ($dbconn->next_result());
  }
return $out;
}

///still building
function dirToArray($pdir) { 
$d1=dir($pdir);

$phnTmplt = new stdClass();

$phnTmplt->path = $d1->path;
while (false !== ($e1 = $d1->read())) {
   if ($e1!='.' && $e1!='..') {
   $i++;
   $phnTmplt->make[$i]=$e1;
   $d2=dir($e1);
    echo $d2->path;
//	while (false !== ($e2 = $d2->read())) {
//	   if ($e2!='.' && $e2!='..') {
//		$j++;
  // 		$phnTmplt->make->model=[$j]=$e2;
//	   }
  //      }
   
   }
}
$d2->close();
$d1->close();
return $phnTmplt;

} 

?> 

