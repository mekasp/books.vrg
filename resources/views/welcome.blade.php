<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Books App</title>
    </head>
    <body>
        <div id="app">
            <h1>@{{ message }}</h1>
            <div v-for="arr in arrs">
                @{{ arr }}
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</html>
<script>
var app = new Vue({
    el: '#app',
    data: {
        message: 'Привет, Vue!',
        arrs: [1,2,3,4,5,6]
    }
})
</script>
