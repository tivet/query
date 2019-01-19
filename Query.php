<?php

    namespace Tivet\Query;

    use Tivet\Query\Interfaces\ConnectionInterface;

    class Query
    {
        const DEFAULT_HOST_ADDRESS   = '127.0.0.1';

        const DEFAULT_NICKNAME       = 'Query';

        const DEFAULT_QUERY_USERNAME = 10011;

        const DEFAULT_QUERY_PORT     = 10011;

        /**
         * @var \TeamSpeak3_Adapter_Abstract
         * @var \TeamSpeak3_Node_Abstract
         * @var \TeamSpeak3_Node_Host
         * @var \TeamSpeak3_Node_Server
         */
        public static $factory;


        public static function factory(ConnectionInterface $adapter)
        {
            self::$factory = $adapter->connect();

            return new Query();
        }


        /**
         * @return \TeamSpeak3_Adapter_ServerQuery
         */
        public function getAdapter() : \TeamSpeak3_Adapter_ServerQuery
        {
            return self::$factory->getAdapter();
        }


        /**
         * @return \TeamSpeak3_Node_Host
         */
        public function getHost() : \TeamSpeak3_Node_Host
        {
            return $this->getAdapter()->getHost();
        }


        /**
         * @return \TeamSpeak3_Node_Server
         */
        public function getSelectedServer() : \TeamSpeak3_Node_Server
        {
            return $this->getHost()->serverGetSelected();
        }
    }