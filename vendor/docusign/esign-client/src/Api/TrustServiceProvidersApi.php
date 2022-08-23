<?php
/**
 * TrustServiceProvidersApi
 * PHP version 5
 *
 * @category Class
 * @package  DocuSign\eSign
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * DocuSign REST API
 *
 * The DocuSign REST API provides you with a powerful, convenient, and simple Web services API for interacting with DocuSign.
 *
 * OpenAPI spec version: v2.1
 * Contact: devcenter@docusign.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.13-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace DocuSign\eSign\Api\TrustServiceProvidersApi;



namespace DocuSign\eSign\Api;

use \DocuSign\eSign\Client\ApiClient;
use \DocuSign\eSign\Client\ApiException;
use \DocuSign\eSign\Configuration;
use \DocuSign\eSign\ObjectSerializer;

/**
 * TrustServiceProvidersApi Class Doc Comment
 *
 * @category Class
 * @package  DocuSign\eSign
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TrustServiceProvidersApi
{
    /**
     * API Client
     *
     * @var \DocuSign\eSign\Client\ApiClient instance of the ApiClient
     */
    protected $apiClient;

    /**
     * Constructor
     *
     * @param \DocuSign\eSign\Client\ApiClient|null $apiClient The api client to use
     */
    public function __construct(\DocuSign\eSign\Client\ApiClient $apiClient = null)
    {
        if ($apiClient === null) {
            $apiClient = new ApiClient();
        }

        $this->apiClient = $apiClient;
    }

    /**
     * Get API client
     *
     * @return \DocuSign\eSign\Client\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set the API client
     *
     * @param \DocuSign\eSign\Client\ApiClient $apiClient set the API client
     *
     * @return TrustServiceProvidersApi
     */
    public function setApiClient(\DocuSign\eSign\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation getSealProviders
     *
     * Returns Account available seals for specified account.
     *
    * @param string $account_id The external account number (int) or account ID Guid.
     * @throws \DocuSign\eSign\Client\ApiException on non-2xx response
     * @return \DocuSign\eSign\Model\AccountSeals
     */
    public function getSealProviders($account_id)
    {
        list($response) = $this->getSealProvidersWithHttpInfo($account_id);
        return $response;
    }

    /**
     * Operation getSealProvidersWithHttpInfo
     *
     * Returns Account available seals for specified account.
     *
    * @param string $account_id The external account number (int) or account ID Guid.
     * @throws \DocuSign\eSign\Client\ApiException on non-2xx response
     * @return array of \DocuSign\eSign\Model\AccountSeals, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSealProvidersWithHttpInfo($account_id)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getSealProviders');
        }
        // parse inputs
        $resourcePath = "/v2.1/accounts/{accountId}/seals";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType([]);


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\DocuSign\eSign\Model\AccountSeals',
                '/v2.1/accounts/{accountId}/seals'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\DocuSign\eSign\Model\AccountSeals', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\DocuSign\eSign\Model\AccountSeals', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\DocuSign\eSign\Model\ErrorDetails', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }
}
