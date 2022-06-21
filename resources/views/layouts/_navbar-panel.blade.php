
{{--@inject('userService', 'App\Services\User\UserService')--}}

<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="hidden-xs">
                    {{{ Auth::user()->username }}}
                </span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header" style="height: 85px">
                    <p>
                       <b>{{{ Auth::user()->username }}}</b>
                        <br/>
                        {{{ Auth::user()->role->name }}}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
{{--                        <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
                    </div>
                    <div class="pull-right">
{{--                        <a href="#" class="btn btn-default btn-flat">Sign out</a>--}}
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
{{--                                <i class="fa fa-sign-in" style="vertical-align: middle; padding-right: 2px;"></i>--}}
                                Sortir
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>
