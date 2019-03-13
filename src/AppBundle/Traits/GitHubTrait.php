<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/11/2019
 * Time: 12:02 PM
 */

namespace AppBundle\Traits;


trait GitHubTrait
{
    private function makeRequest($api){
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $api, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        } catch (\Exception $e) {
            $response = null;
        }

        return $response;
    }
}
