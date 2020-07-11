<h1 align="center">Welcome to jetmeshi 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.0-blue.svg?cacheSeconds=2592000" />
  <a href="#" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
  <a href="https://twitter.com/SyodoB" target="_blank">
    <img alt="Twitter: SyodoB" src="https://img.shields.io/twitter/follow/SyodoB.svg?style=social" />
  </a>
</p>

> 料理は面倒…、外食は高い…、でも栄養は摂りたい…、そんな需要を満たす最速フードを集めたサイトです。
みんなのアイデアを共有しましょう！
Cooking is a hassle...eating out is expensive...but I want to get nutrition...this is a site that collects the fastest food to meet such a demand.
Let's share everyone's ideas!

## Imprementions

+ Store image into S3 after compressing 1080px
  and 100px sumnails by GD Library.
+ Cropping images by croppieJS.
+ LIKE posting and listing on mordal window method by AJAX.
+ Tags management.
+ Searching by title, tags, budget and cooking time.
+ Review on creator's posts and display avarage on post.
+ Responsive Nav-menu that is able to slide from right.

+ 画像を1080px圧縮してからS3に保存。GDライブラリ使用。
+ croppieJSによる画像のトリミング。
+ AJAXによるLIKE投稿とmordal windowへのリスティング。
+ タグ管理。
+ タイトル、タグ、予算、調理時間で検索。
+ クリエイターの投稿にレビューをつけて、投稿にアベレージを表示。
+ 右からスライドできるレスポンシブナビメニュー。

## Back borns

+ Language: PHP, JavaScript, SCSS, HTML, MySQL
+ Framework: Laravel v7., blade template, Bootstrap4.5, jQuery3.5.
+ Tool: Circle CI, Docker, letsencrypt(SSL), Adobe XD(wire frame), mermaid.js(sequence), lint tool(CSfixer, ESlint), cz-emoji, webpack.mix.js, MySQL Workbench, VScode
+ Infrastructure: AWS (lightsail, S3)

## ER-Diagram

<img src="https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/Screen+Shot+2020-07-11+at+16.39.56.png">

## AWS

<img src="https://cm-jetmeshi.s3-ap-northeast-1.amazonaws.com/jetmeshi-aws.jpg">

## Sequence Diagram

```sh
https://github.com/RyujiOdaJP/Jetmeshi/blob/master/Sequence.pdf
```

## Install

```sh
composer install
yarn install
```

## Usage

```sh
yarn run start
```

## Author

👤 **Ryuji Oda <ryuji.oda@gmail.com>**

* Twitter: [@SyodoB](https://twitter.com/SyodoB)
* Github: [@RyujiOdaJP](https://github.com/RyujiOdaJP)
* LinkedIn: [@RyujiOda](https://linkedin.com/in/ryuji-oda-a3a897176)

## Show your support

Give a ⭐️ if this project helped you!

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_