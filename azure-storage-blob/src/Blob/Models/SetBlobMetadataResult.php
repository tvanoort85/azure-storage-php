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
use MicrosoftAzure\Storage\Common\Internal\Validate;

/**
 * Holds results of calling getBlobMetadata wrapper
 *
 * @see      https://github.com/azure/azure-storage-php
 */
class SetBlobMetadataResult
{
    private $etag;
    private $lastModified;
    private $requestServerEncrypted;

    /**
     * Creates SetBlobMetadataResult from response headers.
     *
     * @param array $headers response headers
     *
     * @internal
     *
     * @return SetBlobMetadataResult
     */
    public static function create(array $headers)
    {
        $result = new SetBlobMetadataResult();

        $result->setETag(Utilities::tryGetValueInsensitive(
            Resources::ETAG,
            $headers
        ));

        $date = Utilities::tryGetValueInsensitive(
            Resources::LAST_MODIFIED,
            $headers
        );
        $result->setLastModified(Utilities::rfc1123ToDateTime($date));

        $result->setRequestServerEncrypted(
            Utilities::toBoolean(
                Utilities::tryGetValueInsensitive(
                    Resources::X_MS_REQUEST_SERVER_ENCRYPTED,
                    $headers
                ),
                true
            )
        );

        return $result;
    }

    /**
     * Gets blob lastModified.
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Sets blob lastModified.
     *
     * @param \DateTime $lastModified value.
     */
    protected function setLastModified(\DateTime $lastModified)
    {
        Validate::isDate($lastModified);
        $this->lastModified = $lastModified;
    }

    /**
     * Gets blob etag.
     *
     * @return string
     */
    public function getETag()
    {
        return $this->etag;
    }

    /**
     * Sets blob etag.
     *
     * @param string $etag value.
     */
    protected function setETag($etag)
    {
        Validate::canCastAsString($etag, 'etag');
        $this->etag = $etag;
    }

    /**
     * Gets the whether the contents of the request are successfully encrypted.
     *
     * @return bool
     */
    public function getRequestServerEncrypted()
    {
        return $this->requestServerEncrypted;
    }

    /**
     * Sets the request server encryption value.
     *
     * @param bool $requestServerEncrypted
     */
    public function setRequestServerEncrypted($requestServerEncrypted)
    {
        $this->requestServerEncrypted = $requestServerEncrypted;
    }
}
