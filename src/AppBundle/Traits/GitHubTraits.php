<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/9/2019
 * Time: 12:03 PM
 */

namespace AppBundle\Traits;


use GuzzleHttp\Exception\ClientException;

trait GitHubTraits
{
      function getOwnerFromGitHubByUserName($username){
        $api = 'https://api.github.com/users/'.$username;

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $api, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'auth' => ['bmry', 'bb2328864465baeb658411e7c096114f8270a685']
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        } catch (\Exception $e) {
            $response = null;
        }

        return $response;
    }


}