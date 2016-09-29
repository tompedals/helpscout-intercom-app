# Intercom app for Help Scout

## Installation

Create or open your Help Scout app project. This app was developed to work with the [tompedals/helpscout-dynamic-app-symfony](https://github.com/tompedals/helpscout-dynamic-app-symfony) skeleton project.

This app is then installable via [Composer](https://getcomposer.org/) as [tompedals/helpscout-intercom-app](https://packagist.org/packages/tompedals/helpscout-intercom-app):

    composer require tompedals/helpscout-intercom-app

Add the bundle to your kernel:

    new TomPedals\HelpScoutApp\Intercom\IntercomAppBundle()

Add the bundle routing:

    intercom_app:
        resource: '@IntercomAppBundle/Resources/config/routing.yml'
        prefix: /intercom

Configure the bundle:

    intercom_app:
        app_id: '%intercom_app_id%'
        api_key: '%intercom_api_key%'

The app will now be available at `https://yourdomain.com/intercom/`

## Configuration

The bundle configuration allows each attribute to be enabled/disabled. By default all attributes (except user email) are enabled.

    intercom_app:
        user_id: true
        email: true
        name: true
        signed_up_at: true
        last_request_at: true
        session_count: true
        unsubscribed_from_emails: true
        user_agent_data: true
        location: true
        social_profiles: true
        custom_attributes:
            - custom_one
            - custom_two
            - custom_three
        company:
            company_id: true
            plan: true
            monthly_spend: true
            session_count: true
            user_count: true
            custom_attributes:
                - company_custom_one
                - company_custom_two
                - company_custom_three

To better understand what each of these attributes are see the [Intercom API docs](https://developers.intercom.com/reference#user-model) for the User and Company models.
