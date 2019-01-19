<?php

    namespace Tivet\Query\Adapters\Connection;

    use Tivet\Query\Query;
    use Tivet\Query\Interfaces\ConnectionInterface;

    class TeamSpeak3Adapter implements ConnectionInterface
    {
        const URI_SCHEME  = "serverquery";

        const URI_PATTERN = "%scheme%://%username%:%password%@%address%:%query_port%/%query%";

        /**
         * @var string
         */
        protected $scheme = self::URI_SCHEME;

        /**
         * @var string
         */
        protected $username = Query::DEFAULT_QUERY_USERNAME;

        /**
         * @var string
         */
        protected $password;

        /**
         * @var string
         */
        protected $nickname = Query::DEFAULT_NICKNAME;

        /**
         * @var string
         */
        protected $hostAddress = Query::DEFAULT_HOST_ADDRESS;

        /**
         * @var string
         */
        protected $queryPort = Query::DEFAULT_QUERY_PORT;

        /**
         * @var array
         */
        protected $extraParameters = [];


        public function __construct()
        {
            //
        }


        /**
         * Set query username
         *
         * @param string $username
         * @return ConnectionInterface
         */
        public function setUsername(string $username) : ConnectionInterface
        {
            $this->username = $username;

            return $this;
        }


        /**
         * Set query password
         *
         * @param string $password
         * @return ConnectionInterface
         */
        public function setPassword(string $password) : ConnectionInterface
        {
            $this->password = $password;

            return $this;
        }


        /**
         * Set query nickname
         *
         * @param string $nickname
         * @return ConnectionInterface
         */
        public function setNickname(string $nickname) : ConnectionInterface
        {
            $this->nickname = $nickname;

            return $this;
        }


        /**
         * Set instance ip address
         *
         * @param string $hostAddress
         * @return ConnectionInterface
         */
        public function setHost(string $hostAddress) : ConnectionInterface
        {
            $this->hostAddress = $hostAddress;

            return $this;
        }


        /**
         * Set instance query port
         *
         * @param string|int $queryPort
         * @return ConnectionInterface
         */
        public function setQueryPort(string $queryPort) : ConnectionInterface
        {
            $this->queryPort = $queryPort;

            return $this;
        }


        /**
         * Add extra parameters to uri
         *
         * @param string $key
         * @param string $value
         * @return mixed
         */
        public function addQuery(string $key, string $value) : ConnectionInterface
        {
            $this->extraParameters[$key] = $value;

            return $this;
        }


        /**
         * @return \TeamSpeak3_Adapter_Abstract
         * @return \TeamSpeak3_Node_Abstract
         * @return \TeamSpeak3_Node_Host
         * @return \TeamSpeak3_Node_Server
         */
        public function connect()
        {
            $uri = $this->makeUri();

            $teamspeak3 = new \TeamSpeak3();

            return $teamspeak3::factory($uri);
        }


        /**
         * @return string|null
         */
        public function makeUri() : ?string
        {
            $replace = [
                "%scheme%"     => $this->scheme,
                "%username%"   => $this->username,
                "%password%"   => $this->password,
                "%address%"    => $this->hostAddress,
                "%query_port%" => $this->queryPort,
                "%query%"      => "?" . http_build_query($this->extraParameters),
            ];

            return str_replace(array_keys($replace), array_values($replace), self::URI_PATTERN);
        }
    }