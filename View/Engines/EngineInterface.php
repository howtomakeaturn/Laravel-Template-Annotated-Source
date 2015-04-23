<?php namespace Illuminate\View\Engines;

interface EngineInterface {

	/**
	 * Get the evaluated contents of the view.
	 *
	 * @param  string  $path
	 * @param  array   $data
	 * @return string
	 */
     // 喔喔，「引擎介面」就是模板引擎介面喔。
     
     // 快講你的檔案路徑跟要塞的資料啦！
	public function get($path, array $data = array());

}
