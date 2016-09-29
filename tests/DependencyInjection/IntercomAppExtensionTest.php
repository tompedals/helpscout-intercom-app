<?php

namespace TomPedals\HelpScoutApp\Intercom\DependencyInjection;

use Mockery;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class IntercomAppExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testRegistersAppHandlerService()
    {
        $container = $this->createContainer();
        $this->loadWithConfig($container, [
            'app_id' => 'abc',
            'api_key' => 'secret',
        ]);

        $this->assertHasService($container, 'intercom_app.handler');
    }

    public function testRegistersAppActionService()
    {
        $container = $this->createContainer();
        $this->loadWithConfig($container, [
            'app_id' => 'abc',
            'api_key' => 'secret',
        ]);

        $this->assertHasService($container, 'intercom_app.action');
    }

    public function testPassesAttributesToHandler()
    {
        $container = $this->createContainer();
        $this->loadWithConfig($container, [
            'app_id' => 'abc',
            'api_key' => 'secret',
        ]);

        $handler = $container->get('intercom_app.handler');
        $this->assertSame([
            'user_id' => true,
            'email' => false,
            'name' => true,
            'signed_up_at' => true,
            'last_request_at' => true,
            'session_count' => true,
            'unsubscribed_from_emails' => true,
            'user_agent_data' => true,
            'location' => true,
            'social_profiles' => true,
            'custom_attributes' => [],
            'company' => [
                'company_id' => true,
                'plan' => true,
                'monthly_spend' => true,
                'session_count' => true,
                'user_count' => true,
                'custom_attributes' => [],
            ],
        ], $handler->getAttributes());
    }

    public function testHandlesCustomAttributes()
    {
        $container = $this->createContainer();
        $this->loadWithConfig($container, [
            'app_id' => 'abc',
            'api_key' => 'secret',
            'attributes' => [
                'custom_attributes' => [
                    'height',
                    'weight',
                    'age',
                ],
            ],
        ]);

        $handler = $container->get('intercom_app.handler');
        $this->assertSame([
            'height',
            'weight',
            'age',
        ], $handler->getAttributes()['custom_attributes']);
    }

    public function testHandlesCompanyCustomAttributes()
    {
        $container = $this->createContainer();
        $this->loadWithConfig($container, [
            'app_id' => 'abc',
            'api_key' => 'secret',
            'attributes' => [
                'company' => [
                    'custom_attributes' => [
                        'height',
                        'weight',
                        'age',
                    ],
                ],
            ],
        ]);

        $handler = $container->get('intercom_app.handler');
        $this->assertSame([
            'height',
            'weight',
            'age',
        ], $handler->getAttributes()['company']['custom_attributes']);
    }

    private function assertHasService(ContainerBuilder $container, $id)
    {
        $this->assertTrue($container->hasDefinition($id) || $container->hasAlias($id), sprintf('The service %s should be defined.', $id));
    }

    private function assertNotHasService(ContainerBuilder $container, $id)
    {
        $this->assertFalse($container->hasDefinition($id) || $container->hasAlias($id), sprintf('The service %s should not be defined.', $id));
    }

    private function loadWithConfig(ContainerBuilder $container, array $config = [])
    {
        $extension = new IntercomAppExtension();
        $extension->load([$config], $container);
    }

    private function createContainer($debug = true)
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.debug', $debug);
        $container->set('twig', Mockery::mock('Twig_Environment'));

        return $container;
    }
}
