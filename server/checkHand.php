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
  if(isStraight($handArray) && !isStraightFlush($handArray))
    return 3;
  if(isFlush($handArray))
    return 4;
  if(isHouse($handArray))
    return 5;
  if(isFour($handArray))
    return 6;
  if(isStraightFlush($handArray) && !isRoyalFlush($handArray))
    return 7;
  if(isRoyalFlush($handArray))
    return 8;
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
    $ordered = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    for($i=0;$i<5;++$i)
    {
      ++$ordered[$handArray[$i]->rank];
    }
    $counter = 0;
    for($i=1;$i<=13;++$i)
    {
      if($counter == 5)
        return true;
      if($counter > 0 && $ordered[$i] != 1)
        return false;
      if($ordered[$i] == 1)
        ++$counter;
    }
  }
  return false;
}

function isFlush($handArray)
{
  if(count($handArray) == 5)
  {
    $firstsuite = false;
  }
  return false;
}

function isHouse($handArray)
{
  if(count($handArray) == 5)
  {
    $ca = 0;
    $cb = 0;
  }
  return false;
}

function isFour($handArray)
{
  if(count($handArray) == 5)
  {
    $ca = 0;
    $ta = 0;
    $cb = 0;
    $tb = 0;
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
    $lowestCard = 0;
  }
  return false;
}


?>
