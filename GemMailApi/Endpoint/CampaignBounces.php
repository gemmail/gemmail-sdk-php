<?php
/**
 * This file contains the campaign bounces endpoint for GemMailApi PHP-SDK.
 *
 * @author Rapt Internet <rapt@rapt.com.br>
 * @link https://rapt.com.br/
 * @copyright 2017-2019 https://rapt.com.br/
 */


/**
 * GemMailApi_Endpoint_CampaignBounces handles all the API calls for campaign bounces.
 *
 * @author Adnan Neser Junior <neser@rapt.com.br>
 * @package GemMailApi
 * @subpackage Cache
 * @since 1.0
 */
class GemMailApi_Endpoint_CampaignBounces extends GemMailApi_Base
{
    /**
     * Get bounces from a certain campaign
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param string $campaignUid
     * @param integer $page
     * @param integer $perPage
     * @return GemMailApi_Http_Response
     */
    public function getBounces($campaignUid, $page = 1, $perPage = 10)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('campaigns/%s/bounces', $campaignUid)),
            'paramsGet'     => array(
                'page'      => (int)$page,
                'per_page'  => (int)$perPage,
            ),
            'enableCache'   => true,
        ));

        return $response = $client->request();
    }

    /**
     * Create a new bounce in the given campaign
     *
     * @param string $campaignUid
     * @param array $data
     * @return GemMailApi_Http_Response
     */
    public function create($campaignUid, array $data)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_POST,
            'url'           => $this->config->getApiUrl(sprintf('campaigns/%s/bounces', (string)$campaignUid)),
            'paramsPost'    => $data,
        ));

        return $response = $client->request();
    }
}
