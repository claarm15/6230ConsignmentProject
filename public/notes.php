<!doctype html>
<head>
	<title>Private Notes</title>
</head>
<body>
<h1>Notes for Consignment Project</h1>
<p>Hey everyone, I have no idea what notes you need and don't, but I figure having something written down is better than nothing. Here are some general notes that might help some.  The biggest thing is feel free to ask.  Also feel free to edit this page and add details you need to as well.</p>

<h2>At the top of each file</h2>
<p>We have a config file that needs to be set up at the start of each file.  </p>

<?php echo htmlspecialchars("<?php");?>
<br>
include_once('../etc/config.php');
</br>
<?php echo htmlspecialchars("?>");?>

<br><p>You only need the closing php tag if you switching to html at that point.</p>
<p>What this does is sets up the db class, loads the validation class (since everyone will use it), and will handle the session information to show if people are logged in or not (not implemented yet). </p>

<h2>Database functionality</h2>
<p>This is a pretty database centric site.  While the logic of when and how to tie into the database is left upto each individual.  I thought it would be helpful to have a class handles all the connections and mechanics for us.  That is why there is a db object loaded in the config file.  As long as you put the include statement in the top of your page, you have access to the db class.</p>
<p>To use the db class, you just have to use the $db object.</p>


<?php echo htmlspecialchars('$result = $db->get_array("SELECT * FROM user");');?>

<p>This will query the database and save the result in an array.  You can then test if it is empty (no result) or use the results to do whatever you need.  It will save the field name as the key and the values.  So if it is the id field you could get the results by using  $result['id'].</p>

Another one you might need to use if using more than one table.. (especially for the inserts with multiple tables)...

<?php echo htmlspecialchars('$billing_id = $db->get_insert_id();');?>

<p>The idea here is you get the idea of the last query so you can use it as a foreign key in the next query.  If you look in registration.php you can see where I used it.</p>

<h2>Validation Tips</h2>
<p>The validation class doesn't start off instatiated.  I don't want to mix errors between pages, so each page needs a comment like this:</p>
<p><?php echo htmlspecialchars('$val = new validator();');?></p>
<p>Each of the validation functions returns a true or false so they can be used in if statements.  When you call: </p>
<p><?php echo htmlspecialchars('$errors = $val->get_errors();');?></p>
<p>That will return an array of errors.  Specific key values of each error can be given to retrieve just that one from the list when necessary.</p>
</body>
