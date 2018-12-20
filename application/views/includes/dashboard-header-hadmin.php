<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-toolbar class="md-whiteframe-z1" md-theme="hospiclr">
	<div class="md-toolbar-tools" style="background-color:#614da4">
		<div>
			<a ui-sref="{{user_path}}">
				<img src="<?= base_url()?>assets/images/ha_main125.png?<?= time();?>">
			</a>
		</div>
		<span flex></span>
		<div>
			<span style="color:#FFFFFF;font-size:14px;">Welcome {{user_name}} ({{user_erole_code}})<?php
				if($this->session->role_code!=HMADMIN)
				{
					echo ",".$this->session->branch_name;
				}
				else if($this->session->role_code!=HA_ADMIN)
				{
					echo ",".$this->session->branch_name;
				}
				?></span>
		</div>
		<md-menu-bar>
			<md-menu ng-repeat="my_menu in user_main_menus">
				<button class="md-raised" aria-label="my_menu_{{$index}}" ng-click="$mdOpenMenu($event)">
					<span class="{{my_menu.icon}}"></span>
					<span class="menu-name">{{my_menu.name}}</span>
				</button>
			</md-menu>
			<md-menu>
				<button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
					<span class="icon-info3"></span>
					<span class="menu-name">About</span>
				</button>
				<md-menu-content width="3">
					<md-menu-item>
						<md-button ui-sref="home.about_product">About Product</md-button>
					</md-menu-item>
					<md-menu-item>
						<md-button ui-sref="home.mail_fun">Mail Function</md-button>
					</md-menu-item>
					<md-menu-item>
						<md-menu>
							<md-button ng-click="$mdOpenMenu()">User Manuals</md-button>
							<md-menu-content width="3">
								<md-menu-item>
									<md-button ui-sref="home.web_application">Web Application</md-button>
								</md-menu-item>
								<md-menu-item>
									<md-button ui-sref="home.mobile_app">Mobile App</md-button>
								</md-menu-item>
							</md-menu-content>
						</md-menu>
					</md-menu-item>

				</md-menu-content>
			</md-menu>
			<md-menu>
				<button ng-click="$mdOpenMenu($event)" aria-label="user name" style="color:#fff;">
					<span class="icon-user-tie"></span>
					<span class="menu-name">Profile</span>
				</button>
				<md-menu-content width="60">
					<md-menu-item>
						<md-button ng-click="showProfile($event,user_id)">Profile</md-button>
					</md-menu-item>
					<md-menu-item>
						<md-button ng-click="logout();">Logout</md-button>
					</md-menu-item>
				</md-menu-content>
			</md-menu>
		</md-menu-bar>
	</div>
</md-toolbar>
