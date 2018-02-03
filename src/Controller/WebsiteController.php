<?php

namespace App\Controller;

use App\Support\StringSupport;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebsiteController extends Controller
{
    /**
     * @Route("/", name="get_substrings")
     *
     * @param Request $request
     *
     * @return Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function getSubstringsAction(Request $request): Response
    {
        $result = null;
        $form   = $this
            ->createFormBuilder()
            ->add('string',     TextType::class,    ['label' => 'String: '])
            ->add('length',     IntegerType::class, ['label' => 'Minimal length: '])
            ->add('substrings', SubmitType::class,  ['label' => 'Get substrings'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data      = $form->getData();
            $string    = (string)($data['string'] ?? '');
            $minLength = (int)($data['length'] ?? 0);
            $result    = (new StringSupport)->getSubstrings($string, $minLength);
        }

        return $this->render('base.html.twig', [
            'form'       => $form->createView(),
            'substrings' => $result,
        ]);
    }
}
