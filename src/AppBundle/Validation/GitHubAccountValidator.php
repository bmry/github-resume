<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/9/2019
 * Time: 11:27 AM
 */

namespace AppBundle\Validation;


use AppBundle\Traits\GitHubTrait;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GitHubAccountValidator implements AccountValidatorInterface
{
    use GitHubTrait;

    public function accountExist($accountUsername)
    {
        $accountExist = true;
        $userApi = 'https://api.github.com/users/'.$accountUsername;
        $apiResponse = $this->makeRequest($userApi);
        if($apiResponse->getStatusCode() != 200) {
            $accountExist = false;
        }
        return $accountExist;
    }

}