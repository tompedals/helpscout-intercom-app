<?php

namespace TomPedals\HelpScoutApp\Intercom\View;

class CompanyViewTest extends \PHPUnit_Framework_TestCase
{
    public function testGetId()
    {
        $company = json_decode($this->getCompanyResponse(), false);
        $view = new CompanyView($company, $this->getAttributeConfig());

        $this->assertSame('531ee472cce572a6ec000006', $view->getId());
    }

    private function getCompanyResponse()
    {
        return <<<'JSON'
{
  "type": "company",
  "id": "531ee472cce572a6ec000006",
  "name": "Blue Sun",
  "plan": {
    "type":"plan",
    "id":"1",
    "name":"Paid"
  },
  "company_id": "6",
  "remote_created_at": 1394531169,
  "created_at": 1394533506,
  "updated_at": 1396874658,
  "monthly_spend": 49,
  "session_count": 26,
  "user_count": 10,
  "custom_attributes": {
    "paid_subscriber" : true,
    "team_mates": 0
  }
}
JSON;
    }

    private function getAttributeConfig()
    {
        return [
            'company_id' => true,
            'plan' => true,
            'monthly_spend' => true,
            'session_count' => true,
            'user_count' => true,
            'custom_attributes' => [],
        ];
    }
}
