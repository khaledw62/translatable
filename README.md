# Translatable
Translatable is a Laravel package for dealing with Multi-Lang Tables.

## Installation

Using [composer](https://getcomposer.org/) to install translatable.

```bash
composer require echosters/translatable
```
## DataBase

| id  | title_en | title_ar | 
| ------------- | ------------- | ------------- |
| 1  | Hello  | مرحبا | 

## Preparing your model
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Echosters\Translatable\Translatable;

class Blog extends Model
{
    use Translatable;

    public $translatedColumns = ['title'];
}
```
## Usage

```php
//local = en
$blog = Blog::find(1);
$blog->title; // Hello

//local = ar
$blog = Blog::find(1);
$blog->title; // مرحبا
```
## Query
You May use ```whereLocale``` to query one of your translatable columns depending on the current locale
```php
//local = en
$blog = Blog::whereLocal('title', 'LIKE', '%hell%')->first();
$blog->title; // Hello

//local = ar
$blog = Blog::whereLocal('title', 'LIKE', '%مرح%')->first();
$blog->title; // مرحبا
```

## Notes
just know that the ```title``` property doesn't exist in your table the trait will add it while the model is booting,
in other words the sql generated statement will be like below.

when locale is ```en``` statement```select title_en as title```

when locale is ```ar``` statement```select title_ar as title```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


## License
[MIT](https://choosealicense.com/licenses/mit/)
