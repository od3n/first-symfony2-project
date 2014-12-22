<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends Controller
{

    public function indexAction($name)
    {

        return new Response('<html><body>Hello ' . $name . '!</body></html>');
    }

    public function redirectAction()
    {
        return $this->redirect($this->generateUrl('hello'), 301);
    }

    public function forwardAction($name)
    {
        $response = $this->forward('AcmeHelloBundle:Hello:fancy', array(
            'name' => $name,
            'colour' => 'green'
        ));

        return $response;
    }

    public function fancyAction($name, $colour)
    {
        return new Response('<html><body>fancy Hello ' . $colour . ' '. $name . '!</body></html>');
    }

    public function rendermeAction($name)
    {

        return $this->render(
            'AcmeHelloBundle:Hello:renderme.html.twig',
            array('name' => $name)
        );
    }

    public function notfoundAction()
    {
        $product = false;
        if (!$product) {
            throw $this->createNotFoundException('404 demo');
        }
    }

    public function exceptionAction()
    {
        throw new \Exception('500 demo');
    }

    public function getsessionAction(Request $request)
    {
        $session = $request->getSession();
        $foo = $session->get('foo');
        $filters = $session->get('filters', 'default value');

        return new Response('<html><body>Get session demo: ' . $foo .  ' + ' . $filters . '</body></html>');
    }

    public function setsessionAction(Request $request)
    {
        $session = $request->getSession();
        $session->set('foo', 'bar');

        return new Response('<html><body>Set session demo</body></html>');
    }
} 