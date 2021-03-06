[![Travis_ci Status](https://api.travis-ci.org/filestack/filestack-php.svg?branch=master)](https://travis-ci.org/filestack/filestack-php)
[![Coverage Status](https://coveralls.io/repos/github/filestack/filestack-php/badge.svg?branch=master)](https://coveralls.io/github/filestack/filestack-php?branch=master)
[![CodeClimate Status](https://codeclimate.com/github/filestack/filestack-php/badges/gpa.svg)](https://codeclimate.com/github/filestack/filestack-php)

# Filestack PHP SDK
<a href="https://www.filestack.com"><img src="https://filestack.com/themes/filestack/assets/images/press-articles/color.svg" align="left" hspace="10" vspace="6"></a>
This is the official PHP SDK for Filestack - API and content management system that makes it easy to add powerful file uploading and transformation capabilities to any web or mobile application.

## Resources

* [Filestack](https://www.filestack.com)
* [Documentation](https://www.filestack.com/docs)

## Installing

Install ``filestack`` with composer, either run

    $ composer require --prefer-dist filestack/filestack-php "dev-master"

or add

```
"filestack/filestack-php": "dev-master"
```

or download from GitHub

    https://github.com/filestack/filestack-php.git

## Usage

Filestack library gives you access to three useful classes:

* `FilestackClient` - for easy file upload (creates Filelink objects)
* `Filelink` - for file handling (downloading, converting etc.)
* `FileSecurity` - for applying policy and signature values to your API calls

### Uploading files
First, you need to create an instance of FilestackClient

```php
use Filestack\FilestackClient;

$client = new FilestackClient('YOUR_API_KEY');
```

### Storage
Amazon S3 is used to store your files by default. If you wish to use a different one, you can pass in additional parameter 'location' when making upload() and store calls

```php
$client = FilestackClient('YOUR_API_KEY');
$extras = [
    'Location' => 'dropbox',
    'Filename' => 'somefilename.jpg',
];

$filepath = '/path/to/file';
$filelink = $client->upload($filepath);

# get metadata of file
$metadata = $client->getMetaData($filelink->handle, $fields);

# get content of a file
$content = $client->getContent($filelink->handle);

# download a file
$destination = '/path/to/file';
$result = $client->download($filelink->handle, $destination);

# overwrite a file
$filelink2 = $client->overwrite('/path/to/file', $filelink->handle);
```

### Manipulating files

Filelink objects can be created in two ways:

 - by uploading a file with using FilestackClient
 - by initializing Filelink with file handle and api_key

First method was shown above, the second method is also very easy and will create objects representing files that were already uploaded.

```php
use Filestack\filelink;

$file = new Filelink('pGj2wWfBTMuXhWe2J3bL', 'YOUR_API_KEY');

# transforming an image
$transformed_filelink = $filelink
            ->circle()
            ->blur(['amount' => '20'])
            ->save();

# get metadata
$metadata = $filelink->getMetaData();

# get content of a file
$content = $filelink->getContent();

$filepath = '/path/to/file';

# download a file
$filelink->download($filepath);

# overwrite remote file with local file
$filelink->overwrite($filepath);

# delete remote file
$filelink->delete();

```

### Tagging files and detecting safe for work content

```php
use Filestack\FilestackClient;
use Filestack\FilestackSecurity;

$security = new FilestackSecurity('YOUR_SECURITY_SECRET');
$client = new FilestackClient('YOUR_API_KEY', $security);

$file_handle = 'bzjSo5gAT76ra25sjk4c';

# get tags with client
$result_json = $client->getTags($file_handle);

# get tags with filelink
$filelink = new Filelink($file_handle, 'YOUR_API_KEY', $security);

$json_result = $filelink->getTags();

# get safe for work flag with client
$result_json = $client->getSafeForWork($file_handle);

# get safe for work flag with filelink
$json_result = $filelink->getSafeForWork();

```

For more examples, see the [examples/](examples/) folder in this project.

## Versioning

Filestack PHP SDK follows the [Semantic Versioning](http://semver.org/).

## Code Standard

- PSR-2 coding standard (http://www.php-fig.org/psr/psr-2/)
- PSR-4 autoloading standard (http://www.php-fig.org/psr/psr-4/)
- phpDoc documentation comments standard (https://www.phpdoc.org/docs/latest/getting-started/your-first-set-of-documentation.html)

## Testing

- To run tests, from the project root director, run
```
vendor/bin/phpunit
```

- To generate coverage report, run following command (will generage html files under
directory coverage/)
```
vendor/bin/phpunit --coverage-html=coverage
```

- To run PHPMD for CodeClimate checks
```
vendor/bin/phpmd filestack xml phpmd-rules.xml > logs/phpmd-report-filestack.xml
vendor/bin/phpmd tests xml phpmd-rules.xml > logs/phpmd-report-tests.xml
```
## Issues

If you have problems, please create a [Github Issue](https://github.com/filestack/filestack-php/issues).

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Credits

Thank you to all the [contributors](https://github.com/filestack/filestack-php/graphs/contributors).
