<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta and Title -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HotSwapJS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        code[class*="language-"], pre[class*="language-"] {
            font-size: 1em !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-black dark:bg-gray-900 dark:text-white">
<div class="bg-gray-50 dark:bg-gray-900">
    @include('partials.frontend-selector')

    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <!-- Background Image -->
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="background image"/>

        <!-- Content Container -->
        <div class="relative w-full max-w-6xl px-6 py-8">
            <!-- Blog Content -->
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <article class="prose prose-base dark:prose-invert mx-auto max-w-5xl prose-a:text-blue-400">
                    <!-- Blog Post Content Starts Here -->
                    <!-- Title -->
                    <h1 class="text-3xl font-bold mb-4 text-center">
                        HotSwapJS: Swapping Multiple Frontends in a Laravel Application
                    </h1>

                    <!-- GitHub Link -->
                    <div class="flex justify-center mb-6">
                        <a href="https://github.com/hotsaucejake/hotswapjs" target="_blank" class="flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
                            <!-- GitHub Icon -->
                            <svg class="w-6 h-6 mr-2 fill-current" viewBox="0 0 16 16" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38
                                        0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01
                                        1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95
                                        0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82a7.65 7.65 0 012 0c1.53-1.04
                                        2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65
                                        3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013
                                        8.013 0 0016 8c0-4.42-3.58-8-8-8z" />
                            </svg>
                            View on GitHub
                        </a>
                    </div>

                    <!-- Introduction -->
                    <p>
                        I'll walk you through how I configured a Laravel application to serve multiple JavaScript frontends, including Angular, Lit, Preact, React, Solid, Svelte, Vanilla TypeScript, and Vue, &mdash; and even the default Blade templates. This setup allows you to swap out the frontend of your application seamlessly, which is particularly useful if you're undecided on which frontend framework to use or if you want to showcase different frontend implementations.
                    </p>

                    <p>
                        <strong>Note:</strong> All project folders are organized side-by-side to simulate separate projects, but the assets are bundled into the <code>public</code> folder of the Laravel application.
                    </p>

                    <p>
                        We also respect the routing of the frontend frameworks, allowing Laravel to serve the frontend and handle API routes appropriately. You can check this out with the Vue project selecting different routes.
                    </p>

                    <!-- Table of Contents -->
                    <h2 id="table-of-contents" class="text-2xl font-semibold mt-8 mb-4">Table of Contents</h2>
                    <ul class="list-disc list-inside">
                        <li><a href="#introduction" class="text-blue-600 hover:underline">Introduction</a></li>
                        <li><a href="#project-structure" class="text-blue-600 hover:underline">Project Structure</a></li>
                        <li><a href="#laravel-routes-setup" class="text-blue-600 hover:underline">Laravel Routes Setup</a></li>
                        <li>
                            <a href="#controllers" class="text-blue-600 hover:underline">Controllers</a>
                            <ul class="list-disc list-inside">
                                <li><a href="#frontendswapcontroller" class="text-blue-600 hover:underline">FrontendSwapController</a></li>
                                <li><a href="#hotswapjscontroller" class="text-blue-600 hover:underline">HotSwapJSController</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#services" class="text-blue-600 hover:underline">Services</a>
                            <ul class="list-disc list-inside">
                                <li><a href="#frontendservice" class="text-blue-600 hover:underline">FrontendService</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#requests" class="text-blue-600 hover:underline">Requests</a>
                            <ul class="list-disc list-inside">
                                <li><a href="#frontendswaprequest" class="text-blue-600 hover:underline">FrontendSwapRequest</a></li>
                            </ul>
                        </li>
                        <li><a href="#configuration" class="text-blue-600 hover:underline">Configuration</a></li>
                        <li>
                            <a href="#frontend-configuration" class="text-blue-600 hover:underline">Frontend Configuration</a>
                            <ul class="list-disc list-inside">
                                <li><a href="#angular-setup" class="text-blue-600 hover:underline">Angular Setup</a></li>
                                <li><a href="#vue-setup" class="text-blue-600 hover:underline">Vue Setup</a></li>
                                <li><a href="#other-frontend-frameworks" class="text-blue-600 hover:underline">Other Frontend Frameworks</a></li>
                            </ul>
                        </li>
                        <li><a href="#conclusion" class="text-blue-600 hover:underline">Conclusion</a></li>
                    </ul>

                    <h2 id="introduction" class="text-2xl font-semibold mt-8 mb-4">Introduction</h2>
                    <p>
                        A few years ago, I started a personal project using Laravel for the API backend. I was unsure which frontend framework to use, so I devised a way to swap out the frontend while interacting with my API. I wanted a semi-monolithic application where Laravel would serve the frontend and respect the frontend's routes while using my API routes.
                    </p>
                    <p>
                        This explains how to set up a Laravel application to serve multiple frontends and switch between them dynamically using session management.
                    </p>

                    <!-- Project Structure -->
                    <h2 id="project-structure" class="text-2xl font-semibold mt-8 mb-4">Project Structure</h2>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-bash text-sm">
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
</code>
        </pre>

                    <!-- Laravel Routes Setup -->
                    <h2 id="laravel-routes-setup" class="text-2xl font-semibold mt-8 mb-4">Laravel Routes Setup</h2>
                    <p>
                        In the <code>routes/web.php</code> file, we define the routes needed for frontend swapping and handling all non-API requests.
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-php">
// routes/web.php

&lt;?php

use App\Http\Controllers\FrontendSwapController;
use App\Http\Controllers\HotSwapJSController;
use Illuminate\Support\Facades\Route;

Route::post('frontend', FrontendSwapController::class)
    -&gt;name('frontend');

// This route captures all routes (/{any}) and passes them to the HotSwapJSController
// The where clause excludes any routes that start with 'api', allowing your API routes to function normally.
Route::any('/{any}', HotSwapJSController::class)
    -&gt;where('any', '^(?!api).*$')
    -&gt;name('home');
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li>
                            <strong>Route <code>frontend</code>:</strong> Handles POST requests to change the current frontend. It uses the <code>FrontendSwapController</code>.
                        </li>
                        <li>
                            <strong>Route <code>home</code>:</strong> Captures all requests except those starting with <code>api</code> and delegates them to the <code>HotSwapJSController</code>.
                        </li>
                        <li>
                            This allows for routing with your frontend frameworks while still allowing Laravel to handle API routes.
                        </li>
                    </ul>

                    <!-- Controllers -->
                    <h2 id="controllers" class="text-2xl font-semibold mt-8 mb-4">Controllers</h2>

                    <!-- FrontendSwapController -->
                    <h3 id="frontendswapcontroller" class="text-xl font-semibold mt-6 mb-4">FrontendSwapController</h3>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-php">
// app/Http/Controllers/FrontendSwapController.php

&lt;?php

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
        $validated = $request-&gt;validated();

        $this-&gt;frontendService-&gt;setCurrentFrontend($validated['frontend']);

        return redirect()-&gt;route('home', ['any' =&gt; '/']);
    }
}
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>Purpose:</strong> Updates the current frontend based on user selection and redirects to the home route.</li>
                        <li><strong>Dependency Injection:</strong> Uses the <code>FrontendServiceInterface</code> to interact with the frontend session data.</li>
                        <li><strong>Validation:</strong> Uses <code>FrontendSwapRequest</code> to validate the incoming request data.</li>
                    </ul>

                    <!-- HotSwapJSController -->
                    <h3 id="hotswapjscontroller" class="text-xl font-semibold mt-6 mb-4">HotSwapJSController</h3>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-php">
// app/Http/Controllers/HotSwapJSController.php

&lt;?php

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
        $frontend = $this-&gt;frontendService-&gt;getCurrentFrontend();

        return view($frontend);
    }
}
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>Purpose:</strong> Serves the view corresponding to the current frontend stored in the session.</li>
                        <li><strong>Dynamic View Rendering:</strong> Returns the Blade view based on the frontend selected.</li>
                    </ul>

                    <!-- Services -->
                    <h2 id="services" class="text-2xl font-semibold mt-8 mb-4">Services</h2>

                    <!-- FrontendService -->
                    <h3 id="frontendservice" class="text-xl font-semibold mt-6 mb-4">FrontendService</h3>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-php">
// app/Services/FrontendService.php

&lt;?php

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
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>Purpose:</strong> Manages the frontend selection stored in the session.</li>
                        <li><strong>Methods:</strong>
                            <ul class="list-disc list-inside">
                                <li><code>getCurrentFrontend()</code>: Retrieves the current frontend from the session or returns the default.</li>
                                <li><code>setCurrentFrontend($frontend)</code>: Sets the current frontend in the session.</li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Requests -->
                    <h2 id="requests" class="text-2xl font-semibold mt-8 mb-4">Requests</h2>

                    <!-- FrontendSwapRequest -->
                    <h3 id="frontendswaprequest" class="text-xl font-semibold mt-6 mb-4">FrontendSwapRequest</h3>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-php">
// app/Http/Requests/FrontendSwapRequest.php

&lt;?php

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
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>Purpose:</strong> Validates the frontend selection from the request.</li>
                        <li><strong>Validation Rules:</strong>
                            <ul class="list-disc list-inside">
                                <li>The <code>frontend</code> field is required and must be one of the allowed frontends specified in the configuration.</li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Configuration -->
                    <h2 id="configuration" class="text-2xl font-semibold mt-8 mb-4">Configuration</h2>
                    <p>
                        Create a configuration file <code>config/hotswapjs.php</code>:
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-php">
// config/hotswapjs.php

&lt;?php

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
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>frontends:</strong> An array of allowed frontend names.</li>
                        <li><strong>default_frontend:</strong> The default frontend to use if none is selected.</li>
                    </ul>

                    <!-- Frontend Configuration -->
                    <h2 id="frontend-configuration" class="text-2xl font-semibold mt-8 mb-4">Frontend Configuration</h2>

                    <!-- Angular Setup -->
                    <h3 id="angular-setup" class="text-xl font-semibold mt-6 mb-4">Angular Setup</h3>
                    <p>
                        **`angular.json`:**
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-json">
// angular/angular.json

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
        }
        // ... other configurations ...
      }
    }
  }
}
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>outputPath:</strong> Specifies where to output the build files (<code>../hotswapjs/public/angular</code>).</li>
                        <li><strong>baseHref &amp; deployUrl:</strong> Set to ensure assets are correctly referenced when served from the Laravel application.</li>
                        <li><strong>Copying index.html:</strong> After building, we need to copy <code>index.html</code> to Laravel's views.</li>
                    </ul>

                    <p>
                        **`package.json` Scripts:**
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-json">
// angular/package.json

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
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>build:prod Script:</strong> Builds the Angular application and copies the <code>index.html</code> to Laravel's <code>resources/views</code> directory as <code>angular.blade.php</code>.</li>
                    </ul>

                    <!-- Vue Setup -->
                    <h3 id="vue-setup" class="text-xl font-semibold mt-6 mb-4">Vue Setup</h3>
                    <p>
                        **`vite.config.js`:**
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-js">
// vue/vite.config.js

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
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>outDir:</strong> Outputs the build files to Laravel's public folder (<code>../hotswapjs/public/vue</code>).</li>
                        <li><strong>base:</strong> Sets the base path for assets to <code>/vue/</code> to ensure correct asset referencing.</li>
                    </ul>

                    <p>
                        **`package.json` Scripts:**
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-json">
// vue/package.json

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
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>build:prod Script:</strong> Builds the Vue application and copies the <code>index.html</code> to Laravel's <code>resources/views</code> directory as <code>vue.blade.php</code>.</li>
                    </ul>

                    <!-- Other Frontend Frameworks -->
                    <h3 id="other-frontend-frameworks" class="text-xl font-semibold mt-6 mb-4">Other Frontend Frameworks</h3>
                    <p>
                        For other frameworks using Vite (e.g., Lit, Preact, React, Solid, Svelte, Vanilla TypeScript), the configuration follows a similar pattern.
                    </p>
                    <p>
                        **`vite.config.js` Template:**
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-js">
// [frontend-project]/vite.config.js

import { defineConfig } from 'vite'
import &lt;frontend-plugin&gt; from 'vite-plugin-&lt;frontend&gt;' // Replace with the appropriate plugin

export default defineConfig({
  plugins: [&lt;frontend-plugin&gt;()],
  build: {
    outDir: '../hotswapjs/public/&lt;frontend-project&gt;', // Output to Laravel's public folder
    emptyOutDir: true, // Clear the folder before each build
  },
  base: '/&lt;frontend-project&gt;/', // Set the base URL
})
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>outDir:</strong> Outputs build files to the corresponding directory in Laravel's public folder.</li>
                        <li><strong>base:</strong> Ensures assets are correctly referenced.</li>
                    </ul>

                    <p>
                        **`package.json` Scripts Template:**
                    </p>
                    <pre class="bg-gray-100 dark:bg-gray-800 rounded p-4 overflow-x-auto">
<code class="language-json">
// [frontend-project]/package.json

{
  // ... other configurations ...
  "scripts": {
    "build": "vite build",
    "build:prod": "npm run build && cp ../hotswapjs/public/&lt;frontend-project&gt;/index.html ../hotswapjs/resources/views/&lt;frontend-project&gt;.blade.php"
  },
  // ... other dependencies ...
}
</code>
        </pre>
                    <p>
                        <strong>Explanation:</strong>
                    </p>
                    <ul class="list-disc list-inside">
                        <li><strong>build:prod Script:</strong> Builds the application and copies the <code>index.html</code> to Laravel's views directory.</li>
                    </ul>

                    <!-- Conclusion -->
                    <h2 id="conclusion" class="text-2xl font-semibold mt-8 mb-4">Conclusion</h2>
                    <p>
                        By organizing the project folders side-by-side and configuring each frontend's build process to output to the Laravel application's public directory, we can seamlessly swap between different frontend frameworks. The Laravel application uses session management to keep track of the user's selected frontend and serves the appropriate Blade view.
                    </p>
                    <p>
                        This setup allows for a semi-monolithic application where Laravel serves the frontend and respects the frontend's routes while still handling API routes appropriately. It's a flexible solution for projects where the frontend framework may change or when showcasing multiple frontend implementations.
                    </p>

                </article>
                <!-- Blog Post Content Ends Here -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</div>
</body>
</html>
