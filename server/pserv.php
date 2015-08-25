<?php
$unmatchedfname = "forbidden/unmatched.pusoydos";

$gameid = sha1($_SERVER['REMOTE_ADDR'] . "_" . microtime(true) . "thisisagame");

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
      $validcount = -100;
      $output .= $parts[$i][0] . " " . $parts[$i][1] . " " . $parts[$i][2] . "\n";
      if($parts[$i][0] == $_POST['id'])
      {
        $matched = true;
        echo "four";
        $gamefilestuff = file_get_contents("forbidden/" . $parts[$i][2] . ".pusoydos");
        $gamefilestuff = explode("\n", $gamefilestuff);
        for($j=0;$j<count($gamefilestuff);++$j)
        {
          $gamefilestuff[$j] = explode(" ", $gamefilestuff[$j]);
          if(count($gamefilestuff[$j]) == 2 && $gamefilestuff[$j][0] == $_POST['id'])
            $gamefilestuff[$j][] = $_POST['name'];
          $gamefilestuff[$j] = implode(" ", $gamefilestuff[$j]);
        }
        $newlinechar = "\n";
        $gamefilestuff = implode($newlinechar, $gamefilestuff);
        //print_r(gettype($gamefilestuff));
        file_put_contents("forbidden/" . $parts[$i][2] . ".pusoydos", $gamefilestuff);
      }
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
    $vcounter = 0;
    $output = "";
    $gamefilecontents = "";
    for($i=0;$i<count($parts);++$i)
    {
      if(count($parts[$i]) == 2)
      {
        ++$vcounter;
        if(trim($parts[$i][0]) == $_POST["id"])
        {
          $matched = true;
          $output .= $parts[$i][0] . " " . time();
          if($vcounter <=4)
            $output .= " $gameid";
          $output .= "\n";
          $gamefilecontents .= $parts[$i][0] . " " . time() . " " . $_POST['name'] . "\n";
        }
        else {
          $output .= $parts[$i][0] . " " . $parts[$i][1];
          if($vcounter <= 4)
            $output .= " $gameid";
          $output .= "\n";
          $gamefilecontents .= $parts[$i][0] . " " . $parts[$i][1] . "\n";
        }
      }
      else if(count($parts[$i]) >= 3)
      {
        $output .= $parts[$i][0] . " " . $parts[$i][1] . " " . $parts[$i][2] . "\n";
      }
    }
    echo "four";
    file_put_contents("forbidden/" . $gameid . ".pusoydos", $gamefilecontents);
    chmod("forbidden/" . $gameid . ".pusoydos", 0666);
  }
  file_put_contents($unmatchedfname, $output);
}

else{
  header('Content-Type:text/plain');
  $wow = file_get_contents($unmatchedfname);
  echo $unmatchedfname . " Contents:\n\n" . $wow;
}

?>
