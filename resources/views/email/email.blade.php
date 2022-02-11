<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{config('app.name', 'Contact Company')}}</title>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <strong>Name:</strong> {{$data[0]['name']}}
                </div>
                <div class="col-md-6">
                    <strong>Email Address:</strong> {{$data[0]['email']}}
                </div>
                <div class="col-md-6">
                    <strong>Gender:</strong> {{$data[0]['gender']}}
                </div>
                <div class="col-md-12">
                    <p>
                        <strong>Content:</strong>
                        <br>
                        {{$data[0]['content']}}
                </div>
            </div>
        </div>

    </body>

</html>