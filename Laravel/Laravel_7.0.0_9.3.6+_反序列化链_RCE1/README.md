# Laravel_7.0.0_9.3.6+\_反序列化链_RCE1

对应 `PHPGGC` 中的 `Laravel/RCE8`

这是 `Laravel` 反序列化链系列的第八篇文章

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

7.0.0<= x <= 9.3.6+

## 0x02 漏洞分析

这是到目前为止分析的第一个起点不是 `src/Illuminate/Broadcasting/PendingBroadcast.php` 的链子，这里的链子借用了 `guzzlehttp` 中的代码，起点为 `src/Cookie/FileCookieJar.php::__destruct()` 

```
public function __destruct()
{
    $this->save($this->filename);
}
```

 `$this->filename` 可控，直接进入 `save` 方法

![](https://gitee.com/N0puple/picgo/raw/master/img/20220919202039.png)

之后遍历整个类的属性，最后进行 `file_put_contents` ，`$filename` 是传进来的参数，我们可控，当我们将其设置为某个类时，一定是错误，会抛出一个 `exception` ，但这里会将 `$filename` 与字符串拼接，因此可以触发 `$filename` 的类中的 `__toString`

我们选定该类为 `src/Illuminate/Validation/Rules/RequiredIf.php` 中的 `RequiredIf` 类，看此处的 `__toString` 方法

![](https://gitee.com/N0puple/picgo/raw/master/img/20220919202945.png)

很明显，这里可以调用任意的回调函数，接下来只要找到执行命令并且不需要参数的可回调函数即可

这样的位置不难找，我们找到 `PhpOption::option()` ，位于 `src/PhpOption/LazyOption.php`

![](https://gitee.com/N0puple/picgo/raw/master/img/20220919203308.png)

`$this->option` 控制为 `null` ，`$this->callback` 与 `$this->arguments` 都可控，但是由于这个方法的属性为 `private` ，因此无法直接调用，只能找类内部调用的位置，这里可以找到一个 `get` 方法是调用了的

```
public function get()
{
    return $this->option()->get();
}
```

通过这个 `get` 方法我们可以调用到 `option` ，从而命令执行

## 0x03 漏洞复现

通过 `exp.php` 生成 `payload` ，然后直接打

![](https://gitee.com/N0puple/picgo/raw/master/img/20220919200532.png)



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





