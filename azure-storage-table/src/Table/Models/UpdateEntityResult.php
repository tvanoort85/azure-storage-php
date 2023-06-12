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

namespace MicrosoftAzure\Storage\Table\Models;

use MicrosoftAzure\Storage\Common\Internal\Utilities;
use MicrosoftAzure\Storage\Table\Internal\TableResources as Resources;

/**
 * Holds result of updateEntity and mergeEntity APIs
 *
 * @see      https://github.com/azure/azure-storage-php
 */
class UpdateEntityResult
{
    private $_etag;

    /**
     * Creates UpdateEntityResult from HTTP response headers.
     *
     * @param array $headers The HTTP response headers.
     *
     * @internal
     *
     * @return UpdateEntityResult
     */
    public static function create(array $headers)
    {
        $result = new UpdateEntityResult();
        $result->setETag(
            Utilities::tryGetValueInsensitive(Resources::ETAG, $headers)
        );

        return $result;
    }

    /**
     * Gets entity etag.
     *
     * @return string
     */
    public function getETag()
    {
        return $this->_etag;
    }

    /**
     * Sets entity etag.
     *
     * @param string $etag The entity ETag.
     */
    protected function setETag($etag)
    {
        $this->_etag = $etag;
    }
}
