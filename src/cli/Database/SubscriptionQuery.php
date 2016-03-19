<?php

namespace Jalle19\StatusManager\Database;

use Jalle19\StatusManager\Database\Base\SubscriptionQuery as BaseSubscriptionQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * @package   Jalle19\StatusManager\Database
 * @copyright Copyright &copy; Sam Stenvall 2015-
 * @license   https://www.gnu.org/licenses/gpl.html The GNU General Public License v2.0
 */
class SubscriptionQuery extends BaseSubscriptionQuery
{

	/**
	 * @param Instance $instance
	 * @param User     $user
	 *
	 * @return SubscriptionQuery
	 * @throws \Propel\Runtime\Exception\PropelException
	 */
	public function getPopularChannelsQuery(Instance $instance, User $user)
	{
		$this->withColumn('channel.name', 'channelName');
		$this->withColumn('user.name', 'userName');
		$this->withColumn('SUM((julianday(subscription.stopped) - julianday(subscription.started)) * 86400)',
			'totalTimeSeconds');
		$this->select(['channelName', 'userName', 'totalTimeSeconds']);
		$this->joinChannel('channel');
		$this->joinUser('user');
		$this->groupBy('channelName');
		$this->orderBy('totalTimeSeconds', Criteria::DESC);

		// Apply filtering
		$this->filterByStopped(null, Criteria::NOT_EQUAL);
		$this->filterByInstance($instance);

		if ($user !== null)
			$this->filterByUser($user);

		return $this;
	}

}
