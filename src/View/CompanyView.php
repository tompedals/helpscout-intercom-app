<?php

namespace TomPedals\HelpScoutApp\Intercom\View;

class CompanyView
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @param object $company
     * @param array  $attributes
     */
    public function __construct($company, array $attributes)
    {
        $this->id = $company->id;
        $this->name = $company->name;

        $attributeNames = ['company_id', 'plan', 'monthly_spend', 'session_count', 'user_count'];
        foreach ($attributeNames as $attributeName) {
            if ($attributes[$attributeName] && isset($company->$attributeName)) {
                // Get the attribute value from the company object
                $this->attributes[$attributeName] = $company->$attributeName;
            }
        }

        foreach ($attributes['custom_attributes'] as $customAttributeName) {
            if (isset($company->custom_attributes->$customAttributeName)) {
                $this->attributes[$customAttributeName] = $company->custom_attributes->$customAttributeName;
            }
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
