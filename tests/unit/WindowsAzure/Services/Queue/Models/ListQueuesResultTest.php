<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Queue\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace PEAR2\Tests\Unit\WindowsAzure\Services\Queue\Models;
use PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult;
use PEAR2\Tests\Framework\TestResources;

/**
 * Unit tests for class ListQueuesResult
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Queue\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class ListQueueResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::create 
     */
    public function testCreateWithEmpty()
    {
        // Setup
        $sample = TestResources::listQueuesEmpty();
        
        // Test
        $actual = ListQueuesResult::create($sample);
        
        // Assert
        $this->assertCount(0, $actual->getQueues());
        $this->assertTrue(empty($sample['NextMarker']));
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::create 
     */
    public function testCreateWithOneEntry()
    {
        // Setup
        $sample = TestResources::listQueuesOneEntry();
        
        // Test
        $actual = ListQueuesResult::create($sample);
        
        // Assert
        $queues = $actual->getQueues();
        $this->assertCount(1, $queues);
        $this->assertEquals($sample['Queues']['Queue']['Name'], $queues[0]->getName());
        $this->assertEquals($sample['Queues']['Queue']['Url'], $queues[0]->getUrl());
        $this->assertEquals($sample['Marker'], $actual->getMarker());
        $this->assertEquals($sample['MaxResults'], $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::create 
     */
    public function testCreateWithMultipleEntries()
    {
        // Setup
        $sample = TestResources::listQueuesMultipleEntries();
        
        // Test
        $actual = ListQueuesResult::create($sample);
        
        // Assert
        $queues = $actual->getQueues();
        $this->assertCount(2, $queues);
        $this->assertEquals($sample['Queues']['Queue'][0]['Name'], $queues[0]->getName());
        $this->assertEquals($sample['Queues']['Queue'][0]['Url'], $queues[0]->getUrl());
        $this->assertEquals($sample['Queues']['Queue'][1]['Name'], $queues[1]->getName());
        $this->assertEquals($sample['Queues']['Queue'][1]['Url'], $queues[1]->getUrl());
        $this->assertEquals($sample['MaxResults'], $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
        
        return $actual;
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::getQueues
     * @depends testCreateWithMultipleEntries
     */
    public function testGetQueues($result)
    {
        // Test
        $actual = $result->getQueues();
        
        // Assert
        $this->assertCount(2, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::setQueues
     * @depends testCreateWithMultipleEntries
     */
    public function testSetQueues($result)
    {
        // Setup
        $sample = new ListQueuesResult();
        $expected = $result->getQueues();
        
        // Test
        $sample->setQueues($expected);
        
        // Assert
        $this->assertEquals($expected, $sample->getQueues());
        $expected[0]->setName('test');
        $this->assertNotEquals($expected, $sample->getQueues());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::setPrefix
     */
    public function testSetPrefix()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = 'myprefix';
        
        // Test
        $options->setPrefix($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getPrefix());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::getPrefix
     */
    public function testGetPrefix()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = 'myprefix';
        $options->setPrefix($expected);
        
        // Test
        $actual = $options->getPrefix();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::setNextMarker
     */
    public function testSetNextMarker()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = 'mymarker';
        
        // Test
        $options->setNextMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getNextMarker());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::getNextMarker
     */
    public function testGetNextMarker()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = 'mymarker';
        $options->setNextMarker($expected);
        
        // Test
        $actual = $options->getNextMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::setMarker
     */
    public function testSetMarker()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = 'mymarker';
        
        // Test
        $options->setMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getMarker());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::getMarker
     */
    public function testGetMarker()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = 'mymarker';
        $options->setMarker($expected);
        
        // Test
        $actual = $options->getMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::setMaxResults
     */
    public function testSetMaxResults()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = '3';
        
        // Test
        $options->setMaxResults($expected);
        
        // Assert
        $this->assertEquals($expected, $options->getMaxResults());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Queue\Models\ListQueuesResult::getMaxResults
     */
    public function testGetMaxResults()
    {
        // Setup
        $options = new ListQueuesResult();
        $expected = '3';
        $options->setMaxResults($expected);
        
        // Test
        $actual = $options->getMaxResults();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
}

?>
