# php-unserialize-lib

## Introduction

`php-unserialize-lib`是一个根据 `php`反序列化工具 [@PHPGGC](https://github.com/ambionics/phpggc) 对应编写而来的反序列化靶场，提供 `PHPGGC`中大部分反序列化漏洞环境，省去了搭建环境的麻烦。

此外，还收集网上一些其他常用框架的反序列化链，并对收录的所有反序列化链进行漏洞分析复现，并给出自己的 `poc`，以供参考。

`php-unserialize-lib` 的结构参考了 [@vulhub](https://github.com/vulhub/vulhub) ，省去了不少麻烦。

## List

以下是可用环境的列表，包括 `PHPGGC` 中的 和 自己收集的一些反序列化漏洞的环境，括号中的是漏洞环境使用的应用版本

#### PHPGGC

- [x] CodeIgniter4
  - [x] RCE1
  - [x] RCE2
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
  - [ ] RCE1
  - [ ] RCE2
  - [ ] RCE3
  - [ ] RCE4
  - [ ] RCE5
  - [ ] RCE6
  - [ ] RCE7
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
  - [ ] FW1
  - [x] FW2
  - [ ] RCE1
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


#### Other

- [x] cakephp（这部分暂时不开放）
  - [x] RCE1 （4.2.3）
  - [x] RCE2 （4.2.3）





## Thanks

- [PHPGGC](https://github.com/ambionics/phpggc)
- [vulhub](https://github.com/vulhub/vulhub)

