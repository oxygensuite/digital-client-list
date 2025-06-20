<?php

namespace OxygenSuite\DigitalClient\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use OxygenSuite\DigitalClient\Exceptions\DCLAuthenticationException;
use OxygenSuite\DigitalClient\Exceptions\DCLConnectionException;
use OxygenSuite\DigitalClient\Exceptions\DCLException;
use OxygenSuite\DigitalClient\Exceptions\InvalidResponseException;
use OxygenSuite\DigitalClient\Exceptions\RateLimitExceededException;
use OxygenSuite\DigitalClient\Exceptions\TransmissionFailedException;
use ReflectionClass;

abstract class DCLRequest
{
    private const DEV_URL = 'https://mydataapidev.aade.gr/DCL/';
    private const PRODUCTION_URL = 'https://mydatapi.aade.gr/DCL/';

    private static ?string $user_id = null;
    private static ?string $subscription_key = null;
    private static ?string $env = null;
    private static array $request_options;

    private static ?HandlerStack $handler;

    public static function setHandler(?MockHandler $handler): void
    {
        self::$handler = HandlerStack::create($handler);
    }

    /**
     * Initialize the DCL API with the user_id, subscription_key, and environment.
     *
     * @param  string  $user_id  The user id provided by AADE
     * @param  string  $subscription_key  The subscription key provided by AADE
     * @param  string  $env  'dev' or 'production'
     * @return void
     */
    public static function init(string $user_id, string $subscription_key, string $env): void
    {
        self::setCredentials($user_id, $subscription_key);
        self::setEnvironment($env);
    }

    /**
     * Set the user_id and subscription_key for the DCL API.
     *
     * @param  string  $user_id  The user id provided by AADE
     * @param  string  $subscription_key  The subscription key provided by AADE
     * @return void
     */
    public static function setCredentials(string $user_id, string $subscription_key): void
    {
        self::$user_id = $user_id;
        self::$subscription_key = $subscription_key;
    }

    /**
     * Set the environment to either 'dev' or 'production'.
     *
     * @param  string  $env  'dev' or 'production'
     * @param  bool  $is_provider  Set to true if the request is for the providers
     * @return void
     */
    public static function setEnvironment(string $env): void
    {
        self::$env = strtolower($env);
    }

    /**
     * <ul>Describes the SSL certificate verification behavior of a request.
     *
     * <li>Set to <code>true</code> to enable SSL certificate verification and use the default CA bundle provided by operating system.</li>
     * <li>Set to <code>false</code> to disable certificate verification (this is insecure!).</li>
     * <li>Set to a string to provide the path to a CA bundle to enable verification using a custom certificate.</li>
     * </ul>
     *
     * <pre>
     * // Use the system's CA bundle (this is the default setting)
     * DCLRequest::verifyClient(true);
     *
     * // Use a custom SSL certificate on disk.
     * DCLRequest::verifyClient('/path/to/cert.pem');
     *
     * // Disable validation entirely (don't do this!).
     * DCLRequest::verifyClient(false);
     * </pre>
     *
     * <br>
     * <p>If you do not need a specific certificate bundle, then Mozilla provides a commonly used CA bundle which can be downloaded <a href="https://curl.haxx.se/ca/cacert.pem">here</a>
     * (provided by the maintainer of cURL). Once you have a CA bundle available on disk, you can set the "openssl.cafile" PHP ini
     * setting to point to the path to the file, allowing you to omit the "verify" request option.
     * Much more detail on SSL certificates can be found on the <a href="http://curl.haxx.se/docs/sslcerts.html">cURL website</a>.</p>
     *
     * @param  bool|string  $verify
     * @return void
     */
    public static function verifyClient(bool|string $verify = true): void
    {
        self::$request_options['verify'] = $verify;
    }

    /**
     * The number of seconds to wait while trying to connect to myDATA server.
     * Use 0 to wait indefinitely (the default behavior).
     *
     * @param  int  $seconds
     * @return void
     */
    public static function setConnectionTimeout(int $seconds): void
    {
        self::$request_options['connect_timeout'] = $seconds;
    }

    /**
     * You can customize requests created and transferred by a client using request options.
     * Request options control various aspects of a request including, headers, query string
     * parameters, timeout settings, the body of a request, and much more.
     *
     * @param  array  $requestOptions
     * @return void
     * @see https://docs.guzzlephp.org/en/stable/request-options.html
     */
    public static function setRequestOptions(array $requestOptions): void
    {
        self::$request_options = $requestOptions;
    }

    public static function isProduction(): bool
    {
        return self::$env === 'production';
    }

    public static function isDevelopment(): bool
    {
        return self::$env === 'dev';
    }

    /**
     * @throws DCLAuthenticationException
     */
    private static function validateCredentials(): void
    {
        if (empty(self::$user_id) || empty(self::$subscription_key)) {
            throw new DCLAuthenticationException(401);
        }
    }

    /**
     * @throws DCLAuthenticationException|DCLException
     */
    protected function get(array $query): string
    {
        self::validateCredentials();

        try {
            $response = $this->client()->get($this->getUrl(), ['query' => $query]);
            $responseXml = $response->getBody()->getContents();

            // We always expect a response xml from DCL
            if (empty(trim($responseXml))) {
                throw new InvalidResponseException("Empty response received from AADE DCL API");
            }

            return $responseXml;
        } catch (GuzzleException $e) {
            $this->handleTransmissionException($e);
        }
    }

    /**
     * @throws DCLAuthenticationException|DCLException
     */
    protected function post(array $query = null, string $body = null): string
    {
        self::validateCredentials();

        $params = [];
        if (!empty($query)) {
            $params['query'] = $query;
        }

        if (!empty($body)) {
            $params['body'] = $body;
        }

        try {
            $response = $this->client()->post($this->getUrl(), $params);
            $responseXml = $response->getBody()->getContents();

            // We always expect a response XML from DCL
            if (empty(trim($responseXml))) {
                throw new InvalidResponseException("Empty response received from AADE DCL API");
            }

            return $responseXml;
        } catch (GuzzleException $e) {
            $this->handleTransmissionException($e);
        }
    }

    /**
     * Authorization errors, bad request, communication errors,
     * DCL server errors, rate limits, connection timeout, etc.
     *
     * @throws DCLAuthenticationException|DCLException
     */
    protected function handleTransmissionException(GuzzleException $exception)
    {
        if ($exception->getCode() === 401) {
            throw new DCLAuthenticationException($exception->getCode(), $exception);
        }

        // In case the endpoint url is wrong or connection timed out
        if ($exception->getCode() === 0) {
            throw new DCLConnectionException($exception->getCode(), $exception);
        }

        // Rate limit exception
        if ($exception->getCode() === 429) {
            throw new RateLimitExceededException($exception->getMessage(), $exception->getCode(), $exception);
        }

        throw new TransmissionFailedException($exception->getMessage(), $exception->getCode(), $exception);
    }

    private function client(): Client
    {
        $config = [
            'headers' => [
                'aade-user-id' => self::$user_id,
                'ocp-apim-subscription-key' => self::$subscription_key,
                'Content-Type' => "text/xml",
            ],
        ];

        if (isset(self::$handler)) {
            $config['handler'] = self::$handler;
        }

        if (isset(self::$request_options)) {
            $config = array_merge($config, self::$request_options);
        }

        return new Client($config);
    }

    public function getUrl(): string
    {
        $action = $this->getAction();
        $url = $this->getUrlForErp();

        return $url.$action;
    }

    private function getUrlForErp(): string
    {
        return self::isProduction() ? self::PRODUCTION_URL : self::DEV_URL;
    }

    private function getAction(): string
    {
        return $this->action ?? (new ReflectionClass($this))->getShortName();
    }
}
