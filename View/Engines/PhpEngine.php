<?php namespace Illuminate\View\Engines;
// 大膽預測：既然這個php engine是用來處理.php檔的，它八成沒做多少狗屁事

// 它八成大方回傳內容而已！因為PHP本身就是你他媽的PHP引擎阿
class PhpEngine implements EngineInterface {

	/**
	 * Get the evaluated contents of the view.
	 *
	 * @param  string  $path
	 * @param  array   $data
	 * @return string
	 */
	public function get($path, array $data = array())
	{
		return $this->evaluatePath($path, $data);
	}

    // 這個雞巴函式跟get根本一模一樣。註解還可以不一樣，靠！
    
    // 就承認get是為了對使用者友善而存在就好了嘛！
	/**
	 * Get the evaluated contents of the view at the given path.
	 *
	 * @param  string  $__path
	 * @param  array   $__data
	 * @return string
	 */
	protected function evaluatePath($__path, $__data)
	{
        // 果然沒做多少雞巴事
        
        // 只是先開再關php的output buffering而已
		$obLevel = ob_get_level();

		ob_start();

		extract($__data);

		// We'll evaluate the contents of the view inside a try/catch block so we can
		// flush out any stray output that might get out before an error occurs or
		// an exception is thrown. This prevents any partial views from leaking.
		try
		{
			include $__path;
		}
		catch (\Exception $e)
		{
			$this->handleViewException($e, $obLevel);
		}

		return ltrim(ob_get_clean());
	}

	/**
	 * Handle a view exception.
	 *
	 * @param  \Exception  $e
	 * @param  int  $obLevel
	 * @return void
	 *
	 * @throws $e
	 */
	protected function handleViewException($e, $obLevel)
	{
        // 隨便啦，反正這個函式就是把遇到的例外...用力搞定啦
        
        // 哈哈
		while (ob_get_level() > $obLevel)
		{
			ob_end_clean();
		}

		throw $e;
	}

}
