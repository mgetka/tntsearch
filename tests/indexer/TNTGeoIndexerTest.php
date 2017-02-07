<?php

use TeamTNT\TNTSearch\Indexer\TNTIndexer;
use TeamTNT\TNTSearch\Indexer\TNTGeoIndexer;

class TNTGeoIndexerTest extends PHPUnit_Framework_TestCase
{
    protected $indexName = "testGeoIndex";
    protected $config    = [
        'driver'   => 'sqlite',
        'database' => __DIR__ . '/../_files/cities.sqlite',
        'host'     => 'localhost',
        'username' => 'testUser',
        'password' => 'testPass',
        'storage'  => __DIR__ . '/../_files/',
    ];

    public function testGeoIndexCreation()
    {
        $geoIndex = new TNTGeoIndexer;
        $geoIndex->disableOutput = true;
        $geoIndex->loadConfig($this->config);
        $geoIndex->createIndex('cities.geo.index');
        $geoIndex->query('SELECT id, longitude, latitude FROM cities;');
        $geoIndex->run();
    }

    public function tearDown()
    {
        if (file_exists(__DIR__ . '/../_files/' . $this->indexName)) {
            unlink(__DIR__ . '/../_files/' . $this->indexName);
        }
    }
}