<?php
/**
 * This file contains the templates endpoint for GemMailApi PHP-SDK.
 * 
 * @author Rapt Internet <rapt@rapt.com.br>
 * @link https://rapt.com.br/
 * @copyright 2017-2019 https://rapt.com.br/
 */
 
 
/**
 * GemMailApi_Endpoint_Templates handles all the API calls for email templates.
 * 
 * @author Adnan Neser Junior <neser@rapt.com.br>
 * @package GemMailApi
 * @subpackage Cache
 * @since 1.0
 */
class GemMailApi_Endpoint_Templates extends GemMailApi_Base
{
    /**
     * Get all the email templates of the current customer
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param integer $page
     * @param integer $perPage
     * @return GemMailApi_Http_Response
     */
    public function getTemplates($page = 1, $perPage = 10)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl('templates'),
            'paramsGet'     => array(
                'page'      => (int)$page, 
                'per_page'  => (int)$perPage
            ),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }

    /**
     * Search through all the email templates of the current customer
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @since GemMail 1.4.4
     * @param integer $page
     * @param integer $perPage
     * @param array $filter
     * @return GemMailApi_Http_Response
     */
    public function searchTemplates($page = 1, $perPage = 10, array $filter = array())
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl('templates'),
            'paramsGet'     => array(
                'page'      => (int)$page,
                'per_page'  => (int)$perPage,
                'filter'    => $filter,
            ),
            'enableCache'   => true,
        ));

        return $response = $client->request();
    }
    
    /**
     * Get one template
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param string $templateUid
     * @return GemMailApi_Http_Response
     */
    public function getTemplate($templateUid)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('templates/%s', (string)$templateUid)),
            'paramsGet'     => array(),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Create a new template
     * 
     * @param array $data
     * @return GemMailApi_Http_Response
     */
    public function create(array $data)
    {
        if (isset($data['content'])) {
            $data['content'] = base64_encode($data['content']);
        }
        
        if (isset($data['archive'])) {
            $data['archive'] = base64_encode($data['archive']);
        }
        
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_POST,
            'url'           => $this->config->getApiUrl('templates'),
            'paramsPost'    => array(
                'template'  => $data
            ),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Update existing template for the customer
     * 
     * @param string $templateUid
     * @param array $data
     * @return GemMailApi_Http_Response
     */
    public function update($templateUid, array $data)
    {
        if (isset($data['content'])) {
            $data['content'] = base64_encode($data['content']);
        }
        
        if (isset($data['archive'])) {
            $data['archive'] = base64_encode($data['archive']);
        }
        
        $client = new GemMailApi_Http_Client(array(
            'method'        => GemMailApi_Http_Client::METHOD_PUT,
            'url'           => $this->config->getApiUrl(sprintf('templates/%s', $templateUid)),
            'paramsPut'     => array(
                'template'  => $data
            ),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Delete existing template for the customer
     * 
     * @param string $templateUid
     * @return GemMailApi_Http_Response
     */
    public function delete($templateUid)
    {
        $client = new GemMailApi_Http_Client(array(
            'method'    => GemMailApi_Http_Client::METHOD_DELETE,
            'url'       => $this->config->getApiUrl(sprintf('templates/%s', $templateUid)),
        ));
        
        return $response = $client->request();
    }
}