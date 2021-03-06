<?php

namespace Jalle19\StatusManager\Test\Configuration\Reader;

use Jalle19\StatusManager\Configuration\Reader\YamlReader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlReaderTest
 * @package   Jalle19\StatusManager\Test\Configuration\Reader
 * @copyright Copyright &copy; Sam Stenvall 2016-
 * @license   https://www.gnu.org/licenses/gpl.html The GNU General Public License v2.0
 */
class YamlReaderTest extends \PHPUnit_Framework_TestCase
{

	public function testReader()
	{
		$configuration = [
			'foo' => 'bar',
			'baz',
		];

		$tmpFile = $this->getTemporaryFilePath();
		file_put_contents($tmpFile, Yaml::dump($configuration));

		$reader = new YamlReader($tmpFile);
		$this->assertEquals($configuration, $reader->readConfiguration());
	}


	/**
	 * @expectedException \Jalle19\StatusManager\Exception\InvalidConfigurationException
	 * @expectedExceptionMessageRegExp *The configuration file does not*
	 */
	public function testMissingFile()
	{
		$reader = new YamlReader('/tmp/does/not/exist');
		$reader->readConfiguration();
	}


	/**
	 * @expectedException \Jalle19\StatusManager\Exception\InvalidConfigurationException
	 * @expectedExceptionMessageRegExp *Failed to parse*
	 */
	public function testUnparsableConfiguration()
	{
		$tmpFile = $this->getTemporaryFilePath();
		file_put_contents($tmpFile, "\t\tfail");

		$reader = new YamlReader($tmpFile);
		$reader->readConfiguration();
	}


	/**
	 * @return string
	 */
	private function getTemporaryFilePath()
	{
		return tempnam(sys_get_temp_dir(), 'yaml');
	}

}
