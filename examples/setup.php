<?php
/**
 * Este arquivo contém exemplos de utilização do SDK PHP do GemMail.
 *
 * @author Rapt Internet <rapt@rapt.com.br>
 * @link https://rapt.com.br/
 * @copyright 2017-2019 https://rapt.com.br/
 */

exit('COMENTE-ME PARA TESTAR OS EXEMPLOS!');

// require the autoloader class if you haven't used composer to install the package
require_once dirname(__FILE__) . '/../GemMailApi/Autoloader.php';

// register the autoloader if you haven't used composer to install the package
GemMailApi_Autoloader::register();

// if using a framework that already uses an autoloading mechanism, like Yii for example,
// you can register the autoloader like:
// Yii::registerAutoloader(array('GemMailApi_Autoloader', 'autoloader'), true);

/**
 * Notes:
 * https://gerenciador.gemmail.com.br/api/index.php
 * Configuration components:
 * The api for the GemMail is designed to return proper etags when GET requests are made.
 * We can use this to cache the request response in order to decrease loading time therefore improving performance.
 * In this case, we will need to use a cache component that will store the responses and a file cache will do it just fine.
 * Please see GemMailApi/Cache for a list of available cache components and their usage.
 *  Componentes de configuração:
 * A API do GemMail foi projetada para retornar etags apropriadas quando solicitações GET são feitas.
 * Podemos usar isso para armazenar em cache a resposta da solicitação, a fim de diminuir o tempo de carregamento, melhorando o desempenho.
 * Nesse caso, precisaremos usar um componente de cache que armazene as respostas e um cache de arquivo fará isso muito bem.
 * Consulte GemMailApi / Cache para obter uma lista dos componentes de cache disponíveis e seu uso.
 */

// configuration object
$config = new GemMailApi_Config(array(
    'apiUrl'        => 'https://gerenciador.gemmail.com.br/api/index.php',
    'publicKey'     => 'PUBLIC-KEY',
    'privateKey'    => 'PRIVATE-KEY',

    // components
    'components' => array(
        'cache' => array(
            'class'     => 'GemMailApi_Cache_File',
            'filesPath' => dirname(__FILE__) . '/../GemMailApi/Cache/data/cache', // make sure it is writable by webserver
        )
    ),
));

// now inject the configuration and we are ready to make api calls
GemMailApi_Base::setConfig($config);

// start UTC
date_default_timezone_set('UTC');
