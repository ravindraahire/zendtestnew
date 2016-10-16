<?php
class CachingController extends Zend_Controller_Action
{
	/**
	 * Cache text action
	 */
	public function cacheTextAction()
	{
		try {
			//Frontend attributes of what we are caching
			$frontendoption = array (
				'cache_id_prefix' => 'cache_demo_',
				'lifetime' => 3
			);

			$backendOptions = array ('cache_dir' => '../application/tmp');

			//Create Zend_Cache object
			$cache = Zend_Cache::factory('Core', 'File',
				$frontendoption,
				$backendOptions
			);

			//Create the content to cache.
			$time = date('Y-m-d h:m:s');
//			$cache->clean();
			//Check if we want to retrieve from cache or not.
			if (!$mytime = $cache->load('mytime')) {
				$cache->save($time, 'mytime');
				$mytime = $time;
			} else {
				echo "Reading from cache <br>";
			}
 
			echo "Current time : " . $mytime;
			//Supress the view
			$this->_helper->viewRenderer->setNoRender();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function cacheFileAction()
	{
		try {
			//Initialise file path
			$filepath = '../public/aboutus.html';

			$frontendoption = [
				'cache_id_prefix' => 'demo_',
				'lifetime' => 900,
				'master_file' => $filepath
			];

			$backendOptions = ['cache_dir' => '../application/tmp'];

			$cache = Zend_Cache::factory('File',
				'File',
				$frontendoption,
				$backendOptions);

			if (!$myContent = $cache->load('aboutuscontent')) {
				$content = file_get_contents($filepath);
				$cache->save($content, 'aboutuscontent');
				$myContent = $content;
			} else {
				echo 'Reading from cache <br>';
			}
			var_dump($myContent);exit;

			$this->_helper->viewRenderer->setNoRender();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function cacheClassAction()
	{
		require 'Misc/Misc.php';
	}
}