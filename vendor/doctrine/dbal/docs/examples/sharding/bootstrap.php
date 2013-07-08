<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\Shards\DBAL\SQLAzure\SQLAzureShardManager;

//mine from Doctrine documentation
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$config = array(
    'dbname'   => 'SalesDB',
    'host'     => 'tcp:dbname.windows.net',
    'user'     => 'user@dbname',
    'password' => 'XXX',
    'sharding' => array(
        'federationName'   => 'Orders_Federation',
        'distributionKey'  => 'CustId',
        'distributionType' => 'integer',
    )
);

if ($config['host'] == "tcp:dbname.windows.net") {
    die("You have to change the configuration to your Azure account.\n");
}

$conn = DriverManager::getConnection($config);
$shardManager = new SQLAzureShardManager($conn);

//mine from Doctrine documentation
//default Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"),$isDevMode);

//database  configuration parameters
$connectionOptions = array(
    'driver' => 'pdo_mysql',
    'host'   => '127.0.0.1',
    'dbname' => 'fitnessclub',
    'username' => 'root',
    'password' => ''
);

//obtaining the entity manager
$entityManager = $entityManager::create($connectionOptions,$config);