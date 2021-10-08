## ThinkPHP 反序列化链 RCE2

### 漏洞环境

执行如下命令启动一个 `thinkphp 5.0.24` 的环境：

```
docker-compose up -d
```

访问 http://x.x.x.x/ ，看到 `hello world` 既搭建成功

测试代码

```php
<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        if(isset($_POST['a'])){
            return unserialize(base64_decode($_POST['a']));
        }
        else{
            return 'hello world';
        }
    }
}
```

### 漏洞影响

测试版本 5.0.24

### 漏洞分析

暂未开放

### 漏洞复现

![image-20210913220824735](./images01.jpg)

### 漏洞 EXP

暂未开放



