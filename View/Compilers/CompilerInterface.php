<?php namespace Illuminate\View\Compilers;
// Compilers資料夾提供一個interface

// 大家記得遵守interface跟compiler溝通喔

// 它只提供三個功能

// compile下去、找到compile後的存放路徑、檢查過期與否
interface CompilerInterface {

	/**
	 * Get the path to the compiled version of a view.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public function getCompiledPath($path);

	/**
	 * Determine if the given view is expired.
	 *
	 * @param  string  $path
	 * @return bool
	 */
	public function isExpired($path);

	/**
	 * Compile the view at the given path.
	 *
	 * @param  string  $path
	 * @return void
	 */
	public function compile($path);

}
