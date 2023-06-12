<?php

/**
 * LICENSE: The MIT License (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * https://github.com/azure/azure-storage-php/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * PHP version 5
 *
 * @link      https://github.com/azure/azure-storage-php
 */

namespace MicrosoftAzure\Storage\Tests\Unit\Common;

use MicrosoftAzure\Storage\Common\Internal\Resources;
use MicrosoftAzure\Storage\Common\ServiceException;
use MicrosoftAzure\Storage\Tests\Framework\TestResources;
use MicrosoftAzure\Storage\Tests\Framework\ReflectionTestBase;
use MicrosoftAzure\Storage\Common\SharedAccessSignatureHelper;

/**
* Unit tests for class SharedAccessSignatureHelper
*
* @link      https://github.com/azure/azure-storage-php
*/
class SharedAccessSignatureHelperTest extends ReflectionTestBase
{
    public function testConstruct()
    {
        // Setup
        $accountName = TestResources::ACCOUNT_NAME;
        $accountKey = TestResources::KEY4;

        // Test
        $sasHelper = new SharedAccessSignatureHelper($accountName, $accountKey);

        // Assert
        $this->assertNotNull($sasHelper);

        return $sasHelper;
    }

    public function testValidateAndSanitizeSignedService()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedService = self::getMethod('validateAndSanitizeSignedService', $sasHelper);

        $authorizedSignedService = [];
        $authorizedSignedService[] = "BqtF";
        $authorizedSignedService[] = "bQtF";
        $authorizedSignedService[] = "fqTb";
        $authorizedSignedService[] = "ffqq";
        $authorizedSignedService[] = "BbbB";

        $expected = [];
        $expected[] = "bqtf";
        $expected[] = "bqtf";
        $expected[] = "bqtf";
        $expected[] = "qf";
        $expected[] = "b";

        for ($i = 0; $i < count($authorizedSignedService); ++$i) {
            // Test
            $actual = $validateAndSanitizeSignedService->invokeArgs($sasHelper, [$authorizedSignedService[$i]]);

            // Assert
            $this->assertEquals($expected[$i], $actual);
        }
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The string should only be a combination of
     */
    public function testValidateAndSanitizeSignedServiceThrowsException()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedService = self::getMethod('validateAndSanitizeSignedService', $sasHelper);
        $unauthorizedSignedService = "BqTfG";

        // Test: should throw an InvalidArgumentException
        $validateAndSanitizeSignedService->invokeArgs($sasHelper, [$unauthorizedSignedService]);
    }

    public function testValidateAndSanitizeSignedResourceType()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedResourceType = self::getMethod('validateAndSanitizeSignedResourceType', $sasHelper);

        $authorizedSignedResourceType = [];
        $authorizedSignedResourceType[] = "sCo";
        $authorizedSignedResourceType[] = "Ocs";
        $authorizedSignedResourceType[] = "OOsCc";
        $authorizedSignedResourceType[] = "OOOoo";

        $expected = [];
        $expected[] = "sco";
        $expected[] = "sco";
        $expected[] = "sco";
        $expected[] = "o";

        for ($i = 0; $i < count($authorizedSignedResourceType); ++$i) {
            // Test
            $actual = $validateAndSanitizeSignedResourceType->invokeArgs(
                $sasHelper,
                [$authorizedSignedResourceType[$i]]
            );

            // Assert
            $this->assertEquals($expected[$i], $actual);
        }
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The string should only be a combination of
     */
    public function testValidateAndSanitizeSignedResourceTypeThrowsException()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedResourceType = self::getMethod('validateAndSanitizeSignedResourceType', $sasHelper);

        $unauthorizedSignedResourceType = "oscB";

        // Test: should throw an InvalidArgumentException
        $validateAndSanitizeSignedResourceType->invokeArgs($sasHelper, [$unauthorizedSignedResourceType]);
    }

    public function testValidateAndSanitizeSignedProtocol()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedProtocol = self::getMethod('validateAndSanitizeSignedProtocol', $sasHelper);

        $authorizedSignedProtocol = [];
        $authorizedSignedProtocol[] = "hTTpS";
        $authorizedSignedProtocol[] = "httpS,hTtp";

        $expected = [];
        $expected[] = "https";
        $expected[] = "https,http";

        for ($i = 0; $i < count($authorizedSignedProtocol); ++$i) {
            // Test
            $actual = $validateAndSanitizeSignedProtocol->invokeArgs($sasHelper, [$authorizedSignedProtocol[$i]]);

            // Assert
            $this->assertEquals($expected[$i], $actual);
        }
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage is invalid
     */
    public function testValidateAndSanitizeSignedProtocolThrowsException()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedProtocol = self::getMethod('validateAndSanitizeSignedProtocol', $sasHelper);

        $unauthorizedSignedProtocol = "htTp";

        // Test: should throw an InvalidArgumentException
        $validateAndSanitizeSignedProtocol->invokeArgs(
            $sasHelper,
            [$unauthorizedSignedProtocol]
        );
    }

    public function testGenerateAccountSharedAccessSignatureToken()
    {
        // Setup
        $accountName = TestResources::ACCOUNT_NAME;
        $accountKey = TestResources::KEY4;

        // Test
        $sasHelper = new SharedAccessSignatureHelper($accountName, $accountKey);

        // create the test cases
        $testCases = TestResources::getSASInterestingUTCases();

        foreach ($testCases as $testCase) {
            // test
            $actualSignature = $sasHelper->generateAccountSharedAccessSignatureToken(
                $testCase[0],
                $testCase[1],
                $testCase[2],
                $testCase[3],
                $testCase[4],
                $testCase[5],
                $testCase[6],
                $testCase[7]
            );

            // assert
            $this->assertEquals($testCase[8], urlencode($actualSignature));
        }
    }

    public function testValidateAndSanitizeSignedPermissions()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedPermissions = self::getMethod(
            'validateAndSanitizeSignedPermissions',
            $sasHelper
        );

        $pairs = TestResources::getInterestingSignedResourcePermissionsPair();

        $expectedErrorMessage = \substr(
            Resources::STRING_NOT_WITH_GIVEN_COMBINATION,
            0,
            strpos(Resources::STRING_NOT_WITH_GIVEN_COMBINATION, '%s')
        );

        foreach ($pairs as $pair) {
            if ($pair['expected'] == '') {
                $message = '';
                try {
                    $validateAndSanitizeSignedPermissions->invokeArgs(
                        $sasHelper,
                        [$pair['sp'], $pair['sr']]
                    );
                } catch (\InvalidArgumentException $e) {
                    $message = $e->getMessage();
                }
                $this->assertContains(
                    $expectedErrorMessage,
                    $message
                );
            } else {
                $result = $validateAndSanitizeSignedPermissions->invokeArgs(
                    $sasHelper,
                    [$pair['sp'], $pair['sr']]
                );
                $this->assertEquals($pair['expected'], $result);
            }
        }
    }

    public function testGenerateCanonicalResource()
    {
        // Setup
        $sasHelper = $this->testConstruct();
        $validateAndSanitizeSignedService = self::getMethod('generateCanonicalResource', $sasHelper);

        $resourceNames = [];
        $resourceNames[] = "filename";
        $resourceNames[] = "/filename";
        $resourceNames[] = "/filename/";
        $resourceNames[] = "folder/filename";
        $resourceNames[] = "/folder/filename";
        $resourceNames[] = "/folder/filename/";
        $resourceNames[] = "/folder/eñe20!.pdf/";

        $expected = [];
        $expected[] = "/blob/test/filename";
        $expected[] = "/blob/test/filename";
        $expected[] = "/blob/test/filename/";
        $expected[] = "/blob/test/folder/filename";
        $expected[] = "/blob/test/folder/filename";
        $expected[] = "/blob/test/folder/filename/";
        $expected[] = "/blob/test/folder/eñe20!.pdf/";

        for ($i = 0; $i < count($resourceNames); ++$i) {
            // Test
            $actual = $validateAndSanitizeSignedService->invokeArgs($sasHelper, ['test', Resources::RESOURCE_TYPE_BLOB, $resourceNames[$i]]);

            // Assert
            $this->assertEquals($expected[$i], $actual);
        }
    }
}
