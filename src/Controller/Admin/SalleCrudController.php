<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Entity\Salle;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class SalleCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return Salle::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom_salle'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            BooleanField::new('active'),

        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Salle) {
            return;
        }
        $reservation = new Reservation();
        $reservation->setSalle($entityInstance);
        $reservation->setSalleReservee('Room');
        $reservation->setDateHeureReservation(new \DateTimeImmutable());
        $reservation->setEntreprise('SAGA');

        $entityInstance->setCapacité($reservation);
        parent::persistEntity($em, $entityInstance);
    }
}