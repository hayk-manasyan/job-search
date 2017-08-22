<?php
/**
 * Created by PhpStorm.
 * User: hayk
 * Date: 8/21/17
 * Time: 1:11 PM
 */

namespace Github\Service;


interface SearchServiceInterface
{
    /**
     * Search job by specific description
     *
     * @param string $description A search term, such as "ruby" or "java".
     * @return mixed
     */
    public function searchByDescription($description);

    /**
     * Search job by specific location
     *
     * @param string $location A city name, zip code, or other location search term
     * @return mixed
     */
    public function searchByLocation($location);

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
    );

    /**
     * Search by Job ID
     *
     * @param string $jobId
     * @return mixed
     */
    public function searchById($jobId);

}