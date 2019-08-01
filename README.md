# Dynamically extensible ActiveQuery class

This extension provides dynamical customization ActiveQuery filters.

For license information check the [LICENSE](LICENSE.md)-file.

## Install

Either run
```shell script
$ php composer.phar require matrozov/yii2-pro-active-query
```

or add
```json
"matrozov/yii2-pro-active-query": "@dev"
```
to the `require` section of your `composer.json` file.

## Usage

Simply add `ProActiveQueryTrait` trait to your ActiveRecord class and specify ProActiveQuery `query`-function like this:
```php
class MyClass extends ActiveRecord
{
    use ProActiveQueryTrait;

    ...

    public static function queryMyFunc(ActiveQuery &$query)
    {
        $query->andWhere(['deleted_at' => null']);
    }
}
``` 
Now, you can simple selection from database with your filter function:
```php
$items = MyClass::find()->myFunc()->all();
```

Any function with any parameters with `query`-prefix can be called from ActiveQuery:
```php
    public static function queryStatusIs(ActiveQuery &$query, $status)
    {
        $query->andWhere(['status' => $status]);
    }
```
```php
$items = MyClass::find()->statusIs('ready')->all();
```

You can use additional trait for share `query`-function between ActiveRecord classes.
