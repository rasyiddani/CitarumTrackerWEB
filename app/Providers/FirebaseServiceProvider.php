<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Database as FirebaseDatabase;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $firebaseCredentialsPath = config('firebase.credentials.path');

        // Ensure the file exists before trying to load it
        if (file_exists($firebaseCredentialsPath)) {
            $this->app->singleton(FirebaseAuth::class, function ($app) use ($firebaseCredentialsPath) {
                return (new Factory)
                    ->withServiceAccount($firebaseCredentialsPath)
                    ->withDatabaseUri('https://iot-impedance-default-rtdb.firebaseio.com')
                    ->createAuth();
            });

            $this->app->singleton(FirebaseDatabase::class, function ($app) use ($firebaseCredentialsPath) {
                return (new Factory)
                    ->withServiceAccount($firebaseCredentialsPath)
                    ->withDatabaseUri('https://iot-impedance-default-rtdb.firebaseio.com')
                    ->createDatabase();
            });
        } else {
            // Handle the missing file situation gracefully
            Log::error("Firebase credentials file not found at: {$firebaseCredentialsPath}");
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
