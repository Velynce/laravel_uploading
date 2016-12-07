<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Forms</title>
    </head>
    <body>
        <div class="container">
            @if($errors->any())
            <strong>errors in form: </strong>
            <ul>
                @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
            </ul>
            @endif
            <div class="content">
                <form action= "{{ url('contact/create') }}" method="post">
                   <!-- <input type="hidden" name="_method" value="put"> -->
                    {{ csrf_field() }} <!-- //grabs auto generated session token */ -->
                    <label for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname" value="{{ old('fname') }}"><br>
                    <label for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname" value="{{ old('lname') }}"><br>
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"><br>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" value="{{ old('password') }}"><br>

                    <input type="submit">

                </form>
            </div>
        </div>
    </body>
</html>