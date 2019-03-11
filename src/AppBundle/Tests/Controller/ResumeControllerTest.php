<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\BaseTestCase;

class ResumeControllerTest extends BaseTestCase
{

    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains("{$this->trans('header.form_header')}",$this->client->getResponse()->getContent());
    }

    public function testGenerateResume()
    {
        $crawler = $this->client->request('GET', '/');
        $token = $crawler->filter('input#appbundle_resume_username')
            ->attr('value');
        $this->assertTrue(($token && null !== $token), 'token not found');

        if (!$token) {
            throw new \Exception('Unable to submit form without token');
        }
        $form = $crawler->selectButton("{$this->trans('form.label.generate_resume_button')}")->form();
        $formName = 'appbundle_resume';

        $repoType = $crawler
            ->filter("#{$formName}_repoType option:contains(\"GitHub\")")
            ->attr('value');

        $form["{$formName}[username]"] = 'bmry';
        $form["{$formName}[repoType]"]->select($repoType);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains("{$this->trans('header.form.label.username')}",$this->client->getResponse()->getContent());

    }

}
