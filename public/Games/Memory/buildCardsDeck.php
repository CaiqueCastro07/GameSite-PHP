<?php

include('cards.php');

function buildDeck(){
global $cards;

$copyCards = array(...$cards);

foreach($cards as $i => $single){

  $idx = $i;

  $copyCards[$idx]['title'] .= '2';

};

$doubleCards = [...$cards,...$copyCards];


$test = shuffle($doubleCards);


 return $doubleCards;

}

?>