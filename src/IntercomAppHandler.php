<?php

namespace TomPedals\HelpScoutApp\Intercom;

use Exception;
use GuzzleHttp\Exception\BadResponseException;
use Intercom\IntercomClient;
use TomPedals\HelpScoutApp\AppHandlerInterface;
use TomPedals\HelpScoutApp\AppRequest;
use TomPedals\HelpScoutApp\Intercom\View\UserView;
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
     * @var string
     */
    private $appId;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @param Twig_Environment $twig
     * @param IntercomClient   $client
     * @param string           $appId
     * @param array            $attributes
     */
    public function __construct(Twig_Environment $twig, IntercomClient $client, $appId, array $attributes)
    {
        $this->twig = $twig;
        $this->client = $client;
        $this->appId = $appId;
        $this->attributes = $attributes;
    }

    /**
     * @param AppRequest $request
     *
     * @return string The HTML to output within the Help Scout sidebar
     */
    public function handle(AppRequest $request)
    {
        try {
            $user = $this->client->users->getUsers(['email' => $request->getCustomer()->getEmail()]);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
            if ($response->getStatusCode() === 404) {
                return 'User not found.';
            }

            return 'Unable to communicate with Intercom.';
        } catch (Exception $exception) {
            return 'Unable to communicate with Intercom.';
        }

        return $this->twig->render('@IntercomApp/app.html.twig', [
            // App ID required for deep linking into Intercom
            'appId' => $this->appId,
            'user' => new UserView($user, $this->getAttributes()),
        ]);
    }

    /**
     * Returns the attributes. Mostly used for testing the handler configuration.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
