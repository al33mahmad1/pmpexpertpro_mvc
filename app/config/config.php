<?php
	// Database Params
	// define("DB_HOST", "localhost");
	// define("DB_USER", "root");
	// define("DB_NAME", "gigaheap_pmpexpertpro");
	// define("DB_PASSWORD", "");

	define("DB_HOST", "pmpexpertpro.com.mysql");
	define("DB_USER", "pmpexpertpro_compmpexpert_ppp");
	define("DB_NAME", "pmpexpertpro_compmpexpert_ppp");
	define("DB_PASSWORD", "ramy_65u6rhf");

	// Root Settings
	// define("APPROOT", dirname(dirname(__file__)));
	// define("URLROOT", "http://localhost/pmpexpertpro");
	// define("ROOTDIR", "/pmpexpertpro");

	// Root Settings
	define("APPROOT", dirname(dirname(__file__)));
	define("URLROOT", "https://pmpexpertpro.com/portal");
	define("ROOTDIR", "/portal");

	define("SITENAME", "PMPEXPERTPRO");

	define("TIMEOUT", (3600 * 5)); // 1 Hr Seconds  x  # of Hours
	define("OTP_TIME", 10); //  3 Hours

	define("WEBSITE_URL", "https://pmpexpertpro.com/contact/");
	define("WEBSITE_CONTACT_PAGE_URL", "https://pmpexpertpro.com/contact/");

	// Membership Access vars
	define("BASIC", "basic");
	define("STANDARD", "scrum");
	define("PREMIUM", "agilepremium");
	define("COMPREHENSIVE", "agileandscrum");

	// Secret fro payment success
	define("PAYMENT_SECRET", "PAY_WITH_PAYPAL");