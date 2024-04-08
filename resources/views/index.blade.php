<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">


</head>

<body>
    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Create New Post</button>
    <form method="post" action="/posts/{id}">
        @csrf
        <input type="text" name="find" id="find" placeholder="Find By Id...">
        <button type="submit" class="btn btn-primary">Find</button>
    </form>
    <h1>All Posts:</h1>
    @foreach($posts as $post)
    <div class="bg-info">
        <!-- <p>id:$post -> id</p> -->
        <h4>Title:{{ $post->title }}</h4>
        <p>Description:{{ $post->description }}</p>
    </div>
    @endforeach
    <form method="POST" action="/posts">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Create New Post Your Self</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control m-2 text-black" type="text" name="title" id="title" placeholder="Enter Title Here...">
                        <input class="form-control m-2 text-black" type="text" name="description" id="descritiption " placeholder="Enter Description Here...">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>