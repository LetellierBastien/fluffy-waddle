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
        if ($this->result->getChoicesFor($this->opponentSide)[i] == parent::foeChoice())
        {
          return false;
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

        if (count($this->result->getChoicesFor($this->mySide)) == 0)
          return parent::friendChoice();
        if ($this->result->getLastChoiceFor($this->opponentSide) == parent::friendChoice())
        {
          if ($this->is_only_friend())
            return parent::foeChoice();
          else if ($this->is_better_to_foe())
            return parent::foeChoice();

          return parent::friendChoice();
        }

        if ($this->result->getLastChoiceFor($this->opponentSide) == parent::foeChoice())
        {
          if ($this->result->getLastChoiceFor($this->mySide) == parent::friendChoice())
          {
            if ($this->result->getLastScoreFor($this->opponentSide) >= $this->result->getLastScoreFor($this->mySide))
            {
              return parent::foeChoice();
            }
            else {
              return parent::friendChoice();
            }
          }
          else {
            if ($this->result->getLastScoreFor($this->opponentSide) >= $this->result->getLastScoreFor($this->mySide))
            {
              return parent::foeChoice();
            }
            else {
              if ($this->result->getLastScoreFor($this->opponentSide) >= $this->result->getLastScoreFor($this->mySide))
              return parent::friendChoice();
            }
          }
        }
        return parent::friendChoice();
    }

};
