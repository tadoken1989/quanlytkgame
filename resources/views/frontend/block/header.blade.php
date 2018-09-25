<ui-view name="header" class="ng-scope">
        <div id="header" class="header ng-scope">
    <div class="ng-view" autoscroll="true"></div>
    <div class="container">
        <div class="row">
            {{--<div id="logo"><a href="/"><img alt="Gamota" title="Gamota" src="/asset/images/logo.png"></a></div>--}}
            @if(auth()->user())
            <div ng-if="logged" class="dropdown pull-right ng-scope" uib-dropdown="" style="">
                <a ng-href="javascript:;" id="drop_user" class="user dropdown-toggle" uib-dropdown-toggle="" data-delay="1000" data-close-others="false" role="buton" aria-haspopup="true" aria-expanded="false" href="javascript:;">
                <span class="username ng-binding" ng-bind="username">Thang Ht</span>
                <span>
                <img ng-src="/asset/images/no-avatar.png" class="user-avata" src="{{ auth()->user()->avatar }}"></span>
                </a>
                <ul uib-dropdown-menu="" role="menu" aria-labelledby="split-button" class="dropdown-menu">
                    <li><a ng-href="/user/profile" href="/user/profile"> <span class="username ng-binding">Thang Ht</span></a></li>
                    <li><a ng-href="/user/profile" href="/user/profile"> <span><i class="ion-person"></i> Thông tin tài khoản  </span></a></li>
                    <li><a ng-href="/user/profile?state=message" href="/user/profile?state=message"> <span><i class="fa fa-envelope"></i> Tin nhắn  </span><span class="badge ng-binding">  0</span></a></li>
                    <li><a rel="nofollow" target="_blank" href="#"> <span><i class="fa fa-usd"></i> Nạp tiền  </span></a></li>
                    <li class="divider"></li>
                    <li><a ng-href="/" onclick="return false" ng-click="logout()" href="/"> <span> Thoát  </span></a></li>
                </ul>
            </div>
            @else
            <!-- end ngIf: logged -->
            <!-- ngIf: !logged -->
            <div class="pull-right">
                <div id="search-top">
                    <!-- ngIf: search -->
                    <div class="search-box top-search" ng-class="{active:search}">
                        <form class="ng-pristine ng-valid">
                            <!--<input ng-model="keyword" ng-change="search_link()" type="search" placeholder="Tìm kiếm...">
                            <button type="submit" class="btn-search" ng-click="handleSearch()"><i class="fa fa-search"></i></button>-->
                            <input ng-model="keyword" type="search" placeholder="Tìm kiếm..." class="ng-pristine ng-untouched ng-valid ng-empty">
                            <button type="submit" class="btn-search" ng-click="handleSearch()"><i class="fa fa-search"></i></button>
                            <span class="close">×</span>
                        </form>
                    </div>
                    <div class="search-icon" ng-click="search = !search">
                        <!-- ngIf: search -->
                        <!-- ngIf: !search -->
                            <i ng-if="!search" class="fa fa-search ng-scope"> </i>
                        <!-- end ngIf: !search -->
                    </div>
                </div>
            </div>
            @endif
            <div id="navigation">
                <div class="navi-backdrop" style="display: none;"></div>
                <div class="animated-arrow"><span></span></div>
                <div class="navigation">
                    <ul>
                        @foreach(getMenu() as $item)
                            <li class="ng-scope"><a class="" href="{{ $item->url }}" style=""><i class="fa fa-gift"></i> {{ $item->name }}</a>
                            </li>
                        @endforeach
                        @if(!auth()->user())
                        <li><a ng-class="{active:active('{{ route('frontend.user.register') }}')}" href="{{ route('frontend.user.register') }}"><i class="fa fa-download"></i> Đăng Kí</a></li>
                        <li><a ng-class="{active:active('{{ route('frontend.user.login') }}')}" href="{{ route('frontend.user.login') }}"><i class="fa fa-download"></i> Đăng Nhập</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</ui-view>