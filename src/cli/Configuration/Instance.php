<?php

namespace Jalle19\StatusManager\Configuration;

use Jalle19\tvheadend\Tvheadend;

/**
 * Class Instance
 * @package   Jalle19\StatusManager\Configuration
 * @copyright Copyright &copy; Sam Stenvall 2015-
 * @license   https://www.gnu.org/licenses/gpl.html The GNU General Public License v2.0
 */
class Instance implements \JsonSerializable
{

	/**
	 * @var string the name of the instance
	 */
	private $_name;

	/**
	 * @var array the names of users whose subscriptions should be ignored
	 */
	private $_ignoredUsers;

	/**
	 * @var Tvheadend the actual tvheadend instance
	 */
	private $_instance;


	/**
	 * Instance constructor.
	 *
	 * @param string $name
	 * @param string $address
	 * @param int    $port
	 */
	public function __construct($name, $address, $port)
	{
		$this->_name         = $name;
		$this->_ignoredUsers = [];

		// Create the actual instance
		$this->_instance = new Tvheadend($address, $port);
	}


	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->_name;
	}


	/**
	 * @return array
	 */
	public function getIgnoredUsers()
	{
		return $this->_ignoredUsers;
	}


	/**
	 * @param array $ignoredUsers
	 */
	public function setIgnoredUsers($ignoredUsers)
	{
		$this->_ignoredUsers = $ignoredUsers;
	}


	/**
	 * Sets the credentials to use
	 *
	 * @param $username
	 * @param $password
	 */
	public function setCredentials($username, $password)
	{
		$this->_instance->setCredentials($username, $password);
	}


	/**
	 * @return Tvheadend
	 */
	public function getInstance()
	{
		return $this->_instance;
	}


	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [
			'name' => $this->getName(),
		];
	}

}
