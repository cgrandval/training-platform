<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;




class PoolVideoType extends AbstractType
{
	public function buildform(FormBuilderInterface $builder, array $option)
	{
		$builder->add('libelle', TextType::class)
        ;        
	}
}