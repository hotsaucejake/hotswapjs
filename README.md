# HotSwapJS: Swapping Multiple Frontends in a Laravel Application

I'll walk you through how I configured a Laravel application to serve multiple JavaScript frontends, including Angular, Lit, Preact, React, Solid, Svelte, Vanilla TypeScript, and Vue, - and even the default Blade templates. This setup allows you to swap out the frontend of your application seamlessly, which is particularly useful if you're undecided on which frontend framework to use or if you want to showcase different frontend implementations.

**Note:** All project folders are organized side-by-side to simulate separate projects, but the assets are bundled into the `public` folder of the Laravel application.

We also respect the routing of the frontend frameworks, allowing Laravel to serve the frontend and handle API routes appropriately. You can check this out with the Vue project selecting different routes.

## Table of Contents

- [Introduction](#introduction)
- [Project Structure](#project-structure)
- [Laravel Routes Setup](#laravel-routes-setup)
- [Controllers](#controllers)
    - [FrontendSwapController](#frontendswapcontroller)
    - [HotSwapJSController](#hotswapjscontroller)
- [Services](#services)
    - [FrontendService](#frontendservice)
- [Requests](#requests)
    - [FrontendSwapRequest](#frontendswaprequest)
- [Configuration](#configuration)
- [Frontend Configuration](#frontend-configuration)
    - [Angular Setup](#angular-setup)
    - [Vue Setup](#vue-setup)
    - [Other Frontend Frameworks](#other-frontend-frameworks)
- [Conclusion](#conclusion)

## Introduction

A few years ago, I started a personal project using Laravel for the API backend. I was unsure which frontend framework to use, so I devised a way to swap out the frontend while interacting with my API. I wanted a semi-monolithic application where Laravel would serve the frontend and respect the frontend's routes while using my API routes.

This explains how to set up a Laravel application to serve multiple frontends and switch between them dynamically using session management.

## Project Structure

The project directories are organized side-by-side to simulate separate projects:

```
hotswapjs/
├── angular/          # Angular project
├── lit/              # Lit project
├── preact/           # Preact project
├── react/            # React project
├── solid/            # Solid project
├── svelte/           # Svelte project
├── vanilla/          # Vanilla TypeScript project
├── vue/              # Vue project
└── hotswapjs/        # Laravel application
    ├── app/
    ├── config/
    ├── public/
    │   ├── angular/
    │   ├── lit/
    │   ├── preact/
    │   ├── react/
    │   ├── solid/
    │   ├── svelte/
    │   ├── vanilla/
    │   └── vue/
    ├── resources/
    │   └── views/
    │       ├── angular.blade.php
    │       ├── lit.blade.php
    │       ├── preact.blade.php
    │       ├── react.blade.php
    │       ├── solid.blade.php
    │       ├── svelte.blade.php
    │       ├── vanilla.blade.php
    │       └── vue.blade.php
    └── routes/
        └── web.php
```

## Laravel Routes Setup

In the `routes/web.php` file, we define the routes needed for frontend swapping and handling all non-API requests.

```php
<?php

use App\Http\Controllers\FrontendSwapController;
use App\Http\Controllers\HotSwapJSController;
use Illuminate\Support\Facades\Route;

Route::post('frontend', FrontendSwapController::class)
    ->name('frontend');

// This route captures all routes (/{any}) and passes them to the HotSwapJSController
// The where clause excludes any routes that start with 'api', allowing your API routes to function normally.
Route::any('/{any}', HotSwapJSController::class)
    ->where('any', '^(?!api).*$')
    ->name('home');
```

**Explanation:**

- **Route `frontend`:** Handles POST requests to change the current frontend. It uses the `FrontendSwapController`.
- **Route `home`:** Captures all requests except those starting with `api` and delegates them to the `HotSwapJSController`.
- This allows for routing with your frontend frameworks while still allowing Laravel to handle API routes.

## Controllers

### FrontendSwapController

```php
<?php

namespace App\Http\Controllers;

use App\Contracts\FrontendServiceInterface;
use App\Http\Requests\FrontendSwapRequest;
use Illuminate\Http\RedirectResponse;

class FrontendSwapController extends Controller
{
    private FrontendServiceInterface $frontendService;

    public function __construct(FrontendServiceInterface $frontendService)
    {
        $this->frontendService = $frontendService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(FrontendSwapRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->frontendService->setCurrentFrontend($validated['frontend']);

        return redirect()->route('home', ['any' => '/']);
    }
}
```

**Explanation:**

- **Purpose:** Updates the current frontend based on user selection and redirects to the home route.
- **Dependency Injection:** Uses the `FrontendServiceInterface` to interact with the frontend session data.
- **Validation:** Uses `FrontendSwapRequest` to validate the incoming request data.

### HotSwapJSController

```php
<?php

namespace App\Http\Controllers;

use App\Contracts\FrontendServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotSwapJSController extends Controller
{
    private FrontendServiceInterface $frontendService;

    public function __construct(FrontendServiceInterface $frontendService)
    {
        $this->frontendService = $frontendService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        $frontend = $this->frontendService->getCurrentFrontend();

        return view($frontend);
    }
}
```

**Explanation:**

- **Purpose:** Serves the view corresponding to the current frontend stored in the session.
- **Dynamic View Rendering:** Returns the Blade view based on the frontend selected.

## Services

### FrontendService

```php
<?php

namespace App\Services;

use App\Contracts\FrontendServiceInterface;

class FrontendService implements FrontendServiceInterface
{
    public function getCurrentFrontend(): string
    {
        return session('frontend', config('hotswapjs.default_frontend'));
    }

    public function setCurrentFrontend(string $frontend): void
    {
        session(['frontend' => $frontend]);
    }
}
```

**Explanation:**

- **Purpose:** Manages the frontend selection stored in the session.
- **Methods:**
    - `getCurrentFrontend()`: Retrieves the current frontend from the session or returns the default.
    - `setCurrentFrontend($frontend)`: Sets the current frontend in the session.

## Requests

### FrontendSwapRequest

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FrontendSwapRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'frontend' => [
                'required',
                Rule::in(config('hotswapjs.frontends')),
            ],
        ];
    }
}
```

**Explanation:**

- **Purpose:** Validates the frontend selection from the request.
- **Validation Rules:**
    - The `frontend` field is required and must be one of the allowed frontends specified in the configuration.

## Configuration

Create a configuration file `config/hotswapjs.php`:

```php
<?php

return [

    'frontends' => [
        'welcome',
        'angular',
        'lit',
        'preact',
        'react',
        'solid',
        'svelte',
        'vanilla',
        'vue',
    ],

    'default_frontend' => 'welcome',
];
```

**Explanation:**

- **frontends:** An array of allowed frontend names.
- **default_frontend:** The default frontend to use if none is selected.

## Frontend Configuration

### Angular Setup

**`angular.json`:**

```json
{
  "$schema": "./node_modules/@angular/cli/lib/config/schema.json",
  "version": 1,
  "newProjectRoot": "projects",
  "projects": {
    "angular": {
      "projectType": "application",
      "schematics": {
        "@schematics/angular:component": {
          "style": "scss"
        }
      },
      "root": "",
      "sourceRoot": "src",
      "prefix": "app",
      "architect": {
        "build": {
          "builder": "@angular-devkit/build-angular:application",
          "options": {
            "outputPath": "../hotswapjs/public/angular",
            "baseHref": "/",
            "deployUrl": "/angular/browser/",
            "index": "src/index.html",
            "browser": "src/main.ts",
            "polyfills": [
              "zone.js"
            ],
            "tsConfig": "tsconfig.app.json",
            "inlineStyleLanguage": "scss",
            "assets": [
              {
                "glob": "**/*",
                "input": "public"
              }
            ],
            "styles": [
              "src/styles.scss"
            ],
            "scripts": []
          },
          "configurations": {
            "production": {
              "budgets": [
                {
                  "type": "initial",
                  "maximumWarning": "500kB",
                  "maximumError": "1MB"
                },
                {
                  "type": "anyComponentStyle",
                  "maximumWarning": "2kB",
                  "maximumError": "4kB"
                }
              ],
              "outputHashing": "all",
              "baseHref": "/",
              "deployUrl": "/angular/browser/"
            },
            "development": {
              "optimization": false,
              "extractLicenses": false,
              "sourceMap": true,
              "baseHref": "/",
              "deployUrl": "/angular/browser/"
            }
          },
          "defaultConfiguration": "production"
        },
        // ... other configurations ...
      }
    }
  }
}
```

**Explanation:**

- **outputPath:** Specifies where to output the build files (`../hotswapjs/public/angular`).
- **baseHref & deployUrl:** Set to ensure assets are correctly referenced when served from the Laravel application.
- **Copying index.html:** After building, we need to copy `index.html` to Laravel's views.

**`package.json` Scripts:**

```json
{
  "name": "angular",
  "version": "0.0.0",
  "scripts": {
    "ng": "ng",
    "start": "ng serve",
    "build": "ng build",
    "build:prod": "ng build --configuration production && cp ../hotswapjs/public/angular/browser/index.html ../hotswapjs/resources/views/angular.blade.php",
    "watch": "ng build --watch --configuration development",
    "test": "ng test"
  },
  // ... other dependencies ...
}
```

**Explanation:**

- **build:prod Script:** Builds the Angular application and copies the `index.html` to Laravel's `resources/views` directory as `angular.blade.php`.

### Vue Setup

**`vite.config.js`:**

```js
import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [
    vue(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  build: {
    outDir: '../hotswapjs/public/vue',
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'index.html'),
    },
  },
  base: '/vue/', // Set the base URL for assets
})
```

**Explanation:**

- **outDir:** Outputs the build files to Laravel's public folder (`../hotswapjs/public/vue`).
- **base:** Sets the base path for assets to `/vue/` to ensure correct asset referencing.

**`package.json` Scripts:**

```json
{
  "name": "vue",
  "version": "0.0.0",
  "private": true,
  "type": "module",
  "scripts": {
    "dev": "vite",
    "build": "run-p type-check \"build-only {@}\" --",
    "preview": "vite preview",
    "build-only": "vite build",
    "type-check": "vue-tsc --build --force",
    "lint": "eslint . --ext .vue,.js,.jsx,.cjs,.mjs,.ts,.tsx,.cts,.mts --fix --ignore-path .gitignore",
    "format": "prettier --write src/",
    "build:prod": "npm run build-only && cp ../hotswapjs/public/vue/index.html ../hotswapjs/resources/views/vue.blade.php"
  },
  // ... other dependencies ...
}
```

**Explanation:**

- **build:prod Script:** Builds the Vue application and copies the `index.html` to Laravel's `resources/views` directory as `vue.blade.php`.

### Other Frontend Frameworks

For other frameworks using Vite (e.g., Lit, Preact, React, Solid, Svelte, Vanilla TypeScript), the configuration follows a similar pattern.

**`vite.config.js` Template:**

```js
import { defineConfig } from 'vite'
import <frontend-plugin> from 'vite-plugin-<frontend>' // Replace with the appropriate plugin

export default defineConfig({
  plugins: [<frontend-plugin>()],
  build: {
    outDir: '../hotswapjs/public/<frontend-project>', // Output to Laravel's public folder
    emptyOutDir: true, // Clear the folder before each build
  },
  base: '/<frontend-project>/', // Set the base URL
})
```

**Explanation:**

- **outDir:** Outputs build files to the corresponding directory in Laravel's public folder.
- **base:** Ensures assets are correctly referenced.

**`package.json` Scripts Template:**

```json
{
  // ... other configurations ...
  "scripts": {
    "build": "vite build",
    "build:prod": "npm run build && cp ../hotswapjs/public/<frontend-project>/index.html ../hotswapjs/resources/views/<frontend-project>.blade.php"
  },
  // ... other dependencies ...
}
```

**Explanation:**

- **build:prod Script:** Builds the application and copies the `index.html` to Laravel's views directory.

## Conclusion

By organizing the project folders side-by-side and configuring each frontend's build process to output to the Laravel application's public directory, we can seamlessly swap between different frontend frameworks. The Laravel application uses session management to keep track of the user's selected frontend and serves the appropriate Blade view.

This setup allows for a semi-monolithic application where Laravel serves the frontend and respects the frontend's routes while still handling API routes appropriately. It's a flexible solution for projects where the frontend framework may change or when showcasing multiple frontend implementations.
