<?php namespace Illuminate\View\Engines;

use Closure;

class EngineResolver {

	/**
	 * The array of engine resolvers.
	 *
	 * @var array
	 */
	protected $resolvers = array();

	/**
	 * The resolved engine instances.
	 *
	 * @var array
	 */
	protected $resolved = array();

	/**
	 * Register a new engine resolver.
	 *
	 * The engine string typically corresponds to a file extension.
	 *
	 * @param  string   $engine
	 * @param  \Closure  $resolver
	 * @return void
	 */
	public function register($engine, Closure $resolver)
	{
        // 喔，誤會一場，EngineResolver根本不是什麼IoC container
        
        // 只是把東西放進一個陣列。算是他媽的簡易版的IoC container
		$this->resolvers[$engine] = $resolver;
	}

	/**
	 * Resolver an engine instance by name.
	 *
	 * @param  string  $engine
	 * @return \Illuminate\View\Engines\EngineInterface
	 * @throws \InvalidArgumentException
	 */
	public function resolve($engine)
	{
        // resolve...解析什麼鬼啊。只是把東西從陣列拿出來，幹
		if (isset($this->resolved[$engine]))
		{
			return $this->resolved[$engine];
		}

		if (isset($this->resolvers[$engine]))
		{
            // call_user_func可以這樣用喔！可以用在Closure身上，執行一段動作ㄝ。真他媽的帥氣
			return $this->resolved[$engine] = call_user_func($this->resolvers[$engine]);
		}
        // 好啦反正resolve就是希望每個resolver只會執行一次。之後直接從memory裡面叫出來。
		throw new \InvalidArgumentException("Engine $engine not found.");
	}

}
// 我知道這個Resolver只有存放PhpEngine跟CompilerEngine啦，接下來就看它們
