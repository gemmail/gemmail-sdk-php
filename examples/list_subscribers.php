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
$endpoint = new GemMailApi_Endpoint_ListSubscribers();

/*===================================================================================*/

// GET ALL ITEMS
$response = $endpoint->getSubscribers('LIST-UNIQUE-ID', $pageNumber = 1, $perPage = 10);

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// GET ONE ITEM
$response = $endpoint->getSubscriber('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// SEARCH BY EMAIL
$response = $endpoint->emailSearch('LIST-UNIQUE-ID', 'fulano@dominio.com.br');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// SEARCH BY EMAIL IN ALL LISTS
$response = $endpoint->emailSearchAllLists('fulano@dominio.com.br');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// SEARCH BY CUSTOM FIELDS IN A LIST
$response = $endpoint->searchByCustomFields('LIST-UNIQUE-ID', array(
    'EMAIL' => 'fulano@dominio.com.br'
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// ADD SUBSCRIBER
$response = $endpoint->create('LIST-UNIQUE-ID', array(
    'EMAIL'    => 'fulano@dominio.com.br', // the confirmation email will be sent!!! Use valid email address
    'FNAME'    => 'fulano',
    'LNAME'    => 'Doe'
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/


$response = $endpoint->createBulk('LIST-UNIQUE-ID', array(
	array(
		'EMAIL'    => 'fulano@dominio.com.br',
		'FNAME'    => 'Fulano',
		'LNAME'    => 'de Tal'
	),
	array(
		'EMAIL'    => 'ciclano@dominio.com.br',
		'FNAME'    => 'Ciclano',
		'LNAME'    => 'de Tal'
	),
	array(
		'EMAIL'    => 'beltrano@dominio.com.br',
		'FNAME'    => 'Beltrano',
		'LNAME'    => 'de Tal'
	)
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';


/*===================================================================================*/

// UPDATE EXISTING SUBSCRIBER
$response = $endpoint->update('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID', array(
    'EMAIL'    => 'fulano@dominio.com.br',
    'FNAME'    => 'Fulano',
    'LNAME'    => 'de Tal - teste de update'
));

// DISPLAY RESPONSE
echo '<hr />';
echo '<pre>';
print_r($response->body);

/*===================================================================================*/

// CREATE / UPDATE EXISTING SUBSCRIBER
$response = $endpoint->createUpdate('LIST-UNIQUE-ID', array(
    'EMAIL'    => 'fulano@dominio.com.br',
    'FNAME'    => 'Fulano',
    'LNAME'    => 'de Tal - teste de update 2'
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UNSUBSCRIBE existing subscriber, no email is sent, unsubscribe is silent
$response = $endpoint->unsubscribe('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UNSUBSCRIBE existing subscriber by email address, no email is sent, unsubscribe is silent
$response = $endpoint->unsubscribeByEmail('LIST-UNIQUE-ID', 'fulano@dominio.com.br');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';
/*===================================================================================*/

// DELETE SUBSCRIBER, no email is sent, delete is silent
$response = $endpoint->delete('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';
/*===================================================================================*/

// DELETE SUBSCRIBER by email address, no email is sent, delete is silent
$response = $endpoint->deleteByEmail('LIST-UNIQUE-ID', 'fulano@dominio.com.br');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';
