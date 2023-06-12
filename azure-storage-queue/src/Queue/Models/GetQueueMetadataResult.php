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

namespace MicrosoftAzure\Storage\Queue\Models;

/**
 * Holds result from calling GetQueueMetadata wrapper
 *
 * @see      https://github.com/azure/azure-storage-php
 */
class GetQueueMetadataResult
{
    private $_approximateMessageCount;
    private $_metadata;

    /**
     * Constructor
     *
     * @param int   $approximateMessageCount Approximate number of queue messages.
     * @param array $metadata                user defined metadata.
     *
     * @internal
     */
    public function __construct($approximateMessageCount, array $metadata)
    {
        $this->setApproximateMessageCount($approximateMessageCount);
        $this->setMetadata(null === $metadata ? [] : $metadata);
    }

    /**
     * Gets approximate message count.
     *
     * @return int
     */
    public function getApproximateMessageCount()
    {
        return $this->_approximateMessageCount;
    }

    /**
     * Sets approximate message count.
     *
     * @param int $approximateMessageCount value to use.
     *
     * @internal
     */
    protected function setApproximateMessageCount($approximateMessageCount)
    {
        $this->_approximateMessageCount = $approximateMessageCount;
    }

    /**
     * Sets metadata.
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->_metadata;
    }

    /**
     * Sets metadata.
     *
     * @param array $metadata value to use.
     *
     * @internal
     */
    protected function setMetadata(array $metadata)
    {
        $this->_metadata = $metadata;
    }
}
