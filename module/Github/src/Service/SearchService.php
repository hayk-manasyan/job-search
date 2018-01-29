<?php
/**
 * Created by PhpStorm.
 * User: hayk
 * Date: 8/21/17
 * Time: 1:18 PM
 */

namespace Github\Service;


use Jobs\Manager\JobsManager;
use Jobs\Mapper\SourceMapper;
use Utils\Service\HostService;
use Zend\Json\Json;

class SearchService implements SearchServiceInterface
{
    protected $jobManager;

    public function __construct(JobsManager $jobsManager)
    {
        $this->jobManager = $jobsManager;
    }

    const GITHUB_JOBS_URL = 'https://jobs.github.com/';

    /**
     * Search job by specific description
     *
     * @param string $description A search term, such as "ruby" or "java".
     * @return mixed
     */
    public function searchByDescription($description)
    {
        $url = self::GITHUB_JOBS_URL . 'positions.json';

        $response = HostService::makeApiCall($url, ['description' => $description]);
        if(is_null($response)) {
            return null;
        }

        $response = Json::decode($response, true);
        foreach ($response as $res) {
            $this->jobManager->saveNewJob($res, SourceMapper::TYPE_GITHUB, $description);
        }

        return $response;
    }

    /**
     * Search job by specific location
     *
     * @param string $location A city name, zip code, or other location search term
     * @return mixed
     */
    public function searchByLocation($location)
    {
        // TODO: Implement searchByLocation() method.
    }

    /**
     * Search Jobs By combined params
     *
     * @param string|null $description A search term, such as "ruby" or "java".
     * @param string|null $location A city name, zip code, or other location search term.
     * @param string|null $lat A specific latitude. If used, you must also send long and must not send location.
     * @param string|null $long A specific longitude. If used, you must also send lat and must not send location.
     * @param bool $fullTime If you want to limit results to full time positions set this parameter to 'true'.
     * @return mixed
     */
    public function searchByCombinedParams(
        $description = null,
        $location = null,
        $lat = null,
        $long = null,
        $fullTime = false
    )
    {
        $url = self::GITHUB_JOBS_URL . 'positions.json';

        $params = [
            'description' => $description,
            'location' => $location,
        ];

        $response = HostService::makeApiCall($url, $params);

        try {
            return Json::decode($response, true);
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * Search by Job ID
     *
     * @param string $jobId
     * @return mixed
     */
    public function searchById($jobId)
    {
        $url = self::GITHUB_JOBS_URL . 'positions/' . $jobId . '.json';

        $response = HostService::makeApiCall($url);

        try {
            return Json::decode($response, true);
        } catch (\Exception $ex) {
            return null;
        }

    }
}