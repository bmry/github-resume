<?php

/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 5:43 PM
 */

namespace AppBundle\Service;

set_time_limit(0);

use AppBundle\Traits\GitHubTraits;
use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Exception\ClientException;

class GitHubAccount implements SourceRepoAccountInterface
{
    private $repositories;
    private $repositoryLink;
    private $avatarUrl;
    private $website;
    private $numberOfPublicRepository;
    private $owner;
    private $percentageOfLanguageUsed;
    private $repoLanguageAPIs;
    private $totalSumOfLanguageSize;
    private $totalRepository;


    use GitHubTraits;

    public function __construct($accountUserName)
    {
        $this->repositories = new ArrayCollection();
        $this->repoLanguageAPIs = array();
        $this->totalSumOfLanguageSize = 0;
        $this->setAccountProperties($accountUserName);
        $this->createRepositoryList($accountUserName);
    }


    public function getOwner()
    {
        return $this->owner;
    }

    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    public function getWebsite()
    {
        return $this->website;
    }
    public function getRepositories()
    {
        return $this->repositories;
    }

    public function getTotalRepo(){
        return $this->totalRepository;
    }

    public function getPercentageOfLanguageUsed()
    {
        return $this->calculatePercentageOfLanguageUsed();
    }

    public function setAccountProperties($accountUserName)
    {
        $accountOwnerDetails =  $this->getOwnerFromGitHubByUserName($accountUserName);
        $accountOwnerDetails = json_decode($accountOwnerDetails->getBody()->getContents());
        $this->repositoryLink = $accountOwnerDetails->repos_url;
        $this->totalRepository = $accountOwnerDetails->public_repos;
        $this->avatarUrl = $accountOwnerDetails->avatar_url;
        $this->owner = $accountOwnerDetails->name == null ? $accountOwnerDetails->login : $accountOwnerDetails->name;
        $this->website = $accountOwnerDetails->blog;

        return $this;
    }

    private function createRepositoryList($accountUserName)
    {
        $content  = $this->getRepositoryFromGitHubByUserName($accountUserName);
        $repos = json_decode($content->getBody()->getContents());

        foreach ($repos as $repo){
            $repoObject = new \stdClass();
            $repoObject->repoLink = $repo->html_url;
            $repoObject->repoName = $repo->name;
            $repoObject->repoDescription = $repo->description;
            $this->repoLanguageAPIs[] = $repo->languages_url;
            $this->repositories->add($repoObject);
        }
    }

    function getRepositoryFromGitHubByUserName($username){
        $api = 'https://api.github.com/users/'.$username.'/repos';

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

    function getRepositoryLanguageFromGitHub($languageAPI){

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $languageAPI, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
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

    private function calculatePercentageOfLanguageUsed(){

        $languageAndTotalSizeInAccount = array();
        foreach($this->repoLanguageAPIs as $api){
            $response = $this->getRepositoryLanguageFromGitHub($api);
            $responses = (array)json_decode($response->getBody()->getContents());
            foreach($responses as $key=>$value){
                if(array_key_exists($key, $languageAndTotalSizeInAccount)){
                    $languageAndTotalSizeInAccount[$key] = $languageAndTotalSizeInAccount[$key] + $value;
                }else{
                    $languageAndTotalSizeInAccount[$key] = $value;
                }
            }
        }

        $this->totalSumOfLanguageSize = array_sum($languageAndTotalSizeInAccount);
        $percentageOfLanguageUsed = array_map(function ($value){
            return round(($value/($this->totalSumOfLanguageSize) * 100),3);

        },$languageAndTotalSizeInAccount);

        return $percentageOfLanguageUsed;
    }


}