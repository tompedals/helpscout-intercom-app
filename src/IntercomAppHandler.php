<?php

namespace TomPedals\HelpScoutApp\Intercom;

use DateTime;
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
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
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
