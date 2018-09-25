<ui-view name="laucher" class="ng-scope"><!-- GAMOTA launcher -->
<!-- ngIf: vm.os != 'android' && vm.os!= 'ios' --><div class="fixed_launcher md-hidden hidden-sm ng-scope" ng-if="vm.os != 'android' &amp;&amp; vm.os!= 'ios'" ng-class="{'hidden': hiddenLauncher}">
    <div class="launcher_title">
        <p class="launcher">Tải</p>
        <p class="launcher">Game </p>
        <p class="launcher">Ngay</p>
    </div>
    <div class="launcher_btn">
        <a href="javascript:;" target="_blank" class="btn-launcher" ng-click="sendToGa($event, 'Download Launcher(Popup)')">Tải ngay</a>
    </div>
</div>
 </ui-view>