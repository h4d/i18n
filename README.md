# ¿Qué es esto?

Es un biblioteca básica para la traducción de cadenas y/o cualquier otra cosa relacionada con la internacionalización y las "locales" del sistema.

# Instalación vía composer:

Esta biblioteca puede instalarse vía composer ejecutando:

    $ composer require h4d/i18n
    
__NOTA__: Para el correcto functionamiento de la bibioteca deben estar instaladas en el sistemas las bibliotecas gettext y los correspondientes paquetes de locales (para cada uno de los idiomas a los que se quiera dar soporte). Por ejemplo, en el caso de la Ubuntu habría que:

1. Instalar gettext: 
    
        apt-get install gettext

2. Instalar los packs de idiomas que necesitemos, por ejemplo para el español: 
        
        apt-get install language-pack-es

    
# Ejemplos del uso del traductor:

## Traductor tirando de fichero csv

Ejemplo básico de un traductor tirando de ficheros CSV localizados en el directorio _./data_. Los nombres de los ficheros deben coincidir con el del idioma. En el caso del ejemplo debe existir un fichero llamado _es_ES.csv_ en el directorio _./data_.

    use H4D\I18n\Translator;
    use H4D\I18n\Translator\Adapters\CsvAdapter;

    try
    {
        // New CSV adaptor instance (CSV file: ./data/es_ES.csv)
        $adapter = new CsvAdapter('es_ES', [CsvAdapter::OPTION_TRANSLATIONS_DIRECTORY=>__DIR__.'/data']);
    
        // New translator instace
        $translator = new Translator($adapter);
    
        // Translate a simple string
        $translated = $translator->translate('Simple string.');
        printf('Translated string: %s' . PHP_EOL, $translated);
    
        // Translate a string with vars
        $translated = $translator->translate('Hello %s!', 'Pakito');
        printf('Translated string: %s' . PHP_EOL, $translated);
    
    }
    catch (\Exception $e)
    {
        printf('EXCEPTION!!: %s'.PHP_EOL, $e->getMessage());
    }

Para "capturar" en un fichero las cadenas que no tienen traducción disponible se pueden emplear las siguientes opciones (segundo parámetro del constructor de los adaptadores):

- __OPTION_LOG_UNTRANSLATED_STRING__ (bool): true=>se capturan del cadenas que no tienen traducción, false=>no se capturan las cadenas sin traducción.
- __OPTION_UNTRANSLATED_STRING_LOG_FILE__ (string): Ruta del fichero en la que se guardarán las cadenas sin traducción.

```
// New CSV adaptor instance (CSV file: ./data/es_ES.csv) + capture untranslated strings to ./untranslated.txt
$adapter = new CsvAdapter('es_ES', [CsvAdapter::OPTION_TRANSLATIONS_DIRECTORY=>__DIR__.'/data',
                                    CsvAdapter::OPTION_LOG_UNTRANSLATED_STRING=>true,
                                    CsvAdapter::OPTION_UNTRANSLATED_STRING_LOG_FILE=>__DIR__.'/untranslated.txt']);
```

## Traductor tirando de gettext

Ejemplo básico de un traductor tirando de ficheros gettext (.mo) localizados en el directorio _./data_. 

Por requerimientos de gettext, dentro del directorio indicado debe existir una estructura de directorios como la siguiente:

    .
    ├── en_GB
    │   └── LC_MESSAGES
    │       ├── test.mo
    │       └── test.po
    └── es_ES
        └── LC_MESSAGES
            ├── test.mo
            └── test.po

Los directorios de idiomas deben seguir el formato _ll_cc_ donde _ll_ es un código ISO-639 de dos letras que representa el idioma y _cc_ es un código ISO-3166 de dos letras que representa el país. Los ficheros *.po y *.mo pueden tener cualquier nombre que queramos.
 

    use H4D\I18n\Translator;
    use H4D\I18n\Translator\Adapters\GettextAdapter;
    
    try
    {
        // New Gettext adaptor instance (use .mo file located in ./data/es_ES/LC_MESSAGES directory with name "test")
        $adapter = new GettextAdapter('es_ES.UTF-8',
                                      [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY => __DIR__ . '/data',
                                       GettextAdapter::OPTION_TRANSLATIONS_DOMAIN => 'test']);
    
        // New translator instace
        $translator = new Translator($adapter);
    
        // Translate a simple string
        $translated = $translator->translate('Simple string.');
        printf('Translated string: %s' . PHP_EOL, $translated);
    
        // Translate a string with vars
        $translated = $translator->translate('Hello %s!', 'Pakito');
        printf('Translated string: %s' . PHP_EOL, $translated);
    
    }
    catch (\Exception $e)
    {
        printf('EXCEPTION!!: %s'.PHP_EOL, $e->getMessage());
    }

Al igual que con el adaptador de ficheros CSV se podrían capturar las cadenas sin traducción empleando las opciones __OPTION_LOG_UNTRANSLATED_STRING__ y __OPTION_UNTRANSLATED_STRING_LOG_FILE__.

    $adapter = new GettextAdapter('es_ES.UTF-8',
                                  [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY => __DIR__ . '/data',
                                   GettextAdapter::OPTION_TRANSLATIONS_DOMAIN => 'test',
                                   GettextAdapter::OPTION_LOG_UNTRANSLATED_STRING => true,
                                   GettextAdapter::OPTION_UNTRANSLATED_STRING_LOG_FILE => __DIR__
                                                                                          . '/unstranslated.txt']);
