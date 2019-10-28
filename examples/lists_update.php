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

// update list
// please see countries.php example file for a list of allowed countries/zones for list company
$response = $endpoint->update('LIST-UNIQUE-ID', array(
    // required
    'general' => array(
        'name'          => 'My list created from the API - now updated!', // required
        'description'   => 'This is a test list, created from the API.', // required
    ),
    // required
    'defaults' => array(
        'from_name' => 'Fulano de Tal', // required
        'from_email'=> 'fulanodoe@dominio.com.br', // required
        'reply_to'  => 'fulanodoe@dominio.com.br', // required
        'subject'   => 'Hello!',
    ),
    // optional
    'notifications' => array(
        // notification when new subscriber added
        'subscribe'         => 'yes', // yes|no
        // notification when subscriber unsubscribes
        'unsubscribe'       => 'yes', // yes|no
        // where to send the notifications.
        'subscribe_to'      => 'fulanodoe@dominio.com.br',
        'unsubscribe_to'    => 'fulanodoe@dominio.com.br',
    ),
    // optional, if not set customer company data will be used
    'company' => array(
        'name'      => 'Fulano de Tal INC', // required
        'country'   => 'United States', // required
        'zone'      => 'New York', // required
        'address_1' => 'Some street address', // required
        'address_2' => '',
        'zone_name' => '',
        'city'      => 'New York City',
        'zip_code'  => '10019',
    ),
));

// and get the response
echo '<pre>';
print_r($response->body);
echo '</pre>';
