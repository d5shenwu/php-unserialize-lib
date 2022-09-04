# Laravel_5.4.0_8.6.9\_反序列化链_RCE1

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

5.4.0 <= 8.6.9+

## 0x02 漏洞分析

首先来找起点，一般就是 `__destruct` 或者 `__wakeup` ，这里使用 `laravel` 最常见的入口 `src/Illuminate/Broadcasting/PendingBroadcast.php::__destruct()` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904144627.png)

`$this->events` 与 `$this->event` 可控，因此只需要找到某个类的 `dispatch` 方法，并且可以执行命令的地方就可以，这里找到 `src/Illuminate/Events/Dispatcher.php::dispatch($event, $payload = [], $halt = false)` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904145044.png)

此处传进来的 `$payload` 为空，因此值为默认的空数组，对我们后面也没有什么影响，主要看到对 `$event` 可能存在影响的方法，看到这里的 `$this->parseEventAndPayload` 

```
protected function parseEventAndPayload($event, $payload)
{
    if (is_object($event)) {
        list($payload, $event) = [[$event], get_class($event)];
    }

    return [$event, array_wrap($payload)];
}
```

我们的`$event` 不为对象，因此将会直接返回， `$event` 不会被影响，这里直接来到 198 行的 `$this->getListeners` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904145901.png)

`$this->listeners` 可控，因此此处的 `$listeners` 也可控，不存在 `$eventName` 时直接返回 `$listeners` ，因此返回值是我们可控的，之后直接被遍历，然后执行 `$listeners($event, $payload)` 

`$listeners` 与`$event` 可控，`$payload` 为空，因此可以执行命令

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904150255.png)

## 0x03 漏洞复现

通过 `exp.php` 生成 `payload` ，然后直接打

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904151025.png)



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

