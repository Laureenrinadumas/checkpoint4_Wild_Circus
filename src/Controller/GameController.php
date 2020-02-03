<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="show_game", methods={"GET"})
     */
    public function game() {

        $numb = 7;

        $result = '';
        if(isset($_GET['numb']))
        {
            $user_numb = (int)$_GET['numb'];
            if ($user_numb < $numb) {
                $result = 'Lost ! Your number is too small';
            } elseif ($user_numb > $numb) {
                $result = 'Lost ! Your number is too big';
            } elseif ($user_numb === $numb) {
                $result = 'Won! Well done ! you win two places for the event of your choice!';
            } else {
                $result = 'Try !';
            }
        }

            return $this->render('wild/game.html.twig', [
                'result' => $result
            ]);
    }


}