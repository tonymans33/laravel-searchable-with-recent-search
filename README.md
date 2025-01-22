# Laravel Searchable with Recent Search Feature

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-searchable.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-searchable)
[![run-tests](https://github.com/spatie/laravel-searchable/actions/workflows/run-tests.yml/badge.svg)](https://github.com/spatie/laravel-searchable/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-searchable.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-searchable)

This package makes it easy to get structured search from a variety of sources. Here's an example where we search through some models. We already did some small preparation on the models themselves.

```php
$searchResults = (new Search())
   ->registerModel(User::class, 'name')
   ->registerModel(BlogPost::class, 'title')
   ->search('john');
```

The search will be performed case insensitive. `$searchResults` now contains all `User` models that contain `john` in the `name` attribute and `BlogPost`s that contain 'john' in the `title` attribute.

In your view you can now loop over the search results:

```blade
<h1>Search</h1>

There are {{ $searchResults->count() }} results.

@foreach($searchResults->groupByType() as $type => $modelSearchResults)
   <h2>{{ $type }}</h2>
   
   @foreach($modelSearchResults as $searchResult)
       <ul>
            <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
       </ul>
   @endforeach
@endforeach
```

In this example we used models, but you can easily add a search aspect for an external API, list of files or an array of values.

---

## Recent Search Feature

### About
This package now includes a recent search feature that allows tracking, retrieving, and managing user searches efficiently.

### Installation

1. **Publish Config and Migration Files**

    Run the following command to publish the configuration and migration files:

    ```bash
    php artisan vendor:publish --tag=recent-search-config
    php artisan vendor:publish --tag=recent-search-migrations
    ```

2. **Run Migrations**

    After publishing the migration files, migrate your database:

    ```bash
    php artisan migrate
    ```

3. **Update the Config File**

    In the `config/recentsearch.php` file, set the `user_model` to your User model:

    ```php
    'user_model' => App\Models\User::class,
    ```

### Usage

#### Add the Trait
To enable recent search functionality for a model, add the `HasRecentSearchTrait` to it:

```php
use HasRecentSearchTrait;
```

#### Available Functions

- **Store a Recent Search**

    ```php
    User::storeRecentSearch($request->q);
    ```

    This saves the recent search query for the user.

- **Retrieve Recent Searches**

    ```php
    $recentSearches = User::getRecentSearches();
    ```

    This retrieves all recent searches for the user.

- **Delete a Specific Search Record**

    ```php
    User::deleteRecentSearchRecord($id);
    ```

    This deletes a specific search record by its ID.

- **Clear All Recent Searches**

    ```php
    User::clearRecentSearches();
    ```

    This clears all recent search records for the user.

---

## Original Features

### Preparing your models

In order to search through models you'll have to let them implement the `Searchable` interface.

```php
namespace Spatie\Searchable;

interface Searchable
{
    public function getSearchResult(): SearchResult;
}
```

You'll only need to add a `getSearchResult` method to each searchable model that must return an instance of `SearchResult`. Here's how it could look like for a blog post model.

```php
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class BlogPost extends Model implements Searchable
{
     public function getSearchResult(): SearchResult
     {
        $url = route('blogPost.show', $this->slug);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
         );
     }
}
```

---

## Credits

- [Alex Vanderbist](https://github.com/AlexVanderbist)
- [Freek Van der Herten](https://github.com/freekmurze)
- [Tony Mansour](https://github.com/tonymans33) (<mansourtony44@gmail.com>)
- [All Contributors](../../contributors)

---

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

