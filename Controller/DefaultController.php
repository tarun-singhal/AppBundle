<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Product;
use AppBundle\Entity\task;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\SfUser;
use AppBundle\Event\SitemapEvent;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class DefaultController extends Controller
{
    /**
     * @Route("/app/login", name="app_login")
     */
    public function indexAction(Request $req)
    {
       if($req->getMethod() == 'POST'){
            $repository = $this->getDoctrine()->getRepository('AppBundle:SfUser');
            
            $data = $repository->findOneBy(array('email'=>$req->get('user_email'), 'password' => $req->get('user_pwd')));
            if (!$data) {
                throw $this->createNotFoundException(
                    'No Account found for id '
                );
            }
            //Add flash message
            $this->addFlash(
                'success',
                'Successfully Logged-In....'
            );
            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('AppBundle:Login:index.html.twig');
    }
    
    /**
     * @Route("/app/home", name="app_home")
     * 
     */
    public function homeAction()
    {
        $message = \Swift_Message::newInstance()
        ->setSubject("Test Subject")
        ->setFrom("tarun.singhal@osscube.com")
        ->setTo("tarun.singhal@osscube.com")
        ->setBody("Welcome to swift mailer demo", 'text/html');
        
        $this->get('mailer')->send($message);
        //how to set the parameter.yml param 
//         $container = new ContainerBuilder();
//         $container->set('database_name', 'tarun_db');
//         $container->set('database_name', $service)
        $event = new SitemapEvent();
//         echo $container->get('database_name');die('show');
        $dispatcher = $this->get('event_dispatcher');
        $dispatcher->dispatch('appbundle.events.sitemap', $event);
        
        $page = $event->getUserLog();
        
        $logger = $this->get('logger');
        $logger->info('I just got the logger');
        $logger->error('An error occured');
        return $this->render('AppBundle:Login:home.html.twig', array('datetime' => $page[0]['time']));
    }
    
    /**
     * @Route("/product")
     */
    public function createAction()
    {
        $product = new Product();
        
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');
    
        $em = $this->getDoctrine()->getManager();
    
        $em->persist($product);
        $em->flush();
    
        return new Response('Created product id '.$product->getId());
    }
    
    /**
     * @Route("/show/{id}")
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->find($id);
    
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('default/product.html.twig', array('data' => $product));
    }
    
    /**
     * @Route("/new")
     */
    public function newAction()
    {
        $request = new Request(); 
        // create a task and give it some dummy data for this example
        $task = new task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));
    
        $form = $this->createFormBuilder($task)
        ->add('task', 'text', array('label' => 'Please enter Task:'))
        ->add('dueDate', 'date', array('label' => 'Please provide Due Date','widget' => 'single_text'))
        ->add('save', 'submit', array('label' => 'Create Task'))
        ->getForm();
    
        $form->handleRequest($request);
        if($form->isValid()){
            die('submit here');
        }
        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
}
