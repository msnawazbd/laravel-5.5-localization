# Laravel 5.5 Localization

### Step 01. Create a middleware "Language"
 >php artisan make:middleware Language

Update the code that is present with the one below :

```php
public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = 'en';
        }

        App::setLocale($locale);

        return $next($request);
    }
```

### Step 02. We need to register this class in "Kernel.php"

```php
protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            // ...
            \App\Http\Middleware\Language::class,
        ],
    ];
```

### Step 03. Create language file in "resources/lang"

- Create a file in **en** folder named **"home.php"**

```php
return [
    'welcome' => 'Welcome to My Blog'
];
```

- Create a folder named **bn**

- In **bn** folder create a file named **"home.php"** 

```php
return [
    'welcome' => 'আমার ব্লগ এ স্বাগতম',
];
```

### Step 04. Let set up the Route and Controller
```php
Route::get('lang/{lang}', 'WebController@language');
```

- Create a function in "**WebController.php**" named **language**
```php
public function language($lang)
    {
        Session::put('locale', $lang);
        return redirect()->back();
    }
```

### Step 05. And finally prepare the View
- Create two anchor link, first one for **English** and second one for **Bangla**
```html
<a href="{{ url('lang', 'en') }}">@lang('home.english')</a>
<a href="{{ url('lang', 'bn') }}">@lang('home.bangla')</a>
```
- Now we have to view **English** or **Bangla** using
```php
<h1>@lang('home.welcome')</h1>
```
- OR
````php
{{ __('home.welcome') }}
````
- OR
```
if(Session::get('locale') == 'bn')
    // ...
@endif
```
### Wrapping Up :)
