<?php
$unmatchedfname = "forbidden/unmatched.pusoydos";

if(isset($_POST["id"]) && isset($_POST['type']) && $_POST['type'] == 'findmatch')
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
    if(count($parts[$i]) == 2)
    {
      ++$validcount;
      if(trim($parts[$i][0]) == $_POST["id"])
      {
        $matched = true;
        $output .= $parts[$i][0] . " " . time() . "\n";
      }
      else {
        if(intval($parts[$i][1]) + 10 > time()) // 10 second grace
          $output .= $parts[$i][0] . " " . $parts[$i][1] . "\n";
        else {
          --$validcount;
          $parts[$i] = "";
        }
      }
    }
    else if(count($parts[$i]) >= 3)
    {
      $output .= $parts[$i][0] . " " . $parts[$i][1] . " " . $parts[$i][2] . "\n";
      if($parts[$i][0] == $_POST['id'])
        echo "four";
    }
    else {
      $parts[$i] = "";
    }
  }
  if(!$matched)
  {
    $output .= $_POST['id'] . " " . time();
    $parts[] = array($_POST['id'] , (string)time());
    ++$validcount;
  }
  if($validcount >= 4)
  {
    $gameid = sha1($_SERVER['REMOTE_ADDR'] . "_" . microtime(true) . "thisisagame");
    $vcounter = 0;
    $output = "";
    for($i=0;$i<count($parts) && $vcounter < 4;++$i)
    {
      if(count($parts[$i]) == 2)
      {
        ++$vcounter;
        if(trim($parts[$i][0]) == $_POST["id"])
        {
          $matched = true;
          $output .= $parts[$i][0] . " " . time() . " $gameid\n";
        }
        else {
          $output .= $parts[$i][0] . " " . $parts[$i][1] . " $gameid\n";
        }
      }
      else if(count($parts[$i]) >= 3)
      {
        $output .= $parts[$i][0] . " " . $parts[$i][1] . " " . $parts[$i][2] . "\n";
      }
    }
    echo "four";
  }
  file_put_contents($unmatchedfname, $output);
}

else{
  header('Content-Type:text/plain');
  $wow = file_get_contents($unmatchedfname);
  echo $unmatchedfname . " Contents:\n\n" . $wow;
}

?>
