<?php

    class config {
        //Database settings
        // You can use your own MySQL or MariaDB server for database connection
        public static string $DatabaseController_host = "HOST";
        public static string $DatabaseController_user = "USER";
        public static string $DatabaseController_password = "PASSWORD";
        public static string $DatabaseController_database = "DATABASE";
        public static string $DatabaseController_encoding = "utf-8";

        //Basic settings for Seo
        //Every page has his own seo settings, you must define it on Model's top.
        public static string $SeoController_Title = "Title";
        public static string $SeoController_Charset = "utf-8";
        public static string $SeoController_Description = "Description";
        public static string $SeoController_FQDN = "www.google.hu";
        public static string $SeoController_MetaKeywords = "oop, mvc, php";
        public static string $SeoController_OpenGraphImage = "image.png";

        //Session Name
        public static string $SessionController_SessionName = "Session-Name";

        // !!IMPORTANT SETTINGS!! //
        public static string $SiteGenerator_HtmlLang = "HU";

        //Mail setting
        public static string $Mail_DefaultSender = "";
        public static string $Mail_Host = "";
        public static string $Mail_Username = "";
        public static string $Mail_Password = "";
        public static $Mail_IsReplyTo = true;
        public static string $Mail_AddReplyTo = "";
    }
?>