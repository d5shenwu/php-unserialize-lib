# php-unserialize-lib

## 0x00 Introduction

`php-unserialize-lib`是一个反序列化靶场，提供 [@PHPGGC](https://github.com/ambionics/phpggc) 中大部分反序列化漏洞环境与分析。

此外，还将收集网上一些其他常用框架的反序列化链，对收录的所有反序列化链进行漏洞分析复现，并给出自己的 `poc`，以供参考。

`php-unserialize-lib` 搭建环境部分参考了 [@vulhub](https://github.com/vulhub/vulhub) 。

## 0x01 List

以下是可用环境与分析的列表，包括 `PHPGGC` 的和自己收集的一些反序列化漏洞的环境与分析。

- [x] CakePHP
  - [x] RCE1 （4.2.3）
  - [x] RCE2 （4.2.3, add）
- [x] CodeIgniter4
  - [x] RCE1（4.0.0-rc.4）
  - [x] RCE2（4.0.4）
- [ ] Laravel
  - [ ] RCE1（unsuccess）
  - [x] Laravel_5.4.0_8.6.9\_反序列化链_RCE1
  - [x] RCE3（5.5.39）
  - [x] RCE4（5.5.39）
  - [x] RCE5（5.8.30）
  - [x] RCE6（5.5.39）
  - [ ] RCE7（unsuccess）
- [ ] ThinkPHP
  - [ ] FW1（unsuccess）
  - [x] FW2（5.0.3）
  - [ ] RCE1（unsuccess）
  - [x] RCE2（5.0.24）
- [ ] ZendFramework
  - [ ] FD1
  - [ ] RCE1
  - [ ] RCE2
  - [ ] RCE3
  - [ ] RCE4

## 0x02 GitBook

这里给分析文档专门创建了一个 `GitBook` ，方便查询与观看

https://n0puple.gitbook.io/php-unserialize-lib/

## 0x03 公众号

创建了一个公众号，长期更新反序列化链与漏洞复现相关知识。

公众号搜索：安全漏洞复现

扫码关注：

![](https://gitee.com/N0puple/picgo/raw/master/img/qrcode_for_gh_a41358b842dd_430.jpg)

