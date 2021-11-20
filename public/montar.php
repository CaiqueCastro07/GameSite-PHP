<?php

include('./Assets/tools.php');

$page = "";
$minesInfo = false;
$memoryInfo = false;

function formLayout()
{

    global $dados;
    global $minesInfo;
    $status = "";
    $bombsNumber = 0;

    $newBase = explode('#gameHere', $dados->base, 2);

    if ($dados->game == "memory") {

        $memoryInfo = false;

        if (!$dados->cards) {

                $memoryInfo = buildDeck();
           
        } else {

            $memoryInfo = array_values(json_decode($dados->cards, true));
        }

        $copy = [...$memoryInfo];

        $revealed = array();

        if ($dados->cardOrder) {

            foreach ($copy as $i => $card) {

                $idx = $i;

                if ($dados->cardOrder === $memoryInfo[$idx]['title']) {
                    $memoryInfo[$idx]['clicked'] = true;
                }
            };

            foreach ($memoryInfo as $card) {

                if ($card['clicked'] === true && $card['revealed'] === false) {

                    array_push($revealed, $card['title']);
                }
            };
        }

        $memoryDiv = "";

        foreach ($memoryInfo as $i => $card) {

            $input = "<input type='submit' class='pickCard' name='cardOrder' value='" . $card['title'] . "'/>";

            $media = " style='background-image:url(" . $card['media'] . ");'";

            if (!$card['clicked'] && $card['revealed'] === false) {

                $media = " style='background-image:url(https://i.imgur.com/pzfTKtf.png);'";

                if (count($revealed) === 2) {

                    $input = "<input type='submit' class='pickCard' name='cardOrder value='' />";
                }

                if ($card['revealed']) {
                    $input = "";
                }
            } else {

                $input = "";


                if (count($revealed) === 2) {

                    $input = "<input type='submit' class='pickCard' name='cardOrder value='' />";
                }

                if ($card['revealed']) {
                    $input = "";
                }
            }


            if ($card['revealed']) {
                $input = "";
            }

            $memoryDiv .= "<div class='card'" . $media . " >" . $input . "</div>";
        }

        if (count($revealed) === 2) {

            $revealed[0] = str_replace("2", "", $revealed[0]);
            $revealed[1] = str_replace("2", "", $revealed[1]);

            if ($revealed[0] !== $revealed[1]) {

                for ($i = 0; $i < count($memoryInfo); $i++) {

                    $memoryInfo[$i]['clicked'] = false;
                };
            } else {

                for ($i = 0; $i < count($memoryInfo); $i++) {

                    if ($revealed[0] === str_replace("2", "", $memoryInfo[$i]['title'])) {

                        $memoryInfo[$i]['revealed'] = true;
                    }
                };
            }
        };

        $button = "";
        $state = "<input type='hidden' name='cards' value='" . json_encode(array_values($memoryInfo)) . "' />";

        $over = 0;

        foreach($memoryInfo as $card){

            if($card['revealed']){
                $over++;
            }
        }

        if($over === 12){
        $button = "<div class='holdInfo'><input class='start' type=submit name='memoryStatus' value='New Game' /></div>";
        }

        $page = $newBase[0] . "<div class='memory'>" . $button . $state  . "<div class='memBoard'>" . $memoryDiv . "</div></div>" . $newBase[1];
        
        echo $page;

        return;
    }

    if ($dados->game == "mine") {

        $mineOrder = json_decode($dados->mineOrder);

        if (!$dados->mines) {

            if ($dados->status) {

                if ($dados->bombs > 40) {
                    $dados->bombs = 40;
                }
                if ($dados->bombs <= 6) {
                    $dados->bombs = 6;
                }

                $minesInfo = generateGrid($dados->bombs);
            }
        }

        if ($dados->mines) {

            $minesInfo = array_values(json_decode($dados->mines, true));
        };

        if ($dados->mineOrder) {

            $minesInfo[$mineOrder->idx]['clicked'] = true;

            $target = $minesInfo[$mineOrder->idx];

            if ($target['value'] === 'B') {

                $newMines = array(...$minesInfo);

                foreach ($newMines as $i => $e) {

                    $idx = $i;

                    $minesInfo[$idx]['clicked'] = true;
                };
            };

            if ($target['value'] === 0) {

                function revealAround($around)
                {

                    global $minesInfo;

                    foreach ($around as $i => $e) {
                        if ($minesInfo[$e]['value'] === 'B') {
                            continue;
                        }
                        if ($minesInfo[$e]['clicked'] === true) {
                            continue;
                        }

                        $minesInfo[$e]['clicked'] = true;

                        if ($minesInfo[$e]['value'] === 0) {
                            revealAround($minesInfo[$e]['around']);
                        }
                    }
                }

                revealAround($target['around']);
            };
        }

        $mode = array(
            "hidden" => function ($value) {
                return "<input type='submit' class='submit' name='mineOrder' value='" . $value . "'/>";
            },
            "bomb" => function ($value) {
                return "<div class='bomb' value='" . $value . "'>B</div>";
            },
            "empty" => function ($value) {
                return "<div class='empty value='" . $value . "'></div>";
            },
            "danger" => function ($value) {
                $number = json_decode($value);

                return "<div class='danger' value='" . $value . "'>" . $number->value . "</div>";
            }
        );

        $minesDiv = "";

        $clickedCC = 0;

        if ($dados->status) {

            foreach ($minesInfo as $mine) {

                if ($mine['clicked']) {

                    $clickedCC++;

                    if ($mine['value'] === 'B') {

                        $minesDiv .= $mode['bomb'](json_encode($mine));
                        continue;
                    }

                    if ($mine['value'] === 0) {

                        $minesDiv .= $mode['empty'](json_encode($mine));
                        continue;
                    }

                    $minesDiv .= $mode['danger'](json_encode($mine));

                    continue;
                }

                $minesDiv .= $mode['hidden'](json_encode($mine));
            };
        };

        $state = "
        <div class='holdInfo'><input class='start' type=submit name='status' value='New Game' />
        <input class='choose' type='number' name='bombs' value='6'/></div>
            ";

        if ($dados->status) {

            $state = "
                <input type='hidden' name='mineSave' value='" . json_encode(array_values($minesInfo)) . "'/>
                   
                    <input type='hidden' name='status' value='running' />";
        }

        if ($clickedCC === count($minesInfo)) {
            $state = "<div class='holdInfo'><input class='start' type=submit name='status' value='New Game' />
            <input class='choose' type='number' name='bombs' value='6' /></div>
                      <input type=hidden name='mineSave' value='" . false . "'/>
                      ";
        };

        $page = $newBase[0] . "<div class='mine'>" . $state . "<div class='board'>" . $minesDiv . "</div></div>" . $newBase[1];

        $toAddRefresh = explode('#refreshSame', $page, 2);

        $page = $toAddRefresh[0] . "<input type='hidden' name='modo' value='mine' />" . $toAddRefresh[1];

        echo $page;

        return;
    }
};
