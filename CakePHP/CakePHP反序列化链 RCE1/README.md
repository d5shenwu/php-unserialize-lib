## Cakephp 反序列化链 RCE1

### 漏洞环境

执行如下命令启动一个 `cakephp 4.2.3` 的环境：

```
docker-compose up -d
```

访问 http://x.x.x.x/index.php/test ，看到 `hello world` 既搭建成功

测试代码

```php
<?php
namespace App\Controller;
class TestController extends AppController
{
    public function index()
    {
        if(isset($_GET['a']))
        {
            unserialize(base64_decode($_GET['a']));
        }
        else
        {
            echo 'hello world';
        }
    }
}
```

### 漏洞影响

? < 4.x <= 4.2.3（测试版本 4.2.3）

? < 3.x <= 3.9.6 （未测试）

### 漏洞分析

暂未开放

### 漏洞复现

![image-20210913220824735](./image01.png)

### 漏洞 EXP

暂未开放



