<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $user = new User();
        $user->setEmail('roman@gmail.com');
        $user->setPassword('tomorrow');

        $form = $this->createFormBuilder($user)       
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'User login'))
            ->getForm();

            //$form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($email)
                ->find($password);
        
                if (!$user) {
                    throw $this->createNotFoundException(
                        'No user found for email '.$email
                    );
                }
                else {
                    return $this->redirectToRoute('after');
                }               
            }    

        return $this->render('default/login.html.twig', array(
            'form' => $form->createView(),
        ));

       
    }


    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        
        $user = new User();
        $user->setUsername('romanstec');
        $user->setEmail('roman@gmail.com');
        $user->setPassword('tomorrow');
        
            $form = $this->createFormBuilder($user)
                ->add('username', TextType::class)
                ->add('email', TextType::class)
                ->add('password', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'User register'))
                ->getForm();
        
            $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $user = $form->getData();
        
                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($user);

                $entityManager->flush();
        
                return $this->redirectToRoute('login');
            }
        
            return $this->render('default/register.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/after/{id}", name="after")
     */
    public function afterAction($id)
    {
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        return $this->render('default/after.html.twig', array(
            'user' => $user
        ));
    }    
}