<?php

namespace Jalle19\StatusManager\Message;

/**
 * Base class for messages that can be sent between the server and the clients
 *
 * @package   Jalle19\StatusManager
 * @copyright Copyright &copy; Sam Stenvall 2016-
 * @license   https://www.gnu.org/licenses/gpl.html The GNU General Public License v2.0
 */
abstract class AbstractMessage implements \JsonSerializable
{

	const TYPE_STATUS_UPDATES                = 'statusUpdates';
	const TYPE_POPULAR_CHANNELS_REQUEST      = 'popularChannelsRequest';
	const TYPE_POPULAR_CHANNELS_RESPONSE     = 'popularChannelsResponse';
	const TYPE_MOST_ACTIVE_WATCHERS_REQUEST  = 'mostActiveWatchersRequest';
	const TYPE_MOST_ACTIVE_WATCHERS_RESPONSE = 'mostActiveWatchersResponse';

	/**
	 * @var string
	 */
	private $_type;

	/**
	 * @var mixed
	 */
	private $_payload;


	/**
	 * @param string $type
	 * @param mixed  $payload
	 */
	public function __construct($type, $payload)
	{
		$this->_type    = $type;
		$this->_payload = $payload;
	}


	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->_type;
	}


	/**
	 * @return mixed
	 */
	public function getPayload()
	{
		return $this->_payload;
	}


	/**
	 * @inheritdoc
	 */
	public function jsonSerialize()
	{
		return [
			'type'    => $this->_type,
			'payload' => $this->_payload,
		];
	}

}
