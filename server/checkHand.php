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
    return true;
  return false;
}

function isDouble($handArray)
{
  if(count($handArray) == 2)
  {
    if($handArray[0]->rank == $handArray[1]->rank)
      return true;
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
    for($i=0;$i<=12;++$i)
    {
      if($counter == 5)
        return true;
      if($counter > 0 && $ordered[$i] != 1)
        return false;
      if($ordered[$i] == 1)
        ++$counter;
    }
    if($counter == 5)
      return true;
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
    return true;
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
      return true;
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
      return true;
  }
  return false;
}

function isStraightFlush($handArray)
{
  if(isStraight($handArray) && isFlush($handArray))
    return true;
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
      return true;
  }
  return false;
}


?>
