<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author FlorentD
 */
class LetellierBastienPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    protected function is_only_friend()
    {
      if (count($this->result->getChoicesFor($this->opponentSide)) < 2)
        return false;
      for ($i = 0; count($this->result->getChoicesFor($this->opponentSide)) > $i; $i++) {
        if ($this->result->getChoicesFor($this->opponentSide)[i] == parent::foeChoice())
        {
          return false;
        }
      }
      return true;
    }

    protected function is_better_to_foe()
    {
      for ($i = 0; count($this->result->getChoicesFor($this->opponentSide)) > $i; $i++) {
        if ($this->result->getChoicesFor($this->opponentSide)[i] == parent::friendChoice()
        && $this->result->getChoicesFor($this->mySide)[i - 1] == parent::foeChoice())
        {
          continue;
        }
      }
      return true;
    }

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        //Premier on est cool
        if (count($this->result->getChoicesFor($this->mySide)) == 0)
          return parent::friendChoice();

        //Si le mec est cool
        if ($this->result->getLastChoiceFor($this->opponentSide) == parent::friendChoice())
        {
          //Est ce que c'est un pigeon?
          if ($this->is_only_friend())
            return parent::foeChoice();
          //Bon alors est ce qu'il est con?
          else if ($this->is_better_to_foe())
            return parent::foeChoice();

          //Ah :/ il est ni l'un ni l'autre donc on se la joue cool :/
          return parent::friendChoice();
        }

        //Si il a fait un coup de p...oney
        if ($this->result->getLastChoiceFor($this->opponentSide) == parent::foeChoice())
        {
          //Si avant j'avais fait un coup de poney
          if ($this->result->getLastChoiceFor($this->mySide) == parent::friendChoice())
          {
            //Bon ok my bad mais est ce qu'il me bèze?
            if ($this->result->getLastScoreFor($this->opponentSide) >= $this->result->getLastScoreFor($this->mySide))
            {
              //Batard casse toi
              return parent::foeChoice();
            }
            else {
              //Bon ok tant que je te bat çà passe
              return parent::friendChoice();
            }
          }
          else {
            //T'es serieux???? Tu gagne en plus?
            if ($this->result->getLastScoreFor($this->opponentSide) >= $this->result->getLastScoreFor($this->mySide))
            {
              //Casse toi!
              return parent::foeChoice();
            }
            else {
              //Pfff... t'es un gamin... vasi t'as pas fait ca la dernière fois qd même?
              if ($this->result->getChoicesFor($this->opponentSide)[count($this->result->getChoicesFor($this->opponentSide)) - 1])
              //Tch... t'es dure en affaire... vasi prend ma pièce...
                return parent::friendChoice();
              else
              //Vtff batard je garde mon cash
                return parent::foeChoice();
            }
          }
        }
        return parent::friendChoice();
    }

};
