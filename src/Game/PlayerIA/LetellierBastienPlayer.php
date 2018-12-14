<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author LetellierBastien
 */
class LetellierBastienPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    protected function is_only_friend()
    {
      for ($i = 0; $this->result->getNbRound() > $i; $i++) {
        if ($this->result->getChoicesFor($this->opponentSide)[i] == parent::foeChoice())
        {
          return false;
        }
      }
      return true;
    }

    protected function is_better_to_foe()
    {
      $foe = 0;
      $cool = 0;
      if ($this->result->getNbRound() > 2)
        return false;
      for ($i = 0; $this->result->getNbRound() > $i; $i++) {
        if ($this->result->getChoicesFor($this->opponentSide)[i] == parent::friendChoice()
        && $this->result->getChoicesFor($this->mySide)[i - 1] == parent::foeChoice())
        {
          $cool++;
          continue;
        }
        else {
          return false;
        }
        if ($this->result->getChoicesFor($this->opponentSide)[i] == parent::friendChoice())
        {
          $cool++;
        }
        else {
          $foe++;
        }
      }

      return $foe > $cool;
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

        //Si c'est le premier tour ==> est friendly
        if (count($this->result->getChoicesFor($this->mySide)) == 0)
          return parent::friendChoice();

        //Est ce que j'ai eu une pièce?
        if ($this->result->getLastChoiceFor($this->opponentSide) == parent::friendChoice())
        {
          //Alors est ce que la personne contre moi est un "friendly"
          if ($this->is_only_friend())
            return parent::foeChoice();
          //Dommage, alors est ce que c'est bien d'etre méchant contre lui?
          else if ($this->is_better_to_foe())
            return parent::foeChoice();

          //ah... bon ba dans le doute on est cool
          return parent::friendChoice();
        }

        //Est ce que j'ai rien reçus
        if ($this->result->getLastChoiceFor($this->opponentSide) == parent::foeChoice())
        {
          //Est ce que j'était cool?
          if ($this->result->getLastChoiceFor($this->mySide) == parent::friendChoice())
          {
            //Est ce que il est meilleur que moi?
            if ($this->result->getLastScoreFor($this->opponentSide) >= $this->result->getLastScoreFor($this->mySide))
            {
              //Est ce que ca fait qu'une fois?
              if ($this->result->getChoicesFor($this->opponentSide)[$this->result->getNbRound() - 1] == parent::friendChoice())
              //Alors je suis friend
                return parent::friendChoice();
                else {
                  //Alors je suis foe
                  return parent::foeChoice();
                }
            }
            else {
              //Alors je redeviens gentil pour gagner des point
              return parent::friendChoice();
            }
          }
          else {
            //Est ce qu'il a plus de point que moi alors?
            if ($this->result->getLastScoreFor($this->opponentSide) >= $this->result->getLastScoreFor($this->mySide))
            {
              //Alors je foe
              return parent::foeChoice();
            }
            else {
              //Est ce que ca fait qu'une fois?
              if ($this->result->getChoicesFor($this->opponentSide)[$this->result->getNbRound() - 1] == parent::friendChoice())
              //Alors je suis friend
                return parent::friendChoice();
              else
              //Alors je suis foe
                return parent::foeChoice();
            }
          }
        }
        //au cas ou je suis friend
        return parent::friendChoice();
    }

};
