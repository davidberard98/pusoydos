<?php
$unmatchedfname = "forbidden/unmatched.pusoydos";

if(isset($_POST["id"]))
{
  $raw = file_get_contents($unmatchedfname);
  $parts = explode("\n", $raw);
  $output ="";
  for($i=0;$i<count($parts);++$i)
  {
    $parts[$i] = explode(" ", $parts[$i]);
  }
  $matched = false;
  $validcount = 0;
  for($i=0;$i<count($parts);++$i)
  {
    if(count($parts[$i]) >= 2)
    {
      ++$validcount;
      if(trim($parts[$i][0]) == $_POST["id"])
      {
        $matched = true;
        $output .= $parts[$i][0] . " " . time() . "\n";
      }
      else {
        if(intval($parts[$i][1]) + 10 > time())
          $output .= $parts[$i][0] . " " . $parts[$i][1] . "\n";
      }
    }
  }
  if(!$matched)
  {
    $output .= $_POST['id'] . " " . time();
    ++$validcount;
  }
  if($validcount >= 4)
    echo "four";
  file_put_contents($unmatchedfname, $output);
}

else{
  header('Content-Type:text/plain');
  $wow = file_get_contents($unmatchedfname);
  echo $unmatchedfname . " Contents:\n\n" . $wow;
}

?>
