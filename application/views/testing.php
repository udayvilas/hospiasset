<div id="sideNavContainer" ng-controller="sideNavController as ctrl" layout="row" ng-cloak>
<md-sidenav md-component-id="left" class="md-sidenav-left">Welcome to TutorialsPoint.Com</md-sidenav>
<md-content>           
   <md-button ng-click="openLeftMenu()">Open Left Menu</md-button>
<md-button ng-click="openRightMenu()">Open Right Menu</md-button>
</md-content>
<md-sidenav md-component-id="right" class="md-sidenav-right">
   <md-button href="http://google.com">Google</md-button>
</md-sidenav>

</div>