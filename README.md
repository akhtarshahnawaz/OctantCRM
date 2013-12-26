OctantCRM
=========

Octant CRM is a Cutomer Relationship Management (CRM), Employee Resource Planning (ERP) and order Management System Completely written in PHP . It is an amazing piece of software for software development, web development and IT firms to track their progress in realtime and keep their project workflow smooth



Requirements
============

1. Enable PHP Installation to support Bracket Type "[]" array. This is only available in PHP versions 5.5.0 and above


Installation
============

1. Go to "OctantCRM/application/config/database.php"
2. Edit Lines
				$db['default']['username'] = '<YOUR DATABASE USERNAME>';
				$db['default']['password'] = '<YOUR DATABASE PASSWORD>';
				$db['default']['database'] = '<YOUR DATABASE NAME>';


3. Go to link  "<installation folder>/index.php/install"
4. Fill in Username and Password for managing CRM



Email Setup
============

1. Go to "OctantCRM/application/config/email.php"
2. Edit Lines

		$config['smtp_host'] = '<SMTP HOST>';
		$config['smtp_user'] = '<SMTP USERNAME>';
		$config['smtp_pass'] = '<SMTP PASSWORD>';
