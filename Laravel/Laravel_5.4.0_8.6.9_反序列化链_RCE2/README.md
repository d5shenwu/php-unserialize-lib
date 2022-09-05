## Laravel_5.4.0_8.6.9\_反序列化链_RCE2

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

这条链子与 Laravel_5.5.0_5.8.35\_反序列化链_RCE1 很像，开局依旧是 `src/Illuminate/Broadcasting/PendingBroadcast.php::__destruct()` ，然后以 `__call` 入手，这里使用的是 `src/Illuminate/Validation/Validator.php::__call()` ，我们看到这里的代码

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905194557.png)

`$method` 是传进来的方法名，值为 `dispatch` ，`$parameters` 可控，`$method` 进入 `Str::snake` 进行一定的转换，然后返回，这里我们不用看代码，直接让 `dispatch` 进入得到返回值即可，不影响结果

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905195259.png)

可以看到，返回的 `$rule` 为空，接下来 `$this->extensions` 可控，我们进入 `$this->callExtension` 方法，第一个参数为空字符串，第二个参数可控

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905195450.png)

这里写的很明了，`$this->extensions` 可控，`$parameters` 也可控，直接可进入 `call_user_func_array($callback, $parameters);` ，并且可以命令执行

## 0x03 漏洞复现

通过 `exp.php` 生成 `payload` ，然后直接打

![](https://gitee.com/N0puple/picgo/raw/master/img/20220905200040.png)

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





