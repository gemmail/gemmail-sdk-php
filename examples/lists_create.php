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

// create the lists endpoint:
$endpoint = new GemMailApi_Endpoint_Lists();

// create a new list
// please see countries.php example file for a list of allowed countries/zones for list company
$response = $endpoint->create(array(
    // required
    'general' => array(
        'name'          => 'Lista criada pela API', // required
        'description'   => 'Descrição da lista criada pela API.', // required
    ),
    // required
    'defaults' => array(
        'from_name' => 'Nome da Empresa', // required
        'from_email'=> 'empresa@dominio.com', // required
        'reply_to'  => 'empresa@dominio.com', // required
        'subject'   => 'Opa!',
    ),
    // optional
    'notifications' => array(
        // notification when new subscriber added
        'subscribe'         => 'yes', // yes|no
        // notification when subscriber unsubscribes
        'unsubscribe'       => 'yes', // yes|no
        // where to send the notifications.
        'subscribe_to'      => 'empresa@dominio.com',
        'unsubscribe_to'    => 'empresa@dominio.com',
    ),
    // optional, if not set customer company data will be used
    'company' => array(
        'name'      => 'Emoresa Ltda', // required
        'country'   => 'Brazil', // required
        'zone'      => 'Sao Paulo', // required
        'address_1' => 'Rua xyz', // required
        'address_2' => '',
        'zone_name' => '', // when country doesn't have required zone.
        'city'      => 'São Paulo',
        'zip_code'  => '00000-000',
    ),
));

// and get the response
echo '<pre>';
print_r($response->body);
echo '</pre>';
