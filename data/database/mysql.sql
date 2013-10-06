
--
-- Estructura de tabla para la tabla `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `iso` char(2) NOT NULL,
  `english_name` varchar(64) NOT NULL,
  `native_name` varchar(64) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`iso`),
  UNIQUE KEY `english_name` (`english_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Language codes as defined in ISO 639-1';

--
-- Volcado de datos para la tabla `languages`
--

INSERT INTO `languages` (`iso`, `english_name`, `native_name`, `active`) VALUES
('aa', 'Afar', 'Qafara', 0),
('ab', 'Abkhazian', 'Аҧсуа', 0),
('af', 'Afrikaans', 'Afrikaans', 0),
('am', 'Amharic', 'አማርኛ', 0),
('ar', 'Arabic', 'العربية', 0),
('as', 'Assamese', 'অসমীয়া', 0),
('ay', 'Aymara', 'aymar aru', 0),
('az', 'Azerbaijani', 'Azərbaycanca', 0),
('ba', 'Bashkir', 'башҡорт теле', 0),
('be', 'Byelorussian', 'Беларуская мова', 0),
('bg', 'Bulgarian', 'Български', 0),
('bi', 'Bislama', 'Bislama', 0),
('bn', 'Bengali/Bangla', 'বাংলা', 0),
('bo', 'Tibetan', 'བོད་ཡིག', 0),
('br', 'Breton', 'brezhoneg', 0),
('ca', 'Catalan', 'Català', 0),
('co', 'Corsican', 'Corsu', 0),
('cs', 'Czech', 'Česky', 0),
('cy', 'Welsh', 'Cymraeg', 0),
('da', 'Danish', 'Dansk', 0),
('de', 'German', 'Deutsch', 0),
('dz', 'Dzongkha', 'རྫོང་ཁ', 0),
('el', 'Greek', 'Ελληνικά', 0),
('en', 'English', 'English', 1),
('eo', 'Esperanto', 'Esperanto', 0),
('es', 'Spanish', 'Español', 1),
('et', 'Estonian', 'Eesti keel', 0),
('eu', 'Basque', 'Euskera', 0),
('fa', 'Persian', 'فارسی', 0),
('fi', 'Finnish', 'Suomi', 0),
('fj', 'Fijian', 'vosa Vakaviti', 0),
('fo', 'Faeroese', 'føroyskt', 0),
('fr', 'French', 'Français', 0),
('fy', 'Western Frisian', 'frysk', 0),
('ga', 'Irish', 'Gaeilge', 0),
('gd', 'Scots/Gaelic', 'Gàidhlig', 0),
('gl', 'Galician', 'Galego', 0),
('gn', 'Guarani', 'Avañe''ẽ', 0),
('gu', 'Gujarati', 'ગુજરાતી', 0),
('ha', 'Hausa', ' هَوُسَ', 0),
('hi', 'Hindi', 'हिन्दी', 0),
('hr', 'Croatian', 'hrvatski jezik', 0),
('hu', 'Hungarian', 'Magyar', 0),
('hy', 'Armenian', 'Հայերեն', 0),
('ia', 'Interlingua', 'Interlingua', 0),
('ie', 'Interlingue', 'Interlingue', 0),
('ik', 'Inupiak', 'Iñupiaq', 0),
('in', 'Indonesian', 'Bahasa Indonesia', 0),
('is', 'Icelandic', 'íslenska', 0),
('it', 'Italian', 'Italiano', 0),
('iw', 'Hebrew', ' עברית', 0),
('ja', 'Japanese', '日本語', 0),
('ji', 'Yiddish', 'ייִדיש', 0),
('jw', 'Javanese', 'basa Jawa', 0),
('ka', 'Georgian', 'ქართული', 0),
('kk', 'Kazakh', 'Қазақ тілі', 0),
('kl', 'Greenlandic', 'kalaallisut', 0),
('km', 'Cambodian', 'ភាសាខ្មែរ', 0),
('kn', 'Kannada', 'ಕನ್ನಡ', 0),
('ko', 'Korean', '한국어', 0),
('ks', 'Kashmiri', 'कॉशुर, کٲشُر', 0),
('ku', 'Kurdish', 'Kurdî', 0),
('ky', 'Kirghiz', 'кыргыз тили', 0),
('la', 'Latin', 'Latinum', 0),
('ln', 'Lingala', 'Lingala', 0),
('lo', 'Laothian', 'ພາສາລາວ', 0),
('lt', 'Lithuanian', 'Lietuvių', 0),
('lv', 'Latvian/Lettish', 'Latviešu', 0),
('mg', 'Malagasy', 'Malagasy fiteny', 0),
('mi', 'Maori', 'te reo Māori', 0),
('mk', 'Macedonian', 'Македонски', 0),
('ml', 'Malayalam', 'മലയാളം', 0),
('mn', 'Mongolian', 'монгол хэл', 0),
('mr', 'Marathi', 'मराठी', 0),
('ms', 'Malay', 'Bahasa Melayu', 0),
('mt', 'Maltese', 'Malti', 0),
('my', 'Burmese', 'ျမန္မာစာ', 0),
('na', 'Nauruan', 'Ekakairũ Naoero', 0),
('ne', 'Nepali', 'नेपाली', 0),
('nl', 'Dutch', 'Nederlands', 0),
('no', 'Norwegian', 'Norsk', 0),
('oc', 'Occitan', 'Occitan', 0),
('om', 'Oromo', 'Afaan Oromoo', 0),
('pa', 'Punjabi', 'ਪੰਜਾਬੀ', 0),
('pl', 'Polish', 'Polski', 0),
('ps', 'Pashto/Pushto', 'پښتو', 0),
('pt', 'Portuguese', 'Português', 0),
('qu', 'Quechua', 'Runa Simi', 0),
('rm', 'Romansh', 'rumantsch grischun', 0),
('ro', 'Romanian', 'Română', 0),
('ru', 'Russian', 'Русский', 0),
('rw', 'Kinyarwanda', 'kinyaRwanda', 0),
('sa', 'Sanskrit', 'संस्कृतम्', 0),
('sd', 'Sindhi', 'سنڌي', 0),
('sg', 'Sango', 'yângâ tî sängö', 0),
('si', 'Singhalese', 'සිංහල', 0),
('sk', 'Slovak', 'slovenčina', 0),
('sl', 'Slovenian', 'slovenščina', 0),
('sm', 'Samoan', 'gagana fa''a Samoa', 0),
('sn', 'Shona', 'chiShona', 0),
('so', 'Somali', 'Soomaaliga', 0),
('sq', 'Albanian', 'shqip', 0),
('sr', 'Serbian', 'српски језик', 0),
('ss', 'Swati', 'siSwati', 0),
('st', 'Southern Sotho', 'Sesotho', 0),
('su', 'Sundanese', 'basa Sunda', 0),
('sv', 'Swedish', 'Svenska', 0),
('sw', 'Swahili', 'Kiswahili', 0),
('ta', 'Tamil', 'தமிழ்', 0),
('te', 'Telugu', 'తెలుగు', 0),
('tg', 'Tajik', 'тоҷикӣ', 0),
('th', 'Thai', 'ไทย', 0),
('ti', 'Tigrinya', 'ትግርኛ', 0),
('tk', 'Turkmen', 'Түркмен', 0),
('tl', 'Tagalog', 'Wikang Tagalo', 0),
('tn', 'Tswana', 'Setswana', 0),
('to', 'Tonga', 'chiTonga', 0),
('tr', 'Turkish', 'Türkçe', 0),
('ts', 'Tsonga', 'Xitsonga', 0),
('tt', 'Tatar', 'татарча', 0),
('uk', 'Ukrainian', 'Українська', 0),
('ur', 'Urdu', 'اردو', 0),
('uz', 'Uzbek', 'O''zbek', 0),
('vi', 'Vietnamese', 'Tiếng Việt', 0),
('vo', 'Volapuk', 'Volapük', 0),
('wo', 'Wolof', 'Wolof', 0),
('xh', 'Xhosa', 'isiXhosa', 0),
('yo', 'Yoruba', 'Yorùbá', 0),
('zh', 'Chinese', '中文', 0),
('zu', 'Zulu', 'isiZulu', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `key` varchar(64) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `options`
--

INSERT INTO `options` (`key`, `value`) VALUES
('default_comment_status', 's:4:"open";'),
('default_language_code', 's:2:"en";');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `author` bigint(20) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_published` datetime DEFAULT NULL,
  PRIMARY KEY (`lang`,`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


