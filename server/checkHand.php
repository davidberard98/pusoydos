<?php

require_once("card.php");

function handType($integerHand)
{
  $hands = array(
    0 => "invalid",
    1 => "singles",
    2 => "doubles",
    3 => "straight",
    4 => "flush",
    5 => "house",
    6 => "4 of a kind",
    7 => "straight flush",
    8 => "royal flush",
  );
  return $hands[$integerHand];
}

function isValidHand($handArray)
{
  if(isSingle($handArray))
    return 1;
  if(isDouble($handArray))
    return 2;
  if(isRoyalFlush($handArray))
    return 8;
  if(isStraightFlush($handArray))
    return 7;
  if(isFour($handArray))
    return 6;
  if(isHouse($handArray))
    return 5;
  if(isFlush($handArray))
    return 4;
  if(isStraight($handArray))
    return 3;

  return 0;
}

function isSingle($handArray)
{
  if(count($handArray) == 1)
    return $handArray[0];
  return false;
}

function isDouble($handArray)
{
  if(count($handArray) == 2)
  {
    if($handArray[0]->rank == $handArray[1]->rank)
    { // true
      if($handArray[0]->greaterThan($handArray[1]))
        return $handArray[0];
      return $handArray[1];
    }
  }
  return false;
}

function isStraight($handArray)
{
  if(count($handArray) == 5)
  {
                  // 3,4,5,6,7,8,9,0,J,Q,K,A,2
    $ordered = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
    for($i=0;$i<5;++$i)
    {
      $val = ($handArray[$i]->rank-3+13)%13;
      ++$ordered[$val];
    }
    $counter = 0;
    $largest = 12;
    for($i=0;$i<=12;++$i)
    {
      if($counter == 5)
      {
        $largest = $i-1;
        break;
      }
      if($counter > 0 && $ordered[$i] != 1)
        return false;
      if($ordered[$i] == 1)
        ++$counter;
    }
    if($counter == 5)
    { // true
      for($i=0;$i<5;++$i) // find the large card
      {
        if(($handArray[$i]->rank-3+13)%13 == $largest)
          return $handArray[$i];
      }
    }
  }
  return false;
}

function isFlush($handArray)
{
  if(count($handArray) == 5)
  {
    $suitetype = $handArray[0]->suite;
    for($i=1;$i<5;++$i)
    {
      if($handArray[$i]->suite != $suitetype)
        return false;
    }
    //true
    $highcard = new card("A");
    for($i=0;$i<5;++$i)
    {
      if($handArray[$i]->greaterThan($highcard))
        $highcard = $handArray[$i];
    }
    return $highcard;
  }
  return false;
}

function isHouse($handArray)
{
  if(count($handArray) == 5)
  {
    $countA = 0;
    $rankA = 0;
    $countB = 0;
    $rankB = 0;
    for($i=0;$i<5;++$i)
    {
      if($handArray[$i]->rank == $rankA)
        ++$countA;
      if($handArray[$i]->rank == $rankB)
        ++$countB;
      if($handArray[$i]->rank != $rankA && $handArray[$i]->rank != $rankB)
      {
        if($rankA == 0)
        {
          $rankA = $handArray[$i]->rank;
          ++$countA;
        }
        if($rankA != 0 && $rankB == 0)
        {
          $rankB = $handArray[$i]->rank;
          ++$countB;
        }
      }
    }
    if(($countA == 2 && $countB == 3) || ($countA == 3 && $countB == 2))
    { // true
      if($countA == 2) // flip it
      {
        $countA = 3;
        $countB = 2;
        //$holder = $rankA;
        $rankA = $rankB;
        //$rankB = $holder;
      }
      $highcard = new card("A");
      for($i=0;$i<5;++$i)
      {
        if($handArray[$i]->rank == $rankA && $handArray[$i]->greaterThan($highcard))
          $highcard = $handArray[$i]
      }
      return $highcard;
    }
  }
  return false;
}

function isFour($handArray)
{
  if(count($handArray) == 5)
  {
    $theRank = $handArray[0]->rank;
    $counter = 1;
    for($i=1;$i<5;++$i)
    {
      if($handArray[$i]->rank == $theRank)
        ++$counter;
    }
    if($counter == 4)
    { // true
      return new card($theRank . 'h');
    }
  }
  return false;
}

function isStraightFlush($handArray)
{
  if(isStraight($handArray) && isFlush($handArray))
    return isStraight($handArray);
  return false;
}

function isRoyalFlush($handArray)
{
  if(isStraightFlush($handArray))
  {
    $lowest = 14;
    for($i=0;$i<5;++$i)
    {
      if($handArray[$i]->rank < $lowest && $handArray[$i]->rank >= 3)
        $lowest = $handArray[$i]->rank;
    }
    if($lowest == 11)
      return new card("2" . $handArray[$i]->suite);
  }
  return false;
}


?>
