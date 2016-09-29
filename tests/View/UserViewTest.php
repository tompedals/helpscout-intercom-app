<?php

namespace TomPedals\HelpScoutApp\Intercom\View;

class UserViewTest extends \PHPUnit_Framework_TestCase
{
    public function testGetId()
    {
        $user = json_decode($this->getUserResponse(), false);
        $view = new UserView($user, $this->getAttributeConfig());

        $this->assertSame('530370b477ad7120001d', $view->getId());
    }

    private function getUserResponse()
    {
        return <<<'JSON'
{
  "type": "user",
  "id": "530370b477ad7120001d",
  "user_id": "25",
  "email": "wash@serenity.io",
  "name": "Hoban Washburne",
  "updated_at": 1392734388,
  "last_seen_ip" : "1.2.3.4",
  "unsubscribed_from_emails": false,
  "last_request_at": 1397574667,
  "signed_up_at": 1392731331,
  "created_at": 1392734388,
  "session_count": 179,
  "user_agent_data": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9",
  "pseudonym": null,
  "anonymous": false,
  "custom_attributes": {
    "paid_subscriber" : true,
    "monthly_spend": 155.5,
    "team_mates": 1
  },
  "avatar": {
    "type":"avatar",
    "image_url": "https://example.org/128Wash.jpg"
  },
  "location_data": {
      "type": "location_data",
      "city_name": "Dublin",
      "continent_code": "EU",
      "country_code": "IRL",
      "country_name": "Ireland",
      "latitude": 53.159233,
      "longitude": -6.723,
      "postal_code": null,
      "region_name": "Dublin",
      "timezone": "Europe/Dublin"
  },
  "social_profiles": {
    "type":"social_profile.list",
    "social_profiles": [
      {
        "name": "Twitter",
        "id": "1235d3213",
        "username": "th1sland",
        "url": "http://twitter.com/th1sland"
      }
    ]
  },
  "companies": {
    "type": "company.list",
    "companies": [
      {
        "id" : "530370b477ad7120001e",
        "name" : "Test"
      }
    ]
  },
  "segments": {
    "type": "segment.list",
    "segments": [
      {
        "id" : "5310d8e7598c9a0b24000002"
      }
    ]
  },
  "tags": {
    "type": "tag.list",
    "tags": [
      {
        "id": "202"
      }
    ]
  }
}
JSON;
    }

    private function getAttributeConfig()
    {
        return [
            'user_id' => true,
            'email' => true,
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
        ];
    }
}
