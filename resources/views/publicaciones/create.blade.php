@extends('layouts.plantilla')

@section('title', 'Submit to Reddit')


@section('content')

    <div class="contenedor">
        <div class="pp">
            <div class="create">
                <div class="post-item">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                    </svg>
                    <h3>Post</h3>
                </div>
            </div>
            <form action="/submit" method="POST">
                @csrf
                <input type="text" name="title" id="" class="input" placeholder="Title" required>
                <textarea name="content" id="" cols="30" rows="10" placeholder="Content (Optional)"></textarea>
                <input type="submit" value="Post">
            </form>
        </div>
    </div>

@endsection