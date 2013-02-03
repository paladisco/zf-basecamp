<?php
include('basecamp.php');
class Local_Basecamp_Api{

    const APP_ID = 'My Application ID';
    const APP_CONTACT = 'email@example.com';

    private $_baseUrl;
    private $_credentials;
    private $_helloHeader;
    private $_logger;

    public function __construct($accountId,$username,$password){
        $appName = self::APP_ID;
        $appContact = self::APP_CONTACT;

        $basecampAccountId = $accountId;
        $basecampUsername = $username;
        $basecampPassword = $password;

        if (is_null($this->_logger)) {
            $this->_logger = new DummyLogger;
        }

        $this->_baseUrl = "https://basecamp.com/$basecampAccountId/api/v1";
        $this->_credentials = "$basecampUsername:$basecampPassword";
        $this->_helloHeader = "User-Agent: $appName ($appContact)";

    }

    public function apiCall($method, $path, $params=array(),&$response_headers=array()){
        $url = $this->_baseUrl.'/'.ltrim($path, '/');

        $query = in_array($method, array('GET','DELETE')) ? $params : array();

        $payload = in_array($method, array('POST','PUT')) ? stripslashes(json_encode($params)) : array();

        $request_headers = in_array($method, array('POST','PUT')) ? array("Content-Type: application/json; charset=utf-8", 'Expect:') : array();
        $request_headers[] = $this->_helloHeader;

        $this->_logger->debug("About to send API request:\n"
            .print_r(compact('method', 'url', 'query',
                'payload', 'request_headers'), 1));

        $response = curl_http_api_request_($method, $url, $this->_credentials, $query, $payload, $request_headers,
            $response_headers);

        $statusCode = $response_headers['http_status_code'];
        if ($statusCode >= 400) {
            throw new Exception("HTTP error $statusCode:\n"
                .print_r(compact('method', 'url', 'query',
                    'payload', 'request_headers',
                    'response_headers', 'response',
                    'shops_myshopify_domain',
                    'shops_token'), 1));
        }

        return json_decode($response);
    }

    public function getProjects(){
        try {
            $projects = $this->apiCall('GET', '/projects.json');
            return $projects;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}