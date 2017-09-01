# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Open]

### To Add

* add link to openhub.net
* add url handler to the server to
    * enable the option to bypass the whole default content, format and status code creation
* add scrutinizer status
* add unit tests

### To Change

## [Unreleased]

### Added

### Changed

## [2.0.0](https://github.com/bazzline/http_request_mock_server/tree/2.0.0) - released at 2017-09-01

### Added

* created dedicated [HttpRequestMockServerFactory](source/HttpRequestMockServerFactory.php) to enable the option to
    * we are now able to use the code outside the [index.php](public/index.php)
    * enabled the option to extend the existing [factory](source/HttpRequestMockServerFactory.php) and its protected methods to create your own [HttpRequestMockServer](source/HttpRequestMockServer.php)
* link to latest stable in the [README.md](README.md)

### Changed

* fixed broken links in [CHANGELOG.md](CHANGELOG.md)
* removed not project relevant content from the [CHANGELOG.md](CHANGELOG.md)

## [1.0.0](https://github.com/bazzline/http_request_mock_server/tree/1.0.0) - released at 2017-08-31

### Added

* [CHANGELOG.md](CHANGELOG.md)
* [Semantic Versioning](http://semver.org)

### Changed

* Moved from [stevleibelt/php_http_test_request_server](https://github.com/stevleibelt/php_http_test_request_server) into this repository
