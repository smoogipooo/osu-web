{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => blade_safe(str_replace(' ', '&nbsp;', e($user->username))),
    'pageDescription' => page_description($user->username),
])

@section('content')
    @include('users._restricted_banner', compact('user'))

    <div class="js-react--profile-page osu-layout osu-layout--full"></div>
@endsection

@section ("script")
    @parent

    <script data-turbolinks-eval="always">
        var postEditorToolbar = {!! json_encode(['html' => view('forum._post_toolbar')->render()]) !!};
    </script>

    @foreach ($jsonChunks as $name => $data)
        <script id="json-{{$name}}" type="application/json">
            {!! json_encode($data) !!}
        </script>
    @endforeach

    @include('layout._react_js', ['src' => 'js/react/profile-page.js'])
@endsection
