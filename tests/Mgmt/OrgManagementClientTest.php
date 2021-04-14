<?php
require_once __DIR__ . '../../../vendor/autoload.php';


use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\OrgManagementClient;
use Test\TestConfig;
use PHPUnit\Framework\TestCase;

class OrgManagementClientTest extends TestCase
{
    /**
     * @var OrgManagementClient
     */
    private $orgManagement;

    private $_testConfig;

    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $manageConfig = (object) TestConfig::getConfig('Management');
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient($manageConfig->userPoolId, $manageConfig->userPoolSercet);
        $management->requestToken();
        $this->orgManagement = $management->orgs();
    }

    public function testGetNodeById()
    {
        // nodeId
        $nodeId = $this->_testConfig->nodeId;
        $node = $this->orgManagement->getNodeById($nodeId);
        parent::assertNotEmpty($node);
        parent::assertEquals($nodeId, $node->id);
    }
}
