<?php
/****************************************************** Open .node ***
 * Description:   
 * Status:        Stable.
 * Author:        Alexandre Dath <alexandre@dotnode.com>
 * $Id$
 *
 * Copyright (C) 2005 Alexandre Dath <alexandre@dotnode.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 ******************** http://opensource.ikse.net/projects/dotnode ***/

require_once 'XML/RPC.php';

define('LOGIKSE_INVALID_DSN', 1);
define('LOGIKSE_NOHOSTPASS', 2);

define('LOGIN_NOTVALID', $XML_RPC_erruser+1);
define('LOGIN_NOTSUBSCRIBED', $XML_RPC_erruser+2);
define('LOGIN_NOTEXIST', $XML_RPC_erruser+3);
define('LOGIN_ALREADYSUBSCRIBED', $XML_RPC_erruser+4);
define('LOGIN_ALREADYEXIST', $XML_RPC_erruser+4);
define('LOGIN_TOOSHORT', $XML_RPC_erruser+5);
define('LOGIN_DB_ERROR', $XML_RPC_erruser+6);
define('LOGIN_SAME_LOGIN_PASS', $XML_RPC_erruser+7);
define('SESSION_BADHOST', $XML_RPC_erruser+8);
define('LOGIN_BADFORM', $XML_RPC_erruser+9);
define('LOGIN_PASSTOOSHORT', $XML_RPC_erruser+10);
define('LOGIN_PASSBADFORMAT', $XML_RPC_erruser+11);

class Logikse
{
	var $client;
	var $response;
	var $identity;
	var $dsn;
	var $timeout;
	var $debug = false;

	function Logikse ($dsn = null)
	{
		if(is_string($dsn))
			$this->dsn = parse_url($dsn);
		elseif(is_array($dsn))
			$this->dsn = $dsn;
		elseif(!is_array($dsn) && !is_string($dsn))
			error_log(__CLASS__.' . '.__FUNCTION__.' | Bad DSN');

		if(!isset($this->dsn['port']))
			$this->dsn['port'] = 80;

		$this->client = new XML_RPC_Client($this->dsn['path'], $this->dsn['host'], $this->dsn['port']);
		$this->client->setDebug ($this->debug);

		if(isset($this->dsn['user']) && isset($this->dsn['pass']))
			$this->client->setCredentials($this->dsn['user'], $this->dsn['pass']);
		else
			return new Logikse_Error(LOGIKSE_NOHOSTPASS, 'Host/passwd missed');
		// Init Logikse Session
		$params = new XML_RPC_Value(
                                array(
                                        'host' => new XML_RPC_Value($this->dsn['user']),
                                        'passwd' => new XML_RPC_Value($this->dsn['pass'])
                                     ), 'struct');
		$msg = new XML_RPC_Message('session.start', array($params));
		$response = $this->Request($msg);
		if (!$response->faultCode())
                {
                        $v = $response->value();
                        $this->session_id = $v->scalarval();
                }
                else
			error_log(__CLASS__.' . '.__FUNCTION__.' | No session ! '.$response->faultString());
	}

	function setTimeout($timeout)
	{
		$this->timeout = $timeout;
	}

	function Request($xmlrpc_message)
	{
		return $this->client->send($xmlrpc_message, $this->timeout, $this->dsn['scheme']);
	}

	function isError($thing)
	{
		if(is_a($thing, 'Logikse_Error'))
			return true;
		else
			return false;
	}

	function check ($login, $passwd)
	{
		$params = new XML_RPC_Value(
				array(
					'session_id' => new XML_RPC_Value($this->session_id),
					'login' => new XML_RPC_Value($login),
					'passwd' => new XML_RPC_Value($passwd)
				     ), 'struct');
		$msg = new XML_RPC_Message('login.check', array($params));
		$response = $this->Request($msg);
		if (!$response->faultCode()) {
			$v = $response->value();
			while(list($key,$value) = $v->structeach())
				$_RPC[$key] = $value->scalarval();

			return array('id' => $_RPC['id'], 'login' => $_RPC['login']);
		}
		else
			return new Logikse_Error($response->faultCode(), $response->faultString());
	}
	
	function create ($login, $passwd, $email)
        {
                $params = new XML_RPC_Value(
                                array(
                                        'session_id' => new XML_RPC_Value($this->session_id),
                                        'login' => new XML_RPC_Value(urlencode($login)),
                                        'passwd' => new XML_RPC_Value(urlencode($passwd)),
                                        'email' => new XML_RPC_Value($email)
                                     ), 'struct');
                $msg = new XML_RPC_Message('login.create', array($params));
                $response = $this->Request($msg);
                if (!$response->faultCode())
		{
                        $v = $response->value();
                        while(list($key,$value) = $v->structeach())
                                $_RPC[$key] = $value->scalarval();

                        return array('id' => $_RPC['id'], 'login' => $_RPC['login']);
                }
                else
                        return new Logikse_Error($response->faultCode(), $response->faultString());
        }

	function isExist($login)
	{
		$msg = new XML_RPC_Message('login.exist', array(new XML_RPC_Value(urlencode($login))));
		$response = $this->Request($msg);
		if (!$response->faultCode())
                {
                        $v = $response->value();
                        return $v->scalarval();
                }
                else
                        return new Logikse_Error($response->faultCode(), $response->faultString());
	}

        function isSubscribed($login)
        {
		$params = new XML_RPC_Value(
                                array(
                                        'session_id' => new XML_RPC_Value($this->session_id),
                                        'login' => new XML_RPC_Value(urlencode($login)),
                                     ), 'struct');

                $msg = new XML_RPC_Message('login.subscribed', array($params));
                $response = $this->Request($msg);
                if (!$response->faultCode())
                {
                        $v = $response->value();
                        return $v->scalarval();
                }
                else
                        return new Logikse_Error($response->faultCode(), $response->faultString());
        }

        function subscribe ($login, $passwd)
        {
                $params = new XML_RPC_Value(
                                array(
                                        'session_id' => new XML_RPC_Value($this->session_id),
                                        'login' => new XML_RPC_Value(urlencode($login)),
                                        'passwd' => new XML_RPC_Value(urlencode($passwd))
                                     ), 'struct');
                $msg = new XML_RPC_Message('login.subscribe', array($params));
                $response = $this->Request($msg);
                if (!$response->faultCode())
		{
                        $v = $response->value();
                        return true;
                }
                else
                        return new Logikse_Error($response->faultCode(), $response->faultString());
        }


}

class Logikse_Error
{
	var $errno;
	var $errstr;

	function Logikse_Error($errno, $errstr) 
	{
		$this->errno = $errno;
		$this->errstr = $errstr;
	}

	function getMessage()
	{
		return $this->errstr;
	}

	function getErrorNo()
	{
		return $this->errno;
	}
}
?>
