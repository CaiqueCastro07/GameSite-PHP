<?php


class processar
{
   public $base = "
<form action='index.php' method='post' id='minegame'>
<div class='background'>
   <div class='area'>
      <div class='navbar'>
      #refreshSame
         <input type='submit' name='modo' value='memory' class='tab1' />
         <input type='submit' name='modo' value='mine' class='tab2' />
      </div>
      <input type='hidden' name='oldMine' value='' />
      <div class='jogo'>
      #gameHere
      </div>
   </div>
</div>
</form>";

   public $game = "memory";
   public $mines = false;
   public $mineOrder = "";
   public $status = false;
   public $bombs = 0;

   public $cards = false;
   public $cardOrder = null;
   public $memoryStatus = false;

   function __construct()
   {

      if (isset($_POST['mineSave'])) {

         $this->mines = $_POST['mineSave']; // continua string

      };

      if (isset($_POST['mineOrder'])) {

         $this->mineOrder = $_POST['mineOrder']; // continua string

      };

      if (isset($_POST['command'])) {

         $this->mines = false; // continua string

      }

      if (isset($_POST['status'])) {

         $this->status = true; // continua string

      }

      if (isset($_POST['bombs'])) {

         $this->bombs = $_POST['bombs']; // continua string

      }

      if (isset($_POST['modo'])) {

         $this->game = $_POST['modo'];
      };

      if (isset($_POST['cardOrder'])) {

         $this->cardOrder = $_POST['cardOrder'];
      };

      if (isset($_POST['cards'])) {

         $this->cards = $_POST['cards'];
      };

      if (isset($_POST['memoryStatus'])) {

         $this->cards = false;
      };
      
   }
}

$dados = new processar();
