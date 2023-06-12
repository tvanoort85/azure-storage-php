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

use MicrosoftAzure\Storage\Common\Internal\Validate;

/**
 * optional parameters for createXXXBlob wrapper
 *
 * @see      https://github.com/azure/azure-storage-php
 */
class CreateBlobOptions extends BlobServiceOptions
{
    private $_contentType;
    private $_contentEncoding;
    private $_contentLanguage;
    private $_contentMD5;
    private $_cacheControl;
    private $_contentDisposition;
    private $_metadata;
    private $_sequenceNumber;
    private $_numberOfConcurrency;

    /**
     * Gets blob contentType.
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->_contentType;
    }

    /**
     * Sets blob contentType.
     *
     * @param string $contentType value.
     */
    public function setContentType($contentType)
    {
        $this->_contentType = $contentType;
    }

    /**
     * Gets contentEncoding.
     *
     * @return string
     */
    public function getContentEncoding()
    {
        return $this->_contentEncoding;
    }

    /**
     * Sets contentEncoding.
     *
     * @param string $contentEncoding value.
     */
    public function setContentEncoding($contentEncoding)
    {
        $this->_contentEncoding = $contentEncoding;
    }

    /**
     * Gets contentLanguage.
     *
     * @return string
     */
    public function getContentLanguage()
    {
        return $this->_contentLanguage;
    }

    /**
     * Sets contentLanguage.
     *
     * @param string $contentLanguage value.
     */
    public function setContentLanguage($contentLanguage)
    {
        $this->_contentLanguage = $contentLanguage;
    }

    /**
     * Gets contentMD5.
     *
     * @return string
     */
    public function getContentMD5()
    {
        return $this->_contentMD5;
    }

    /**
     * Sets contentMD5.
     *
     * @param string $contentMD5 value.
     */
    public function setContentMD5($contentMD5)
    {
        $this->_contentMD5 = $contentMD5;
    }

    /**
     * Gets cacheControl.
     *
     * @return string
     */
    public function getCacheControl()
    {
        return $this->_cacheControl;
    }

    /**
     * Sets cacheControl.
     *
     * @param string $cacheControl value to use.
     */
    public function setCacheControl($cacheControl)
    {
        $this->_cacheControl = $cacheControl;
    }

    /**
     * Gets content disposition.
     *
     * @return string
     */
    public function getContentDisposition()
    {
        return $this->_contentDisposition;
    }

    /**
     * Sets content disposition.
     *
     * @param string $contentDisposition value to use.
     */
    public function setContentDisposition($contentDisposition)
    {
        $this->_contentDisposition = $contentDisposition;
    }

    /**
     * Gets blob metadata.
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->_metadata;
    }

    /**
     * Sets blob metadata.
     *
     * @param array $metadata value.
     */
    public function setMetadata(array $metadata)
    {
        $this->_metadata = $metadata;
    }

    /**
     * Gets blob sequenceNumber.
     *
     * @return int
     */
    public function getSequenceNumber()
    {
        return $this->_sequenceNumber;
    }

    /**
     * Sets blob sequenceNumber.
     *
     * @param int $sequenceNumber value.
     */
    public function setSequenceNumber($sequenceNumber)
    {
        Validate::isInteger($sequenceNumber, 'sequenceNumber');
        $this->_sequenceNumber = $sequenceNumber;
    }

    /**
     * Gets number of concurrency for sending a blob.
     *
     * @return int
     */
    public function getNumberOfConcurrency()
    {
        return $this->_numberOfConcurrency;
    }

    /**
     * Sets number of concurrency for sending a blob.
     *
     * @param int $numberOfConcurrency the number of concurrent requests.
     */
    public function setNumberOfConcurrency($numberOfConcurrency)
    {
        $this->_numberOfConcurrency = $numberOfConcurrency;
    }
}
