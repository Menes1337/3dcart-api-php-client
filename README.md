[![Build Status](https://travis-ci.org/Menes1337/3dcart-api-php-client.svg?branch=master)](https://travis-ci.org/Menes1337/3dcart-api-php-client)
[![codecov](https://codecov.io/gh/Menes1337/3dcart-api-php-client/branch/master/graph/badge.svg)](https://codecov.io/gh/Menes1337/3dcart-api-php-client)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/aab429ac8fb342de98cc3283d920a369)](https://www.codacy.com/app/Menes1337/3dcart-api-php-client?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Menes1337/3dcart-api-php-client&amp;utm_campaign=Badge_Grade)

# 3dcart PHP Api-Client

## Project properties

Codestyle: PSR-1 (http://www.php-fig.org/psr/psr-1/) / PSR-2 (http://www.php-fig.org/psr/psr-2/)

Autoloading: PSR-4 (http://www.php-fig.org/psr/psr-4/)

Minimum PHP Version: 5.6

## Example usage

### Project Initialization
    
    git clone https://github.com/Menes1337/3dcart-api-php-client.git
    cd 3dcart-api-php-client
    composer install
    
### Soap API
    include('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
    
    use \ThreeDCart\Primitive\StringValueObject;
        
    $soapFactory = new \ThreeDCart\Api\Soap\Factory();
    $soapClient  = $soapFactory->getApiClient(
        new StringValueObject('Your 3dcart API key'),
        new StringValueObject('yourstore.3dcartstores.com')
    );

    $customerObjects = $soapClient->getCustomers();

    var_dump($customerObjects);
    
### Advanced SOAP API
    include('vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
    
    use \ThreeDCart\Primitive\StringValueObject;
    
    $soapFactory = new \ThreeDCart\Api\Soap\Factory();
    $advancedClient  = $soapFactory->getAdvancedApiClient(
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
3. Make sure the codestyle (PSR-1 / PSR-2) is applied to your changes, your code is PHP Unit tested and can be executed on PHP 5.6/7.0/7.1
4. Commit your changes (`git commit -am 'Add some feature'`))
5. Push to the branch (`git push origin my-new-feature`)
6. Create a new pull request
