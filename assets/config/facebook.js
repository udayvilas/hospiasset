app.config(function(facebookProvider)
{
	facebookProvider.setInitParams('826735917458949',true,true,true,'v2.6');
	facebookProvider.setPermissions(['email','public_profile']);
});

(function(d, s, id)
{
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));