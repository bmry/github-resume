<?php
/**
 * Created by PhpStorm.
 * User: glenn
 * Date: 09.07.15
 * Time: 13:52.
 */

namespace AppBundle\Validation\Constraints;

use AppBundle\Factory\AccountValidatorFactory;
use AppBundle\Entity\RequestData;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class RepoAccountValidator extends ConstraintValidator
{

    public function validate($object, Constraint $constraint)
    {
        if (!$object instanceof RequestData) {
            return;
        }


        if($this->internetConnectionIsGood()){
            $repositoryType = $object->getRepoType();
            $accountUserName = $object->getUsername();
            $accountValidator = AccountValidatorFactory::buildAccountValidator($repositoryType);
            if($repositoryType != 'GitHub'){
                $this->context->buildViolation(
                    'account.only_github',
                    []
                )->addViolation();
            }

            if (!$accountValidator->accountExist($accountUserName)) {
                $this->context->buildViolation(
                    'account.not_found',
                    ['%repoName%' => $repositoryType, '%username%' => $accountUserName]
                )->addViolation();
            }
        }else{
            $this->context->buildViolation(
                'poor.internet_connection',
                []
            )->addViolation();
        }
    }

    private function internetConnectionIsGood(){
        $goodInternet = false;
        $connected = @fsockopen("www.google.com", 80,$errorno,$errorstr, 45);

        if ($connected){
            $goodInternet = true; //action when connected
            fclose($connected);
        }
        return $goodInternet;
    }

}
