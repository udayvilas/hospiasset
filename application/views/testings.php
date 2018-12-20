<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/palette.css">
<div layout="column" flex>
<md-toolbar>
<h3>Angular Material</h3>
</md-toolbar>
<div class="container" layout="row" flex>
<md-sidenav md-is-locked-open="true" class="md-whiteframe-4dp">
<md-list>
  <md-list-item>
		<md-button>
		<ng-md-icon icon="login" style="fill: #abcdef" size="24"></ng-md-icon>
		Login
		</md-button>
  </md-list-item>
  <md-list-item>
		<md-button>
		<ng-md-icon icon="send" style="fill: #abcdef" size="24"></ng-md-icon>
		Register
		</md-button>
  </md-list-item>
</md-list>
</md-sidenav>
<md-content id="content">
	<h2>Mahendar Karne</h2>
	<p>Auto complete shows the completion popup as you type, so you can fill in long words by typing only a few characters. It's enabled by default for source code and HTML (but only after entering a < character).</p>
</md-content>
</div>
</div>