#!/usr/bin/php
<?php


if ($argc < 3)
{ 
   echo "Usage: {$argv[0]} <file> <location>".PHP_EOL;
}
else
{
  $file=$argv[1];
  $location=$argv[2];
  
  $filename="directory.csv";
   if(is_file($file))
   {
        $handle=fopen($file, 'r');
	//file_put_contents("directory.csv","");	
        while(!feof($handle))
        {
                $line = fgets($handle, 8192);
                $data1=preg_split("/</",$line);
                $data2=preg_replace("/>|\"|\\n|\s+$/","",$data1);
		
		@$dirdata="\"{$location}\",\"{$data2[0]}\",\"{$data2[1]}\"".PHP_EOL;
		
		file_put_contents("directory.csv",$dirdata,FILE_APPEND | LOCK_EX);
        }
    }

}
?>
