<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomePageController extends AbstractController
{
	#[Route('/', name: 'app_main')]
	public function index(): Response
	{
		return $this->render('main/main.html.twig');
	}
}