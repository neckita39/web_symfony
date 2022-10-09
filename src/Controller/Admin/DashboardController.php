<?php

namespace App\Controller\Admin;

use App\Entity\Quote;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
	public const ROLE_ADMIN = 'ROLE_ADMIN';

	private string $url = '/login';
	private $routeBuilder;

	#[Route('/admin', name: 'admin')]
	public function index(): Response
	{
		$this->routeBuilder = $this->container->get(AdminUrlGenerator::class);
		$this->makeUrl();
		return $this->redirect($this->url);
	}

	public function configureDashboard(): Dashboard
	{
		return Dashboard::new()->setTitle('Web Symfony');
	}

	public function configureMenuItems(): iterable
	{
		yield MenuItem::linkToCrud('Quotes', 'fas fa-comments', Quote::class);
	}

	public function makeUrl(): void
	{
		if (!$this->getUser())
		{
			return;
		}

		if (!in_array(static::ROLE_ADMIN, $this->getUser()->getRoles(), true))
		{
			return;
		}

		$this->url = $this->routeBuilder->setController(QuoteCrudController::class)->generateUrl();
	}
}
