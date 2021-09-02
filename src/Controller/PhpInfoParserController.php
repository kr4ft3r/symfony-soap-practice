<?php

namespace App\Controller;

use App\Service\PhpInfoParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhpInfoParserController extends AbstractController
{

    /**
     * @route("/phpinfo")
     */
    public function index(PhpInfoParser $phpInfo)
    {
        $soapServer = new \SoapServer(dirname(__FILE__).'/../../web/soap/phpinfo.wsdl');
        $soapServer->setObject($phpInfo);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }

    /**
     * @Route("/")
     */
    public function test()
    {
        $response = new Response();
        $response->setContent("hello");
        return $response;
    }

}