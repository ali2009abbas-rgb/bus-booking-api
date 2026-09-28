<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        //  تخصيص شكل الاستجابة (Custom Formatting) عند حدوث أي خطأ في الـ API
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*') || $request->wantsJson()) {

                // تحديد رمز الحالة (HTTP Status Code) بحسب نوع الخطأ
                $statusCode = method_exists($e, 'getStatusCode')
                    ? $e->getStatusCode()
                    : ($e->getCode() >= 400 && $e->getCode() < 600 ? $e->getCode() : 500);

                // إرجاع بنية موحدة لردود الأخطاء
                return response()->json([
                    'success' => false,
                    'error'   => $e->getMessage() ?: 'حدث خطأ في الخادم',
                ], $statusCode);
            }
        });
    })->create();
