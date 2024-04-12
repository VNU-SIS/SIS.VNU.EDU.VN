@extends('client.layouts.main')
@section('title', 'SIS')
@section('content')
<div id="body" style="margin-top: 30px;">
    <div class=container>
        <div class=content-pad-3x>
            <div class=row>
                <div id=content class=col-md-12>
                    <article class=single-event-content>
                        <div class=member-item>
                            <div class=row>
                                <div class="col-md-4 col-xs-5">
                                    <div class=content-pad>
                                        <div class=item-thumbnail>
                                            <img width="80%" height="auto"
                                                style="object-fit: cover;"
                                                src="{{ isset($user[0]->avatar) ? $user[0]->avatar : "https://iupac.org/wp-content/uploads/2018/05/default-avatar.png" }}"
                                                class="attachment-thumb_263x263 size-thumb_263x263 wp-post-image"
                                                alt srcset sizes
                                                data-sf-original-srcset="http://sis.vnu.edu.vn/wp-content/uploads/2021/11/Picture1-1-263x263.png 263w, http://sis.vnu.edu.vn/wp-content/uploads/2021/11/Picture1-1-150x150.png 150w, http://sis.vnu.edu.vn/wp-content/uploads/2021/11/Picture1-1-50x50.png 50w, http://sis.vnu.edu.vn/wp-content/uploads/2021/11/Picture1-1-80x80.png 80w, http://sis.vnu.edu.vn/wp-content/uploads/2021/11/Picture1-1-100x100.png 100w, http://sis.vnu.edu.vn/wp-content/uploads/2021/11/Picture1-1-255x255.png 255w, http://sis.vnu.edu.vn/wp-content/uploads/2021/11/Picture1-1-300x300.png 300w">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-xs-7">
                                    <div class=content-pad>
                                        <div class=item-content>
                                            <h3 class=item-title>{{ $user[0]->name }}</h3>
                                            <h4 class=small-text>{{ isset($user[0]->position_title) ? $user[0]->position_title : "" }}</h4>
                                            <div class="member-tax small-text">
                                                <a href="#"
                                                    class=cat-link>
                                                    {{ $user[0]->level_title }}
                                                </a>
                                            </div>
                                            <p>
                                                Email: {{ $user[0]->email }}
                                            </p>
                                            @if (isset($user[0]->phone))
                                                <p>
                                                    ĐT: {{ $user[0]->phone }}
                                                </p>
                                            @endif
                                            @if (isset($user[0]->date_of_birth))
                                                <p>
                                                    Ngày Sinh: {{ $user[0]->date_of_birth }}
                                                </p>
                                            @endif
                                            @if (isset($user[0]->facebook_link))
                                                <p>
                                                    ĐT: {{ $user[0]->facebook_link }}
                                                </p>
                                            @endif
                                            <ul class="list-inline social-light"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=pure-content>
                            <div class=content-pad>
                                @if (Session::get('website_language') == 'en')
                                    {!! $user[0]->info_en !!}
                                @else
                                    {!! $user[0]->info !!}
                                @endif
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection