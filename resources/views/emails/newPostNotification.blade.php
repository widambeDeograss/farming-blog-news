<!DOCTYPE html>
<html>
<head>
    <title>New Blog Post Published</title>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p>{{ $description }}</p>
    <p><img src="{{ $imageBase64 }}" alt="Post Image"></p>
    <p><a href="{{ $postUrl }}">Read more</a></p>
</body>
</html>
