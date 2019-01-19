<?php

    namespace Tivet\Query\Interfaces;

    interface ConnectionInterface
    {
        /**
         * Set query username
         *
         * @param string $username
         * @return ConnectionInterface
         */
        public function setUsername(string $username) : self;


        /**
         * Set query password
         *
         * @param string $password
         * @return ConnectionInterface
         */
        public function setPassword(string $password) : self;


        /**
         * Set query nickname
         *
         * @param string $nickname
         * @return ConnectionInterface
         */
        public function setNickname(string $nickname) : self;


        /**
         * Set instance ip address
         *
         * @param string $hostAddress
         * @return ConnectionInterface
         */
        public function setHost(string $hostAddress) : self;


        /**
         * Set instance query port
         *
         * @param string|int $queryPort
         * @return ConnectionInterface
         */
        public function setQueryPort(string $queryPort) : self;


        /**
         * Add extra parameters to uri
         *
         * @param string $key
         * @param string $value
         * @return mixed
         */
        public function addQuery(string $key, string $value) : self;


        /**
         * @return string|null
         */
        public function makeUri() : ?string;


        /**
         * @return \TeamSpeak3_Adapter_Abstract
         * @return \TeamSpeak3_Node_Abstract
         * @return \TeamSpeak3_Node_Host
         * @return \TeamSpeak3_Node_Server
         */
        public function connect();
    }