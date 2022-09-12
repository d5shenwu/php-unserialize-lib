# Laravel_5.4.0_9.3.6+\_反序列化链_RCE1

无对应，根据 `PHPGGC` 中的 `Laravel/RCE5` 而写出来的，全版本通杀

这是 `Laravel` 反序列化链系列的第六篇文章

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

使用 `laravel` 最常见的入口 `src/Illuminate/Broadcasting/PendingBroadcast.php::__destruct()` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904144627.png)

`$this->events` 与 `$this->event` 可控，找某个类的 `dispatch` 方法，这里找到 `src/Illuminate/Bus/Dispatcher.php::dispatch($command)` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905205855.png)

`$this->queueResolver` 与 `$command` 可控，我们进入 `$this->commandShouldBeQueued($command)` ，查看代码

```php
protected function commandShouldBeQueued($command)
{
    return $command instanceof ShouldQueue;
}
```

因此需要传进来的 `$command` 是 `ShouldQueue` 的实例，而 `ShouldQueue` 是一个接口，因此只要是实现此接口的类的实例即可

 ![](https://gitee.com/N0puple/picgo/raw/master/img/20220905211326.png)

如上的都可以，此处选取 `BroadcastEvent`  类，然后进入 `$this->dispatchToQueue` 方法

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905224039.png)

`$connection` 为 `$command->connection` ，而 `$command` 是 `BroadcastEvent` 的实例，因此 `$connection` 可通过设置一个 `connection` 值来控制，而 `$this->queueResolver` 也是可控的，因此可以直接命令执行

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

