<?php
/**
 * This file contains the lists subscribers endpoint for GemMailApi PHP-SDK.
 *
 * @author Rapt Internet <rapt@rapt.com.br>
 * @link https://rapt.com.br/
 * @copyright 2017-2019 https://rapt.com.br/
 */


/**
 * GemMailApi_Endpoint_ListSubscribers handles all the API calls for lists subscribers.
 *
 * @author Adnan Neser Junior <neser@rapt.com.br>
 * @package GemMailApi
 * @subpackage Cache
 * @since 1.0
 */
class GemMailApi_Endpoint_ListSubscribers extends GemMailApi_Base
{
    /**
     * Get subscribers from a certain mail list
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param string $listUid
     * @param integer $page
     * @param integer $perPage
     * @return GemMailApi_Http_Response
     */
    public function getSubscribers($listUid, $page = 1, $perPage = 10)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers', $listUid)),
            'paramsGet'     => array(
                'page'      => (int)$page,
                'per_page'  => (int)$perPage,
            ),
            'enableCache'   => true,
        ));

        return $response = $client->request();
    }

    /**
     * Get one subscriber from a certain mail list
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param string $listUid
     * @param string $subscriberUid
     * @return GemMailApi_Http_Response
     */
    public function getSubscriber($listUid, $subscriberUid)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s', (string)$listUid, (string)$subscriberUid)),
            'paramsGet'     => array(),
            'enableCache'   => true,
        ));

        return $response = $client->request();
    }

    /**
     * Create a new subscriber in the given list
     *
     * @param string $listUid
     * @param array $data
     * @return GemMailApi_Http_Response
     */
    public function create($listUid, array $data)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_POST,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers', (string)$listUid)),
            'paramsPost'    => $data,
        ));

        return $response = $client->request();
    }

	/**
	 * Create subscribers in bulk in the given list
	 * This feature is available since GemMail 1.8.1 
	 * 
	 * @param string $listUid
	 * @param array $data
	 * @return GemMailApi_Http_Response
	 */
	public function createBulk($listUid, array $data)
	{
		$client = new GemMailApi_Http_Client(array(
			'method'        => GemMailApi_Http_Client::METHOD_POST,
			'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/bulk', (string)$listUid)),
			'paramsPost'    => array('subscribers' => $data),
		));

		return $response = $client->request();
	}

    /**
     * Update existing subscriber in given list
     *
     * @param string $listUid
     * @param string $subscriberUid
     * @param array $data
     * @return GemMailApi_Http_Response
     */
    public function update($listUid, $subscriberUid, array $data)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_PUT,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s', (string)$listUid, (string)$subscriberUid)),
            'paramsPut'     => $data,
        ));

        return $response = $client->request();
    }

    /**
     * Unsubscribe existing subscriber from given list
     *
     * @param string $listUid
     * @param string $subscriberUid
     * @return GemMailApi_Http_Response
     */
    public function unsubscribe($listUid, $subscriberUid)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_PUT,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s/unsubscribe', (string)$listUid, (string)$subscriberUid)),
            'paramsPut'     => array(),
        ));

        return $response = $client->request();
    }

    /**
     * Unsubscribe existing subscriber by email address
     *
     * @param string $listUid
     * @param string emailAddress
     * @return GemMailApi_Http_Response
     */
    public function unsubscribeByEmail($listUid, $emailAddress)
    {
        $response = $this->emailSearch($listUid, $emailAddress);

        // the request failed.
        if ($response->isCurlError) {
            return $response;
        }

        $bodyData = $response->body->itemAt('data');

        // subscriber not found.
        if ($response->isError && $response->httpCode == 404) {
            return $response;
        }

        if (empty($bodyData['subscriber_uid'])) {
            return $response;
        }

        return $this->unsubscribe($listUid, $bodyData['subscriber_uid']);
    }

    /**
     * Unsubscribe existing subscriber by email address from all lists
     *
     * @param string emailAddress
     * @return GemMailApi_Http_Response
     */
    public function unsubscribeByEmailFromAllLists($emailAddress)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_PUT,
            'url'           => $this->config->getApiUrl('lists/subscribers/unsubscribe-by-email-from-all-lists'),
            'paramsPut'     => array(
                'EMAIL' => $emailAddress,
            ),
        ));

        return $response = $client->request();
    }


    /**
     * Delete existing subscriber in given list
     *
     * @param string $listUid
     * @param string $subscriberUid
     * @return GemMailApi_Http_Response
     */
    public function delete($listUid, $subscriberUid)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_DELETE,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s', (string)$listUid, (string)$subscriberUid)),
            'paramsDelete'  => array(),
        ));

        return $response = $client->request();
    }

    /**
     * Delete existing subscriber by email address
     *
     * @param string $listUid
     * @param string emailAddress
     * @return GemMailApi_Http_Response
     */
    public function deleteByEmail($listUid, $emailAddress)
    {
        $response = $this->emailSearch($listUid, $emailAddress);
        $bodyData = $response->body->itemAt('data');

        if ($response->isError || empty($bodyData['subscriber_uid'])) {
            return $response;
        }

        return $this->delete($listUid, $bodyData['subscriber_uid']);
    }

    /**
     * Search in a list for given subscriber by email address
     *
     * @param string $listUid
     * @param string $emailAddress
     * @return GemMailApi_Http_Response
     */
    public function emailSearch($listUid, $emailAddress)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/search-by-email', (string)$listUid)),
            'paramsGet'     => array('EMAIL' => (string)$emailAddress),
        ));

        return $response = $client->request();
    }

    /**
     * Search in a all lists for given subscriber by email address
     * Please note that this is available only for GemMail >= 1.3.6.2
     *
     * @param string $emailAddress
     * @return GemMailApi_Http_Response
     */
    public function emailSearchAllLists($emailAddress)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl('lists/subscribers/search-by-email-in-all-lists'),
            'paramsGet'     => array('EMAIL' => (string)$emailAddress),
        ));

        return $response = $client->request();
    }

	/**
	 * Search in a list by custom fields
	 * 
	 * @param $listUid
	 * @param array $fields
	 * @param int $page
	 * @param int $perPage
	 *
	 * @return GemMailApi_Http_Response
	 */
	public function searchByCustomFields($listUid, array $fields = array(), $page = 1, $perPage = 10)
	{
		$paramsGet = $fields;
		$paramsGet['page']      = (int)$page;
		$paramsGet['per_page']  = (int)$perPage;
		
		$client = new GemMailApi_Http_Client(array(
			'method'        => GemMailApi_Http_Client::METHOD_GET,
			'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/search-by-custom-fields', (string)$listUid)),
			'paramsGet'     => $paramsGet,
		));

		return $response = $client->request();
	}

    /**
     * Create or update a subscriber in given list
     *
     * @param string $listUid
     * @param array $data
     * @return GemMailApi_Http_Response
     */
    public function createUpdate($listUid, $data)
    {
        $emailAddress    = !empty($data['EMAIL']) ? $data['EMAIL'] : null;
        $response        = $this->emailSearch($listUid, $emailAddress);

        // the request failed.
        if ($response->isCurlError) {
            return $response;
        }

        $bodyData = $response->body->itemAt('data');

        // subscriber not found.
        if ($response->isError && $response->httpCode == 404) {
            return $this->create($listUid, $data);
        }

        if (empty($bodyData['subscriber_uid'])) {
            return $response;
        }

        return $this->update($listUid, $bodyData['subscriber_uid'], $data);
    }
}
