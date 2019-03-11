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
                ],
                'auth' => ['bmry','bb2328864465baeb658411e7c096114f8270a685']
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        } catch (\Exception $e) {
            $response = null;
        }

        return $response;
    }
}