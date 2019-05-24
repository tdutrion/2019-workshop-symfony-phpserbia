<?php

namespace App\UI\Form;

use App\Domain\Entity\Invoice;
use App\UI\Form\Transformer\InvoiceIdentifier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class InvoiceType extends AbstractType
{
    private $transformer;

    public function __construct(InvoiceIdentifier $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifier', TextType::class, [
                'invalid_message' => 'Invalid invoice identifier format',
            ])
        ;
        $builder->get('identifier')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
