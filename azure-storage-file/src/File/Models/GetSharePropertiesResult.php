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

namespace MicrosoftAzure\Storage\File\Models;

use MicrosoftAzure\Storage\Common\Internal\MetadataTrait;
use MicrosoftAzure\Storage\Common\Internal\Utilities;
use MicrosoftAzure\Storage\File\Internal\FileResources as Resources;

/**
 * Holds result of getShareProperties and getShareMetadata
 *
 * @link      https://github.com/azure/azure-storage-php
 */
class GetSharePropertiesResult
{
    use MetadataTrait;

    private $quota;

    /**
     * Gets file quota.
     *
     * @return int
     */
    public function getQuota()
    {
        return $this->quota;
    }

    /**
     * Sets file quota.
     *
     * @param int $quota value.
     *
     * @return void
     */
    protected function setQuota($quota)
    {
        $this->quota = $quota;
    }

    /**
     * Create an instance using the response headers from the API call.
     *
     * @param  array  $responseHeaders The array contains all the response headers
     *
     * @internal
     *
     * @return GetSharePropertiesResult
     */
    public static function create(array $responseHeaders)
    {
        $result = static::createMetadataResult($responseHeaders);

        $result->setQuota(\intval(Utilities::tryGetValueInsensitive(
            Resources::X_MS_SHARE_QUOTA,
            $responseHeaders
        )));

        return $result;
    }
}
