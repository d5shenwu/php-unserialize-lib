# php-unserialize-lib

## Introduction

`php-unserialize-lib`是一个根据 `php`反序列化工具 [@PHPGGC](https://github.com/ambionics/phpggc) 对应编写而来的反序列化靶场，提供 `PHPGGC`中大部分反序列化漏洞环境，省去了搭建环境的麻烦。

此外，还将收集网上一些其他常用框架的反序列化链，对收录的所有反序列化链进行漏洞分析复现，并给出自己的 `poc`，以供参考。

`php-unserialize-lib` 搭建环境部分参考了 [@vulhub](https://github.com/vulhub/vulhub) ，省去了不少麻烦。

## List

以下是可用环境的列表，包括 `PHPGGC` 的和自己收集的一些反序列化漏洞的环境，括号中的是漏洞环境使用的应用版本，含有 `add` 标志的是 `phpggc` 中没有的链，含有 `unsuccess` 标志的是复现过，但是没有复现成功的。

- [x] CakePHP
  - [x] RCE1 （4.2.3）
  - [x] RCE2 （4.2.3, add）

- [x] CodeIgniter4
  - [x] RCE1（4.0.0-rc.4）
  - [x] RCE2（4.0.4）
- [ ] Doctrine
  - [ ] FW1
  - [ ] FW2
- [ ] Drupal7
  - [ ] FD1
  - [ ] RCE1
- [ ] Guzzle
  - [ ] FW1
  - [ ] INFO1
  - [ ] RCE1
- [ ] Horde
  - [ ] RCE1
- [ ] Laminas
  - [ ] FD1
  - [ ] FW1
- [ ] Laravel
  - [ ] RCE1（unsuccess）
  - [x] RCE2（5.5.39）
  - [x] RCE3（5.5.39）
  - [x] RCE4（5.5.39）
  - [x] RCE5（5.8.30）
  - [x] RCE6（5.5.39）
  - [ ] RCE7（unsuccess）
- [ ] Magento
  - [ ] FW1
  - [ ] SQLI1
- [ ] Monolog
  - [ ] RCE1
  - [ ] RCE2
  - [ ] RCE3
  - [ ] RCE4
  - [ ] RCE5
  - [ ] RCE6
  - [ ] RCE7
- [ ] Phalcon
  - [ ] RCE1
- [ ] PHPCSFixer
  - [ ] FD1
  - [ ] FD2
- [ ] PHPExcel
  - [ ] FD1
  - [ ] FD2
  - [ ] FD3
  - [ ] FD4
- [ ] Pydio/Guzzle
  - [ ] RCE1
- [ ] Slim
  - [ ] RCE1
- [ ] Smarty
  - [ ] FD1
  - [ ] SSRF1
- [ ] SwiftMailer
  - [ ] FD1
  - [ ] FW1
  - [ ] FW2
  - [ ] FW3
  - [ ] FW4
- [ ] Symfony
  - [ ] FW1
  - [ ] FW2
  - [ ] RCE1
  - [ ] RCE2
  - [ ] RCE3
  - [ ] RCE4
  - [ ] RCE5
- [ ] TCPDF
  - [ ] FD1
- [ ] ThinkPHP
  - [ ] FW1（unsuccess）
  - [x] FW2（5.0.3）
  - [ ] RCE1（unsuccess）
  - [x] RCE2（5.0.24）
- [ ] WordPress/Dompdf
  - [ ] RCE1
  - [ ] RCE2
- [ ] WordPress/Guzzle
  - [ ] RCE1
  - [ ] RCE2
- [ ] WordPress/P/EmailSubscribers
  - [ ] RCE1
- [ ] WordPress/P/EverestForms
  - [ ] RCE1
- [ ] WordPress/P/WooCommerce
  - [ ] RCE1
  - [ ] RCE2
- [ ] WordPress/P/YetAnotherStarsRating
  - [ ] RCE1
- [ ] WordPress/PHPExcel
  - [ ] RCE1
  - [ ] RCE2
  - [ ] RCE3
  - [ ] RCE4
  - [ ] RCE5
  - [ ] RCE6
- [ ] Yii
  - [ ] RCE1
- [ ] Yii2
  - [ ] RCE1
  - [ ] RCE2
- [ ] ZendFramework
  - [ ] FD1
  - [ ] RCE1
  - [ ] RCE2
  - [ ] RCE3
  - [ ] RCE4

