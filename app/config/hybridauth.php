<?php
return array(	
	"base_url"   => "http://Localhost:8000/social/auth",
	"providers"  => array (
		"Google"     => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "9824738942-4g6mv5siudqkgb9768662jad4qhb5lir.apps.googleusercontent.com", "secret" => "3hbp4TiSn_kAjlgw36IvB3_4" ),
			//"scope"		=> "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar",
			"scope"		=> "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/calendar.readonly",
			),
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "ID", "secret" => "SECRET" ),
			),
		"Twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "ID", "secret" => "SECRET" )
			)
	),
);