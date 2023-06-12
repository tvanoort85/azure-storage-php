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

/**
 * optional parameters for CopyBlobOptions wrapper
 *
 * @see      https://github.com/azure/azure-storage-php
 */
class CopyBlobFromURLOptions extends BlobServiceOptions
{
    use AccessTierTrait;

    private $sourceLeaseId;
    private $sourceAccessConditions;
    private $metadata;
    private $isIncrementalCopy;

    /**
     * Gets source access condition
     *
     * @return AccessCondition[]
     */
    public function getSourceAccessConditions()
    {
        return $this->sourceAccessConditions;
    }

    /**
     * Sets source access condition
     *
     * @param array $sourceAccessConditions value to use.
     */
    public function setSourceAccessConditions($sourceAccessConditions)
    {
        if (null !== $sourceAccessConditions
            && is_array($sourceAccessConditions)) {
            $this->sourceAccessConditions = $sourceAccessConditions;
        } else {
            $this->sourceAccessConditions = [$sourceAccessConditions];
        }
    }

    /**
     * Gets metadata.
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Sets metadata.
     *
     * @param array $metadata value.
     */
    public function setMetadata(array $metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * Gets source lease ID.
     *
     * @return string
     */
    public function getSourceLeaseId()
    {
        return $this->sourceLeaseId;
    }

    /**
     * Sets source lease ID.
     *
     * @param string $sourceLeaseId value.
     */
    public function setSourceLeaseId($sourceLeaseId)
    {
        $this->sourceLeaseId = $sourceLeaseId;
    }

    /**
     * Gets isIncrementalCopy.
     *
     * @return bool
     */
    public function getIsIncrementalCopy()
    {
        return $this->isIncrementalCopy;
    }

    /**
     * Sets isIncrementalCopy.
     *
     * @param bool $isIncrementalCopy
     */
    public function setIsIncrementalCopy($isIncrementalCopy)
    {
        $this->isIncrementalCopy = $isIncrementalCopy;
    }
}
