<ul class="sidebar-menu" data-widget="tree">
    <li class="@if(request()->route()->getName() === 'dashboard')active @endif" >
        <a class="link" href="{{ route('dashboard') }}">
            <i class="fa fa-tv" style="vertical-align: middle; padding-right: 10px;"></i>
            <span>Tauler Control</span>
        </a>
    </li>
    <li class="@if(request()->route()->getName() === 'admissions' ||
    request()->route()->getName() === 'admissions.create' ||
    request()->route()->getName() === 'admissions.edit' ||
    request()->route()->getName() === 'admissions.students.create' ||
    request()->route()->getName() === 'admissions.students.edit' ||
    request()->route()->getName() === 'admissions.visits.create' ||
    request()->route()->getName() === 'admissions.visits.edit'
    )active @endif">
        <a href="{{ route('admissions') }}">
            <i class="fa fa-newspaper-o" style="vertical-align: middle; padding-right: 10px;"></i>
            <span>Admissions</span>
        </a>
    </li>

    @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())

    <li class="treeview @if(request()->route()->getName() === 'administration.admissions.questions' ||
    request()->route()->getName() === 'administration.admissions.questions.create' ||
    request()->route()->getName() === 'administration.admissions.questions.edit' ||
    request()->route()->getName() === 'administration.admissions.questions.answers.create' ||
    request()->route()->getName() === 'administration.admissions.questions.answers.edit' ||
    request()->route()->getName() === 'administration.courses' ||
    request()->route()->getName() === 'administration.courses.create' ||
    request()->route()->getName() === 'administration.courses.edit' ||
    request()->route()->getName() === 'administration.courses.summermakers' ||
    request()->route()->getName() === 'administration.courses.summermakers.create' ||
    request()->route()->getName() === 'administration.courses.summermakers.edit' ||
    request()->route()->getName() === 'administration.users' ||
    request()->route()->getName() === 'administration.users.create' ||
    request()->route()->getName() === 'administration.users.edit' ||
    request()->route()->getName() === 'administration.information.courses' ||
    request()->route()->getName() === 'administration.information.courses.create' ||
    request()->route()->getName() === 'administration.information.courses.edit' ||
    request()->route()->getName() === 'administration.languages' ||
    request()->route()->getName() === 'administration.languages.create' ||
    request()->route()->getName() === 'administration.languages.edit' ||
    request()->route()->getName() === 'administration.schools' ||
    request()->route()->getName() === 'administration.schools.create' ||
    request()->route()->getName() === 'administration.schools.edit'
    ) active @endif">
        <a href="#">
            <i class="fa fa-gear" style="vertical-align: middle; padding-right: 10px;"></i>
            <span>Administració</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview @if(request()->route()->getName() === 'administration.courses' ||
                    request()->route()->getName() === 'administration.courses.create' ||
                    request()->route()->getName() === 'administration.courses.edit' ||
                    request()->route()->getName() === 'administration.admissions.questions' ||
                    request()->route()->getName() === 'administration.admissions.questions.create' ||
                    request()->route()->getName() === 'administration.admissions.questions.edit' ||
                    request()->route()->getName() === 'administration.admissions.questions.answers.create' ||
                    request()->route()->getName() === 'administration.admissions.questions.answers.edit' ||
                    request()->route()->getName() === 'administration.languages' ||
                    request()->route()->getName() === 'administration.languages.create' ||
                    request()->route()->getName() === 'administration.languages.edit' ||
                    request()->route()->getName() === 'administration.schools' ||
                    request()->route()->getName() === 'administration.schools.create' ||
                    request()->route()->getName() === 'administration.schools.edit'
                    ) active @endif">
                <a href="#"><i class="fa fa-circle-o"></i>
                    <span>Admissions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->route()->getName() === 'administration.admissions.questions' ||
                    request()->route()->getName() === 'administration.admissions.questions.create' ||
                    request()->route()->getName() === 'administration.admissions.questions.edit' ||
                    request()->route()->getName() === 'administration.admissions.questions.answers.create' ||
                    request()->route()->getName() === 'administration.admissions.questions.answers.edit'
                    ) active @endif">
                        <a  href="{{ route('administration.admissions.questions') }}">
                            {{--                    <i class="fa fa-tv" style="vertical-align: middle; padding-right: 10px;"></i>--}}
                            <i class="fa fa-circle-o"></i>
                            <span>Preguntes</span>
                        </a>
                    </li>
                    <li class="@if(request()->route()->getName() === 'administration.courses' ||
                    request()->route()->getName() === 'administration.courses.create' ||
                    request()->route()->getName() === 'administration.courses.edit' ||
                    request()->route()->getName() === 'administration.courses.summermakers' ||
                    request()->route()->getName() === 'administration.courses.summermakers.create' ||
                    request()->route()->getName() === 'administration.courses.summermakers.edit'
                    ) active @endif">
                        <a  href="{{ route('administration.courses') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Cursos</span>
                        </a>
                    </li>
                    <li class="@if(request()->route()->getName() === 'administration.schools' ||
                    request()->route()->getName() === 'administration.schools.create' ||
                    request()->route()->getName() === 'administration.schools.edit'
                    ) active @endif">
                        <a  href="{{ route('administration.schools') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Escoles</span>
                        </a>
                    </li>
                    <li class="@if(request()->route()->getName() === 'administration.languages' ||
                    request()->route()->getName() === 'administration.languages.create' ||
                    request()->route()->getName() === 'administration.languages.edit'
                    ) active @endif">
                        <a  href="{{ route('administration.languages') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Idiomes</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview @if(request()->route()->getName() === 'administration.information.courses' ||
                    request()->route()->getName() === 'administration.information.courses.create' ||
                    request()->route()->getName() === 'administration.information.courses.edit'
                    ) active @endif">
                <a  href="#">
                    <i class="fa fa-circle-o"></i>
                    <span>Informació</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->route()->getName() === 'administration.information.courses' ||
                    request()->route()->getName() === 'administration.information.courses.create' ||
                    request()->route()->getName() === 'administration.information.courses.edit'
                    ) active @endif">
                        <a  href="{{ route('administration.information.courses') }}">
                            {{--                    <i class="fa fa-tv" style="vertical-align: middle; padding-right: 10px;"></i>--}}
                            <i class="fa fa-circle-o"></i>
                            <span>Cursos</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview @if(request()->route()->getName() === 'administration.users' ||
                    request()->route()->getName() === 'administration.users.create' ||
                    request()->route()->getName() === 'administration.users.edit'
                    ) active @endif">
                <a  href="#">
                    <i class="fa fa-circle-o"></i>
                    <span>Usuaris</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->route()->getName() === 'administration.users' ||
                    request()->route()->getName() === 'administration.users.create' ||
                    request()->route()->getName() === 'administration.users.edit'
                    ) active @endif">
                        <a  href="{{ route('administration.users') }}">
                            {{--                    <i class="fa fa-tv" style="vertical-align: middle; padding-right: 10px;"></i>--}}
                            <i class="fa fa-circle-o"></i>
                            <span>Usuaris</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
        @endif
</ul>
