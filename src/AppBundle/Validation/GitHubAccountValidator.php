<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/9/2019
 * Time: 11:27 AM
 */

namespace AppBundle\Validation;


use AppBundle\Traits\GitHubTraits;

class GitHubAccountValidator implements AccountValidatorInterface
{
    use GitHubTraits;

    public function accountExist($accountUsername)
    {
        $accountExist = true;
        $apiResponse = $this->getOwnerFromGitHubByUserName($accountUsername);
        if($apiResponse->getStatusCode() != 200) {
            $accountExist = false;
        }
        return $accountExist;
    }

}