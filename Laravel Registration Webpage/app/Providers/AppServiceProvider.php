<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define custom validation rule for 'photo'
        Validator::extend('photo', function ($attribute, $value, $parameters, $validator) {
            // Check if the value is a valid file upload
            if (! $value instanceof \Illuminate\Http\UploadedFile) {
                return false;
            }

            // Validate the file's MIME type and extension
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif'];

            if (! in_array($value->getClientMimeType(), $allowedMimeTypes) || 
                ! in_array($value->getClientOriginalExtension(), $allowedExtensions)) {
                return false;
            }

            // Additional validation logic if needed

            return true;
        });
    }
}
