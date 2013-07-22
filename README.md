Easy Reloate for ExpressionEngine
=================================

ExpressionEngine plugin to allow you to move content from one template to another.

The API
-------

To move content from one template to another, first establish what is being moved and define a `key` to store it under using `{exp:easy_relocate:capture}`:

	{exp:easy_relocate:capture key="scripts"}
		<script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript"></script>
		<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	{/exp:easy_relocate:capture}

Then use `{exp:easy_relocate:insert}` to drop it somewhere else:

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="/j/main.js"></script>
	{exp:easy_relocate:insert key="scripts"}

You can drop it in any template processed after the one used to capture the content.

License
-------

Easy Reloate for ExpressionEngine is distributed under the liberal MIT License.