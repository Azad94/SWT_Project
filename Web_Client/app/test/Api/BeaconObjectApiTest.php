<?php
/**
 * BeaconObjectApiTest
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team & Radoslaw Speier
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Healthcare App
 *
 * Beschreibung der Rest-Schnitstelle der Healthcare API
 *
 * OpenAPI spec version: 1.0.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the endpoint.
 */

namespace Swagger\Client;

use \Swagger\Client\Configuration;
use \Swagger\Client\ApiClient;
use \Swagger\Client\ApiException;
use \Swagger\Client\ObjectSerializer;
use Swagger\Client\Model\BeaconObject;
use PHPUnit\Framework\TestCase;

include '../../autoload.php';

/**
 * BeaconObjectApiTest Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class BeaconObjectApiTest extends TestCase
{
    protected $locationID;
    protected $beaconID;
    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass()
    {   $body = new \Swagger\Client\Model\Location(); 
        $body->setBuilding(1);
        $body->setFloor(4);
        $body->setRoom(3);
        
        $body2 = new \Swagger\Client\Model\Beacon();
        $body2->setMajor(1);
        $body2->setMinor(0);
        $api_instanceLocation = new Api\LocationApi();
        $api_instanceBeacon = new Api\BeaconApi();
        try {
            list($return,$statusCode,$c)   =   $api_instanceLocation->locationsPostWithHttpInfo($body);
            list($return2,$statusCode,$c2) = $api_instanceBeacon->beaconsPostWithHttpInfo($body2);  
           
           
            $GLOBALS['locationID']=$return['id'];
            $GLOBALS['beaconID']=$return2['uuid'];
            
        }
         catch (\Swagger\Client\ApiException $e){
            //print_r($e->getResponseBody());
         }
    }

    
    /**
     * Test case for beaconObjectsPost
     *
     * Erstellen.
     *
     */
    public function testBeaconObjectsPost()
    {
       
        $body = new \Swagger\Client\Model\BeaconObject();
        $beaObApi_instance = new \Swagger\Client\Api\BeaconObjectApi();
        $locApi_instance = new \Swagger\Client\Api\LocationApi();
        $beaApi_instance = new \Swagger\Client\Api\BeaconApi();
        
        try
        {
            list($beacon,$statusCode,$c)= $beaApi_instance->beaconsBeaconIdGetWithHttpInfo($GLOBALS['beaconID']);
            $this->assertTrue($statusCode==200);
            $this->assertTrue($beacon!=null);
            list($location,$statusCode,$c) = $locApi_instance->locationsLocationIdGetWithHttpInfo($GLOBALS['locationID']);
            $this->assertTrue($statusCode==200);
            $this->assertTrue($beacon!=null);
            
        }
        catch (Exception $e)
        {  
            //print_r($e->getResponseBody());
            
            $this->assertTrue(false);
        }
        $body->setLocation($location);
        $body->setBeacon($beacon);
        $body->setName("TestBett");
        $body->setBeaconObjectType(BeaconObject::BEACON_OBJECT_TYPE_SENIORENBETT);
        $body->setPictureOfObject(null);
        $body->setState(1);
        
        
        try
        {
            list($result,$statusCode,$c) = $beaObApi_instance->beaconObjectsPostWithHttpInfo($body);
            $this->assertTrue($statusCode==200);
            //print_r($result);
            //print_r($c);
            if ($result!=null){
                return $result['id'];
            }
            else {
                $this->assertrTrue(false);
            }
        } catch (ApiException $e) {
            //print_r($e->getResponseBody());
            $this->assertTrue(false);
        }
    }

    /**
     * Test case for beaconObjectsBeaconObjectIdGet
     *
     * Einzelnes Beacon Object.
     *@depends testBeaconObjectsPost
     */
    public function testBeaconObjectsBeaconObjectIdGet($id)
    {  
       $beaObApi_instance = new \Swagger\Client\Api\BeaconObjectApi();
       
        try{
            list($result,$statusCode,$c)=$beaObApi_instance->beaconObjectsBeaconObjectIdGetWithHttpInfo($id);
            
            $this->assertTrue($statusCode==200);
            //$bo = new \Swagger\Client\Model\BeaconObject();
            
            $location = $result->getLocation();
            $this->assertTrue($location->getBuilding()==1);
            $this->assertTrue($location->getFloor()==4);
            $this->assertTrue($location->getRoom()==3);
            
            $beacon = $result->getBeacon();
            $this->assertTrue($beacon->getMajor()==1);
            $this->assertTrue($beacon->getMinor()==0);
            
            $this->assertTrue($result->getName()=='TestBett');
            $this->assertTrue($result->getState()==1);
            $this->assertTrue($result->getBeaconObjectType()==BeaconObject::BEACON_OBJECT_TYPE_SENIORENBETT);
            $this->assertTrue($result->getPictureOfObject()==null);
            
        } catch(ApiException $e){
            $this->assertTrue(false);
        }
    }

    /**
     * Test case for beaconObjectsBeaconObjectIdPut
     *
     * Bearbeiten.
     *@depends testBeaconObjectsPost 
     */
    public function testBeaconObjectsBeaconObjectIdPut($id)
    {
        $beaObApi_instance = new \Swagger\Client\Api\BeaconObjectApi();
        
        $body = new \Swagger\Client\Model\Location(); 
        $body->setBuilding(1);
        $body->setFloor(2);
        $body->setRoom(3);
        
        $body2 = new \Swagger\Client\Model\Beacon();
        $body2->setMajor(1);
        $body2->setMinor(1);
        $api_instanceLocation = new Api\LocationApi();
        $api_instanceBeacon = new Api\BeaconApi();
        try {
            list($return,$statusCode,$c) = $api_instanceLocation->locationsPostWithHttpInfo($body);
            $this->assertTrue($statusCode==200);
            list($return2,$statusCode2,$c2) = $api_instanceBeacon->beaconsPostWithHttpInfo($body2);
            $this->assertTrue($statusCode==200);
            $locationid=$return['id'];
            $beaconid=$return2['uuid'];
            
            list($result,$statusCode,$c)=$beaObApi_instance->beaconObjectsBeaconObjectIdGetWithHttpInfo($id);
            $this->assertTrue($statusCode==200);
            //print_r($result);
            //$this->assertTrue(==$body->getFloor())   
            
            
        } catch(ApiException $e){
            $this->assertTrue(false);
        }
    }

   

    /**
     * Test case for beaconObjectsGet
     *
     * Alle Beaconobjekte.
     *@depends testBeaconObjectsPost
     */
    public function testBeaconObjectsGet($id)
    {
      $beaObApi_instance = new \Swagger\Client\Api\BeaconObjectApi();
        
        try{
            list($result,$statusCode,$c)=$beaObApi_instance->beaconObjectsGetWithHttpInfo($id);
            $this->assertTrue($statusCode==200);
            $this->assertTrue(count($result)>=1);      
        } catch(ApiException $e){
            $this->assertTrue(false);
        }
    }

       /**
     * Test case for beaconObjectsBeaconObjectIdDelete
     *
     * löschen.
     *@depends testBeaconObjectsPost
     */
    public function testBeaconObjectsBeaconObjectIdDelete($id)
    {
        $beaObApi_instance = new \Swagger\Client\Api\BeaconObjectApi();
        
        try{
            list($result,$statusCode,$c)=$beaObApi_instance->beaconObjectsBeaconObjectIdDeleteWithHttpInfo($id);
            $this->assertTrue($statusCode==200);
            $beaObApi_instance->beaconObjectsBeaconObjectIdGet($id);      
        } catch(ApiException $e){
            $this->assertTrue($e->getCode()==404);
        }
        
    }
    
    /**
     * Test case for beaconObjectsBeaconObjectIdCleaningtasksGet
     *
     * Erhalte alle cleaningtasks zu diesem beaconObject.
     *
     */
    public function testBeaconObjectsBeaconObjectIdCleaningtasksGet()
    {

    }
    
     /**
     * Test case for beaconObjectsBeaconObjectIdTransporttasksGet
     *
     * Erhalte alle Transporttasks die zu diesem beaconObject gehören.
     *
     */
    public function testBeaconObjectsBeaconObjectIdTransporttasksGet()
    {
        
    }
    
       /**
     * Test case for beaconObjectsBeaconObjectIdMaintainancetasksGet
     *
     * Alle Maintainancetasks die zu diesem BeaconObjekt gehören.
     *
     */
    public function testBeaconObjectsBeaconObjectIdMaintainancetasksGet()
    {

    }
    
    /**
     * Setup before running each test case
     */
    public function setUp()
    {
        //post locaion & beacon
        
        
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {

    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {

    }

    
 

}