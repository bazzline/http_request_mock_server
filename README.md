# Http Test Request Server

This component should easy up your testing.
It can also be used as a mocked endpoint.

The current change log can be found [here](CHANGELOG.md).
The latest stable release is [![Latest stable](https://img.shields.io/packagist/v/net_bazzline/http_request_mock_server.svg)](https://packagist.org/packages/net_bazzline/http_request_mock_server)
 
# Benefits

* [dead stupid simple](https://en.wikipedia.org/wiki/KISS_principle) (With Great Power Comes Great Responsibility)
* extendable by its [Open/closed principle](https://en.wikipedia.org/wiki/Open/closed_principle) inside the [HttpRequestmockServerFactory](source/HttpRequestMockServerFactory.php)
* fast and easy to use
* shipped with a ready to use [index.php](public/index.php)
* zero dependencies
* zero configuration, the usage is just a wget away

# Supported GET parameters

## content

[Url encoded](http://php.net/manual/en/function.urlencode.php) string.

## format

One of the following three:

* json
* raw
* xml

## status_code

Any number is working.

# Example

## Returning JSON

Url with all available and supported get parameters

```bash
?format=json&content=%7B%22foo%22%3A+%22bar%22%7D
```

will return

```json
{"foo":"bar"}
```

## Returning RAW

Url with all available and supported get parameters

```bash
?format=raw&content=There+is+no+foo+without+a+bar
```

will return

```text
There is no foo without a bar
```

## Returning XML

Url with all available and supported get parameters

```bash
?format=xml&content=<foo>bar<%2Ffoo>
```

will return

```xml
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<xml>
<foo>bar</foo>
</xml>
```

# Mature Projects

This project has a small number of [source lines of code](https://en.wikipedia.org/wiki/Source_lines_of_code) (less than 127 lines of code without the syntactic sugar). It is just a small thing you can use.
There are a lot of [mature projects](https://packagist.org/search/?q=api%20mock) out there like [http-server-mock](https://packagist.org/packages/upscale/http-server-mock) to name just one.

# Final Words

Star it if you like it :-). Add issues if you need it. Pull patches if you enjoy it. Write a blog entry if you use it. [Donate something](https://gratipay.com/~stevleibelt) if you love it :-].
