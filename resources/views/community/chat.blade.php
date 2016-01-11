{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends("master")
@section('content')
    {{--
    <div class="osu-layout__section osu-layout__section--full">
    <div class="osu-layout__row osu-layout__row--with-gutter">
            <div class="osu-layout__row--page livechat">
                <div class="livechat-channels">
                    <div class="livechat-channels__tab">#polish</div>
                    <div class="livechat-channels__tab">#english</div>
                    <div class="livechat-channels__tab">#hungary</div>
                </div>
                <ul class="livechat-chat">
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                    <li class="livechat-chat__line">[2016-01-11 18:21:12] admin: asdasdas</li>
                </ul>
        </div>
    </div>
</div>
--}}
@endsection


@section ("script")



    @parent

    <script data-turbolinks-eval="always">
    var messages = {!! json_encode([]) !!}
    var channels = {!! json_encode($channels) !!}
    </script>

    <script src="{{ elixir("js/react/live-chat.js") }}" data-turbolinks-eval="always" data-turbolinks-track></script>
    
@endsection