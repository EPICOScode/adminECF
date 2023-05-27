<?php

namespace App\Controller\Admin;

use App\Entity\Salle;
use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ReservationCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('SpaceAdmin');



        yield MenuItem::section('Rooms');
        yield MenuItem::subMenu('Manage', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Add Reservation', 'fas fa-book', salle::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Details', 'fas fa-eye', salle::class)

        ]);


        yield MenuItem::section('Book');
        yield MenuItem::subMenu('Reserve', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Block a room', 'fas fa-key', Reservation::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Reservation', 'fas fa-eye', Reservation::class)

        ]);
    }
}