# Encrypter console script
This script can encrypt / decrypt / hash any given data. It can work with a files, plain text and data given by stdin thread. It uses openssl library for encrypting / decrypting commands, and hash functions for hashing.
This script uses the [Consolly](https://github.com/chop1k/consolly) package to implement the functionality of commands and options.

## Requirements
 - PHP 7.4
 - openssl extension (ext-openssl)
 - readline extension (ext-readline)
 - json extension (ext-json)

## How to use
You can use this script via php interpreter.
```shell
php ./bin/index.php -A hash # for example
```
Or you can use shell wrapper, but then you should specify the path to the bin directory with the index.php script in the ENCRYPTER_SCRIPT_DIR environment variable.
```shell
export ENCRYPTER_SCRIPT_DIR="/path/to/bin/directory"
```
Then you can use shell wrapper.
```shell
./bin/encrypter.sh -A hash # you can use any command listed below
```

### Commands list
 * hash - hashes given data and returns result to the stdout.
    * -a or --algorithm - required option that specifies hash algorithm, default value - sha256.
    * -f or --file - option that specifies the file whose data will be used for hashing.
    * -b or --binary - option that specifies in what form hash will be displayed. If indicated then the hash will be returned in binary.
    * -s or --salt - option that specifies salt. Salt is a text which adds to the main text.
    * -A or --available - returns list of all available hashing algorithms.
 * encrypt - encrypts given data and returns result to the stdout.
    * -a or --algorithm - required option that specifies encryption algorithm.
    * -p or --password - option that specifies password for encryption.
    * -i or --iv - option that specifies initial vector.
    * -f or --file - option that specifies the file whose data will be used for encryption. 
    * -A or --available - returns list of all available algorithms.
    * -b or --binary - option that specifies in what form result will be displayed. If indicated then the result will be returned in binary.
 * decrypt - decrypts given data and returns result to the stdout.
    * -a or --algorithm - required option that specifies decryption algorithm.
    * -p or --password - option that specifies password for decryption.
    * -i or --iv - option that specifies initial vector.
    * -f or --file - option that specifies the file whose data will be used for decryption.
    * -A or --available - returns list of all available algorithms.
    * -b or --binary - option that specifies in what form result will be displayed. If indicated then the result will be returned in binary.

Encrypt / Decrypt commands requires --algorithm option, --password option and --iv option. If password or iv is not specified then it will prompt you to write a password or/and an iv to the console.

## License
Script licensed under the MIT license. See [license file](LICENSE).