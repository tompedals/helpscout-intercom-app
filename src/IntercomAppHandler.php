<?php

namespace TomPedals\HelpScoutApp\Intercom;

use DateTime;
use Intercom\IntercomClient;
use TomPedals\HelpScoutApp\AppHandlerInterface;
use TomPedals\HelpScoutApp\AppRequest;
use Twig_Environment;

class IntercomAppHandler implements AppHandlerInterface
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var IntercomClient
     */
    private $client;

    /**
     * @param Twig_Environment $twig
     * @param IntercomClient $client
     */
    public function __construct(Twig_Environment $twig, IntercomClient $client)
    {
        $this->twig = $twig;
        $this->client = $client;
    }

    /**
     * @param AppRequest $request
     *
     * @return string The HTML to output within the Help Scout sidebar
     */
    public function handle(AppRequest $request)
    {
        return $this->twig->render('@IntercomApp/app.html.twig', [

        ]);
    }
}
