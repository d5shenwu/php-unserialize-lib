# Laravel_5.6.0_9.3.6+\_反序列化链_RCE1

与 Laravel_5.4.0_8.6.12+\_反序列化链_RCE1 几乎一样，只是换了一个控制的参数，本来不想写了，但是这条链子可以通杀 5.6.0 以上全版本，因此还是写一下

这是 `Laravel` 反序列化链系列的第二篇文章

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

5.6.0 <= x <= 9.3.6+

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

我们的`$event` 不为对象，因此将会直接返回， `$event` 不会被影响，这里直接来到 198 行的 `$this->getListeners` ，注意了，这里就是与 Laravel_5.4.0_8.6.12+\_反序列化链_RCE1 区别的地方

![](https://gitee.com/N0puple/picgo/raw/master/img/20220907225148.png)

`laravel8` 中，这里是存在一个 `$this->listeners` 赋值的，因此之前的链子用了该变量，而这里不存在这个变量，导致之前的 `exp` 不适用于 `laravel9` ，而这里还存在一个 `$this->wildcardsCache` 可控制 `$listeners` 的值，在 `laravel8` 中也是存在的，因此可以通过控制该变量来达到 6.0 以上全版本通杀，为什么 6.0 以下不行呢，因此那些版本没用使用 `$this->wildcardsCache` 变量

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

