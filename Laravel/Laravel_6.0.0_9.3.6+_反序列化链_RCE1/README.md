# Laravel_6.0.0_9.3.6+\_反序列化链_RCE1

内容与 Laravel_5.4.0_5.8.35+\_反序列化链_RCE1 几乎一样，算得上是那条链子的延续，可以通杀 6.0.0 以上全版本，因此还是写一下

这是 `Laravel` 反序列化链系列的第四篇文章

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

6.0.0 <= x <= 9.3.6+

6.0.0 以前不可用

## 0x02 漏洞分析

所有位置都和上一条链子一摸一样，唯一的区别是使用到的变量名不一样，因此导致 `exp.php` 不通用，如下

![](https://gitee.com/N0puple/picgo/raw/master/img/20220912213422.png)

位于 `src/Illuminate/Support/Manager.php` ，控制 `$this->container` 的值即可

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

