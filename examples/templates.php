<?php
/**
 * Este arquivo contém exemplos de utilização do SDK PHP do GemMail.
 *
 * @author Rapt Internet <rapt@rapt.com.br>
 * @link https://rapt.com.br/
 * @copyright 2017-2019 https://rapt.com.br/
 */
 
// require the setup which has registered the autoloader
require_once dirname(__FILE__) . '/setup.php';

// CREATE THE ENDPOINT
$endpoint = new GemMailApi_Endpoint_Templates();

/*===================================================================================*/

// GET ALL ITEMS
$response = $endpoint->getTemplates($pageNumber = 1, $perPage = 10);

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// Search ALL ITEMS (available from GemMail 1.4.4)
$response = $endpoint->searchTemplates($pageNumber = 1, $perPage = 10, array(
    'name' => 'my template name'
));

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// GET ONE ITEM
$response = $endpoint->getTemplate('TEMPLATE-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// delete template
$response = $endpoint->delete('TEMPLATE-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// CREATE A NEW TEMPLATE
$rand = rand();
$response = $endpoint->create(array(
    'name'          => 'Meu modelo de API ' . $rand,
    'content'       => file_get_contents(dirname(__FILE__) . '/template-example.html'),
    //'archive'     => file_get_contents(dirname(__FILE__) . '/template-example.zip'),
    'inline_css'    => 'no',// yes|no
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UPDATE A TEMPLATE
$response = $endpoint->update('TEMPLATE-UNIQUE-ID', array(
    'name'          => 'Meu modelo de API - atualizado' . $rand,
    'content'       => file_get_contents(dirname(__FILE__) . '/template-example.html'),
    //'archive'     => file_get_contents(dirname(__FILE__) . '/template-example.zip'),
    'inline_css'    => 'no',// yes|no
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';