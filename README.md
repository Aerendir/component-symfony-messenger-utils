<p align="center">
    <a href="http://www.serendipityhq.com" target="_blank">
        <img style="max-width: 350px" src="http://www.serendipityhq.com/assets/open-source-projects/Logo-SerendipityHQ-Icon-Text-Purple.png">
    </a>
</p>

<h1 align="center">Serendipity HQ Symfony Messenger Utils</h1>
<p align="center">Provides some utilities to use with Symfony's Messenger component.</p>
<p align="center">
    <a href="https://github.com/Aerendir/component-symfony-messenger-utils/releases"><img src="https://img.shields.io/packagist/v/serendipity_hq/component-symfony-messenger-utils.svg?style=flat-square"></a>
    <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square"></a>
    <a href="https://github.com/Aerendir/component-symfony-messenger-utils/releases"><img src="https://img.shields.io/packagist/php-v/serendipity_hq/component-symfony-messenger-utils?color=%238892BF&style=flat-square&logo=php" /></a>
</p>
<p>
    Supports:
    <a title="Supports Symfony ^6.4" href="https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev"><img title="Supports Symfony ^6.4" src="https://img.shields.io/badge/Symfony-%5E6.4-333?style=flat-square&logo=symfony" /></a>
    <a title="Supports Symfony ^7.4" href="https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev"><img title="Supports Symfony ^7.4" src="https://img.shields.io/badge/Symfony-%5E7.4-333?style=flat-square&logo=symfony" /></a>
    <a title="Supports Symfony ^8.0" href="https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev"><img title="Supports Symfony ^8.0" src="https://img.shields.io/badge/Symfony-%5E8.0-333?style=flat-square&logo=symfony" /></a>
</p>
<p>
    Tested with:
    <a title="Tested with Symfony ^6.4" href="https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev"><img title="Tested with Symfony ^6.4" src="https://img.shields.io/badge/Symfony-%5E6.4-333?style=flat-square&logo=symfony" /></a>
    <a title="Tested with Symfony ^7.4" href="https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev"><img title="Tested with Symfony ^7.4" src="https://img.shields.io/badge/Symfony-%5E7.4-333?style=flat-square&logo=symfony" /></a>
    <a title="Tested with Symfony ^8.0" href="https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev"><img title="Tested with Symfony ^8.0" src="https://img.shields.io/badge/Symfony-%5E8.0-333?style=flat-square&logo=symfony" /></a>
</p>

## Current Status

[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=Aerendir_component-symfony-messenger-utils&metric=coverage)](https://sonarcloud.io/dashboard?id=Aerendir_component-symfony-messenger-utils)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=Aerendir_component-symfony-messenger-utils&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=Aerendir_component-symfony-messenger-utils)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=Aerendir_component-symfony-messenger-utils&metric=alert_status)](https://sonarcloud.io/dashboard?id=Aerendir_component-symfony-messenger-utils)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=Aerendir_component-symfony-messenger-utils&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=Aerendir_component-symfony-messenger-utils)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=Aerendir_component-symfony-messenger-utils&metric=security_rating)](https://sonarcloud.io/dashboard?id=Aerendir_component-symfony-messenger-utils)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=Aerendir_component-symfony-messenger-utils&metric=sqale_index)](https://sonarcloud.io/dashboard?id=Aerendir_component-symfony-messenger-utils)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=Aerendir_component-symfony-messenger-utils&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=Aerendir_component-symfony-messenger-utils)

[![Phan](https://github.com/Aerendir/component-symfony-messenger-utils/workflows/Phan/badge.svg)](https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev)
[![PHPStan](https://github.com/Aerendir/component-symfony-messenger-utils/workflows/PHPStan/badge.svg)](https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev)
[![PSalm](https://github.com/Aerendir/component-symfony-messenger-utils/workflows/PSalm/badge.svg)](https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev)
[![PHPUnit](https://github.com/Aerendir/component-symfony-messenger-utils/workflows/PHPunit/badge.svg)](https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev)
[![Composer](https://github.com/Aerendir/component-symfony-messenger-utils/workflows/Composer/badge.svg)](https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev)
[![PHP CS Fixer](https://github.com/Aerendir/component-symfony-messenger-utils/workflows/PHP%20CS%20Fixer/badge.svg)](https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev)
[![Rector](https://github.com/Aerendir/component-symfony-messenger-utils/workflows/Rector/badge.svg)](https://github.com/Aerendir/component-symfony-messenger-utils/actions?query=branch%3Adev)

<hr />
<h3 align="center">
    <b>Do you like this library?</b><br />
    <b><a href="#js-repo-pjax-container">LEAVE A &#9733;</a></b>
</h3>
<p align="center">
    or run<br />
    <code>composer global require symfony/thanks && composer thanks</code><br />
    to say thank you to all libraries you use in your current project, this included!
</p>
<hr />

## Install Serendipity HQ Symfony Messenger Utils via Composer

    $ composer require serendipity_hq/component-symfony-messenger-utils

This library follows the http://semver.org/ versioning conventions.

<hr />
<h3 align="center">
    <b>Do you like this library?</b><br />
    <b><a href="#js-repo-pjax-container">LEAVE A &#9733;</a></b>
</h3>
<p align="center">
    or run<br />
    <code>composer global require symfony/thanks && composer thanks</code><br />
    to say thank you to all libraries you use in your current project, this included!
</p>
<hr />
