# 3dcart PHP Api-Client

## Project properties

Codestyle: PSR-1 (http://www.php-fig.org/psr/psr-1/) / PSR-2 (http://www.php-fig.org/psr/psr-2/)

Autoloading: PSR-4 (http://www.php-fig.org/psr/psr-4/)

Minimum PHP Version: 5.6

## Example usage

### Soap API
    include('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
        
    $soapFactory = new \ThreeDCart\Api\Soap\Factory();
    $soapClient  = $soapFactory->getApiClient(
        new StringValueObject('Your 3dcart API key'),
        new StringValueObject('yourstore.3dcartstores.com')
    );

    $customerObjects = $soapClient->getCustomers();

    var_dump($customerObjects);
    
### Advanced SOAP API
    include('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
    
    $soapFactory = new \ThreeDCart\Api\Soap\Factory();
    $soapClient  = $soapFactory->getAdvancedApiClient(
        new StringValueObject('Your 3dcart API key'),
        new StringValueObject('yourstore.3dcartstores.com')
    );

    $plainCustomersArray = $advancedClient->runQuery(
        new StringValueObject('SELECT * FROM customer')
    );

    var_dump($plainCustomersArray);


## Contributing

You are welcome to contribute!

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make the codestyle (PSR-1 / PSR-2) is applied to your changes, your code is PHP Unit tested and can be executed at least under PHP 5.6
4. Commit your changes (`git commit -am 'Add some feature'`))
5. Push to the branch (`git push origin my-new-feature`)
6. Create a new pull request
