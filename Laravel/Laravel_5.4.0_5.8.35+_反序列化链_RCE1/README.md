# Laravel_5.4.0_5.8.35+\_反序列化链_RCE1

对应 `PHPGGC` 中的 `Laravel/RCE3` ，高版本将参数 `app` 改成了 `container` ，之后的文章会写一下。

这是 `Laravel` 反序列化链系列的第三篇文章

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

5.4.0 <= x <= 5.8.35+

从 6.0.0 开始不可用

## 0x02 漏洞分析

首先来找起点，一般就是 `__destruct` 或者 `__wakeup` ，这里使用 `laravel` 最常见的入口 `src/Illuminate/Broadcasting/PendingBroadcast.php::__destruct()` 

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904144627.png)

`$this->events` 与 `$this->event` 可控，因此我们可以找 `__call` 方法，并且要求可以执行命令

这里找到的是 `src/Illuminate/Support/Manager.php` 中的 `Manager` 抽象类，看这里的 `__call` 方法

```
public function __call($method, $parameters)
{
    return $this->driver()->$method(...$parameters);
}
```

`$this->driver()` 执行后的返回值，指向 `$method` ，这里会执行 `$method` 方法，而 `$method` 值传进来的是 `dispatch` ，那么我们要找可以命令执行的 `dispatch` 方法？当然不是，那写这条链子就没有意义了，这里我们可以跟进 `$this->driver()`

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904221843.png)

跟进 `getDefaultDriver` 方法，而这个方法为抽象方法，那我们必须找一个实现 `Manager` 类的其他类，这里找到的是 `src/Illuminate/Notifications/ChannelManager.php` 的 `ChannelManager` 类，他的 `getDefaultDriver` 方法实现如下

```
public function getDefaultDriver()
{
    return $this->defaultChannel;
}
```

因此这里可以很简单地控制 `$driver` 的值，接着往下看，`$this->drivers` 可控，我们直接跟进 `ChannelManager` 类的 `createDriver` 方法，参数可控，直接返回了 `parent::createDriver($driver);` ，因此是进入 `Manager` 类的 `createDriver` 方法

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904223050.png)

`$this->customCreators` 可控，因此直接进入 `$this->callCustomCreator($driver);` ，并且参数也是传进来的，也可控

```
protected function callCustomCreator($driver)
{
    return $this->customCreators[$driver]($this->app);
}
```

到了这里就简单了，就是一个 `$a($b)` 的形式，而且 `$a` 与 `$b` 都可控，直接可以命令执行

## 0x03 漏洞复现

通过 `exp.php` 生成 `payload` ，然后直接打，查看源码可以看到命令执行结果

![](https://gitee.com/N0puple/picgo/raw/master/img/20220904224909.png)



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

