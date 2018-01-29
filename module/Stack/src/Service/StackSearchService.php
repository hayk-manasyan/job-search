<?php

namespace Stack\Service;



use function GuzzleHttp\default_user_agent;
use JobApis\Jobs\Client\Providers\StackoverflowProvider;
use JobApis\Jobs\Client\Queries\StackoverflowQuery;
use Jobs\Manager\JobsManager;
use Jobs\Mapper\SourceMapper;
use Jobs\Service\SearchServiceInterface;
use Utils\Service\HostService;
use Zend\Json\Json;

class StackSearchService implements SearchServiceInterface
{
    const STACK_JOBS_URL = 'https://stackoverflow.com/jobs/feed';
//q=ruby&l=london&d=20&u=Km
    protected $jobManager;

    public function __construct(JobsManager $jobsManager)
    {
        $this->jobManager = $jobsManager;
    }

    /**
     * Search job by specific description
     *
     * @param string $description A search term, such as "ruby" or "java".
     * @return mixed
     */
    public function searchByDescription( $description )
    {
//        $xml = simplexml_load_file(self::STACK_JOBS_URL . '?q=' . $description );



        $Json = json_encode(simplexml_load_file(self::STACK_JOBS_URL . '?q=' . $description, "SimpleXMLElement", LIBXML_NOCDATA));
        $x = json_decode($Json, true);

        if(!isset($x['channel']['item']) || !count($x['channel']['item']) ) {
            return false;
        }

        foreach ($x['channel']['item'] as $res) {
            $formattedData = $this->generateFormattedArray($res);
            $this->jobManager->saveNewJob($formattedData, SourceMapper::TYPE_STACK_OVERFLOW, $description);
        }

        return true;
    }

    /**
     * @param  $data
     * @return array
     */
    private function generateFormattedArray($data)
    {
        $formattedArray = [
            'id' => $data['guid'],
            'company' => ' ',
            'title' => $data['title'],
            'description' => $data['description'],
            'company_logo' => null,
            'location' => isset($data['location']) ? $data['location'] : null,
            'url' => $data['link'],
            'created_at' => $data['pubDate'],
            'type' => 'Full Time',
            'how_to_apply' => $data['link'],
        ];

        return $formattedArray;

    }

    /**
     * Search job by specific location
     *
     * @param string $location A city name, zip code, or other location search term
     * @return mixed
     */
    public function searchByLocation( $location )
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
        // TODO: Implement searchByCombinedParams() method.
    }

    /**
     * Search by Job ID
     *
     * @param string $jobId
     * @return mixed
     */
    public function searchById( $jobId )
    {
        // TODO: Implement searchById() method.
    }


}