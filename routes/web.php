<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Mail;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'WelcomeController@index')->name('root');
/*Route::get('/', function () {
    $text =<<<EOT
**Note** To make lists look nice, you can wrap items with hanging indents:

    -   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
        Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi,
        viverra nec, fringilla in, laoreet vitae, risus.
    -   Donec sit amet nisl. Aliquam semper ipsum sit amet velit.
        Suspendisse id sem consectetuer libero luctus adipiscing.
EOT;

    return app(ParsedownExtra::class)->text($text);
});*/

/*Route::get('posts', [
    'as' => 'posts.index',
    'uses' => 'PostsController@index'
]);*/

Route::resource('posts', 'PostsController');
Route::resource('posts.comments', 'PostsCommentController');

Route::get('logout', 'Auth\LogoutController@logout');

/*// User Registration
Route::prefix('auth')->name('user.')->group(function () {
    Route::get('register', 'Auth\RegisterController@getRegister')->name('create');
    Route::post('store', 'Auth\RegisterController@postRegister')->name('store');
});*/

// Session
Route::prefix('auth')->name('session.')->group(function () {
//    Route::get('login', 'Auth\LoginController@getLogin')->name('create');
//    Route::post('login', 'Auth\LoginController@postLogin')->name('store');
//    Route::get('logout', 'Auth\LoginController@getLogout')->name('destroy');
    Route::get('github', 'Auth\LoginController@redirectToProvider')->name('github.login');
    Route::get('github/callback', 'Auth\LoginController@handleProviderCallback')->name('github.callback');
});

/*// Password Reminder
Route::prefix('password')->group(function () {
    Route::get('remind', 'Auth\ForgotPasswordController@getEmail')->name('reminder.create');
    Route::post('remind', 'Auth\ForgotPasswordController@postEmail')->name('reminder.store');
    Route::get('reset/{token}', 'Auth\ResetPasswordController@getReset')->name('reset.create');
    Route::post('reset', 'Auth\ResetPasswordController@postReset')->name('reset.store');
});*/

/*Route::get('auth', function () {
    $credentials = [
        'email' => 'john@example.com',
        'password' => 'password'
    ];

    if (! Auth::attempt($credentials)) {
        return 'Incorrect username and password combination';
    }

    Event::fire('user.login', [ Auth::user() ]);
    var_dump('Event fired and continue to next line...');

    return;
});

Event::listen('user.login', function ($user) {
    $user->last_login = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::now());
//    var_dump('"user.log" event catched and passed data is:');
//    var_dump($user->toArray());
    return $user->save();
});*/

Route::get('protected', function () {
    return 'Welcome back, '. Auth::user()->name;
})->middleware('auth');

Route::get('auth/basic', function () {
    return view("welcome");
})->middleware('auth.basic');

Route::get('mail', function () {
    $to = 'jaehwankoo@gmail.com';
    $subject = 'Studing sending email in Laravel';
    $data = [
        'title' => 'Hi there',
        'body' => 'This is the body of an email message',
        'user' => App\User::find(1)
    ];

    return Mail::send('emails.welcome', $data, function ($message) use ($to, $subject) {
        $message->to($to)->subject($subject);
    });
});

Route::get('sms/{to}', function (\Nexmo\Client $nexmo, $to) {
    $message = $nexmo->message()->send([
        'type' => 'unicode',
        'to' => $to,
        'from' => env('NEXMO_NUMBER'),
        'text' => '홍대 라라벨 스터디 곽연준 from Nexmo'
    ]);

    Log::info('send sms message', $message);
});

Route::pattern('image', '(?P<parent>[0-9]{2}-[\._-]+)-(?P<suffix>img-[0-9]{2}.png)');

Route::get('docs/{image}', 'DocumentsController@image')->name('documents.image');

Route::get('docs/{file?}', [
    'as' => 'documents.show',
    'uses' => 'DocumentsController@show'
]);

Route::get('locale', 'WelcomeController@locale')->name('locale');

Route::resource('articles', 'ArticlesController');

Route::get('tags/{id}/articles', 'ArticlesController@index')->name('tags.articles.index');

Route::resource('articles', 'ArticlesController');
