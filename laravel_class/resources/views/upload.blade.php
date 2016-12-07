<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Project</title>
    </head>
    <body>
       <form action="file/load" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <input type="file" name="filefield">
            <input type="submit">
       </form>
    </body>
</html>
