<?php
/**
 * This file contains the campaigns endpoint for GemMailApi PHP-SDK.
 * 
 * @author Rapt Internet <rapt@rapt.com.br>
 * @link https://rapt.com.br/
 * @copyright 2017-2019 https://rapt.com.br/
 */
 
 
/**
 * GemMailApi_Endpoint_CampaignsTracking handles all the API calls for campaigns.
 * 
 * @author Adnan Neser Junior <neser@rapt.com.br>
 * @package GemMailApi
 * @subpackage Cache
 * @since 1.0
 */
class GemMailApi_Endpoint_CampaignsTracking extends GemMailApi_Base
{
    /**
     * Track campaign url click for certain subscriber 
     *
     * @param string $campaignUid
     * @param string $subscriberUid
     * @param string $hash
     * @return GemMailApi_Http_Response
     */
    public function trackUrl($campaignUid, $subscriberUid, $hash)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'    => GemMailApi_Http_Client::METHOD_GET,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s/track-url/%s/%s', (string)$campaignUid, (string)$subscriberUid, (string)$hash)),
            'paramsGet' => array(),
        ));
        
        return $response = $client->request();
    }

    /**
     * Track campaign open for certain subscriber
     *
     * @param string $campaignUid
     * @param string $subscriberUid
     * @return GemMailApi_Http_Response
     */
    public function trackOpening($campaignUid, $subscriberUid)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'    => GemMailApi_Http_Client::METHOD_GET,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s/track-opening/%s', (string)$campaignUid, (string)$subscriberUid)),
            'paramsGet' => array(),
        ));

        return $response = $client->request();
    }

    /**
     * Track campaign unsubscribe for certain subscriber
     *
     * @param string $campaignUid
     * @param string $subscriberUid
     * @param array $data
     * @return GemMailApi_Http_Response
     */
    public function trackUnsubscribe($campaignUid, $subscriberUid, array $data = array())
    {
        $client = new GemMailApi_Http_Client(array(
            'method'     => GemMailApi_Http_Client::METHOD_POST,
            'url'        => $this->config->getApiUrl(sprintf('campaigns/%s/track-unsubscribe/%s', (string)$campaignUid, (string)$subscriberUid)),
            'paramsPost' => $data,
        ));

        return $response = $client->request();
    }
}
