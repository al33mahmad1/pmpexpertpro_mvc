<?php
	// Database Params
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_NAME", "gigaheap_pmpexpertpro");
	define("DB_PASSWORD", "");

	// Root Settings
	define("APPROOT", dirname(dirname(__file__)));
	define("URLROOT", "http://localhost/pmpexpertpro");
	define("ROOTDIR", "/pmpexpertpro");

	define("SITENAME", "PMPEXPERTPRO");

	define("TIMEOUT", (3600 * 5)); // 1 Hr Seconds  x  # of Hours

	define("WEBSITE_URL", "https://gigaheap.com");
	define("WEBSITE_CONTACT_PAGE_URL", "https://gigaheap.com");

	// Membership Access vars
	define("BASIC", "basic");
	define("STANDARD", "scrum");
	define("PREMIUM", "agilepremium");
	define("COMPREHENSIVE", "agileandscrum");

	// Secret fro payment success
	define("PAYMENT_SECRET", "PAY_WITH_PAYPAL");