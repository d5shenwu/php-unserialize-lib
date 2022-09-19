# Laravel_5.4.0_9.3.6+\_反序列化链_RCE3

对应 `PHPGGC` 中的 `Laravel/RCE5`，全版本通杀

这是 `Laravel` 反序列化链系列的第七篇文章

## 0x00 漏洞环境

```
https://github.com/N0puple/php-unserialize-lib
```

进入对应的文件夹执行如下命令启动环境：

```
docker-compose up -d
```

访问 http://x.x.x.x/index.php/test ，看到 `hello world` 既搭建成功

测试代码

```php
<?php
namespace App\Http\Controllers;

class TestController extends Controller
{
	public function index()
	{
		if(isset($_GET['a']))
		{
			unserialize(base64_decode($_GET['a']));
		}
		else
		{
			echo "hello world";
		}
	}
}
```

## 0x01 漏洞影响

5.4.0 <= x <= 9.3.6+

## 0x02 漏洞分析

同样的入口  `src/Illuminate/Broadcasting/PendingBroadcast.php::__destruct()`

```
public function __destruct()
{
    $this->events->dispatch($this->event);
}
```

找到 `src/Illuminate/Bus/Dispatcher.php::dispatch($command)` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905205855.png)

进入 `dispatchToQueue` 方法

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905224039.png)

`$this->queueResolver` 可控，`$connection` 由 `$command` 得到，`$command` 也是可控的，因此都是可控的，因此可以执行任意类，我们找到如下位置

`Mockery\Loader\EvalLoader::load(MockDefinition $definition)` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220919143348.png)

在这里，很容易知道，我们要找到一个 `MockDefinition` 的实例化对象，接下来进入 `getClassName` 方法

```
public function getClassName()
{
    return $this->config->getName();
}
```

找到任意一个存在 `getName` 方法的类加进来就可以了

最后会使用到 `getCode()` 方法来获取值，然后 `eval` 执行，控制 `$this->code` 就可以执行任意代码。

```
public function getCode()
{
    return $this->code;
}
```

我在写链子的时候，`$command` 写的是另一个类，虽然某些版本可用，但是没法通杀，无奈最后用了 `phpggc` 中的 `RCE5` 中的，不得不说，能被该链子确实写的严谨，可以通杀所有版本。

## 0x03 漏洞复现

通过 `exp.php` 生成 `payload` ，然后直接打

![](https://gitee.com/N0puple/picgo/raw/master/img/20220919113028.png)

## 0x04 链接

环境与 `exp` 都可以在如下链接获取

### GitHub

https://github.com/N0puple/php-unserialize-lib

### GitBook:

https://n0puple.gitbook.io/php-unserialize-lib/

### 公众号

公众号搜索：安全漏洞复现

扫码持续关注：

![](https://gitee.com/N0puple/picgo/raw/master/img/qrcode_for_gh_a41358b842dd_430.jpg)

