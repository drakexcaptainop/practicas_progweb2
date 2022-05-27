<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-material/1.2.2/angular-material.min.css" integrity="sha512-dMahqxu9L2XnPgHEO4mWksNGfyvOsV2rtMt5TX7OJdWbky+sw9dyMPw8gwhohmwVXAJW5zVCfdyvhutemjYuzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js" integrity="sha512-7oYXeK0OxTFxndh0erL8FsjGvrl2VMDor6fVqzlLGfwOQQqTbYsGPv4ZZ15QHfSk80doyaM0ZJdvkyDcVO7KFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-animate/1.8.2/angular-animate.min.js" integrity="sha512-jZoujmRqSbKvkVDG+hf84/X11/j5TVxwBrcQSKp1W+A/fMxmYzOAVw+YaOf3tWzG/SjEAbam7KqHMORlsdF/eA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-aria/1.8.2/angular-aria.min.js" integrity="sha512-IP/3KOfYYFXQTJVQkBfavKkpvK8u+JD5r2C5vO3Dj3ufl7Xk0SoI0Oh2MXMFcGSAOxK6oZhWbZVWglgvZwAU+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.8.2/angular-messages.min.js" integrity="sha512-X3xzYri4sQgIJ9lQOEJesZcYYJsdDBekZU9AuEsSXwCHJTOkcEn4Chh9kUlTzTgYKWnQNxT3H96X5boZMuco+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-material/1.2.2/angular-material.min.js" integrity="sha512-d33Yhig4j7KzFwP6m2cqIOpLlDKJBgi1XyE909d4bKaNwdZb1TF6XRbsyHHk37Sp8p7aP2u9gyykeU1SRKzPHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js" integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <div class="container text-white bg-primary p-3">
            <img src="{{ asset('images/univalle.png') }}" width="50" height="50" />
            <h1>Sales System</h1>
        </div>
        @include('layouts.navigation')
        <div class="container p-3">
            @yield('content')
        </div>
    </body>
</html>