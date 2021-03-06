<?php

namespace AppBundle\Form;

use AppBundle\Entity\MemberSummary\JobExperience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', TextType::class)
            ->add('position', TextType::class)
            ->add('location', TextType::class)
            ->add('website', UrlType::class, [
                'required' => false,
                'empty_data' => null,
            ])
            ->add('company_facebook_page', UrlType::class, [
                'required' => false,
                'empty_data' => null,
            ])
            ->add('company_twitter_nickname', TextType::class, [
                'required' => false,
                'empty_data' => null,
            ])
            ->add('started_at', MonthChoiceType::class, [
                'pre_set_now' => true,
            ])
            ->add('ended_at', MonthChoiceType::class, [
                'required' => false,
            ])
            ->add('on_going', CheckboxType::class, [
                'required' => false,
            ])
            ->add('contract', ContractChoiceType::class)
            ->add('duration', JobDurationChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => JobExperience::class,
                'error_mapping' => ['validDuration' => 'on_going'],
            ])
        ;
    }

    public function getParent()
    {
        return SummaryItemType::class;
    }
}
