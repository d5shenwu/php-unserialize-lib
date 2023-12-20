# php-unserialize-lib

## 0x00 Introduction

`php-unserialize-lib`是一个反序列化靶场，提供 [@PHPGGC](https://github.com/ambionics/phpggc) 中大部分反序列化漏洞环境与分析，以及更准确的影响范围。

此外，还将收集网上一些其他常用框架的反序列化链，对收录的所有反序列化链进行漏洞分析复现，并给出自己的 `poc`，以供参考。

## 0x01 List

以下是可用环境与分析的列表，包括 `PHPGGC` 的和自己收集的一些反序列化漏洞的环境与分析。

- [ ] CakePHP
  - [ ] RCE1 （4.2.3）
  - [ ] RCE2 （4.2.3, add）
- [ ] CodeIgniter4
  - [ ] RCE1（4.0.0-rc.4）
  - [ ] RCE2（4.0.4）
- [ ] Laravel
  - [x] Laravel_5.4.0_5.8.35+\_反序列化链_RCE1
  - [x] Laravel_5.4.0_8.6.12+\_反序列化链_RCE1
  - [x] Laravel_5.4.0_9.3.6+\_反序列化链_RCE1
  - [x] Laravel_5.4.0_9.3.6+\_反序列化链_RCE2
  - [x] Laravel_5.4.0_9.3.6+\_反序列化链_RCE3
  - [x] Laravel_5.6.0_9.3.6+\_反序列化链_RCE1
  - [x] Laravel_6.0.0_9.3.6+\_反序列化链_RCE1
  - [x] Laravel_7.0.0_9.3.6+\_反序列化链_RCE1
- [ ] ThinkPHP
  - [ ] FW1（unsuccess）
  - [ ] FW2（5.0.3）
  - [ ] RCE1（unsuccess）
  - [ ] RCE2（5.0.24）
- [ ] ZendFramework
  - [ ] FD1
  - [ ] RCE1
  - [ ] RCE2
  - [ ] RCE3
  - [ ] RCE4



