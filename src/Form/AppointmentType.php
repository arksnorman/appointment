<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AppointmentType extends AbstractType
{
    private $authChecker;

    public function __construct(AuthorizationCheckerInterface $authChecker)
    {
        $this->authChecker = $authChecker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (false === $this->authChecker->isGranted('ROLE_STAFF'))
        {
            $builder
                ->add('disease')
                ->add('description')
            ;
        }
        else
        {
            $builder
                ->add('disease')
                ->add('description')
                ->add('status', ChoiceType::class, [
                    'choices' => [
                        'active' => 'active',
                        'pending' => 'pending',
                        'finished' => 'finished'
                    ]
                ])
                ->add('schedule_date')
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
