<?php

namespace TomPedals\HelpScoutApp\Intercom\View;

class UserView
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var object
     */
    private $location;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $companies = [];

    /**
     * @var array
     */
    private $socialProfiles = [];

    /**
     * @param object $user
     * @param array  $attributes
     */
    public function __construct($user, array $attributes)
    {
        $this->id = $user->id;

        // NB: location_data is shortened to location in the config
        if ($attributes['location']) {
            $this->location = $user->location_data;
        }

        $attributeNames = ['user_id', 'email', 'name', 'signed_up_at', 'last_request_at', 'session_count', 'unsubscribed_from_emails', 'user_agent_data'];
        foreach ($attributeNames as $attributeName) {
            if ($attributes[$attributeName] && isset($user->$attributeName)) {
                // Get the attribute value from the user object
                $this->attributes[$attributeName] = $user->$attributeName;
            }
        }

        foreach ($attributes['custom_attributes'] as $customAttributeName) {
            if (isset($user->custom_attributes->$customAttributeName)) {
                $this->attributes[$customAttributeName] = $user->custom_attributes->$customAttributeName;
            }
        }

        foreach ($user->companies->companies as $company) {
            $this->companies[] = new CompanyView($company, $attributes['company']);
        }

        if ($attributes['social_profiles']) {
            $this->socialProfiles = $user->social_profiles->social_profiles;
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return object
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * @return array
     */
    public function getSocialProfiles()
    {
        return $this->socialProfiles;
    }
}
