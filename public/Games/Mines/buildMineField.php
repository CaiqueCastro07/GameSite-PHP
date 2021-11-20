<?php

function generateGrid($bombs)
{

  $dotsArray = array();

  $idx = 0;

  for ($x = 0; $x < 9; $x++) {
    for ($y = 0; $y < 9; $y++) {

      $dot = array('x' => $x, 'y' => $y, 'idx' => $idx, 'value' => 0, 'around' => array(), 'clicked' => false);

      array_push($dotsArray, $dot);

      $idx++;
    }
  };


  foreach ($dotsArray as $key => $dot) {

    $idx1 = $key;

    $track = array();

    $xAxis = $dotsArray[$idx1]['x'];
    $yAxis = $dotsArray[$idx1]['y'];

    for ($x = -1; $x < 2; $x++) {
      for ($y = -1; $y < 2; $y++) {
        if (($yAxis - $y) <= -1 || ($yAxis - $y) >= 9) {
          continue;
        }
        if (($xAxis - $x) <= -1 || ($xAxis - $x) >= 9) {
          continue;
        };

        array_push($track, array('xS' => $xAxis - $x, 'yS' => $yAxis - $y));
      };
    };

    foreach ($dotsArray as $ii => $e) {

      $i = $ii;


      foreach ($track as $cc) {
        if ($i == $idx1) {
          continue;
        };

        if ($dotsArray[$i]['x'] === $cc['xS'] && $dotsArray[$i]['y'] === $cc['yS']) {
          array_push($dotsArray[$idx1]['around'], $i);
          continue;
        };
      };
    };
  };

  function random($min, $max, $quantity)
  {
    $numbers = range($min, $max - 1);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
  };

  $fieldSize = count($dotsArray);

  $bombsToSend = random(0, $fieldSize, $bombs);

  foreach ($bombsToSend as $place) {

    $dotsArray[$place]['value'] = 'B';
  };

  $newArray = array(...$dotsArray);

  foreach ($newArray as $i => $dots) {

    $idx = $i;

    $value = $newArray[$idx]['value'];
    $around = $dots['around'];
    if ($value !== 'B') {

      foreach ($around as $ele) {

        $each = $dotsArray[$ele]['value'];
        if ($each === 'B') {
          $dotsArray[$idx]['value']++;
        }
      };
    };
  };

  return $dotsArray;
};
