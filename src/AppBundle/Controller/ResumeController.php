<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 5:45 PM
 */

namespace AppBundle\Controller;

use AppBundle\Factory\SourceRepositoryFactory;
use AppBundle\Form\RequestFormType;
use AppBundle\Traits\GitHubTraits;
use AppBundle\Entity\RequestData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResumeController extends Controller
{
    use GitHubTraits;

    public function generateResumeAction(Request $request)
    {
        $requestData = new RequestData();
        $accountUserName = $requestData->getUserName();
        $repositoryType = $requestData->getRepoType();

        $form = $this->createForm(new RequestFormType(), $requestData);
        $form->handleRequest($request);
        $resumeData = array();
        if ($form->isSubmitted() && $form->isValid()) {
            dump($requestData);
            exit;
            $repositoryAccount = SourceRepositoryFactory::buildRepository($repositoryType);
            $repositoryAccount = $repositoryAccount->createUserRepoAccountObject($accountUserName);

            $resumeData = [
                'owner' => $repositoryAccount->getOwner,
                'repositories' => $repositoryAccount->getRepositoryList(),
                'avatarUrl' => $repositoryAccount->getAvatarUrl(),
                //'languagesAndPercentage' => $repositoryAccount->getUsedLanguagePercentage()
            ];

            return $this->render('AppBundle:Resume:resume.html.twig',array('resumeData' => $resumeData));
        }

        return $this->render('AppBundle:Resume:search.html.twig',array('form' => $form->createView()));
    }



}