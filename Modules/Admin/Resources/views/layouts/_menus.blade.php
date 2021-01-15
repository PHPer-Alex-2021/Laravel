<div class="left-sidebar-scroll">
    <div class="left-sidebar-content">
        <ul class="sidebar-elements">
            @foreach(app('hd-menu')->all() as $moduleName=>$groups)
            <li class="divider">{{$moduleName}}</li>
                @foreach($groups as $group)
                <li class="parent">
                    <a href="#">
                        <i class="{{$group['icon']}}"></i>
                        <span>{{$group['title']}}</span>
                    </a>
                    <ul class="sub-menu">
                        @foreach($group['menus'] as $menu)
                        <li>
                            <a href="{{$menu['url']}}">{{$menu['title']}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
