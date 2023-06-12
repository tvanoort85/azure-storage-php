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
 * @see      https://github.com/azure/azure-storage-php
 */

namespace MicrosoftAzure\Storage\Blob\Models;

use MicrosoftAzure\Storage\Blob\Internal\BlobResources as Resources;
use MicrosoftAzure\Storage\Common\Internal\Utilities;

/**
 * The result of calling breakLease API.
 *
 * @see      https://github.com/azure/azure-storage-php
 */
class BreakLeaseResult
{
    private $_leaseTime;

    /**
     * Creates BreakLeaseResult from response headers
     *
     * @param array $headers response headers
     *
     * @return BreakLeaseResult
     */
    public static function create($headers)
    {
        $result = new BreakLeaseResult();

        $result->setLeaseTime(
            Utilities::tryGetValue($headers, Resources::X_MS_LEASE_TIME)
        );

        return $result;
    }

    /**
     * Gets lease time.
     *
     * @return string
     */
    public function getLeaseTime()
    {
        return $this->_leaseTime;
    }

    /**
     * Sets lease time.
     *
     * @param string $leaseTime the blob lease time.
     */
    protected function setLeaseTime($leaseTime)
    {
        $this->_leaseTime = $leaseTime;
    }
}
