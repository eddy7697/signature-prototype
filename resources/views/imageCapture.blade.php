<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .ipad {
            box-sizing: border-box;
            width: 768px;
            height: 1024px;
            border: #eee solid thin;
            border-radius: 3px;
            margin: 80px auto;
            padding: 20px;
            box-shadow: 2px 2px 12px -2px rgba(0, 0, 0, .5);
        }
    </style>
</head>
<body>

    <form action="/api/image/save" enctype="multipart/form-data" method="post">
        @csrf

        <input type="file" name="image">
        <br>
        <br>
        <br>
        <button type="submit">送出照片</button>
    </form>
    
</body>
</html>