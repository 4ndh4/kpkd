 <?php 
function to_excel($query, $filename = 'exceloutput')
{
     $obj =& get_instance();
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below
     $fields = $query->list_fields(); // $query->field_data();
     if ($query->num_rows() == 0) {
          echo '<p>The table appears to have no data.</p>';
     } else {
          for($i=0;$i<count($fields);$i++){
             $headers .= $fields[$i] . "\t";
          }
          /*
          foreach ($fields as $field) {
             $headers .= $field->name . "\t";
          }
          */
          foreach ($query->result() as $row) {
               $line = '';
               foreach($row as $value) {                                            
                    if ((!isset($value)) OR ($value == "")) {
                         $value = "\t";
                    } else {
                         $value = str_replace('"', '""', $value);
                         $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
               }
               $data .= trim($line)."\n";
          }
          $data = str_replace("\r","",$data);
          //header("Content-type: application/x-msdownload");
          //header("Content-Disposition: attachment; filename=$filename.xls");
          return "$headers\n$data"; // echo "$headers\n$data";  
     }
}